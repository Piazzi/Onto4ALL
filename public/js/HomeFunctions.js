function onReady(callback) {
    var intervalId = window.setInterval(function() {
        if (document.getElementsByTagName('body')[0] !== undefined) {
            window.clearInterval(intervalId);
            callback.call(this);
        }
    }, 1000);
}

function setVisible(selector, visible) {
    document.querySelector(selector).style.display = visible ? 'block' : 'none';
}

onReady(function() {
    setVisible('body', true);
    setVisible('#loading', false);
});

$(document).ready(function () {


    // Progress bar from the Methodology tab
    let percentage = $("#progress-bar").width() / $('#progress-bar').offsetParent().width()*100;
    $('input[type="checkbox"]').click(function () {
        if ($(this).prop("checked")) {
            $(this).closest('li').attr('class', 'done');
            percentage = percentage + 12.5;
            $('#progress-bar').width(percentage+'%').attr('aria-valuenow',percentage);
            console.log(percentage);

        } else {
            $(this).closest('li').attr('class', '');
            percentage = percentage -12.5;
            $('#progress-bar').width(percentage+'%').attr('aria-valuenow',percentage);

        }
        $('#progress-text').text(percentage + "% complete");

    });

    /// Send a notification to the notification menu
    $('.geItem').click(function () {
       $('ul .notification-menu').append(' <li>\n' +
           '                                            <a href="#">\n' +
           '                                                <i class="fa fa-warning text-yellow"></i> Dont forget to save your ontology \n' +
           '                                            </a>\n' +
           '                                        </li>');

       $('#notification-counter').text(1);

    });

    // Notification counter
    $("#notifications-menu").click(function () {
            $('#notification-counter').text('');
    });


    // Downloads a .txt file containing all the errors that the user made in the current drawing
    $('#download-errors-txt').click(function () {
        let texts = $('.direct-chat-text').text();
        this.href = "data:text/plain;charset=UTF-8," + encodeURIComponent(texts);
    });

    // Change the text on the sidebar-control button
    let hideSidebar = false;

    $("#control-sidebar").click(function () {
        hideSidebar = !hideSidebar;
    });

    // Build the menu
    $(".geToolbar").append('<div class="geSeparator"> </div>');
    $(".geToolbar").append($('#night-mode'));
    $(".geToolbar").append($('#classes'));
    $(".geToolbar").append($('#relations'));
    $(".geToolbar").append($('#instances'));
    $(".geToolbar").append($('#download-ontology-report'));


});



