window.onload = function () {
    // Append the extra Onto4all buttons in the toolbar
    $(".geToolbar").append('<div class="geSeparator"> </div>');
    $(".geToolbar").append($('#control-sidebar'));
    $(".geToolbar").append($('#night-mode'));
    $(".geToolbar").append($('#classes'));
    $(".geToolbar").append($('#relations'));
    $(".geToolbar").append($('#instances'));
    $(".geToolbar").append($('#download-ontology-report'));
    $(".geToolbar").append($('#open-last-updated-ontology'));

    $(".geMenubar").append($('#open-ontology'));
    $(".geMenubar").append($('#ontology-name'));
    $(".geMenubar").append($('#edit-ontology'));
    $(".geMenubar").append($('#save-ontology'));


};