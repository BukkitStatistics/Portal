<?php
// TODO: make sure there are no players currently playing -> shut the server off! :D
if(fSession::get('maxStep') > 5)
    fURL::redirect('?step=four');

$tpl = new fTemplating($this->get('tplRoot'), 'converter.tpl');
$this->set('tpl', $tpl);

if(fRequest::isPost() && fRequest::get('converter_submit') && !fRequest::get('start')) {
    if($tpl->get('state') == null) {
        /*
       * Store input values
       */
        $tpl->set('host', fRequest::encode('host'));
        $tpl->set('user', fRequest::encode('user'));
        $tpl->set('pw', fRequest::encode('pw'));
        $tpl->set('database', fRequest::encode('database'));


        try {
            $vali = new fValidation();


            $vali->addRequiredFields(array(
                                          'host',
                                          'user',
                                          'pw',
                                          'database'
                                     ))
                ->addCallbackRule('host', 'checkHost', 'Please enter an valid host.');


            $vali->setMessageOrder('type', 'host', 'user', 'pw', 'database')
                ->validate();


            $db = new fDatabase('mysql', $tpl->get('database'),
                                $tpl->get('user'),
                                $tpl->get('pw'),
                                $tpl->get('host'));
            fSession::set('convertDB', array(
                                            'database' => $tpl->get('database'),
                                            'user'     => $tpl->get('user'),
                                            'pw'       => $tpl->get('pw'),
                                            'host'     => $tpl->get('host')
                                       )
            );

            $db->connect();
            $db->close();
            $tpl->set('state', 2);
        } catch(fValidationException $e) {
            fMessaging::create('validation', 'install/converter', $e->getMessage());
        } catch(fConnectivityException $e) {
            fMessaging::create('connectivity', 'install/converter', $e->getMessage());
        } catch(fAuthorizationException $e) {
            fMessaging::create('auth', 'install/converter', $e->getMessage());
        } catch(fNotFoundException $e) {
            fMessaging::create('notfound', 'install/converter', $e->getMessage());
        } catch(fEnvironmentException $e) {
            fMessaging::create('env', 'install/converter', $e->getMessage());
        }
    }
    if($tpl->get('state') == 2) {
        $players = $db->query('
                            SELECT COUNT(DISTINCT player_name)
                            FROM players
                            WHERE last_logout IS NOT NULL
                            AND last_login IS NOT NULL
	    ');
        $p = new fNumber($players->fetchScalar());
        $tpl->set('players', $p->format());
        fSession::set('converterStats[player_count]', $p->format());

        $pvp = $db->query('
                        SELECT COUNT(id) FROM kills
                        WHERE killed = 999
                        AND killed_by = 999
	    '); // killed a player(999) by a player(999)
        $pvp = new fNumber($pvp->fetchScalar());
        $tpl->set('pvp', $pvp->format());
        fSession::set('converterStats[pvp_count]', $pvp->format());

        $pve = $db->query('
                        SELECT COUNT(id) FROM kills
                        WHERE killed != 18
                        AND killed != 0
                        AND killed != 999
                        AND killed_by = 999
	    '); // killed everything except an block(18), nothing(0) or an player(999) by a player(999)
        $pve = new fNumber($pve->fetchScalar());
        $tpl->set('pve', $pve->format());
        fSession::set('converterStats[pve_count]', $pve->format());

        $evp = $db->query('
                        SELECT COUNT(id) FROM kills
                        WHERE killed = 999
                         AND killed_by != 999
                         AND killed_by != 18
                         AND killed_by != 0'
        ); // killed a player(999) by everything except an player(999), a block(18) or nothing(0)
        $evp = new fNumber($evp->fetchScalar());
        $tpl->set('evp', $evp->format());

        $deaths = $db->query('
                            SELECT COUNT(id) FROM kills
                            WHERE killed = 999
                            AND (killed_by = 18 OR killed_by = 0)
        '); // killed a player(999) by a block(18) or nothing(0) -> death causes like falling, drowning etc.
        $deaths = new fNumber($deaths->fetchScalar());
        $tpl->set('deaths', $deaths->format());
    }
}
/*
 * starting with the real converting....
 */
$valid_status = array(
    'players',
    'pvp',
    'pve',
    'evp',
    'deaths'
);
if((fRequest::isPost() && fRequest::get('start'))
   || (fRequest::isGet() && in_array(fRequest::get('status'), $valid_status))
) {
    $db = new fDatabase(
        'mysql',
        fSession::get('convertDB[database]'),
        fSession::get('convertDB[user]'),
        fSession::get('convertDB[pw]'),
        fSession::get('convertDB[host]')
    );
    $db2 = fORMDatabase::retrieve();

    if((fRequest::isPost() && fRequest::get('start')))
        fSession::set('convert', fRequest::get('convert'));

    if((fRequest::isPost() && fRequest::get('start')) || fRequest::get('status') == 'players') {
        $players = $db->query('SELECT
	    DISTINCT player_name,
	    firstever_login,
	    last_login,
	    num_logins,
	    last_logout, 
	    distance_traveled AS total,
	    distance_traveled_in_minecart AS minecart, 
	    distance_traveled_in_boat AS boat, 
	    distance_traveled_on_pig AS pig 
	    FROM players
	    WHERE last_logout IS NOT NULL 
	    AND last_login IS NOT NULL
	    ');

        $player_stmt = $db2->translatedPrepare('INSERT INTO "prefix_players" ("name", "first_login", "logins") VALUES (%s, %i, %i)');
        $login_stmt = $db2->translatedPrepare('INSERT INTO "prefix_players_log" ("playerID", "logged_in", "logged_out") VALUES (%i, %i, %i)');
        $dist_stmt = $db2->translatedPrepare('
	    INSERT INTO "prefix_players_distance" 
	    ("playerID", 
	    "foot", 
	    "boat", 
	    "minecart", 
	    "pig") 
	    VALUES (%i, %i, %i, %i, %i)'
        );

        // catch time for reload...
        $start = new fTime('+' . (ini_get('max_execution_time') - 5) . ' seconds');
        $i = (fRequest::get('last') ? fRequest::get('last') : 1);
        $stop = true;
        $players->seek($i - 1);
        while($players->valid()) {
            $row = $players->fetchRow();
            $last = $db2->query($player_stmt, $row['player_name'], $row['firstever_login'],
                                $row['num_logins'])->getAutoIncrementedValue();
            $foot = $row['total'] - ($row['minecart'] + $row['boat'] + $row['pig']);
            $db2->execute($dist_stmt, $last, $foot, $row['boat'], $row['minecart'], $row['pig']);
            $db2->execute($login_stmt, $last, $row['last_login'], $row['last_logout']);

            $now = new fTime();
            if($now->gte($start)) {
                $stop = false;
                break;
            }
            $i++;
        }
        $db->close();
        $db2->close();
        if($stop) {
            $this->add('header_additions',
                       '<meta http-equiv="REFRESH" content="1;url=?step=converter&status=' .
                       key(fSession::get('convert')) . '">');
            $tpl->set('current_state', 'Moving over to the next step');
        }
        else {
            $this->add('header_additions',
                       '<meta http-equiv="REFRESH" content="1;url=?step=converter&status=players&last=' . $i . '">');
            $perc = round($i / fSession::get('converterStats[player_count]') * 100, 0);
            $tpl->set('current_state', 'Converting players. Current player: ' . $i . ' of ' .
                                       fSession::get('converterStats[player_count]') . '(' . $perc . '&)');
        }
    }
    elseif(fRequest::get('status') == 'pvp' && fSession::get('convert[pvp]')) {
        fSession::delete('convert[pvp]');
    }
    elseif(fRequest::get('status') == 'pve' && fSession::get('convert[pve]')) {
        fSession::delete('convert[pve]');
    }
    elseif(fRequest::get('status') == 'evp' && fSession::get('convert[evp]')) {
        fSession::delete('convert[evp]');
    }
    elseif(fRequest::get('status') == 'deaths' && fSession::get('convert[deaths]')) {
        fSession::delete('convert[deaths]');
    }
    $tpl->set('state', 3);
}