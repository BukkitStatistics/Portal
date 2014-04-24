<table class="table no-border statbox-table-small">
    <tr>
        <td>
            <span class="label label-info">
                <i class="fa fa-globe"></i> {{ distance_stats.total }}
            </span>
        </td>
        <td>{{ 'total'|trans }}</td>
    </tr>
    <tr>
        <td>
            <span class="label label-info">
                <i class="fa fa-exchange"></i> {{ distance_stats.foot }}
            </span>
        </td>
        <td>{{ 'by_foot'|trans|capitalize }}</td>
    </tr>
    <tr>
        <td>
            <span class="label label-info">
                <i class="fa fa-shopping-cart"></i> {{ distance_stats.minecart }}
            </span>
        </td>
        <td>{{ 'by_minecart'|trans|capitalize }}</td>
    </tr>
    <tr>
        <td>
            <span class="label label-info">
                <i class="fa fa-tablet"></i> {{ distance_stats.boat }}
            </span>
        </td>
        <td>{{ 'by_boat'|trans|capitalize }}</td>
    </tr>
    <tr>
        <td>
            <span class="label label-info">
                <i class="fa fa-umbrella"></i> {{ distance_stats.swim }}
            </span>
        </td>
        <td>{{ 'swum'|trans }}</td>
    </tr>
    <tr>
        <td>
            <span class="label label-info">
                <i class="fa fa-fighter-jet"></i> {{ distance_stats.flight }}
            </span>
        </td>
        <td>{{ 'flight'|trans }}</td>
    </tr>
</table>