<table class="table no-border statbox-table-small">
    <tr>
        <td>
            <span class="label label-info">
                <i class="icon-plus"></i> {{ block_stats.placed }}
            </span>
        </td>
        <td>{{ 'placed'|trans }}</td>
    </tr>
    <tr>
        <td>
            <span class="label label-info">
                {{ staticCall('Material', 'getMaterialImg', [block_stats.most_placed[1], 16, null, true])|raw }}
                {{ block_stats.most_placed[0] }}
            </span>
        </td>
        <td>{{ 'top'|trans }} {{ 'placed'|trans }}</td>
    </tr>
    <tr>
        <td>
            <span class="label label-info">
                <i class="icon-minus"></i> {{ block_stats.destroyed }}
            </span>
        </td>
        <td>{{ 'broken'|trans }}</td>
    </tr>
    <tr>
        <td>
            <span class="label label-info">
                {{ staticCall('Material', 'getMaterialImg', [block_stats.most_destroyed[1], 16, null, true])|raw }}
                {{ block_stats.most_destroyed[0] }}
            </span>
        </td>
        <td>{{ 'top'|trans }} {{ 'broken'|trans }}</td>
    </tr>
</table>