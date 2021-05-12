function onReady(callback) {
    var intervalId = window.setInterval(function () {
        if (document.getElementsByTagName('body')[0] !== undefined) {
            window.clearInterval(intervalId);
            callback.call(this);
        }
    }, 2000);
}

function setVisible(selector, visible) {
    document.querySelector(selector).style.display = visible ? 'block' : 'none';
}

function buildMenu() {
    // Append the extra Onto4all buttons in the toolbar
    if(document.getElementsByClassName('geToolbar')[0].childElementCount < 22 || document.getElementsByClassName('geMenubar')[0].childElementCount < 7)
    {
        $(".geToolbar").append('<div class="geSeparator"> </div>');
        $(".geToolbar").append($('#control-sidebar, #classes, #relations, #instances, #download-ontology-report, #open-last-updated-ontology'));
        $(".geMenubar").append($('#open-ontology, #ontology-name, #edit-ontology, #save-ontology'));
    }
}

setInterval(buildMenu, 2000);

onReady(function () {
    setVisible('body', true);
    setVisible('#loading', false);
});

$(document).ready(function () {

    // Select2 Plugin
    $(document).ready(function () {
        $('.js-example-basic-multiple').select2(
            {theme: 'classic'}
        );
    });

    // Progress bar from the Methodology tab
    let percentage = $("#progress-bar").width() / $('#progress-bar').offsetParent().width() * 100;
    $('input[type="checkbox"]').click(function () {
        if ($(this).prop("checked")) {
            $(this).closest('li').attr('class', 'done');
            percentage = percentage + 12.5;
            $('#progress-bar').width(percentage + '%').attr('aria-valuenow', percentage);
            console.log(percentage);

        } else {
            $(this).closest('li').attr('class', '');
            percentage = percentage - 12.5;
            $('#progress-bar').width(percentage + '%').attr('aria-valuenow', percentage);

        }
        $('#progress-text').text(percentage + "% complete");

    });
});



