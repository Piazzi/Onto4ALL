$(document).ready(function() {


    // Change the editor to night mode
    let nightMode = false;

    $("#night-mode").click(function () {
        if(!nightMode)
        {
            // NIGHT MODE
            nightMode = true;
            $(this).text(' ');
            $(this).append('<i class="fa fa-sun-o"></i>');

            $("nav").css("background-color", "#444");
            $(".dropdown-menu").css("background-color", "#444");
            $(".dropdown-menu").css("border-color", "#444");
            $(".user-header").css("background-color", "#444");
            $(".user-header p").css("color", "#00a65a");
            $(".user-footer").css("background-color", "#444");
            $("nav li a ").css("color", "#00a65a");
            $(".user-body a").css("color", "#00a65a", "important");
            $(".user-body ").css("border-color", "#666");
            $(".col-xs-4 a").css("color", "#00a65a !important");
            $("b").css("color", "#00a65a");
            $(".notification-menu .menu li a").css("color", "#00a65a");
            $(".user-footer a").css("background-color", "#444");
            $(".user-footer a ").css("border-color", "#555");

            $(".footer a ").css("background-color", "#444");
            $(".footer a ").css("color", "#00a65a");

            $(".header ").css("background-color", "#444");
            $(".header ").css("color", "#00a65a");
            $(".header ").css("border-color", "#555");

            $(".menu a").css("border-color", "#555");
            $(".menu a").css("color", "#00a65a");
            $(".menu h4").css("color", "#00a65a");

            $(".control-sidebar a").css("background-color", "#444");
            $(".control-sidebar a").css("color", "#f4f4f4");
            $(".control-sidebar a").css("border-color", "#555");
            $(".menu-title").css("color", "#00a65a");

            $(".tab-content").css("background-color", "#444");

            $(".todo-list li").css("background-color", "#444");
            $(".todo-list li").css("border-color", "#555");

            $(".methodology-box").css("background-color", "#555");
            $(".methodology-box").css("border-top", "3px solid #00a65a");
            $(".methodology-title").css("color", "#00a65a");
            $(".fa-text-width").css("color", "#00a65a");
            $(".methodology-footer").css("background-color", "#555");
            $(".methodology-footer h4").css("color", "#f4f4f4");

            $(".main-footer").css("background", "#444");
            $(".main-footer").css("border-top", "1px solid #444");
            $("footer").css("color", "#00a65a");
            $("footer strong a").css("color", "#00a65a");
            $("footer strong ").css("color", "#00a65a");
            $("footer b ").css("color", "#00a65a");

            $("#warnings-console").css("background", "#555");
            $("#warnings-console .box").css("border", "");
            $("#warnings-console-header").css("background-color", "#444");
            $("#warnings-console-header").css("color", "#00a65a");
            $("#warnings-console-header .fa-plus").css("color", "#00a65a");
            $(".fa-question-circle").css("color", "#00a65a");

            $("#control-sidebar-settings-tab .box-header").css("background-color", "#555");
            $("#control-sidebar-settings-tab h4").css("color", "#00a65a");
            $("#control-sidebar-settings-tab .box-header").css("color", "#f4f4f4");
            $("#control-sidebar-settings-tab .box-body").css("background-color", "#555");
            $("#control-sidebar-settings-tab .box-body strong").css("color", "#f4f4f4");
            $("#control-sidebar-settings-tab .box-body p").css("color", "#f4f4f4");

            $("#tipSearch .box-body").css("background-color","#d2d6de");

            $(".geMenubar").css("background-color", "#888");
            $(".geMenubar").css("border-bottom", "1px solid #666");
            $(".geToolbarContainer").css("background-color", "#888");
            $(".geToolbarContainer").css("border-bottom", "1px solid #666");
            $(".geToolbar").css("border-top", "1px");
            $(".geSeparator").css("background", "#777");
            $(".geSidebar").css("background-color", "#888");
            $(".geTitle").css("background-color", "#888");
            $(".geTitle").css("border-bottom", "1px solid #666");
            $(".geSidebarContainer ").css("border-top", "#666");
            $(".geSidebarContainer ").css("background-color", "#999");
            $(".geDialog ").css("background", "#9999");
            $(".mxPopupMenu ").css("background", "#666");
            $(".mxPopupMenuItem span ").css("color", "#333");
            $(".geDiagramBackdrop ").css("background-color", "#d5d5d5");
            $(".geDiagramBackdrop ").css("border", "0px solid #666");
            $(".geFormatContainer ").css("background-color", "#888");
            $(".content-wrapper ").css("background-color", "#888");
            $("#warnings-console  ").css("border", "1px solid #444");
            $("aside ").css("border", "1px");

            $(".geDiagramContainer ").css("background-color", "#777");
            $(".geBackgroundPage ").css("background-color", "#999");

            $(".modal-content").css("background-color", "#888");
            $(".geSidebar input").css("background-color", "#999");


        }
        else
        {
            // NORMAL MODE
            nightMode = false;
            $(this).text(' ');
            $(this).append('<i class="fa fa-moon-o"></i>');

            $("nav").css("background-color", "");
            $(".dropdown-menu").css("background-color", "");
            $(".dropdown-menu").css("border-color", "");
            $(".user-header").css("background-color", "");
            $(".user-header p").css("color", "");
            $(".user-footer").css("background-color", "");
            $("nav li a ").css("color", "");
            $(".dropdown-menu li a ").css("color", "");
            $(".user-body a").css("color", "");
            $(".user-body ").css("border-bottom", "");
            $(".user-body ").css("border-top", "");
            $(".user-body-link ").css("color", "");
            $("b").css("color", "");
            $(".notification-menu .menu li a").css("color", "");

            $(".user-footer a").css("background-color", "");
            $(".user-footer a ").css("border-color", "");

            $(".footer a ").css("background-color", "");
            $(".footer a ").css("color", "");

            $(".header ").css("background-color", "");
            $(".header ").css("color", "");
            $(".header ").css("border-color", "");

            $(".menu a").css("border-color", "");
            $(".menu a").css("color", "");
            $(".menu h4").css("color", "");

            $(".control-sidebar a").css("background-color", "");
            $(".control-sidebar a").css("color", "");
            $(".control-sidebar a").css("border-color", "");
            $(".control-sidebar li a").css("background-color", "");
            $(".control-sidebar .active a").css("background-color", "");

            $(".tab-content").css("background-color", "");
            $("li .active").css("background-color", "");

            $(".todo-list li").css("background-color", "");
            $(".todo-list li").css("border-color", "");
            $(".todo-list a").css("color", "");
            $(".todo-list a").css("background-color", "");

            $(".methodology-box").css("background-color", "");
            $(".methodology-box").css("border-top", "");
            $(".methodology-title").css("color", "");
            $(".fa-text-width").css("color", "");
            $(".methodology-footer").css("background-color", "");
            $(".methodology-footer h4").css("color", "");
            $(".methodology-box").css("border-top-color", "");

            $(".main-footer").css("background", "");
            $(".main-footer").css("border-top", "");
            $("footer").css("color", "");
            $("footer strong").css("color", "");
            $("footer strong a").css("color", "");
            $("footer b ").css("color", "");

            $("#warnings-console").css("background", "");
            $("#warnings-console-header").css("background-color", "");
            $("#warnings-console-header").css("color", "");
            $("#warnings-console-header .fa-plus").css("color", "");
            $(".fa-question-circle").css("color", "");

            $("#control-sidebar-settings-tab .box-header").css("background-color", "");
            $("#control-sidebar-settings-tab h4").css("color", "");
            $("#control-sidebar-settings-tab .box-header").css("color", "");
            $("#control-sidebar-settings-tab .box-body").css("background-color", "");
            $("#control-sidebar-settings-tab .box-body strong").css("color", "");
            $("#control-sidebar-settings-tab .box-body p").css("color", "");
            $("#tipSearch .box-body").css("background-color","");


            $(".geMenubar").css("background-color", "");
            $(".geMenubar").css("border-bottom", "");
            $(".geToolbarContainer").css("background-color", "");
            $(".geToolbarContainer").css("border-bottom", "");
            $(".geToolbar").css("border-top", "");
            $(".geSeparator").css("background", "");
            $(".geSidebar").css("background-color", "");
            $(".geTitle").css("background-color", "");
            $(".geTitle").css("border-bottom", "");
            $(".geSidebarContainer ").css("border-top", "");
            $(".geSidebarContainer ").css("background-color", "");
            $(".geDialog ").css("background", "");
            $(".mxPopupMenu .geMenubarMenu").css("background-color", "");
            $(".mxPopupMenuItem span ").css("color", "grey");
            $(".geDiagramBackdrop ").css("background-color", "");
            $(".geDiagramBackdrop ").css("border", "");
            $(".geFormatContainer ").css("background-color", "");
            $(".content-wrapper ").css("background-color", "");
            $("#warnings-console ").css("border", "");
            $("aside ").css("border", "");

            $(".modal-content").css("background-color", "");

            $(".geSidebar input").css("background-color", "");
            $(".geDiagramContainer ").css("background-color", "");
            $(".geBackgroundPage ").css("background-color", "");



        }
    });

});