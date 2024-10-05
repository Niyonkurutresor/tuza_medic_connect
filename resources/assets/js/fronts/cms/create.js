document.addEventListener('turbo:load', loadFrontCMSData)

function loadFrontCMSData () {

    $('#cmsShortDescription').on('keyup', function () {
        $('#cmsShortDescription').attr('maxlength', 800)
    })
    $('#cmsShortDescription').attr('maxlength', 800)

    if (!$('#cmsTermConditionId').length) {
        return
    }

    let quill1 = new Quill('#cmsTermConditionId', {
        modules: {
            toolbar: [
                [
                    {
                        header: [1, 2, false],
                    }],
                ['bold', 'italic', 'underline'],
                ['image', 'code-block'],
            ],
        },
        placeholder: Lang.get('js.terms_conditions'),
        theme: 'snow', // or 'bubble'
    })
    quill1.on('text-change', function (delta, oldDelta, source) {
        if (quill1.getText().trim().length === 0) {
            quill1.setContents([{ insert: '' }])
        }
    })

    if (!$('#cmsPrivacyPolicyId').length) {
        return
    }

    let quill2 = new Quill('#cmsPrivacyPolicyId', {
        modules: {
            toolbar: [
                [
                    {
                        header: [1, 2, false],
                    }],
                ['bold', 'italic', 'underline'],
                ['image', 'code-block'],
            ],
        },
        placeholder: Lang.get('js.privacy_policy'),
        theme: 'snow', // or 'bubble'
    })
    quill2.on('text-change', function (delta, oldDelta, source) {
        if (quill2.getText().trim().length === 0) {
            quill2.setContents([{ insert: '' }])
        }
    })

    let element = document.createElement('textarea')
    element.innerHTML = $('#cmsTermConditionData').val();
    quill1.root.innerHTML = element.value

    element.innerHTML = $('#cmsPrivacyPolicyData').val();
    quill2.root.innerHTML = element.value

    listenSubmit('#addCMSForm', function () {
        let title = $('#aboutTitleId').val()
        let empty = title.trim().replace(/ \r\n\t/g, '') === ''
        let description = $('#cmsShortDescription').val()
        let empty2 = description.trim().replace(/ \r\n\t/g, '') === ''

        if (empty) {
            displayErrorMessage(
                Lang.get('js.title_no_white_space') )
            return false
        }

        if (empty2) {
            displayErrorMessage(
                Lang.get('js.description_no_white_space') )
            return false
        }

        if ($('#aboutExperience').val() === '') {
            displayErrorMessage(Lang.get('js.experience_required'))
            return false
        }

        let element = document.createElement('textarea')
        let editor_content_1 = quill1.root.innerHTML
        element.innerHTML = editor_content_1
        let editor_content_2 = quill2.root.innerHTML

        if (quill1.getText().trim().length === 0) {
            displayErrorMessage(Lang.get('js.Terms_Conditions_required'))
            return false
        }

        if (quill2.getText().trim().length === 0) {
            displayErrorMessage(Lang.get('js.privacy_policy_required'))
            return false
        }

        $('#termData').val(JSON.stringify(editor_content_1))
        $('#privacyData').val(JSON.stringify(editor_content_2))

    })
}

