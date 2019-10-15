$(document).ready(function () {
    $('#preloader').delay(1000).fadeOut();

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

    $('.geItem').click(function () {
       $('ul .menu').append(' <li>\n' +
           '                                            <a href="#">\n' +
           '                                                <i class="fa fa-warning text-yellow"></i> Dont forget to save your ontology \n' +
           '                                            </a>\n' +
           '                                        </li>');

       $('#notification-counter').text(1);

    });

    $("#notifications-menu").click(function () {
            $('#notification-counter').text('');
    });

});



