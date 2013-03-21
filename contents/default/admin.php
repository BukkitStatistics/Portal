<?php
fMessaging::create('no-cache', '{cache}', true);
fAuthorization::requireLoggedIn();

$tpl = Util::newTpl($this, 'admin');

$tpl->set('langs', array(
                      'en' => 'English',
                      'de' => 'German'
                   ));
$tpl->set('times', array(
                            'Pacific/Midway'       => "(GMT-11:00) Midway Island",
                            'US/Samoa'             => "(GMT-11:00) Samoa",
                            'US/Hawaii'            => "(GMT-10:00) Hawaii",
                            'US/Alaska'            => "(GMT-09:00) Alaska",
                            'US/Pacific'           => "(GMT-08:00) Pacific Time (US &amp; Canada)",
                            'America/Tijuana'      => "(GMT-08:00) Tijuana",
                            'US/Arizona'           => "(GMT-07:00) Arizona",
                            'US/Mountain'          => "(GMT-07:00) Mountain Time (US &amp; Canada)",
                            'America/Chihuahua'    => "(GMT-07:00) Chihuahua",
                            'America/Mazatlan'     => "(GMT-07:00) Mazatlan",
                            'America/Mexico_City'  => "(GMT-06:00) Mexico City",
                            'America/Monterrey'    => "(GMT-06:00) Monterrey",
                            'Canada/Saskatchewan'  => "(GMT-06:00) Saskatchewan",
                            'US/Central'           => "(GMT-06:00) Central Time (US &amp; Canada)",
                            'US/Eastern'           => "(GMT-05:00) Eastern Time (US &amp; Canada)",
                            'US/East-Indiana'      => "(GMT-05:00) Indiana (East)",
                            'America/Bogota'       => "(GMT-05:00) Bogota",
                            'America/Lima'         => "(GMT-05:00) Lima",
                            'America/Caracas'      => "(GMT-04:30) Caracas",
                            'Canada/Atlantic'      => "(GMT-04:00) Atlantic Time (Canada)",
                            'America/La_Paz'       => "(GMT-04:00) La Paz",
                            'America/Santiago'     => "(GMT-04:00) Santiago",
                            'Canada/Newfoundland'  => "(GMT-03:30) Newfoundland",
                            'America/Buenos_Aires' => "(GMT-03:00) Buenos Aires",
                            'Greenland'            => "(GMT-03:00) Greenland",
                            'Atlantic/Stanley'     => "(GMT-02:00) Stanley",
                            'Atlantic/Azores'      => "(GMT-01:00) Azores",
                            'Atlantic/Cape_Verde'  => "(GMT-01:00) Cape Verde Is.",
                            'Africa/Casablanca'    => "(GMT) Casablanca",
                            'Europe/Dublin'        => "(GMT) Dublin",
                            'Europe/Lisbon'        => "(GMT) Lisbon",
                            'Europe/London'        => "(GMT) London",
                            'Africa/Monrovia'      => "(GMT) Monrovia",
                            'Europe/Amsterdam'     => "(GMT+01:00) Amsterdam",
                            'Europe/Belgrade'      => "(GMT+01:00) Belgrade",
                            'Europe/Berlin'        => "(GMT+01:00) Berlin",
                            'Europe/Bratislava'    => "(GMT+01:00) Bratislava",
                            'Europe/Brussels'      => "(GMT+01:00) Brussels",
                            'Europe/Budapest'      => "(GMT+01:00) Budapest",
                            'Europe/Copenhagen'    => "(GMT+01:00) Copenhagen",
                            'Europe/Ljubljana'     => "(GMT+01:00) Ljubljana",
                            'Europe/Madrid'        => "(GMT+01:00) Madrid",
                            'Europe/Paris'         => "(GMT+01:00) Paris",
                            'Europe/Prague'        => "(GMT+01:00) Prague",
                            'Europe/Rome'          => "(GMT+01:00) Rome",
                            'Europe/Sarajevo'      => "(GMT+01:00) Sarajevo",
                            'Europe/Skopje'        => "(GMT+01:00) Skopje",
                            'Europe/Stockholm'     => "(GMT+01:00) Stockholm",
                            'Europe/Vienna'        => "(GMT+01:00) Vienna",
                            'Europe/Warsaw'        => "(GMT+01:00) Warsaw",
                            'Europe/Zagreb'        => "(GMT+01:00) Zagreb",
                            'Europe/Athens'        => "(GMT+02:00) Athens",
                            'Europe/Bucharest'     => "(GMT+02:00) Bucharest",
                            'Africa/Cairo'         => "(GMT+02:00) Cairo",
                            'Africa/Harare'        => "(GMT+02:00) Harare",
                            'Europe/Helsinki'      => "(GMT+02:00) Helsinki",
                            'Europe/Istanbul'      => "(GMT+02:00) Istanbul",
                            'Asia/Jerusalem'       => "(GMT+02:00) Jerusalem",
                            'Europe/Kiev'          => "(GMT+02:00) Kyiv",
                            'Europe/Minsk'         => "(GMT+02:00) Minsk",
                            'Europe/Riga'          => "(GMT+02:00) Riga",
                            'Europe/Sofia'         => "(GMT+02:00) Sofia",
                            'Europe/Tallinn'       => "(GMT+02:00) Tallinn",
                            'Europe/Vilnius'       => "(GMT+02:00) Vilnius",
                            'Asia/Baghdad'         => "(GMT+03:00) Baghdad",
                            'Asia/Kuwait'          => "(GMT+03:00) Kuwait",
                            'Africa/Nairobi'       => "(GMT+03:00) Nairobi",
                            'Asia/Riyadh'          => "(GMT+03:00) Riyadh",
                            'Asia/Tehran'          => "(GMT+03:30) Tehran",
                            'Europe/Moscow'        => "(GMT+04:00) Moscow",
                            'Asia/Baku'            => "(GMT+04:00) Baku",
                            'Europe/Volgograd'     => "(GMT+04:00) Volgograd",
                            'Asia/Muscat'          => "(GMT+04:00) Muscat",
                            'Asia/Tbilisi'         => "(GMT+04:00) Tbilisi",
                            'Asia/Yerevan'         => "(GMT+04:00) Yerevan",
                            'Asia/Kabul'           => "(GMT+04:30) Kabul",
                            'Asia/Karachi'         => "(GMT+05:00) Karachi",
                            'Asia/Tashkent'        => "(GMT+05:00) Tashkent",
                            'Asia/Kolkata'         => "(GMT+05:30) Kolkata",
                            'Asia/Kathmandu'       => "(GMT+05:45) Kathmandu",
                            'Asia/Yekaterinburg'   => "(GMT+06:00) Ekaterinburg",
                            'Asia/Almaty'          => "(GMT+06:00) Almaty",
                            'Asia/Dhaka'           => "(GMT+06:00) Dhaka",
                            'Asia/Novosibirsk'     => "(GMT+07:00) Novosibirsk",
                            'Asia/Bangkok'         => "(GMT+07:00) Bangkok",
                            'Asia/Jakarta'         => "(GMT+07:00) Jakarta",
                            'Asia/Krasnoyarsk'     => "(GMT+08:00) Krasnoyarsk",
                            'Asia/Chongqing'       => "(GMT+08:00) Chongqing",
                            'Asia/Hong_Kong'       => "(GMT+08:00) Hong Kong",
                            'Asia/Kuala_Lumpur'    => "(GMT+08:00) Kuala Lumpur",
                            'Australia/Perth'      => "(GMT+08:00) Perth",
                            'Asia/Singapore'       => "(GMT+08:00) Singapore",
                            'Asia/Taipei'          => "(GMT+08:00) Taipei",
                            'Asia/Ulaanbaatar'     => "(GMT+08:00) Ulaan Bataar",
                            'Asia/Urumqi'          => "(GMT+08:00) Urumqi",
                            'Asia/Irkutsk'         => "(GMT+09:00) Irkutsk",
                            'Asia/Seoul'           => "(GMT+09:00) Seoul",
                            'Asia/Tokyo'           => "(GMT+09:00) Tokyo",
                            'Australia/Adelaide'   => "(GMT+09:30) Adelaide",
                            'Australia/Darwin'     => "(GMT+09:30) Darwin",
                            'Asia/Yakutsk'         => "(GMT+10:00) Yakutsk",
                            'Australia/Brisbane'   => "(GMT+10:00) Brisbane",
                            'Australia/Canberra'   => "(GMT+10:00) Canberra",
                            'Pacific/Guam'         => "(GMT+10:00) Guam",
                            'Australia/Hobart'     => "(GMT+10:00) Hobart",
                            'Australia/Melbourne'  => "(GMT+10:00) Melbourne",
                            'Pacific/Port_Moresby' => "(GMT+10:00) Port Moresby",
                            'Australia/Sydney'     => "(GMT+10:00) Sydney",
                            'Asia/Vladivostok'     => "(GMT+11:00) Vladivostok",
                            'Asia/Magadan'         => "(GMT+12:00) Magadan",
                            'Pacific/Auckland'     => "(GMT+12:00) Auckland",
                            'Pacific/Fiji'         => "(GMT+12:00) Fiji",
                       ));

