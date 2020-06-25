
    /**
     * When a user clicks on the ontology palette the name of
     * the class or relation is searched in the tips menu
     */
    $(".geSidebar .geItem").click(function () {
        let name =  $(this).attr('class');
        name = name.replace("geItem", "").trim();
        if(name != 'Class' && name != 'Callout' && name != 'Textbox' && name != 'Text' && name != 'Instance' && name != 'new_relation')
        {
            $('#search-tip-input').attr('value', name);
            $("#menu-scroll .collapsed-box").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(name) > -1)
            });
        }
    });

    $("#search-tip-input").on("keyup", function () {
        let value = $(this).val().toLowerCase();

        $("#menu-scroll .collapsed-box").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });

    });




