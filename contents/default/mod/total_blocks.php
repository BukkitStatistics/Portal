<?php
$tpl_blocks = Util::newTpl($this, 'mod/total_blocks', 'total_blocks');

$sort = fRequest::get('order_sort', 'string', 'desc');

switch(fRequest::get('order_by', 'int')) {
    case 1:
        $type = 'tp_name';
        $tpl_blocks->set('sort[1]', $sort);
        break;
    default:
    case 2:
        $type = 'SUM(destroyed)';
        $tpl_blocks->set('sort[2]', $sort);
        break;
    case 3:
        $type = 'SUM(placed)';
        $tpl_blocks->set('sort[3]', $sort);
        break;
}

$page = fRequest::get('p', 'int', 1);
$limit = 6;

$blocks = fRecordSet::buildFromSQL(
    'Material',
    array('
        SELECT m.* FROM "prefix_materials" m
        RIGHT JOIN "prefix_total_blocks" b ON m.material_id = b.material_id
        GROUP BY b.material_id
        ORDER BY ' . $type . ' ' . $sort . '
        LIMIT %i,' . $limit . '
    ',
         ($page - 1) * $limit
    ),
    '
    SELECT COUNT(*) FROM (SELECT m.* FROM "prefix_materials" m
    RIGHT JOIN "prefix_total_blocks" b ON m.material_id = b.material_id
    GROUP BY b.material_id) c
    ',
    $limit,
    $page
);

$tpl_blocks->set('block_list', $blocks);

if(fRequest::isAjax()) {
    $tpl_blocks->place();
    die();
}