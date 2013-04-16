<?php
$tpl_death = Util::newTpl($this, 'mod/death_log', 'death_log');

$page = fRequest::get('p', 'int', 1);
$limit = 10;

// TODO: limit total amount by time
$death_log_pvp = fRecordSet::build(
    'DetailedPvpKill',
    array(),
    array('time' => 'desc'),
    $limit / 2,
    $page
);
$death_log_pve = fRecordSet::build(
    'DetailedPveKill',
    array(),
    array('time' => 'desc'),
    $limit / 2 + ($limit / 2 - $death_log_pvp->count()),
    $page
);

$death_log = fRecordSet::buildFromArray(
    array('DetailedPvpKill', 'DetailedPveKill'),
    array_merge($death_log_pve->getRecords(), $death_log_pvp->getRecords()),
    $death_log_pvp->count(true) + $death_log_pve->count(true),
    $limit,
    $page
)->sort('getTime', 'desc');

$tpl_death->set('death_log', $death_log);

if(fRequest::isAjax()) {
    $tpl_death->place();
    die();
}