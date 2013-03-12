$(document).ready(function() {
    // sidebar
    setTimeout(function () {
        $('body').scrollspy({
            target: '.nav-sidebar',
            offset: 66
        });
    }, 100);

    $(document).on('click', '.sort-button', function () {
        var sort = 'desc';
        var button = $(this);
        var bdata = button.data();
        var content = button.parents('div[data-mod]');
        var location = window.location.href.split('?')[0];

        if (bdata['sort'].toLowerCase() == 'desc')
            sort = 'asc';

        $.ajax({
            type: "GET",
            url: location,
            data: {
                'order_by': bdata['type'],
                'order_sort': bdata['sort'],
                'mod': content.data('mod')
            },
            success: function (data) {
                content.html(data);
                content.find('.sort-button[data-type="' + bdata['type'] + '"]').data('sort', sort);
            }
        });
    });
});