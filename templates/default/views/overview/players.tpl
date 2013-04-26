<table class="table no-border statbox-table-small">
    <tr>
        <td>
            <span class="label label-info">
                <i class="icon-group"></i> <?php echo $this->get('players[online]'); ?>
            </span>
        </td>
        <td>Currently online</td>
    </tr>
    <tr>
        <td>
            <span class="label label-important">
                <i class="icon-star"></i> <?php echo $this->get('players[tracked]'); ?>
            </span>
        </td>
        <td>Tracked</td>
    </tr>
    <tr>
        <td>
            <span class="label label-success">
                <i class="icon-signal"></i> <?php echo $this->get('serverstats[max_players]'); ?>
            </span>
        </td>
        <td>Maximum</td>
    </tr>
    <tr>
        <td>
            <span class="label label-info">
                <i class="icon-fire"></i> <?php echo $this->get('serverstats[total_logins]'); ?>
            </span>
        </td>
        <td>Total logins</td>
    </tr>
</table>