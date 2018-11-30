function relation() {
    $(document).ready(function () {
        $('svg').mousemove(function () {
            console.log('aaa');
            $('#search-tip-input').val('aaaaaa').trim();
        });
    });
}

setInterval(relation, 5000);
