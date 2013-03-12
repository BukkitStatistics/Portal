<?php
$tpl = Util::newTpl($this, 'error');

$tpl->set('url', fRequest::get('step'));
