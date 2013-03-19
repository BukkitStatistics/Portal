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

    /*
    Player search
    thanks to: @mrgcohen (http://gist.github.com/mrgcohen)
     */
    window.query_cache = {};
    $('#playerSearch').typeahead({
        source: function (query, process) {
            if (query_cache[query]) {
                process(query_cache[query]);
                return;
            }
            if (typeof searching != "undefined") {
                clearTimeout(searching);
                process([]);
            }
            searching = setTimeout(function () {
                return $.getJSON(
                    "?api&type=search",
                    { q: query },
                    function (data) {
                        if(data['error'] == 'no_data')
                            return;

                        query_cache[query] = data;
                        return process(data);
                    }
                );
            }, 200);
        }
    });
});