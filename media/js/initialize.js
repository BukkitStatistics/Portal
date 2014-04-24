$(document).ready(function () {
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
    window.ids_cache = {};
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
                    "?api=true&type=search",
                    { q: query },
                    function (data) {
                        if (data['error'] == 'no_data')
                            return;

                        query_cache[query] = data['names'];
                        ids_cache = data['ids'];
                        return process(data['names']);
                    }
                );
            }, 200);
        },
        updater: function (item) {
            $('#playerSearchID').val(ids_cache[item]);

            return item;
        }
    });

    init();
});