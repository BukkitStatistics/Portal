<?php
class PlayerInventory extends fActiveRecord {

    public function printEffects() {
        $effects = fJSON::decode($this->getPotionEffects(), true);

        if(empty($effects))
            return;

        foreach($effects as $effect) {
            echo $this->getEffect($effect);
        }
    }

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