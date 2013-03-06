$(document).ready(function() {
    setTimeout(function () {
        $('body').scrollspy({
            target: '.nav-sidebar',
            offset: 66
        });
    }, 100);
});