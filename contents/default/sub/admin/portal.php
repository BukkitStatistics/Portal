<?php
global $cache, $design;
$tpl = $this->loadTemplate('admin/portal', 'sub');

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
$tpl->set('portal_title', fRequest::encode('portal_title', 'string', Util::getOption('portal_title')));
$tpl->set('time_format', fRequest::encode('time_format', 'string', Util::getOption('time_format')));
$tpl->set('timezone', fRequest::encode('timezone', 'string', Util::getOption('timezone')));
$tpl->set('logo_url', fRequest::encode('logo_url', 'string', Util::getOption('logo_url')));

$tpl->set('cache_pages[d]', fRequest::encode('cache_pages[d]', 'int', Util::getOption('cache.pages') / 60 / 60 / 24));
$tpl->set('cache_pages[h]', fRequest::encode('cache_pages[h]', 'int', (Util::getOption('cache.pages') -
                                                                       $tpl->get('cache_pages[d]') * 60 * 60 * 24) /
                                                                      60 / 60));
$tpl->set('cache_pages[m]', fRequest::encode('cache_pages[m]', 'int', (Util::getOption('cache.pages') -
                                                                       $tpl->get('cache_pages[d]') * 60 * 60 * 24 -
                                                                       $tpl->get('cache_pages[h]') * 60 * 60) / 60));
$tpl->set('cache_pages[s]', fRequest::encode('cache_pages[s]', 'int', Util::getOption('cache.pages') -
                                                                      $tpl->get('cache_pages[d]') * 60 * 60 * 24 -
                                                                      $tpl->get('cache_pages[h]') * 60 * 60 -
                                                                      $tpl->get('cache_pages[m]') * 60));

$tpl->set('cache_skins[d]', fRequest::encode('cache_skins[d]', 'int', Util::getOption('cache.skins') / 60 / 60 / 24));
$tpl->set('cache_skins[h]', fRequest::encode('cache_skins[h]', 'int', (Util::getOption('cache.skins') -
                                                                       $tpl->get('cache_skins[d]') * 60 * 60 * 24) /
                                                                      60 / 60));
$tpl->set('cache_skins[m]', fRequest::encode('cache_skins[m]', 'int', (Util::getOption('cache.skins') -
                                                                       $tpl->get('cache_skins[d]') * 60 * 60 * 24 -
                                                                       $tpl->get('cache_skins[h]') * 60 * 60) / 60));
$tpl->set('cache_skins[s]', fRequest::encode('cache_skins[s]', 'int', Util::getOption('cache.skins') -
                                                                      $tpl->get('cache_skins[d]') * 60 * 60 * 24 -
                                                                      $tpl->get('cache_skins[h]') * 60 * 60 -
                                                                      $tpl->get('cache_skins[m]') * 60));


$tpl->set('cache_search[d]', fRequest::encode('cache_search[d]', 'int', Util::getOption('cache.search') / 60 / 60 / 24));
$tpl->set('cache_search[h]', fRequest::encode('cache_search[h]', 'int', (Util::getOption('cache.search') -
                                                                           $tpl->get('cache_search[d]') * 60 * 60 *
                                                                           24) /
                                                                          60 / 60));
$tpl->set('cache_search[m]', fRequest::encode('cache_search[m]', 'int', (Util::getOption('cache.search') -
                                                                           $tpl->get('cache_search[d]') * 60 * 60 *
                                                                           24 -
                                                                           $tpl->get('cache_search[h]') * 60 * 60) /
                                                                          60));
$tpl->set('cache_search[s]', fRequest::encode('cache_search[s]', 'int', Util::getOption('cache.search') -
                                                                          $tpl->get('cache_search[d]') * 60 * 60 * 24 -
                                                                          $tpl->get('cache_search[h]') * 60 * 60 -
                                                                          $tpl->get('cache_search[m]') * 60));

if(fRequest::isPost() && fRequest::check('save')) {
    try {
        $vali = new fValidation();

        $vali->addRequiredFields('portal_title');

        $vali->validate();

        Util::setOption('portal_title', $tpl->get('portal_title'));
        Util::setOption('logo_url', $tpl->get('logo_url'));
        Util::setOption('timezone', $tpl->get('timezone'));
        Util::setOption('time_format', $tpl->get('time_format'));

        $sec = $tpl->get('cache_pages[s]') + $tpl->get('cache_pages[m]') * 60 + $tpl->get('cache_pages[h]') * 60 * 60 +
               $tpl->get('cache_pages[d]') * 60 * 60 * 24;
        Util::setOption('cache.pages', $sec);

        $sec = $tpl->get('cache_skins[s]') + $tpl->get('cache_skins[m]') * 60 + $tpl->get('cache_skins[h]') * 60 * 60 +
               $tpl->get('cache_skins[d]') * 60 * 60 * 24;
        Util::setOption('cache.skins', $sec);

        $sec = $tpl->get('cache_search[s]') + $tpl->get('cache_search[m]') * 60 +
               $tpl->get('cache_search[h]') * 60 * 60 +
               $tpl->get('cache_search[d]') * 60 * 60 * 24;
        Util::setOption('cache.search', $sec);

        if(fRequest::get('delete_skins')) {
            $dir = new fDirectory(__ROOT__ . 'cache/skins');
            $files = $dir->scan('#\.png$#i');

            foreach($files as $file)
                $file->delete();
        }

        if(fRequest::get('delete_pages')) {
            $cache->clear();

            $old = $design->getEnvironment()->getCache();
            if($old === false)
                $design->getEnvironment()->setCache(__ROOT__ . Design::TWIG_CACHE);

            $design->getEnvironment()->clearCacheFiles();

            $design->getEnvironment()->setCache($old);
        }

    } catch(fValidationException $e) {
        fMessaging::create('input', 'admin', $e->getMessage());
    }
}