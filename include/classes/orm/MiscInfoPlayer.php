<?php
class MiscInfoPlayer extends fActiveRecord {

    /**
     * Returns an bar with the $full and $half image.<br>
     * If the bg is null, no bg will be shown.
     *
     * @param      $max
     * @param      $full
     * @param      $half
     * @param null $bg
     *
     * @return string
     */
    private function makeBar($max, $full, $half, $bg = null) {
        $s = '';

        for($i = 1; $i <= 10; $i++) {
            $cur = '';
            $style = '';

            if($i <= ceil($max / 2)) {
                if($max % 2 && $i == ceil($max / 2))
                    $cur = '<img src="' . fFilesystem::translateToWebPath($half) . '" alt="bar">';
                else
                    $cur = '<img src="' . fFilesystem::translateToWebPath($full) . '" alt="bar">';
            }
            else
                if(!is_null($bg))
                    $cur = '<img src="' . fFilesystem::translateToWebPath($bg) . '" alt="bar-none">';

            $s .= $cur . "\n";
        }

        return $s;
    }

    /**
     * Returns the full food bar with half and full hunger indicators.<br>
     * The missing parts are replaced by an empty hunger indicator.
     *
     * @return string
     */
    public function getFoodBar() {
        return $this->makeBar($this->getFoodLevel(), 'media/img/misc/hunger-full.png',
                              'media/img/misc/hunger-half.png', 'media/img/misc/hunger-bg.png');
    }

    /**
     * Returns the full food bar with half and full heart.<br>
     * The missing parts are replaced by an empty heart.
     *
     * @return string
     */
    public function getHealthBar() {
        return $this->makeBar($this->getHealth(), 'media/img/misc/heart-full.png', 'media/img/misc/heart-half.png',
                              'media/img/misc/heart-bg.png');
    }

    /**
     * Returns the full armor bar with half and full armor.<br>
     * The missing parts are not displayed.
     *
     * @return string
     */
    public function getArmorBar() {
        return $this->makeBar($this->getArmorRating(), 'media/img/misc/armor-full.png', 'media/img/misc/armor-half.png');
    }

    /**
     * Returns the xp bar with the current level.
     *
     * @return string
     */
    public function getXPBar() {
        $perc = $this->getExpPerc() * 100;
        $cur = $this->getExpLevel();

        return '<div class="xpbar" style="width: ' . $perc . '%"></div>';
    }

}