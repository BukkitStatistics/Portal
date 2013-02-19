<?php
if(fSession::get('maxStep') < 6)
    fURL::redirect('?step=converter');

$tpl = Util::newTpl($this, 'process');