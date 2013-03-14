<?php
class DistancePlayer extends fActiveRecord {

    protected function configure() {
            fORMColumn::configureNumberColumn($this, 'foot');
            fORMColumn::configureNumberColumn($this, 'minecart');
            fORMColumn::configureNumberColumn($this, 'boat');
            fORMColumn::configureNumberColumn($this, 'pig');
            fORMColumn::configureNumberColumn($this, 'swimmed');
    }

    public function getTotal() {
        return $this->getFoot()->add(
            $this->getMinecart()->add(
                $this->getBoat()->add(
                    $this->getSwimmed()->add(
                        $this->getPig()
                    ))));
    }

}