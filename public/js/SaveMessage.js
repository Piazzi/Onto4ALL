$(document).ready(function () {
    function showSaveMessage() {
        setTimeout(function () {
            $("#warning").show();
            $("#warning").animate({opacity: '0.4'}, "slow");
            $("#warning").animate({opacity: '0.8'}, "slow");
            $("#warning").animate({opacity: '0.4'}, "slow");
            $("#warning").animate({opacity: '0.8'}, "slow");
            $("#warning").animate({opacity: '0.4'}, "slow");
            $("#warning").animate({opacity: '0.8'}, "slow");
        });
    }

    setInterval(showSaveMessage, 5000);
});



