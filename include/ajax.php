<?php
if(!fRequest::isAjax() || !fRequest::get('api'))
    return;

$type = strtolower(fRequest::get('type', 'string', 'none'));
$error = false;
fJSON::sendHeader();

if($type == 'none') {
    $json = fJSON::encode(array(
                       'error' => 'no_type'
                  ));
    die($json);
}


if($type == 'search') {
    if($cache->get('search-player') && Util::getOption('cache.search', 60 * 60 * 1) > 0)
        die($cache->get('search-player'));

    try {
        $res = Util::getDatabase()->translatedQuery('
                    SELECT player_id, name FROM "prefix_players"
                    ORDER BY name ASC
        ');

        $ar = array();

        foreach($res as $row) {
            $ar['names'][] = $row['name'];
            $ar['ids'][$row['name']] = $row['player_id'];
        }


        $json = fJSON::encode($ar);

        $cache->add('search-player.' . DB_TYPE . '.cache', $json, Util::getOption('cache.search', 60 * 60 * 1));

        die($json);

    } catch (fException $e) {
        $error = $e;
    }
}

if($type == 'server_stats') {
    $ar = ServerStatistic::getValues();
    $ar['online_players'] = ServerStatistic::getPlayersOnline()->__toString();

    die(fJSON::encode($ar));
}

if($error) {
    fCore::debug(array('ajax:', $e));
    die(fJSON::encode(array('error' => 'no_data')));
}
