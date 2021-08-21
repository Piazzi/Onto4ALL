function onReady(callback) {
    var intervalId = window.setInterval(function () {
        if (document.getElementsByTagName('body')[0] !== undefined) {
            window.clearInterval(intervalId);
            callback.call(this);
        }
    }, 2000);
}

function setVisible(selector, visible) {
    document.querySelector(selector).style.display = visible ? 'block' : 'none';
}

function buildMenu() {
    // Append the extra Onto4all buttons in the toolbar
    if(document.getElementsByClassName('geToolbar')[0].childElementCount < 22 || document.getElementsByClassName('geMenubar')[0].childElementCount < 8)
    {
        $(".geToolbar").append('<div class="geSeparator"> </div>');
        $(".geToolbar").append($('.toolbar-icon'));
        $(".geMenubar").append($('.menubar-icon'));
    }
}

setInterval(buildMenu, 2000);

onReady(function () {
    setVisible('body', true);
    setVisible('#loading', false);
});

$(document).ready(function () {

    // Select2 Plugin
    $(document).ready(function () {
        $('.js-example-basic-multiple').select2(
            {theme: 'classic'}
            
        );
        $('.js-example-tags').select2({
            theme: 'classic',
            tags: true
        });
    });

    // Progress bar from the Methodology tab
    let percentage = $("#progress-bar").width() / $('#progress-bar').offsetParent().width() * 100;
    $('input[type="checkbox"]').click(function () {
        if ($(this).prop("checked")) {
            $(this).closest('li').attr('class', 'done');
            percentage = percentage + 12.5;
            $('#progress-bar').width(percentage + '%').attr('aria-valuenow', percentage);
            console.log(percentage);

        } else {
            $(this).closest('li').attr('class', '');
            percentage = percentage - 12.5;
            $('#progress-bar').width(percentage + '%').attr('aria-valuenow', percentage);

        }
        $('#progress-text').text(percentage + "% complete");

    });
});

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


