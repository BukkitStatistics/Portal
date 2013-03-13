<?php
$tpl_items = Util::newTpl($this, 'mod/total_items', 'total_items');

switch(fRequest::get('order_by', 'int', 0)) {
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

$items = fRecordSet::buildFromSQL(
    'Material',
    '
    SELECT m.* FROM "prefix_materials" m
    LEFT JOIN "prefix_total_items" b ON m.material_id = b.material_id
    GROUP BY b.material_id
    ORDER BY ' . $type . ' ' . fRequest::get('order_sort', 'string', 'desc') . '
    LIMIT 0,20
    ',
    'SELECT COUNT(material_id) FROM "prefix_materials"',
    20,
    1
);

$tpl_items->set('item_list', $items);

if(fRequest::isAjax()) {
    $tpl_items->place();
    die();
}