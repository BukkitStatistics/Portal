<table class="table table-striped table-bordered sortable">
    <thead>
    <tr>
        <th style="text-align: center;" class="sort-button" data-type="tp_name" data-sort="desc">Block Type</th>
        <th style="text-align: center;" class="sort-button" data-type="destroyed" data-sort="desc">Destroyed</th>
        <th style="text-align: center;" class="sort-button" data-type="placed" data-sort="desc">Placed</th>
    </tr>
    </thead>
    <tbody class="content">
    <?php
    foreach($this->get('block_list') as $block): ?>
    <tr>
        <td>
            <?php echo $block->getImage(); ?>
            <?php echo $block->getName(); ?>
        </td>
        <td>
            <?php echo TotalBlock::countAllOfType('destroyed', $block)->format(); ?>
        </td>
        <td>
            <?php echo TotalBlock::countAllOfType('placed', $block)->format(); ?>
        </td>
    </tr>
        <?php endforeach; ?>
    </tbody>
</table>