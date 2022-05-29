$('#save_value').click(function() {
    let sel = $('input[type=checkbox]:checked').map(function(_, el) {
        return $(el).val();
    }).get();
    let checkboxValues = String(sel).split(',').sort().join(',');
    $('#ontology').attr('value', checkboxValues);
});