<?php
class TotalPvpKill extends fActiveRecord {

    protected function configure() {
        fORMColumn::configureNumberColumn($this, 'times');
    }


}