$(function() {
    var loading = function() {
        var body = document.getElementsByTagName('body');

        var node = document.createElement('<div id="overlay"><div class="loader more"></div></div>');

        document.body.appendChild(node);
        // hit escape to close the overlay
        $(document).keyup(function(e) {
            if (e.which === 27) {
                $('#overlay').remove();
            }
        });
    };
    $('button').click(loading);
});
