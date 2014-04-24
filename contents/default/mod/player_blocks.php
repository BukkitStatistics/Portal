<?php
$tpl_blocks = $this->loadTemplate('mod/player_blocks', 'player_blocks');

$sort = fRequest::get('order_sort', 'string', 'desc');

switch(fRequest::get('order_by', 'int')) {
    case 1:
        $type = Util::getPrefix() . 'materials.tp_name';
        $tpl_blocks->set('sort[1]', $sort);
        break;
    default:
    case 2:
        $type = 'destroyed';
        $tpl_blocks->set('sort[2]', $sort);
        break;
    case 3:
        $type = 'placed';
        $tpl_blocks->set('sort[3]', $sort);
        break;
}

$page = fRequest::get('p', 'int', 1);
$limit = 6;

$blocks = fRecordSet::build(
    'TotalBlock',
    array('player_id=' => fRequest::get('id', 'int')),
    array($type => $sort),
    $limit,
    $page
);

$tpl_blocks->set('block_list', $blocks);

if(fRequest::isAjax()) {
    $tpl_blocks->display();
    die();
}
