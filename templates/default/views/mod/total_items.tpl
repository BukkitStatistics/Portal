<table class="table table-striped table-bordered sortable">
    <thead>
    <tr>
        <th style="text-align: center;" class="sort-button" data-type="1" data-sort="asc">Item Type</th>
        <th style="text-align: center;" class="sort-button" data-type="2" data-sort="asc">Picked Up</th>
        <th style="text-align: center;" class="sort-button" data-type="3" data-sort="asc">Dropped</th>
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
<div id="item_listPagination" class="pagination-centered"></div>

<script type="text/javascript">
    $(document).ready(function () {
        callModulePage(
            'item_list',
            <?php echo $this->get('item_list')->getPages(); ?>,
            <?php echo $this->get('item_list')->getPage(); ?>
        );
    });
</script>