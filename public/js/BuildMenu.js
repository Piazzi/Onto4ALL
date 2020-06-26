window.onload = function () {
    // Append the extra Onto4all buttons in the toolbar
    $(".geToolbar").append('<div class="geSeparator"> </div>');
    $(".geToolbar").append($('#night-mode'));
    $(".geToolbar").append($('#classes'));
    $(".geToolbar").append($('#relations'));
    $(".geToolbar").append($('#instances'));
    $(".geToolbar").append($('#download-ontology-report'));
    $(".geToolbar").append($('#control-sidebar'));
    $(".geMenubar").append($('#ontology-name'));
    $(".geMenubar").append($('#edit-ontology'));
    $(".geMenubar").append($('#save-ontology'));


};