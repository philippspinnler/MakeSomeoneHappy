$(function() {
    $('#loading-example-btn').click(function () {
        var btn = $(this)
        btn.button('loading')
        setTimeout(function() {
            btn.button("reset")
        }, 1000);
    });
});