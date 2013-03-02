<?php
if(fSession::get('maxStep') < 7)
    fURL::redirect('?step=converter');

$tpl = Util::newTpl($this, 'five');