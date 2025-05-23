$('#btn-new-tag').on('click', function() {
    $('#modal-tag').modal('show');
    $.get({
        url: '/tag/create',
        success: function (response) {
            $('#modal-tag-content').html(response);
        }
    });
});

$(document).on('submit', '#tag-form', function (e) {
    e.preventDefault();
    const form = $(this);
    $.post({
        url: form.attr('action'),
        data: form.serialize(),
        success: function(response) {
            const newId = response.id;
            const newText = response.name;
            const select = $('#meal-tag_ids');

            $('#modal-tag').modal('hide');

            if (select.find('option[value="' + newId + '"]').length === 0) {
                const newOption = new Option(newText, newId, true, true);
                select.append(newOption).trigger('change');
            }
        },
    })
});

$('#btn-new-allergen').on('click', function() {
    $('#modal-tag').modal('show');
    $.get({
        url: '/allergen/create',
        success: function (response) {
            $('#modal-tag-content').html(response);
        }
    });
});

$(document).on('submit', '#allergen-form', function (e) {
    e.preventDefault();
    const form = $(this);
    $.post({
        url: form.attr('action'),
        data: form.serialize(),
        success: function(response) {
            const newId = response.id;
            const newText = response.name;
            const select = $('#meal-allergens');

            $('#modal-tag').modal('hide');

            if (select.find('option[value="' + newId + '"]').length === 0) {
                const newOption = new Option(newText, newId, true, true);
                select.append(newOption).trigger('change');
            }
        },
    })
});