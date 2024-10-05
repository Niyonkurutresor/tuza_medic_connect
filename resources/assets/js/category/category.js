'use strict';

Livewire.hook('element.init', ({ component, el }) => {
   if ($('#medicineCategoryHead').length) {
      $('#medicineCategoryHead').select2()
  }
})

listenClick('.add-category', function () {
    $('#add_categories_modal').modal('show').appendTo('body')
})
listenSubmit('#addMedicineCategoryForm', function (event) {
        event.preventDefault();
        var loadingButton = jQuery(this).find('#medicineCategorySave');
        loadingButton.button('loading');
        $.ajax({
            url: $('#indexCategoryCreateUrl').val(),
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#add_categories_modal').modal('hide');
                    Livewire.dispatch('refresh')

                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
            complete: function () {
                loadingButton.button('reset');
            },
        });
});

listenSubmit('#editMedicineCategoryForm', function (event) {
        event.preventDefault();
        var loadingButton = jQuery(this).find('#editCategorySave');
        loadingButton.button('loading');
        var id = $('#editMedicineCategoryId').val();
        $.ajax({
            url: route('categories.update',id),
            type: 'put',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message)
                    $('#edit_categories_modal').modal('hide')
                    if ($('#categoriesShowUrl').length) {
                        window.location.href = $('#categoriesShowUrl').val()
                    } else {
                        Livewire.dispatch('refresh')
                    }
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message)
            },
            complete: function () {
                loadingButton.button('reset');
            },
        });
});

listen('hidden.bs.modal', '#add_categories_modal', function () {
        resetModalForm('#addMedicineCategoryForm', '#medicineCategoryErrorsBox');
});

listen('hidden.bs.modal', '#edit_categories_modal', function () {
        resetModalForm('#editMedicineCategoryForm', '#editMedicineCategoryErrorsBox');
});

function renderCategoryData(id) {
        $.ajax({
            url: route('categories.edit',id),
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    let category = result.data;
                    $('#editMedicineCategoryId').val(category.id);
                    $('#editCategoryName').val(category.name);
                    if (category.is_active === 1)
                        $('#editCategoryIsActive').prop('checked', true);
                    else
                        $('#editCategoryIsActive').prop('checked', false);
                    $('#edit_categories_modal').modal('show');
                    ajaxCallCompleted();
                }
            },
            error: function (result) {
                manageAjaxErrors(result);
            },
        });
}

listenClick('.category-edit-btn', function (event) {
        if ($('.ajaxCallIsRunning').val()) {
            return;
        }
        ajaxCallInProgress();
        let categoryId = $(event.currentTarget).attr('data-id');
        renderCategoryData(categoryId);
});

listenClick('.category-delete-btn', function (event) {
        let categoryId = $(event.currentTarget).attr('data-id');
        deleteItem(route('categories.destroy',categoryId),
            Lang.get('js.category'));
});

// category activation deactivation change event
listenChange('.medicine-category-status', function (event) {
        let categoryId = $(event.currentTarget).attr('data-id');
    activeDeActiveCategory(categoryId);
});
listenClick('#categoryResetFilter', function () {
    $('#medicineCategoryHead').val(0).trigger('change');
    hideDropdownManually($('#medicineCategoryFilterBtn'),
        $('.dropdown-menu'));
});

// activate de-activate category
function activeDeActiveCategory(id) {
        $.ajax({
            url: route('active.deactive',id),
            method: 'post',
            cache: false,
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    Livewire.dispatch('refresh')
                }
            },
        });
};

listenChange('#medicineCategoryHead', function () {
        Livewire.dispatch('changeFilter', { value: $(this).val(),});
        hideDropdownManually($('#medicineCategoryFilterBtn'),
            $('#medicineCategoryFilter'));
});
