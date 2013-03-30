<?php
$tpl = Util::newTpl($this, 'admin/database', 'sub');
// TODO: reset database options
/*
 * Store input values
 */
$tpl->set('delay', fRequest::get('delay', 'int', Util::getOption('log_delay')));
$tpl->set('ping', fRequest::encode('ping', 'int', Util::getOption('ping')));
$tpl->set('db_host', fRequest::encode('db_host', 'string', DB_HOST));
$tpl->set('db_port', fRequest::encode('db_port', 'string', DB_PORT));
$tpl->set('db_user', fRequest::encode('db_user', 'string', DB_USER));
$tpl->set('db_name', fRequest::encode('db_name', 'string', DB_DATABASE));
$tpl->set('db_prefix', fRequest::encode('db_prefix', 'string', DB_PREFIX));
$tpl->set('db_pw', fRequest::encode('db_pw', 'string', DB_PW));

if(fRequest::isPost() && fRequest::check('save')) {
    try {
        $vali = new fValidation();

        $vali->addIntegerFields(
            'delay',
            'ping',
            'db_port'
        );

        $vali->addRequiredFields(
            'delay',
            'ping',
            'db_host',
            'db_port',
            'db_host',
            'db_user',
            'db_name',
            'db_prefix',
            'db_pw'
        );

        $vali->validate();

        Util::setOption('ping', $tpl->get('ping'));
        Util::setOption('log_delay', $tpl->get('delay'));

        $tpl->set('prefix', preg_replace('/_$/', '', $tpl->get('prefix')));

        $contents =
            "<?php \n/*\n* Do not modify this unless you know what you are doing!\n*/\n\ndefine('DB_HOST', '" .
            $tpl->get('db_host') . "');\ndefine('DB_PORT', '" . $tpl->get('db_port') . "');\ndefine('DB_USER', '" .
            $tpl->get('db_user') . "');\ndefine('DB_PW', '" . $tpl->get('db_pw') .
            "');\ndefine('DB_DATABASE', '" . $tpl->get('db_name') . "');\ndefine('DB_PREFIX', '" .
            $tpl->get('db_prefix') . "');\n";

        $db_file = new fFile(__INC__ . 'config/db.php');
        $db_file->write($contents);
    } catch(fValidationException $e) {
        fMessaging::create('input', 'admin', $e->getMessage());
    }
}