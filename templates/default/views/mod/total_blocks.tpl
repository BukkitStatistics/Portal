<table class="table table-striped table-bordered tablesorter" id="worldBlocksTable">
    <thead>
    <tr>
        <th style="text-align: center;">Block Type</th>
        <th style="text-align: center;">Destroyed</th>
        <th style="text-align: center;">Placed</th>
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
<div class="page_navigation pagination force-center"></div>