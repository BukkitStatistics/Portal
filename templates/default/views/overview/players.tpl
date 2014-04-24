<table class="table no-border statbox-table-small">
    <tr>
        <td>
            <span class="label label-info">
                <i class="fa fa-group"></i> {{ player_stats.online }}
            </span>
        </td>
        <td>{{ 'cur_online'|trans }}</td>
    </tr>
    <tr>
        <td>
            <span class="label label-danger">
                <i class="fa fa-star"></i> {{ player_stats.tracked }}
            </span>
        </td>
        <td>{{ 'tracked'|trans|capitalize }}</td>
    </tr>
    <tr>
        <td>
            <span class="label label-success">
                <i class="fa fa-signal"></i> {{ serverstats.max_players }}
            </span>
        </td>
        <td>{{ 'max_online'|trans }}</td>
    </tr>
    <tr>
        <td>
            <span class="label label-info">
                <i class="fa fa-fire"></i> {{ serverstats.total_logins }}
            </span>
        </td>
        <td>{{ 'total_logins'|trans }}</td>
    </tr>
</table>