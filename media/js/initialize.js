$(document).ready(function() {
    // sidebar
    setTimeout(function () {
        $('body').scrollspy({
            target: '.nav-sidebar',
            offset: 66
        });
    }, 100);

    // tablesorter for every element with class tablesorter
    $('.tablesorter').tablesorter({
        sortList: [
            [0, 0]]
    });

    // pagination TODO: find better solution->tablesorter & paginator

});