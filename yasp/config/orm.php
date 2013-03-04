<?php
if(defined('DB_DATABASE') && DB_DATABASE != '') {
    try {
        $db = new fDatabase('mysql', DB_DATABASE, DB_USER, DB_PW, DB_HOST);
        $remapCache = new fCache('file', __ROOT__ . 'cache/orm_remap');

        fORMDatabase::attach($db);

        $schema = new fSchema($db);
        $remapped = $remapCache->get('remapped');
        if($remapped == NULL) {
            $s = '';
            foreach($schema->getTables() as $table) {
                if(stripos($table, DB_PREFIX) !== false) {
                    $class_name = fGrammar::singularize(fGrammar::camelize(str_replace(DB_PREFIX . '_', '', $table),
                                                                           true));
                    $s .= 'fORM::mapClassToTable("' . $class_name . '", "' . $table . '");';
                }
            }
            $remapCache->set('remapped', $s);
        }
        else
            eval($remapped);

        // adds prefix
        $db->registerHookCallback('unmodified', Util::addPrefix);
    } catch(fException $e) {
        fMessaging::create('errors', '{default}', $e->getMessage());
    }
}