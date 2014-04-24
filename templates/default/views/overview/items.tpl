<table class="table no-border statbox-table-small">
    <tr>
        <td>
            <span class="label label-info">
                <i class="fa fa-plus"></i> {{ item_stats.picked }}
            </span>
        </td>
        <td>{{ 'picked_up'|trans }}</td>
    </tr>
    <tr>
        <td>
            <span class="label label-info">
                {{ staticCall('Material', 'getMaterialImg', [item_stats.most_picked[1], 16, null, true])|raw }}
                {{ item_stats.most_picked[0] }}
            </span>
        </td>
        <td>{{ 'most_picked_up'|trans }}</td>
    </tr>
    <tr>
        <td>
            <span class="label label-info">
                <i class="fa fa-minus"></i> {{ item_stats.dropped }}
            </span>
        </td>
        <td>{{ 'dropped'|trans }}</td>
    </tr>
    <tr>
        <td>
            <span class="label label-info">
                {{ staticCall('Material', 'getMaterialImg', [item_stats.most_dropped[1], 16, null, true])|raw }}
                {{ item_stats.most_dropped[0] }}
            </span>
        </td>
        <td>{{ 'most_dropped'|trans }}</td>
    </tr>
</table>