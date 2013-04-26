<table class="table no-border statbox-table-small">
    <tr>
        <td>
            <span class="label label-info">
                <i class="icon-plus"></i> <?php echo $this->get('items[picked]'); ?>
            </span>
        </td>
        <td>Picked up</td>
    </tr>
    <tr>
        <td>
            <span class="label label-info">
                <?php echo Material::getMaterialImg($this->get('items[most_picked][1]'), 16, null, true); ?>
                <?php echo $this->get('items[most_picked][0]'); ?>
            </span>
        </td>
        <td>Most picked up</td>
    </tr>
    <tr>
        <td>
            <span class="label label-info">
                <i class="icon-minus"></i> <?php echo $this->get('items[dropped]'); ?>
            </span>
        </td>
        <td>Dropped</td>
    </tr>
    <tr>
        <td>
            <span class="label label-info">
                <?php echo Material::getMaterialImg($this->get('items[most_dropped][1]'), 16, null, true); ?>
                <?php echo $this->get('items[most_dropped][0]'); ?>
            </span>
        </td>
        <td>Most dropped</td>
    </tr>
</table>