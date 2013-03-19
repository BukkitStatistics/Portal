<?php
if(defined('DB_DATABASE') && DB_DATABASE != '') {
    try {
        $db = new fDatabase('mysql', DB_DATABASE, DB_USER, DB_PW, DB_HOST);

        if($cacheSingle->get('dbOffline') === null) {
            $db->connect();
            $db->close();
            // cache for 12 hours
            $cacheSingle->set('dbOffline', false, 60 * 60 * 12);
        }
        elseif($cacheSingle->get('dbOffline'))
            throw new fConnectivityException('Database not reachable. Try again in a few minutes.');


        fORMDatabase::attach($db);
        fORM::enableSchemaCaching($cacheSingle);

        $schema = new fSchema($db);
        $remapped = $cache->get('remapped');
        if($remapped == NULL) {
            $remapped = '';
            foreach($schema->getTables() as $table) {
                if(DB_PREFIX != '' && stripos($table, DB_PREFIX) !== false) {
                    $class_name = fGrammar::singularize(fGrammar::camelize(str_replace(DB_PREFIX . '_', '', $table),
                                                                           true));
                    $remapped .= 'fORM::mapClassToTable("' . $class_name . '", "' . $table . '");';
                }
            }
            $cache->set('remapped', $remapped);
        }

        eval($remapped);

        // adds prefix
        $db->registerHookCallback('unmodified', Util::addPrefix);
    } catch(fNotFoundException $e) {
        if(is_null($cacheSingle->get('dbOffline')))
            $cacheSingle->set('dbOffline', true, 60 * 2);
        fMessaging::create('error', '{errors}', $e);
    } catch(fAuthorizationException $e) {
        if(is_null($cacheSingle->get('dbOffline')))
            $cacheSingle->set('dbOffline', true, 60 * 2);
        fMessaging::create('error', '{errors}', $e);
    } catch(fConnectivityException $e) {
        if(is_null($cacheSingle->get('dbOffline')))
            $cacheSingle->set('dbOffline', true, 60 * 2);
        fMessaging::create('error', '{errors}', $e);
    }
}
else
    if(!file_exists(__ROOT__ . 'install.php'))
        fMessaging::create('error', '{errors}',
                           new fConnectivityException('The database file is filled incorrectly.'));