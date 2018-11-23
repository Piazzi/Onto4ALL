$(document).ready(function () {
    $("#search-tip-input").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#tipSearch *").filter(function(){
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
