<?php
$tpl_death = Util::newTpl($this, 'mod/death_log', 'death_log');

// TODO: limit total amount by time
$death_log_pvp = fRecordSet::build(
    'DetailedPvpKill',
    array(),
    array('time' => 'desc')
);
$death_log_pve = fRecordSet::build(
    'DetailedPveKill',
    array(),
    array('time' => 'desc')
);

$page = fRequest::get('p', 'int', 1);
$limit = 10;

$death_log = fRecordSet::buildFromArray(
    array('DetailedPvpKill', 'DetailedPveKill'),
    array_merge($death_log_pve->getRecords(), $death_log_pvp->getRecords()),
    $death_log_pvp->count() + $death_log_pve->count(),
    $limit,
    $page
)->sort('getTime', 'desc')->slice(($page - 1) * $limit, $limit, true);

$tpl_death->set('death_log', $death_log);

if(fRequest::isAjax()) {
    $tpl_death->place();
    die();
}