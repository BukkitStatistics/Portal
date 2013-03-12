<?php
$tpl = Util::newTpl($this, 'overview');

// players
if(fRequest::get('mod') == 'players') {
    $order = fRequest::get('order_by', 'string', 'name') == 'tp_name' ? 'name' : fRequest::get('order_by', 'string',
                                                                                               'name');

    $tpl->set('sort[]', null);

    if(fRequest::get('order_by', 'string') == 'prefix_detailed_log_players.time')
        $tpl->set('sort[time]', fRequest::get('order_sort', 'string', 'asc'));
    elseif(fRequest::get('order_by', 'string') == 'first_login')
        $tpl->set('sort[first_login]', fRequest::get('order_sort', 'string', 'asc'));
    else
        $tpl->set('sort[name]', fRequest::get('order_sort', 'string', 'asc'));
}
else {
    $tpl->set('sort[name]', fRequest::get('order_sort', 'string', 'asc'));
    $order = 'name';
}

$players = fRecordSet::build(
    'Player',
    array(),
    array(
         str_ireplace('prefix_', DB_PREFIX . '_', $order) => fRequest::get('order_sort', 'string', 'asc')
    ),
    10,
    1
);

$tpl->set('all_players', $players);

if(fRequest::isAjax() && fRequest::get('mod') == 'players') {
    $tpl->inject('mod/players.tpl');
    die();
}


$tpl->set('all_players', $players);

// blocks
if(fRequest::get('mod') == 'blocks') {
    $order = fRequest::get('order_by', 'string', 'tp_name');
    if($order != 'tp_name')
        $order = 'SUM(' . $order . ')';
}
else
    $order = 'SUM(destroyed)';
$blocks = fRecordSet::buildFromSQL(
    'Material',
    '
    SELECT m.* FROM "prefix_materials" m
    RIGHT JOIN "prefix_total_blocks" b ON m.material_id = b.material_id
    GROUP BY b.material_id
    ORDER BY ' . $order . ' ' . fRequest::get('order_sort', 'string', 'desc') . '
    LIMIT 0,20
    ',
    'SELECT COUNT(material_id) FROM "prefix_materials"',
    20,
    1
);

$tpl->set('block_list', $blocks);

if(fRequest::isAjax() && fRequest::get('mod') == 'blocks') {
    $tpl->inject('mod/total_blocks.tpl');
    die();
}

// items
if(fRequest::get('mod') == 'items') {
    $order = fRequest::get('order_by', 'string', 'tp_name');
    if($order != 'tp_name')
        $order = 'SUM(' . $order . ')';
}
else
    $order = 'SUM(picked_up)';
$items = fRecordSet::buildFromSQL(
    'Material',
    '
    SELECT m.* FROM "prefix_materials" m
    LEFT JOIN "prefix_total_items" b ON m.material_id = b.material_id
    GROUP BY b.material_id
    ORDER BY ' . $order . ' ' . fRequest::get('order_sort', 'string', 'desc') . '
    LIMIT 0,20
    ',
    'SELECT COUNT(material_id) FROM "prefix_materials"',
    20,
    1
);

$tpl->set('item_list', $items);

if(fRequest::isAjax() && fRequest::get('mod') == 'items') {
    $tpl->inject('mod/total_items.tpl');
    die();
}

// death log
$death_log_pvp = fRecordSet::build(
    'DetailedPvpKill',
    array(),
    array('time' => 'asc'),
    10,
    1
);
$death_log_pve = fRecordSet::build(
    'DetailedPveKill',
    array(),
    array('time' => 'asc'),
    10,
    1
);

$death_log = $death_log_pvp->merge($death_log_pve)->sort('getTime', 'desc');

$tpl->set('death_log', $death_log);
// player stats in dashboard
$num = new fNumber($players->count(true));
$player_stats['tracked'] = $num->format();
$player_stats['died'] = Player::countAllDeaths()->format();
$player_stats['killed'] = Player::countAllKillsOfType()->format();

$players = fRecordSet::build(
    'Player',
    array(
         'online=' => true
    )
);
$player_stats['online'] = $players->count(true);


$tpl->set('players', $player_stats);

// server stats in dashboard
$server = new ServerStatistic();

$server_stats['startup'] = $server->getStartup();
$server_stats['shutdown'] = $server->getShutdown();
$server_stats['cur_uptime'] = $server->getCurrentUptime();
$server_stats['total_uptime'] = $server->getTotalUptime();
$server_stats['total_logins'] = Player::countAllLogins()->format();
$server_stats['max_players'] = $server->getMaxPlayersOnline(true);

$tpl->set('serverstats', $server_stats);

// distance
$distance_stats['total'] = Player::getDistanceOfType('total')->format();
$distance_stats['foot'] = Player::getDistanceOfType('foot')->format();
$distance_stats['minecart'] = Player::getDistanceOfType('minecart')->format();
$distance_stats['boat'] = Player::getDistanceOfType('boat')->format();

$tpl->set('distance', $distance_stats);

// block stats
$block_stats['destroyed'] = TotalBlock::countAllOfType('destroyed')->format();
$block_stats['placed'] = TotalBlock::countAllOfType('placed')->format();
$block_stats['most_placed'] = TotalBlock::getMostOfType('placed');
$block_stats['most_destroyed'] = TotalBlock::getMostOfType('destroyed');

$tpl->set('blocks', $block_stats);

// player stats
$tpl->set('online_players', $players);

// deaths stats
$death_stats['total'] = $player_stats['killed'];
$death_stats['pve'] = Player::countAllKillsOfType('pve')->format();
$death_stats['pvp'] = Player::countAllKillsOfType('pvp')->format();
$death_stats['evp'] = Player::countAllKillsOfType('evp')->format();
$death_stats['deaths'] = $player_stats['died'];
$death_stats['most_dangerous'] = Entity::getMostDangerous();
$death_stats['top_killer'] = Player::getMostDangerous();
$death_stats['top_weapon'] = Material::getMostDangerous();
$death_stats['most_killed_mob'] = Entity::getMostKilled();
$death_stats['most_killed_player'] = Player::getMostKilled();

$tpl->set('deaths', $death_stats);

// items stats
$item_stats['dropped'] = TotalItem::countAllOfType('dropped')->format();
$item_stats['picked'] = TotalItem::countAllOfType('picked_up')->format();
$item_stats['most_dropped'] = TotalItem::getMostOfType('dropped');
$item_stats['most_picked'] = TotalItem::getMostOfType('picked_up');

$tpl->set('items', $item_stats);