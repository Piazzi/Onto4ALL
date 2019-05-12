$(document).ready( function() {
    $('#preloader').delay(1500).fadeOut();
    $("#sidebar-control").click(function () {
        $('aside').slideToggle();
    });
    $(".texto").click(function () {
        $(".tip").slideToggle();
    });
    $("#notification-button").click(function () {
        $(".tip").slideToggle();
        $(".menu").slideToggle();
    });
});



