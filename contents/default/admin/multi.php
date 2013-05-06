<?php
if(DB_TYPE != 'default')
    return;
$tpl = $this->loadTemplate('admin/multi', 'sub');
$multi_form = $this->loadTemplate('admin/multi_form', 'multi_form');

$action = fRequest::get('action', 'string', '');
$tpl->set('main', true);
$tpl->set('action', $action);

if($action == 'delete') {
    try {
        $servers = unserialize(Util::getOption('servers'));
        if(!isset($servers[fRequest::encode('slug', 'string')]))
            throw new fValidationException('The server does not exist!');

        $path = __INC__ . 'config/db_' . $servers[fRequest::encode('slug', 'string')]['slug'] . '.php';

        $file = new fFile($path);
        $file->delete();

        unset($servers[fRequest::encode('slug', 'string')]);

        Util::setOption('servers', serialize($servers));

    } catch(fValidationException $e) {
        fMessaging::create('input', 'admin', 'Could not delete! ' . $e->getMessage());
    }
}

if($action == 'add' || $action == 'edit') {
    $tpl->set('main', false);
    $db = array(
        'host'     => '',
        'port'     => '3306',
        'user'     => '',
        'pw'       => '',
        'database' => '',
        'prefix'   => 'statistics',
        'type'     => ''
    );

    $server_name = '';

    if($action == 'edit') {
        $servers = unserialize(Util::getOption('servers'));
        if(!isset($servers[fRequest::encode('slug', 'string')]))
            fMessaging::create('slug', 'admin/multi', 'Server does not exist.');

        $file = __INC__ . 'config/db_' . $servers[fRequest::encode('slug', 'string')]['slug'] . '.php';
        try {
            new fFile($file);

            include_once $file;
            $db = $db_values;

            fRequest::set('server_slug', $servers[fRequest::encode('slug', 'string')]['slug']);
            $server_name = $servers[fRequest::encode('slug', 'string')]['name'];
        } catch(fValidationException $e) {
            fMessaging::create('file', 'admin/multi', $e->getMessage());
        }
    }

    /*
     * Store input values
     */
    $multi_form->set('server_name', fRequest::encode('server_name', 'string', $server_name));
    $multi_form->set('server_slug',
                     strtolower(trim(preg_replace('/[^A-Za-z0-9]+/', '_', fRequest::encode('server_slug', 'string')))));
    $multi_form->set('db_host', fRequest::encode('db_host', 'string', $db['host']));
    $multi_form->set('db_port', fRequest::encode('db_port', 'string', $db['port']));
    $multi_form->set('db_user', fRequest::encode('db_user', 'string', $db['user']));
    $multi_form->set('db_name', fRequest::encode('db_name', 'string', $db['database']));
    $multi_form->set('db_prefix', fRequest::encode('db_prefix', 'string', $db['prefix']));
    $multi_form->set('db_pw', fRequest::encode('db_pw', 'string', $db['pw']));
}
else {
    $servers = Util::getOption('servers');
    $servers = unserialize($servers);

    foreach($servers as $server) {
        $file = __INC__ . 'config/db_' . $server['slug'] . '.php';
        if(!file_exists($file)) {
            $servers[$server['slug']]['db_values'] = null;
            continue;
        }

        include $file;
        $servers[$server['slug']]['db_values'] = $db_values;
    }

    $tpl->set('servers', $servers);
}

if(fRequest::isPost() && fRequest::check('save_server')) {
    $servers = Util::getOption('servers');
    $servers = unserialize($servers);

    try {
        if($action == 'add' && isset($servers[$multi_form->get('server_slug')]))
            throw new fValidationException('Server slug already exists.');

        $vali = new fValidation();

        $vali->addIntegerFields(
            'db_port'
        );

        $vali->addRequiredFields(
            'server_name',
            'server_slug',
            'db_host',
            'db_port',
            'db_host',
            'db_user',
            'db_name',
            'db_prefix',
            'db_pw'
        );

        $vali->validate();

        $db_test = new fDatabase('mysql',
                                 $multi_form->get('db_name'),
                                 $multi_form->get('db_user'),
                                 $multi_form->get('db_pw'),
                                 $multi_form->get('db_host'),
                                 $multi_form->get('db_port'
                                 ));
        $db_test->connect();
        $db_test->close();

        $content = "<?php
/*
* Do not modify this unless you know what you are doing!
*/

\$db_values = array(
    'host'     => '" . $multi_form->get('db_host') . "',
    'port'     => '" . $multi_form->get('db_port') . "',
    'user'     => '" . $multi_form->get('db_user') . "',
    'pw'       => '" . $multi_form->get('db_pw') . "',
    'database' => '" . $multi_form->get('db_name') . "',
    'prefix'   => '" . $multi_form->get('db_prefix') . "',
    'type'     => '" . $multi_form->get('server_slug') . "'
);";

        $path = __INC__ . 'config/db_' . $multi_form->get('server_slug') . '.php';
        if($action == 'add')
            $file = fFile::create($path, $content);
        elseif($action == 'edit') {
            $file = new fFile($path);
            $file->write($content);
        }

        $servers[$multi_form->get('server_slug')] = array(
            'name' => $multi_form->get('server_name'),
            'slug' => $multi_form->get('server_slug')
        );
        Util::setOption('servers', serialize($servers));
        fURL::redirect('?page=admin&sub=multi');
    } catch(fException $e) {
        fMessaging::create('input', 'admin', $e->getMessage());
    }
}