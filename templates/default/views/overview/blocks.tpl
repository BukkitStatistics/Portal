<table class="table no-border statbox-table-small">
    <tr>
        <td>
            <span class="label label-info">
                <i class="icon-plus"></i> {{ block_stats.placed }}
            </span>
        </td>
        <td>Placed</td>
    </tr>
    <tr>
        <td>
            <span class="label label-info">
                {{ staticCall('Material', 'getMaterialImg', [block_stats.most_placed[1], 16, null, true])|raw }}
                {{ block_stats.most_placed[0] }}
            </span>
        </td>
        <td>Top placed</td>
    </tr>
    <tr>
        <td>
            <span class="label label-info">
                <i class="icon-minus"></i> {{ block_stats.destroyed }}
            </span>
        </td>
        <td>Broken</td>
    </tr>
    <tr>
        <td>
            <span class="label label-info">
                {{ staticCall('Material', 'getMaterialImg', [block_stats.most_destroyed[1], 16, null, true])|raw }}
                {{ block_stats.most_destroyed[0] }}
            </span>
        </td>
        <td>Top broken</td>
    </tr>
</table>