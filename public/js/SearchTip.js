$(document).ready(function () {

    $('.Is_A').click(function () {
        $('#search-tip-input').val('Is A');
        var rows = $('.table-search').find('.collapsed-box').hide();
        rows.filter(":contains('is a')").show();
    });

    $('.Part_Of').click(function () {
        $('#search-tip-input').val('Part Of');
        var rows = $('.table-search').find('.collapsed-box').hide();
        rows.filter(":contains('part of')").show();
    });

    $('.Has_Part').click(function () {
        $('#search-tip-input').val('Has Part');
        var rows = $('.table-search').find('.collapsed-box').hide();
        rows.filter(":contains('has part')").show();
    });

    $('.Contains').click(function () {
        $('#search-tip-input').val('Contains');
        var rows = $('.table-search').find('.collapsed-box').hide();
        rows.filter(":contains('contains')").show();
    });

    $('.Realizes').click(function () {
        $('#search-tip-input').val('Realizes');
        var rows = $('.table-search').find('.collapsed-box').hide();
        rows.filter(":contains('realizes')").show();
    });

    $('.Realized_in').click(function () {
        $('#search-tip-input').val('Realized In');
        var rows = $('.table-search').find('.collapsed-box').hide();
        rows.filter(":contains('realized in')").show();
    });

    $('.Contained_in').click(function () {
        $('#search-tip-input').val('Contained In');
        var rows = $('.table-search').find('.collapsed-box').hide();
        rows.filter(":contains('contained in')").show();
    });

    $('.Involved_in').click(function () {
        $('#search-tip-input').val('Involved In');
        var rows = $('.table-search').find('.collapsed-box').hide();
        rows.filter(":contains('involved in')").show();
    });

    $('.Located_in').click(function () {
        $('#search-tip-input').val('Located In');
        var rows = $('.table-search').find('.collapsed-box').hide();
        rows.filter(":contains('located in')").show();
    });

    $('.Member_Of').click(function () {
        $('#search-tip-input').val('Member Of');
        var rows = $('.table-search').find('.collapsed-box').hide();
        rows.filter(":contains('member of')").show();
    });



    $("#search-tip-input").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $(".collapsed-box").filter(function(){
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});