/*
 * Store input values
 */
$tpl->set('language', fRequest::encode('language', 'string', Util::getOption('language')));
$tpl->set('timezone', fRequest::encode('timezone', 'string', Util::getOption('timezone')));
$tpl->set('ping', fRequest::encode('ping', 'int', Util::getOption('ping')));
$tpl->set('time_format', fRequest::encode('time_format', 'string', Util::getOption('time_format')));
$tpl->set('adminemail', fRequest::encode('adminemail', 'string', Util::getOption('adminemail')));
$tpl->set('portal_title', fRequest::encode('portal_title', 'string', Util::getOption('portal_title')));
$tpl->set('logo_url', fRequest::encode('logo_url', 'string', Util::getOption('logo_url')));
$tpl->set('first_join_msg', fRequest::get('first_join_msg', 'string', Util::getOption('first_join_message')));
$tpl->set('show_first_join_msg', fRequest::get('show_first_join_msg', 'string', Util::getOption('show_first_join_message')));
$tpl->set('welcome_msg', fRequest::get('welcome_msg', 'string', Util::getOption('welcome_message')));
$tpl->set('show_welcome_msg', fRequest::get('show_welcome_msg', 'int', Util::getOption('show_welcome_messages')));
$tpl->set('delay', fRequest::get('delay', 'int', Util::getOption('log_delay')));

