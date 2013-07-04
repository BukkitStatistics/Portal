<?php
$tpl = $this->loadTemplate('admin/modules', 'sub');

/*
 * Store input values
 */
$tpl->set('module_blocks', fRequest::encode('module_blocks', 'int', Util::getOption('module.blocks')));
$tpl->set('module_items', fRequest::encode('module_items', 'int', Util::getOption('module.items')));
$tpl->set('module_deaths', fRequest::encode('module_deaths', 'int', Util::getOption('module.deaths')));
$tpl->set('module_inventory', fRequest::encode('module_inventory', 'int', Util::getOption('module.inventory')));

/*
 * Get all hooks from database
 */
$hooks = null;
try {
    $res = Util::getDatabase()->translatedQuery(
        '
        SELECT *
        FROM prefix_settings
        WHERE %r LIKE %s
        ',
        'key',
        'hook.%'
    );

    foreach($res->fetchAllRows() as $row)
        $tmp[] = array(
            'key'   => 'hook_' . substr($row['key'], 5),
            'value' => fRequest::encode('hook_' . substr($row['key'], 5), 'int',
                                        $row['value'])
        );
    $tpl->set('hooks', $tmp);

} catch(fSQLException $e) {
}

if(fRequest::isPost() && fRequest::check('save')) {
    Util::setOption('module.blocks', $tpl->get('module_blocks'));
    Util::setOption('module.items', $tpl->get('module_items'));
    Util::setOption('module.deaths', $tpl->get('module_deaths'));
    Util::setOption('module.inventory', $tpl->get('module_inventory'));

    if($tpl->get('hooks') != null) {
        foreach($tpl->get('hooks') as $row)
            Util::setOption('hook.' . substr($row['key'], 5), $row['value']);
    }
}