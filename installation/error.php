<?php
$tpl = $this->loadTemplate('error', 'tpl');

$tpl->set('url', fRequest::get('step'));
