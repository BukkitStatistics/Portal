<table class="table table-striped table-bordered sortable">
    <thead>
    <tr>
        <th style="text-align: center;" class="sort-button" data-type="1" data-sort="asc">Block Type</th>
        <th style="text-align: center;" class="sort-button" data-type="2" data-sort="asc">Destroyed</th>
        <th style="text-align: center;" class="sort-button" data-type="3" data-sort="asc">Placed</th>
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