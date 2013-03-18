<?php
class MiscInfoPlayer extends fActiveRecord {

    /**
     * Returns an bar with the $full and $half image.<br>
     * If the bg is null, no bg will be shown.
     *
     * @param      $full
     * @param      $half
     * @param null $bg
     *
     * @return string
     */
    private function makeBar($full, $half, $bg = null) {
        $s = '';

        for($i = 1; $i <= 20; $i++) {
            $cur = '';
            $style = '';

            if($i <= $this->getFoodLevel()) {
                if($i == $this->getFoodLevel() && $i % 2 != 0)
                    $cur = '<img src="' . fFilesystem::translateToWebPath($half) . '" alt="bar" />';
                else
                    $cur = '<img src="' . fFilesystem::translateToWebPath($full) . '" alt="bar" />';
            }
            else
                if(!is_null($bg))
                    $style = 'style="background-image: url(' . fFilesystem::translateToWebPath($bg) . ')"';

            $s .= '
            <div class="bar-container" ' . $style . '>
            ' . $cur . '
            </div>' . "\n";
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
        return $this->makeBar(__ROOT__ . 'media/img/misc/hunger-full.png',
                              __ROOT__ . 'media/img/misc/hunger-half.png',
                              __ROOT__ . 'media/img/misc/hunger-bg.png');
    }

    /**
     * Returns the full food bar with half and full heart.<br>
     * The missing parts are replaced by an empty heart.
     *
     * @return string
     */
    public function getHealthBar() {
        return $this->makeBar(__ROOT__ . 'media/img/misc/heart-full.png',
                              __ROOT__ . 'media/img/misc/heart-half.png',
                              __ROOT__ . 'media/img/misc/heart-bg.png');
    }

    /**
     * Returns the xp bar with the current level.
     *
     * @return string
     */
    public function getXPBar() {
        $perc = $this->getExpPerc() * 100;
        $cur = $this->getExpLevel();

        return '
            <div class="force-center xpbar-container">
                <div class="xpbar-cur">
                    ' . $cur .  '
                </div>
                <div class="xpbar" style="width: ' . $perc . '%"></div>
            </div>
                ';
    }

}