<?php
$tpl_blocks = $this->loadTemplate('mod/player_items', 'player_items');

$sort = fRequest::get('order_sort', 'string', 'desc');

switch(fRequest::get('order_by', 'int')) {
    case 1:
        $type = Util::getPrefix() . 'materials.tp_name';
        $tpl_blocks->set('sort[1]', $sort);
        break;
    default:
    case 2:
        $type = 'picked_up';
        $tpl_blocks->set('sort[2]', $sort);
        break;
    case 3:
        $type = 'dropped';
        $tpl_blocks->set('sort[3]', $sort);
        break;
}

$page = fRequest::get('p', 'int', 1);
$limit = 6;

$blocks = fRecordSet::build(
    'TotalItem',
    array('player_id=' => Player::getId(fRequest::get('name', 'string'))),
    array($type => $sort),
    $limit,
    $page
);

$tpl_blocks->set('item_list', $blocks);

if(fRequest::isAjax()) {
    $tpl_blocks->display();
    die();
}
