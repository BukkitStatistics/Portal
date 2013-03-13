$(document).ready(function() {
    // sidebar
    setTimeout(function () {
        $('body').scrollspy({
            target: '.nav-sidebar',
            offset: 66
        });
    }, 100);

    // sortable tables
    $(document).on('click', 'div[data-mod] .sort-button', function () {
        var button = $(this);
        var bdata = button.data();
        var content = button.parents('div[data-mod]');

        callModule(bdata['type'], bdata['sort'], content);
    });
});