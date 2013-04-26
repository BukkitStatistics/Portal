<table class="table no-border statbox-table-small">
    <tr>
        <td>
            <span class="label label-info">
                <i class="icon-plus"></i> <?php echo $this->get('blocks[placed]'); ?>
            </span>
        </td>
        <td>Placed</td>
    </tr>
    <tr>
        <td>
            <span class="label label-info">
                <?php echo Material::getMaterialImg($this->get('blocks[most_placed][1]'), 16, null, true); ?>
                <?php echo $this->get('blocks[most_placed][0]'); ?>
            </span>
        </td>
        <td>Top placed</td>
    </tr>
    <tr>
        <td>
            <span class="label label-info">
                <i class="icon-minus"></i> <?php echo $this->get('blocks[destroyed]'); ?>
            </span>
        </td>
        <td>Broken</td>
    </tr>
    <tr>
        <td>
            <span class="label label-info">
                <?php echo Material::getMaterialImg($this->get('blocks[most_destroyed][1]'), 16, null, true); ?>
                <?php echo $this->get('blocks[most_destroyed][0]'); ?>
            </span>
        </td>
        <td>Top broken</td>
    </tr>
</table>