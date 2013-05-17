<?php
if(defined('DB_DATABASE') && DB_DATABASE != '') {
    try {
        $db = new fDatabase('mysql', DB_DATABASE, DB_USER, DB_PW, DB_HOST, DB_PORT);

        if($cacheSingle->get('dbOffline' . DB_TYPE) === null) {
            $db->connect();
            $db->close();
            // cache for 12 hours
            $cacheSingle->set('dbOffline' . DB_TYPE, false, 60 * 60 * 12);
        }

        if($cacheSingle->get('dbOffline' . DB_TYPE))
            throw new fConnectivityException('Database not reachable. Try again in a few minutes.');


        fORMDatabase::attach($db, DB_TYPE);
        fORM::enableSchemaCaching($cacheSingle, DB_TYPE);

        // adds prefix
        $db->registerHookCallback('unmodified', Util::addPrefix);

        // delete cached files if database was patched by the plugin
        if(Util::getOption('patched', 0)) {
            if($cache->get('remapped_' . DB_TYPE))
                $cache->delete('remapped_' . DB_TYPE);

            fORMDatabase::retrieve('name:' . DB_TYPE)->clearCache();
            fORMSchema::retrieve('name:' . DB_TYPE)->clearCache();

            fCore::debug('cleared db cache');

            Util::setOption('patched', 0);
        }

        $schema = new fSchema($db);
        $remapped = $cache->get('remapped_' . DB_TYPE);
        if($remapped == NULL) {
            $remapped = '';
            foreach($schema->getTables() as $table) {
                if(Util::getPrefix() != '' && stripos($table, Util::getPrefix()) !== false) {
                    try {
                        $class_name = fGrammar::singularize(fGrammar::camelize(str_replace(Util::getPrefix(), '',
                                                                                           $table),
                                                                               true));
                        $remapped .= 'fORM::mapClassToTable("' . $class_name . '", "' . $table . '");';
                        if(DB_TYPE != 'default')
                            $remapped .= 'fORM::mapClassToDatabase("' . $class_name . '", "' . DB_TYPE . '");';
                    } catch(fProgrammerException $e) {
                        fCore::debug($e);
                    }
                }
            }
            $cache->set('remapped_' . DB_TYPE, $remapped);
        }

        eval($remapped);
    } catch(fNotFoundException $e) {
        if(is_null($cacheSingle->get('dbOffline' . DB_TYPE)))
            $cacheSingle->set('dbOffline' . DB_TYPE, true, 60 * 2);
        fMessaging::create('error', '{errors}', $e);
    } catch(fAuthorizationException $e) {
        if(is_null($cacheSingle->get('dbOffline' . DB_TYPE)))
            $cacheSingle->set('dbOffline' . DB_TYPE, true, 60 * 2);
        fMessaging::create('error', '{errors}', $e);
    } catch(fConnectivityException $e) {
        if(is_null($cacheSingle->get('dbOffline' . DB_TYPE)))
            $cacheSingle->set('dbOffline' . DB_TYPE, true, 60 * 2);
        fMessaging::create('error', '{errors}', $e);
    }
}
else
    if(!file_exists(__ROOT__ . 'install.php'))
        fMessaging::create('error', '{errors}',
                           new fConnectivityException('The database file is filled incorrectly.'));