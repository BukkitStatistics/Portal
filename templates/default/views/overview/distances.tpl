<table class="table no-border statbox-table-small">
    <tr>
        <td>
            <span class="label label-info">
                <i class="icon-globe"></i> {{ distance_stats.total }}
            </span>
        </td>
        <td>{{ 'total'|trans }}</td>
    </tr>
    <tr>
        <td>
            <span class="label label-info">
                <i class="icon-exchange"></i> {{ distance_stats.foot }}
            </span>
        </td>
        <td>{{ 'by'|trans|capitalize }} {{ 'foot'|trans }}</td>
    </tr>
    <tr>
        <td>
            <span class="label label-info">
                <i class="icon-shopping-cart"></i> {{ distance_stats.minecart }}
            </span>
        </td>
        <td>{{ 'by'|trans|capitalize }} {{ 'minecart'|trans }}</td>
    </tr>
    <tr>
        <td>
            <span class="label label-info">
                <i class="icon-tablet"></i> {{ distance_stats.boat }}
            </span>
        </td>
        <td>{{ 'by'|trans|capitalize }} {{ 'boat'|trans }}</td>
    </tr>
    <tr>
        <td>
            <span class="label label-info">
                <i class="icon-umbrella"></i> {{ distance_stats.swim }}
            </span>
        </td>
        <td>{{ 'swum'|trans }}</td>
    </tr>
    <tr>
        <td>
            <span class="label label-info">
                <i class="icon-fighter-jet"></i> {{ distance_stats.flight }}
            </span>
        </td>
        <td>{{ 'flight'|trans }}</td>
    </tr>
</table>