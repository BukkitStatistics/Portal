<?php
$tpl = Util::newTpl($this, 'admin/modules', 'sub');

/*
 * Store input values
 */
$tpl->set('module_blocks', fRequest::encode('module_blocks', 'string', Util::getOption('module_blocks')));
$tpl->set('module_items', fRequest::encode('module_items', 'string', Util::getOption('module_items')));
$tpl->set('module_deaths', fRequest::encode('module_deaths', 'string', Util::getOption('module_deaths')));

if(fRequest::isPost() && fRequest::check('save')) {
    Util::setOption('module.blocks', $tpl->get('module_blocks'));
    Util::setOption('module.items', $tpl->get('module_items'));
    Util::setOption('module.deaths', $tpl->get('module_deaths'));
}