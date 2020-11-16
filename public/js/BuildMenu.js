
function buildMenu() {
    // Append the extra Onto4all buttons in the toolbar
    if(document.getElementsByClassName('geToolbar')[0].childElementCount < 22 || document.getElementsByClassName('geMenubar')[0].childElementCount < 7)
    {
        $(".geToolbar").append('<div class="geSeparator"> </div>');
        $(".geToolbar").append($('#control-sidebar, #classes, #relations, #instances, #download-ontology-report, #open-last-updated-ontology'));
        $(".geMenubar").append($('#open-ontology, #ontology-name, #edit-ontology, #save-ontology'));
    }
}

setInterval(buildMenu, 3000);