function ModalFormHandler(buttonSelector, modalUrl, formSelector, selectSelector) {
    $(document).on('click', buttonSelector, function () {
        $('#modal-tag').modal('show');
        $.get({
            url: modalUrl,
            success: function (response) {
                $('#modal-tag-content').html(response);
            }
        });
    });

    $(document).on('submit', formSelector, function (e) {
        e.preventDefault();
        const form = $(this)[0]; // natív DOM elem
        const formData = new FormData(form);

        $.ajax({
            url: $(form).attr('action'),
            method: 'POST',
            data: formData,
            processData: false, // ne alakítsa át a formData-t query stringgé
            contentType: false, // ne állítson be content-type fejlécet
            success: function (response) {
                const newId = response.id;
                const newText = response.name;
                const select = $(selectSelector);

                $('#modal-tag').modal('hide');

                if (select.find('option[value="' + newId + '"]').length === 0) {
                    const newOption = new Option(newText, newId, true, true);
                    select.append(newOption).trigger('change');
                }
            }
        });
    });
}


ModalFormHandler(
    '#btn-new-tag',
    '/tag/create',
    '#tag-form',
    '#meal-tag_ids'
)

ModalFormHandler(
    '#btn-new-allergen',
    '/allergen/create',
    '#allergen-form',
    '#meal-allergens'
)

ModalFormHandler(
    '#btn-new-category',
    '/category/create',
    '#category-form',
    '#meal-category_id'
)

