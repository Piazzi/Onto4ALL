$(document).ready(function () {

    $('svg').mousemove(function () {
        console.log('aaa');
        $('#search-tip-input').val('aaaaaa');
        $("#search-tip-input").on("input",function () {
            var value = $(this).val().toLowerCase();
            $(".collapsed-box").filter(function(){
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
    });

    });


    $("#search-tip-input").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $(".collapsed-box").filter(function(){
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});


