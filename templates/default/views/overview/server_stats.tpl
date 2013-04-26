<table class="table no-border statbox-table-small">
    <tr>
        <td>
            <span class="label label-info">
                <i class="icon-bell"></i> <?php echo $this->get('serverstats[startup]'); ?>
            </span>
        </td>
        <td>Startup</td>
    </tr>
    <tr>
        <td>
            <span class="label label-warning">
                <i class="icon-lock"></i> <?php echo $this->get('serverstats[shutdown]'); ?>
            </span>
        </td>
        <td>Shutdown</td>
    </tr>
    <tr>
        <td>
            <span class="label label-important">
                <i class="icon-calendar"></i> <?php echo $this->get('serverstats[cur_uptime]'); ?>
            </span>
        </td>
        <td>Uptime</td>
    </tr>
    <tr>
        <td>
            <span class="label label-info">
                <i class="icon-bullhorn"></i> <?php echo $this->get('serverstats[playtime]'); ?>
            </span>
        </td>
        <td>Gameplay</td>
    </tr>
</table>