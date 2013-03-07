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
            throw new fConnectivityException(fText::compose('Database not reachable. Try again in a few minutes.'));


        fORMDatabase::attach($db);
        fORM::enableSchemaCaching($cacheSingle);

        $schema = new fSchema($db);
        $remapped = $cache->get('remapped');
        if($remapped == NULL) {
            $s = '';
            foreach($schema->getTables() as $table) {
                if(DB_PREFIX != '' && stripos($table, DB_PREFIX) !== false) {
                    $class_name = fGrammar::singularize(fGrammar::camelize(str_replace(DB_PREFIX . '_', '', $table),
                                                                           true));
                    $s .= 'fORM::mapClassToTable("' . $class_name . '", "' . $table . '");';
                }
            }
            $cache->set('remapped', $s);
        }
        else
            eval($remapped);

        // adds prefix
        $db->registerHookCallback('unmodified', Util::addPrefix);
    } catch(fNotFoundException $e) {
        $cacheSingle->set('dbOffline', true, 60 * 2);
        fMessaging::create('errors', '{default}', $e->getMessage());
    } catch(fAuthorizationException $e) {
        $cacheSingle->set('dbOffline', true, 60 * 2);
        fMessaging::create('errors', '{default}', $e->getMessage());
    } catch(fConnectivityException $e) {
        $cacheSingle->set('dbOffline', true, 60 * 2);
        fMessaging::create('errors', '{default}', $e->getMessage());
    }
}