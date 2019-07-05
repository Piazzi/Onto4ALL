$(document).ready(function () {
    $('#preloader').delay(1500).fadeOut();
    $("#sidebar-control").click(function () {
        $('aside').slideToggle();
        if ($('#sidebar-control-text').text() == 'Hide Sidebar')
            $('#sidebar-control-text').text('Show Sidebar');
        else
            $('#sidebar-control-text').text('Hide Sidebar');

    });
    $(".texto").click(function () {
        $(".tip").slideToggle();
    });
    $("#notification-button").click(function () {
        $(".tip").slideToggle();
        $(".menu").slideToggle();

        if ($('#notification-button-text').text() == 'Hide Tips')
            $('#notification-button-text').text('Show Tips');
        else
            $('#notification-button-text').text('Hide Tips');
    });
});



