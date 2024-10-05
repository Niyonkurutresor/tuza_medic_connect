document.addEventListener('turbo:load', loadSettingData)

let form;
let phone;
let prefixCode;
let loadData = false;

function loadSettingData() {
    let settingCountryId = $('#settingCountryId').val();
    let settingStateId = $('#settingStateId').val();
    let settingCityId = $('#settingCityId').val();
    if (settingCountryId != '') {
        $('#settingCountryId').val(settingCountryId).trigger('change')

        setTimeout(function () {
            $('#settingStateId').val(settingStateId).trigger('change')
        }, 800)

        setTimeout(function () {
            $('#settingCityId').val(settingCityId).trigger('change')
        }, 400)

        loadData = true
    }

    if (!$('#generalSettingForm').length) {
        return
    }

    form = document.getElementById('generalSettingForm')

    phone = document.getElementById('phoneNumber').value
    prefixCode = document.getElementById('prefix_code').value

    let input = document.querySelector('#defaultCountryData')
    let intl = window.intlTelInput(input, {
        initialCountry: defaultCountryCodeValue,
        separateDialCode: true,
        geoIpLookup: function (success, failure) {
            $.get('https://ipinfo.io', function () {
            }, 'jsonp').always(function (resp) {
                var countryCode = (resp && resp.country)
                    ? resp.country
                    : ''
                success(countryCode)
            })
        },
        utilsScript: '../../public/assets/js/inttel/js/utils.min.js',
    })
    let getCode = intl.selectedCountryData['name'] + ' +' + intl.selectedCountryData['dialCode']
    $('#defaultCountryData').val(getCode)
}

listenKeyup('#defaultCountryData', function () {
    let str2 = $(this).val().slice(0, -1) + ''
    return $(this).val(str2)
});

listenClick('.iti__standard', function () {
    let currentSelectedFlag = $(this).parent().parent().parent().next();
    $(this).attr('data-country-code');
    if (currentSelectedFlag.has('#defaultCountryCode')) {
        $('#defaultCountryCode').val($(this).attr('data-country-code'));
    }
    let CountryDataVal = $(this).children('.iti__country-name').text() + ' ' + $(this).children('.iti__dial-code').text();
    $('#defaultCountryData').val(CountryDataVal);
});

listenChange('#settingCountryId', function () {
    $.ajax({
        url: route('states-list'),
        type: 'get',
        dataType: 'json',
        data: {settingCountryId: $(this).val()},
        success: function (data) {
            $('#settingStateId').empty()
            $('#settingCityId').empty()
            $('#settingStateId').append(
                $('<option value=""></option>').text(Lang.get('js.select_state')))
            $('#settingCityId').append(
                $('<option value=""></option>').text(Lang.get('js.select_city')))
            $.each(data.data.states, function (i, v) {
                $('#settingStateId').append(
                    $(`<option ${(!loadData && i == data.data.state_id) ? 'selected' : ''}></option>`)
                    .attr('value', i).text(v))
            })
        },
    })
})

listenChange('#settingrecaptcha',function() {
    let settingrechapcha = $('#settingrecaptcha').prop("checked");
    if (settingrechapcha ==  false) {
        $('.recaptcha-field').css('display','none');
    }else{
        $('.recaptcha-field').css('display','block');
    }
})

listenChange('#settingStateId', function () {
    $('#settingCityId').empty()
    $.ajax({
        url: route('cities-list'),
        type: 'get',
        dataType: 'json',
        data: {stateId: $(this).val()},
        success: function (data) {
            $('#settingCityId').empty()
            $('#settingCityId').append(
                $('<option value=""></option>').text(Lang.get('js.select_city')))
            $.each(data.data.cities, function (i, v) {
                $('#settingCityId').append($(`<option ${(loadData && i == data.data.city_id) ? 'selected' : ''}></option>`)
                .attr('value', i).text(v))
            })
        },
    })
})

listenClick('#settingSubmitBtn', function () {
    let checkedPaymentMethod = $(
        'input[name="payment_gateway[]"]:checked').length
    if (!checkedPaymentMethod) {
        displayErrorMessage(Lang.get('js.select_payment'))
        return false
    }

    if ($('#error-msg').text() !== '') {
        $('#phoneNumber').focus()
        displayErrorMessage(Lang.get('js.contact_number') + $('#error-msg').text())
        return false
    }

    $("#generalSettingForm")[0].submit()
})
