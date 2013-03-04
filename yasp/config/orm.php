<?php
if(defined('DB_DATABASE') && DB_DATABASE != '') {
    try {
        $db = new fDatabase('mysql', DB_DATABASE, DB_USER, DB_PW, DB_HOST);

        fORMDatabase::attach($db);
        $schema = new fSchema($db);
        foreach($schema->getTables() as $table) {
            if(strpos($table, DB_PREFIX)) {
                $class_name = fGrammar::singularize(fGrammar::camelize(str_replace(DB_PREFIX . '_', '', $table), true));
                fORM::mapClassToTable($class_name, $table);
            }
        }

        // adds prefix
        $db->registerHookCallback('unmodified', Util::addPrefix);
    } catch(fException $e) {
        fMessaging::create('errors', '{default}', $e->getMessage());
    }
}