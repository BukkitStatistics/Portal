<?php
class TotalPveKill extends fActiveRecord {

    protected function configure() {
        fORMColumn::configureNumberColumn($this, 'player_killed');
        fORMColumn::configureNumberColumn($this, 'creature_killed');
    }


}