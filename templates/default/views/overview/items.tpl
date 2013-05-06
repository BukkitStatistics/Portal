<table class="table no-border statbox-table-small">
    <tr>
        <td>
            <span class="label label-info">
                <i class="icon-plus"></i> {{ item_stats.picked }}
            </span>
        </td>
        <td>Picked up</td>
    </tr>
    <tr>
        <td>
            <span class="label label-info">
                {{ staticCall('Material', 'getMaterialImg', [item_stats.most_picked[1], 16, null, true])|raw }}
                {{ item_stats.most_picked[0] }}
            </span>
        </td>
        <td>Most picked up</td>
    </tr>
    <tr>
        <td>
            <span class="label label-info">
                <i class="icon-minus"></i> {{ item_stats.dropped }}
            </span>
        </td>
        <td>Dropped</td>
    </tr>
    <tr>
        <td>
            <span class="label label-info">
                {{ staticCall('Material', 'getMaterialImg', [item_stats.most_dropped[1], 16, null, true])|raw }}
                {{ item_stats.most_dropped[0] }}
            </span>
        </td>
        <td>Most dropped</td>
    </tr>
</table>