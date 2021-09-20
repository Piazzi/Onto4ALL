var geToolbar = document.getElementsByClassName('geToolbar');
var geMenubar = document.getElementsByClassName('geMenubar');
var toolbarIcon = document.getElementsByClassName('toolbar-icon');
var menubarIcon = document.getElementsByClassName('menubar-icon');
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
        $(".geToolbar").append(toolbarIcon);
        $(".geMenubar").append(menubarIcon);
    }
}

setInterval(buildMenu, 2000);

onReady(function () {
    setVisible('body', true);
    setVisible('#loading', false);
});

document.addEventListener("DOMContentLoaded", function() { 

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
    let percentage = document.getElementById('progress-bar').clientWidth / document.getElementById('progress-bar').offsetParent().clientWidth * 100;
    document.querySelector('input[type="checkbox"]').addEventListener('click', function () {
        if (this.checked) {
            this.closest('li').setAttribute('class', 'done');
            percentage = percentage + 12.5;
            document.getElementById('progress-bar').clientWidth = percentage + '%';
            document.getElementById('progress-bar').setAttribute('aria-valuenow', percentage);
            console.log(percentage);

        } else {
            this.closest('li').attr('class', '');
            percentage = percentage - 12.5;
            document.getElementById('progress-bar').clientWidth = percentage + '%';
            document.setAttribute('aria-valuenow', percentage);

        }
        document.getElementById('progress-text').textContent = percentage + "% complete";

    });
});

    document.getElementById('search-tip-input').addEventListener("keyup", function () {
        let value = this.value.toLowerCase();
        document.querySelectorAll('#menu-scroll .collapsed-box').filter(function () {
            if(this.textContent.toLowerCase().indexOf(value) > -1){
                this.style.visibility = "visible";
            }
            else{
                this.style.visibility = "hidden";
            }
        });
    });
