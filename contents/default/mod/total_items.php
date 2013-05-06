<?php
$tpl_items = $this->loadTemplate('mod/total_items', 'total_items');

$sort = fRequest::get('order_sort', 'string', 'desc');

switch(fRequest::get('order_by', 'int')) {
    case 1:
        $type = 'tp_name';
        $tpl_items->set('sort[1]', $sort);
        break;
    default:
    case 2:
        $type = 'SUM(picked_up)';
        $tpl_items->set('sort[2]', $sort);
        break;
    case 3:
        $type = 'SUM(dropped)';
        $tpl_items->set('sort[3]', $sort);
        break;
}

$page = fRequest::get('p', 'int', 1);
$limit = 6;

$items = fRecordSet::buildFromSQL(
    'Material',
    array(
         '
        SELECT m.* FROM "prefix_materials" m
        RIGHT JOIN "prefix_total_items" b ON m.material_id = b.material_id
        GROUP BY b.material_id
        ORDER BY ' . $type . ' ' . $sort . '
        LIMIT %i,' . $limit . '
    ',
         ($page - 1) * $limit
    ),
    '
    SELECT COUNT(*) FROM (SELECT m.* FROM "prefix_materials" m
    RIGHT JOIN "prefix_total_items" b ON m.material_id = b.material_id
    GROUP BY b.material_id) c
    ',
    $limit,
    $page
);

$tpl_items->set('item_list', $items);

if(fRequest::isAjax()) {
    $tpl_items->display();
    die();
}