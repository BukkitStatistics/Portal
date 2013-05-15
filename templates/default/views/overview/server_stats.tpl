<table class="table no-border statbox-table-small">
    <tr>
        <td>
            <span class="label label-info">
                <i class="icon-bell"></i> {{ serverstats.startup }}
            </span>
        </td>
        <td>{{ 'startup'|trans }}</td>
    </tr>
    <tr>
        <td>
            <span class="label label-warning">
                <i class="icon-lock"></i> {{ serverstats.shutdown }}
            </span>
        </td>
        <td>{{ 'shutdown'|trans }}</td>
    </tr>
    <tr>
        <td>
            <span class="label label-important">
                <i class="icon-calendar"></i> {{ serverstats.cur_uptime }}
            </span>
        </td>
        <td>{{ 'uptime'|trans|capitalize }}</td>
    </tr>
    <tr>
        <td>
            <span class="label label-info">
                <i class="icon-bullhorn"></i> {{ serverstats.playtime }}
            </span>
        </td>
        <td>{{ 'gameplay'|trans }}</td>
    </tr>
</table>