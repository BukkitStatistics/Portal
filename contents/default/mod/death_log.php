<?php
$tpl_death = Util::newTpl($this, 'mod/death_log', 'death_log');

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

$tpl_death->set('death_log', $death_log);