<?php
$tpl = Util::newTpl($this, 'admin/messages', 'sub');

/*
 * Store input values
 */
$tpl->set('first_join_msg', fRequest::get('first_join_msg', 'string', Util::getOption('first_join_message')));
$tpl->set('show_first_join_msg',
          fRequest::get('show_first_join_msg', 'string', Util::getOption('show_first_join_message')));
$tpl->set('welcome_msg', fRequest::get('welcome_msg', 'string', Util::getOption('welcome_message')));
$tpl->set('show_welcome_msg', fRequest::get('show_welcome_msg', 'string', Util::getOption('show_welcome_messages')));

if(fRequest::isPost() && fRequest::check('save')) {
    try {
        $vali = new fValidation();

        $vali->addConditionalRule('show_welcome_msg', '1', 'welcome_msg');
        $vali->addConditionalRule('show_first_join_msg', '1', 'first_join_msg');

        $vali->validate();

        Util::setOption('show_first_join_message', $tpl->get('show_first_join_msg'));
        Util::setOption('show_welcome_messages', $tpl->get('show_welcome_msg'));
        Util::setOption('welcome_message', $tpl->get('welcome_msg'));
        Util::setOption('first_join_message', $tpl->get('first_join_msg'));
    } catch(fValidationException $e) {
        fMessaging::create('input', 'admin', $e->getMessage());
    }
}