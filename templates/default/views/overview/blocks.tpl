<table class="table no-border statbox-table-small">
    <tr>
        <td>
            <span class="label label-info">
                <i class="fa fa-plus"></i> {{ block_stats.placed }}
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
        <td>{{ 'top_placed'|trans }}</td>
    </tr>
    <tr>
        <td>
            <span class="label label-info">
                <i class="fa fa-minus"></i> {{ block_stats.destroyed }}
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
        <td>{{ 'top_broken'|trans }}</td>
    </tr>
</table>