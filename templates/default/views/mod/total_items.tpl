<table class="table table-striped table-bordered tablesorter" id="worldBlocksTable">
    <thead>
    <tr>
        <th style="text-align: center;">Item Type</th>
        <th style="text-align: center;">Picked Up</th>
        <th style="text-align: center;">Dropped</th>
    </tr>
    </thead>
    <tbody class="content">
    <?php
    foreach($this->get('item_list') as $item): ?>
    <tr>
        <td>
            <?php echo $item->getImage(); ?>
            <?php echo $item->getName(); ?>
        </td>
        <td>
            <?php echo TotalItem::countAllOfType('picked_up', $item)->format(); ?>
        </td>
        <td>
            <?php echo TotalItem::countAllOfType('dropped', $item)->format(); ?>
        </td>
    </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="page_navigation pagination force-center"></div>