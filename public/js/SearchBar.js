$(document).ready(function () {
    $("#table-search-input").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#table-search tr").filter(function(){
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
