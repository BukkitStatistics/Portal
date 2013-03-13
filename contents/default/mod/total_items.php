<?php
$tpl_items = Util::newTpl($this, 'mod/total_items', 'total_items');

switch(fRequest::get('order_by', 'int')) {
    case 1:
        $type = 'tp_name';
        break;
    default:
    case 2:
        $type = 'SUM(picked_up)';
        break;
    case 3:
        $type = 'SUM(dropped)';
        break;
}

$page = fRequest::get('page', 'int', 1);

$items = fRecordSet::buildFromSQL(
    'Material',
    array(
         '
        SELECT m.* FROM "prefix_materials" m
        LEFT JOIN "prefix_total_items" b ON m.material_id = b.material_id
        GROUP BY b.material_id
        ORDER BY ' . $type . ' ' . fRequest::get('order_sort', 'string', 'desc') . '
        LIMIT %i,20
    ', ($page - 1) * 20
    ),
    '
    SELECT COUNT(*) FROM (SELECT m.* FROM "prefix_materials" m
    RIGHT JOIN "prefix_total_items" b ON m.material_id = b.material_id
    GROUP BY b.material_id) c
    ',
    20,
    $page
);

$tpl_items->set('item_list', $items);

if(fRequest::isAjax()) {
    $tpl_items->place();
    die();
}