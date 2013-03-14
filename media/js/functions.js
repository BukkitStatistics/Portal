function callModulePage(id, total, page, max) {
    if (max == undefined)
        max = 5;

    $('#' + id + 'Pagination').bootpag({
        total: total,
        page: page,
        maxVisible: max
    }).on("page", function (event, num) {
            var content = $(event.target).parents('div[data-mod]');
            var data = content.data('last-call');

            if (data != undefined) {
                var type = data['type'];
                var sort = data['sort'];
            }

            callModule(type, sort, content, num);
        });
}

function callModule(type, sort, content, page) {
    var location = window.location.href.split('?')[0];
    if (page == undefined)
        page = 1;

    var loader = $('<div style="display: none;" class="alert alert-info ajax-loader"><h5><i class="icon-spinner icon-spin"></i> Loading..</h5></div>');
    loader.appendTo('body').fadeIn();

    loader.offset({
        top: $(window).scrollTop() + 60,
        left: 20
    })

    $.ajax({
        type: "GET",
        url: location,
        data: {
            'mod': content.data('mod'),
            'order_by': type,
            'order_sort': sort,
            'page': page
        },
        success: function (data) {
            if (data != 'ajax_error') {
                loader.removeClass('alert-info')
                    .addClass('alert-success')
                    .delay(500)
                    .fadeOut('slow', function() {
                        $(this).remove();
                    });
                content.data('last-call', {'type': type, 'sort': sort});
                content.html(data);

                if (sort != undefined) {
                    if (sort.toLowerCase() == 'desc')
                        sort = 'asc';
                    else
                        sort = 'desc';

                    content.find('.sort-button[data-type="' + type + '"]').data('sort', sort);
                }
            } else {
                loader.removeClass('alert-info')
                    .addClass('alert-error')
                    .html('<h3><i class="icon-exclamation-sign"></i> Error.</h3>')
                    .delay(1000)
                    .fadeOut('slow', function () {
                        $(this).remove();
                    });
            }
        }
    });
}