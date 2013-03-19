<?php
if(!fRequest::isAjax() && !fRequest::get('api'))
    return;

$type = fRequest::get('type', 'string', 'none');
$error = false;
fJSON::sendHeader();

if($type == 'none') {
    $json = fJSON::encode(array(
                       'error' => 'no_type'
                  ));
    die($json);
}


if($type == 'search') {
    if($cache->get('search-player'))
        die($cache->get('search-player'));

    try {
        $res = fORMDatabase::retrieve()->translatedQuery('
                    SELECT name FROM "prefix_players"
                    ORDER BY name ASC
        ');

        $ar = array();

        foreach($res as $row)
            $ar[] = $row['name'];

        $json = fJSON::encode($ar);

        $cache->add('search-player', $json, 60 * 60 * 1);

        die($json);

    } catch (fProgrammerException $e) {
        $error = true;
    } catch (fSQLException $e) {
        $error = true;
    } catch (fNoRowsException $e) {
        $error = true;
    }
}

if($error)
    die(fJSON::encode(array('error' => 'no_data')));