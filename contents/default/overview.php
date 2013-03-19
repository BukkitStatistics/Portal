<?php
$tpl = Util::newTpl($this, 'overview');
$this->add('js', 'media/js/jquery.bootpag.js');

// players
$this->inject('mod/players.php');
$tpl->set('total_players', $this->get('total_players'));

// online players
$this->inject('mod/players_online.php');
$tpl->set('players_online', $this->get('players_online'));

// total_blocks
$this->inject('mod/total_blocks.php');
$tpl->set('total_blocks', $this->get('total_blocks'));

// total_items
$this->inject('mod/total_items.php');
$tpl->set('total_items', $this->get('total_items'));

// death log
$this->inject('mod/death_log.php');
$tpl->set('death_log', $this->get('death_log'));

// server stats in dashboard
$server_stats['startup'] = ServerStatistic::getStartup()->format('H:i - d.m.Y');
$server_stats['shutdown'] = ServerStatistic::getShutdown()->format('H:i - d.m.Y');
$server_stats['cur_uptime'] = ServerStatistic::getCurrentUptime();
$server_stats['playtime'] = Player::countTotalPlaytime();
$server_stats['total_logins'] = Player::countAllLogins()->format();
$server_stats['max_players'] = ServerStatistic::getMaxPlayersOnline(true);

$tpl->set('serverstats', $server_stats);

// player stats in dashboard
$player_stats['tracked'] = fRecordSet::tally('Player');
$player_stats['died'] = TotalDeath::countAllDeaths()->format();
$player_stats['killed'] = Player::countAllKillsOfType()->format();
$player_stats['online'] = ServerStatistic::getPlayersOnline()->format();

$tpl->set('players', $player_stats);

// distance
$distance_stats['total'] = Distance::getDistanceOfType('total')->format();
$distance_stats['foot'] = Distance::getDistanceOfType('foot')->format();
$distance_stats['minecart'] = Distance::getDistanceOfType('minecart')->format();
$distance_stats['boat'] = Distance::getDistanceOfType('boat')->format();

$tpl->set('distance', $distance_stats);

// block stats
$block_stats['destroyed'] = TotalBlock::countAllOfType('destroyed')->format();
$block_stats['placed'] = TotalBlock::countAllOfType('placed')->format();
$block_stats['most_placed'] = TotalBlock::getMostOfType('placed');
$block_stats['most_destroyed'] = TotalBlock::getMostOfType('destroyed');

$tpl->set('blocks', $block_stats);

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

$tpl->set('deaths', $death_stats);

// items stats
$item_stats['dropped'] = TotalItem::countAllOfType('dropped')->format();
$item_stats['picked'] = TotalItem::countAllOfType('picked_up')->format();
$item_stats['most_dropped'] = TotalItem::getMostOfType('dropped');
$item_stats['most_picked'] = TotalItem::getMostOfType('picked_up');

$tpl->set('items', $item_stats);