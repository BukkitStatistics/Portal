<?php
class PlayerInventory extends fActiveRecord {

    /**
     * Prints the first inventory row.
     */
    public function printRowOne() {
        echo $this->getRow(fJSON::decode($this->getRowOne(), true));
    }

    /**
     * Prints the seconds inventory row.
     */
    public function printRowTwo() {
        echo $this->getRow(fJSON::decode($this->getRowTwo(), true));
    }

    /**
     * Prints the third inventory row
     */
    public function printRowThree() {
        echo $this->getRow(fJSON::decode($this->getRowThree(), true));
    }

    /**
     * Prints the hotbar.
     */
    public function printHotbar() {
        echo $this->getRow(fJSON::decode($this->getHotbar(), true));
    }

    /**
     * Prints the armour bar.
     */
    public function printArmor() {
        echo $this->getRow(fJSON::decode($this->getArmor(), true), true);
    }

    /**
     * Prints all effects if effects are given.
     */
    public function printEffects() {
        $effects = fJSON::decode($this->getPotionEffects(), true);

        if(empty($effects))
            return;

        foreach($effects as $effect) {
            echo $this->getEffect($effect);
        }
    }

    /**
     * Returns all images of an inventory row.
     *
     * @param      $row
     *
     * @param bool $armor
     *
     * @return string
     */
    private function getRow($row, $armor = false) {
        $s = '';

        if($row == '')
            return '';

        foreach($row as $slot)
            $s .= $this->getSlotItem($slot, $armor);

        return $s;
    }

    private function getSlotItem($slot, $armor = false) {
        // TODO: move to an tpl file...
        $item = new Material($slot['material_id']);
        $item->setEnchantments($slot['enchantments']);
        $s = '';

        $s .= '<div class="' . ($armor ? 'inv-row-item-armor' : 'inv-row-item') . '">';
        if($item->getMaterialId() != '0:0' && $item->getMaterialId() != '-1:0') {
            $s .= $item->getImage(32, null, true);
            if($slot['amount'] > 1) {
                $s .= '<div class="row-item-amount">' . $slot['amount'] . '</div>';
            }
            if($slot['amount'] <= 1 && $slot['durability'] != 0) {
                $s .= '<div class="row-item-durability"><div class="row-item-durability-bar ' .
                      Material::calcDurability($slot['durability']) . '" style="width: ' .
                      $slot['durability'] * 100 . '%"></div></div>';
            }
        }
        $s .= '</div>';

        return $s;
    }

    /**
     * Returns the image for the given $effect.
     *
     * @param $effect
     *
     * @return bool|string
     */
    private function getEffect($effect) {
        $path = __ROOT__ . 'media/img/effects/';
        $id = strlen($effect['effect_id']) > 1 ? $effect['effect_id'] : 0 . $effect['effect_id'];
        $img = $path . 'effect_' . $id . '.png';

        if(!file_exists($img))
            return false;

        return '<img src="' . fFilesystem::translateToWebPath($img) . '" alt="' . fText::compose('effect_' . $id) .
               '" title="' . fText::compose('effect_' . $id) . ' - ' .
               Util::formatSeconds(new fTimestamp($effect['time']), true, true, true, false) .
               '" rel="tooltip" class="player-effect" />';
    }

}