<table class="table no-border statbox-table-small">
    <tr>
        <td>
            <span class="label label-info">
                <i class="icon-group"></i> {{ player_stats.online }}
            </span>
        </td>
        <td>Currently online</td>
    </tr>
    <tr>
        <td>
            <span class="label label-important">
                <i class="icon-star"></i> {{ player_stats.tracked }}
            </span>
        </td>
        <td>Tracked</td>
    </tr>
    <tr>
        <td>
            <span class="label label-success">
                <i class="icon-signal"></i> {{ serverstats.max_players }}
            </span>
        </td>
        <td>Maximum</td>
    </tr>
    <tr>
        <td>
            <span class="label label-info">
                <i class="icon-fire"></i> {{ serverstats.total_logins }}
            </span>
        </td>
        <td>Total logins</td>
    </tr>
</table>