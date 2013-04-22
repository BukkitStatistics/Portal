<?php
$tpl = Util::newTpl($this, 'admin/modules', 'sub');

/*
 * Store input values
 */
$tpl->set('module_blocks', fRequest::encode('module_blocks', 'int', Util::getOption('module.blocks')));
$tpl->set('module_items', fRequest::encode('module_items', 'int', Util::getOption('module.items')));
$tpl->set('module_deaths', fRequest::encode('module_deaths', 'int', Util::getOption('module.deaths')));
$tpl->set('module_inventory', fRequest::encode('module_inventory', 'int', Util::getOption('module.module_inventory')));

if(fRequest::isPost() && fRequest::check('save')) {
    Util::setOption('module.blocks', $tpl->get('module_blocks'));
    Util::setOption('module.items', $tpl->get('module_items'));
    Util::setOption('module.deaths', $tpl->get('module_deaths'));
    Util::setOption('module.inventory', $tpl->get('module_inventory'));
}