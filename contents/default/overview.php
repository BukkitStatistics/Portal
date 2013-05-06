<?php
/** @var Module $this */
$tpl = $this->loadTemplate('overview', 'tpl');
$this->addJs('media/js/jquery.bootpag.js');

// sub templates
$this->loadTemplate('overview/headbar', 'headbar');
$this->loadTemplate('overview/sidebar', 'sidebar');
$this->loadTemplate('overview/online_players', 'online_players');
$this->loadTemplate('overview/server_stats', 'server_stats');
$this->loadTemplate('overview/players', 'players');
$this->loadTemplate('overview/blocks', 'blocks');
$this->loadTemplate('overview/items', 'items');
$this->loadTemplate('overview/distances', 'distances');
$this->loadTemplate('overview/deaths', 'deaths');

// sub modules
$this->loadSubModule('mod/players');
$this->loadSubModule('mod/total_blocks');
$this->loadSubModule('mod/total_items');
$this->loadSubModule('mod/death_log');

// online players
$op = fRecordSet::build(
    'Player',
    array(
         'online=' => true
    ),
    array(
         'login_time' => 'desc'
    )
);

$tpl->set('players_online', $op);

// server stats in dashboard
$ts_zero = new fTimestamp(0);
$server_stats['startup'] = $ts_zero->eq(ServerStatistic::getStartup()) ==
                           true ? fText::compose('never') : ServerStatistic::getStartup()->format('std');
$server_stats['shutdown'] = $ts_zero->eq(ServerStatistic::getShutdown()) ==
                            true ? fText::compose('never') : ServerStatistic::getShutdown()->format('std');
$server_stats['cur_uptime'] = ServerStatistic::getCurrentUptime();
$server_stats['playtime'] = Player::countTotalPlaytime();
$server_stats['total_logins'] = Player::countAllLogins()->format();
$server_stats['max_players'] = ServerStatistic::getMaxPlayersOnline();
$server_stats['uptime_perc'] = ServerStatistic::getUptimePerc();

// player stats in dashboard
$player_stats['tracked'] = fRecordSet::tally('Player');
$player_stats['died'] = TotalDeath::countAllDeaths()->format();
$player_stats['killed'] = Player::countAllKillsOfType()->format();
$player_stats['online'] = ServerStatistic::getPlayersOnline()->format();

// distance
$distance_stats['total'] = Distance::getDistanceOfType('total')->format();
$distance_stats['foot'] = Distance::getDistanceOfType('foot')->format();
$distance_stats['minecart'] = Distance::getDistanceOfType('minecart')->format();
$distance_stats['boat'] = Distance::getDistanceOfType('boat')->format();
$distance_stats['swim'] = Distance::getDistanceOfType('swim')->format();
$distance_stats['flight'] = Distance::getDistanceOfType('flight')->format();

// block stats
$block_stats['destroyed'] = TotalBlock::countAllOfType('destroyed')->format();
$block_stats['placed'] = TotalBlock::countAllOfType('placed')->format();
$block_stats['most_placed'] = TotalBlock::getMostOfType('placed');
$block_stats['most_destroyed'] = TotalBlock::getMostOfType('destroyed');

// deaths stats
$death_stats['total'] = $player_stats['killed'];
$death_stats['pve'] = Player::countAllKillsOfType('pve')->format();
$death_stats['pvp'] = Player::countAllKillsOfType('pvp')->format();
$death_stats['evp'] = Player::countAllKillsOfType('evp')->format();
$death_stats['deaths'] = $player_stats['died'];
$death_stats['most_dangerous'] = Entity::getMostDangerous();
$death_stats['top_killer'] = Player::getMostDangerous();
$death_stats['top_weapon'] = TotalPveKill::getMostDangerousWeapon();
$death_stats['most_killed_mob'] = Entity::getMostKilled();
$death_stats['most_killed_player'] = Player::getMostKilled();

// items stats
$item_stats['dropped'] = TotalItem::countAllOfType('dropped')->format();
$item_stats['picked'] = TotalItem::countAllOfType('picked_up')->format();
$item_stats['most_dropped'] = TotalItem::getMostOfType('dropped');
$item_stats['most_picked'] = TotalItem::getMostOfType('picked_up');

// setting vars
// multi server
if(DB_TYPE == 'default')
    $tpl->set('multi', unserialize(Util::getOption('servers')));

$tpl->set('player_stats', $player_stats);
$tpl->set('serverstats', $server_stats);
$tpl->set('distance_stats', $distance_stats);
$tpl->set('block_stats', $block_stats);
$tpl->set('item_stats', $item_stats);
$tpl->set('death_stats', $death_stats);