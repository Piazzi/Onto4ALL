$(document).ready(function () {

    $(".geSidebar .geItem").click(function () {
      let name =  $(this).attr('class');
      name = name.replace("geItem", "").trim();
      $('#search-tip-input').attr('value', name);
      $("#menu-scroll .collapsed-box").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(name) > -1)
      });
    });

    $("#search-tip-input").on("keyup", function () {
        var value = $(this).val().toLowerCase();

        $("#menu-scroll .collapsed-box").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });

    });
});