$tpl->set('db_host', fRequest::encode('db_host', 'string', DB_HOST));
$tpl->set('db_port', fRequest::encode('db_port', 'string', DB_PORT));
$tpl->set('db_user', fRequest::encode('db_user', 'string', DB_USER));
$tpl->set('db_name', fRequest::encode('db_name', 'string', DB_DATABASE));
$tpl->set('db_prefix', fRequest::encode('db_prefix', 'string', DB_PREFIX));
$tpl->set('db_pw', fRequest::encode('db_pw', 'string', DB_PW));

if(fRequest::isPost() && fRequest::get('save')) {
    try {
        $vali = new fValidation();

        $vali->addEmailFields('adminemail')
            ->addIntegerFields('db_port', 'ping', 'delay');

        $vali->addRequiredFields(
            array(
                 'db_host',
                 'db_port',
                 'db_user',
                 'db_name',
                 'db_prefix',
                 'db_pw',
                 'adminemail',
                 'portal_title',
                 'ping'
            )
        );

        $vali->validate();

        Util::setOption('adminemail', $tpl->get('adminemail'));
        Util::setOption('portal_title', $tpl->get('portal_title'));
        Util::setOption('logo_url', $tpl->get('logo_url'));
        Util::setOption('timezone', $tpl->get('timezone'));
        Util::setOption('language', $tpl->get('language'));
        Util::setOption('time_format', $tpl->get('time_format'));
        Util::setOption('ping', $tpl->get('ping'));
        Util::setOption('show_first_join_message', $tpl->get('show_first_join_msg'));
        Util::setOption('show_welcome_messages', $tpl->get('show_welcome_msg'));
        Util::setOption('welcome_message', $tpl->get('welcome_msg'));
        Util::setOption('first_join_message', $tpl->get('first_join_msg'));
        Util::setOption('log_delay', $tpl->get('delay'));

        if(fRequest::get('adminpw') != '')
            Util::setOption('adminpw', fCryptography::hashPassword(fRequest::get('adminpw', 'string')));

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
elseif(fRequest::isPost() && fRequest::get('logout')) {
    fAuthorization::destroyUserInfo();
    fURL::redirect('./');
}