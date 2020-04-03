$(document).ready(function () {
    $('#preloader').delay(1000).fadeOut();


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


    // Set the tooltips in the homepage

    tippy('#night-mode', {
        content: "Turn ON/OFF the night mode"
    });

    tippy('#control-sidebar', {
        content: "Show/Hide the Sidebar"
    });

    tippy('#open-error-console', {
        content: "Opens the error console"
    });

    tippy('.fa-download', {
        content: "Downloads a .txt file containing all the current errors in the ontology"
    });

    tippy('#errors', {
        content: "The number of errors in your current ontology"
    });

    tippy('#warnings', {
        content: "The number of warnings in your current ontology"
    });

    tippy('.fa-question-circle', {
        content: "Click to see more information!"
    });

    tippy('#classes', {
        content: "The number of classes in your current ontology"
    });

    tippy('#relations', {
        content: "The number of relations in your current ontology"
    });

    tippy('#instances', {
        content: "The number of instances in your current ontology"
    });

});



