$(document).ready( function() {
    $('#preloader').delay(3000).fadeOut();
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



