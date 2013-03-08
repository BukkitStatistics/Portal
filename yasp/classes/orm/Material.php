<?php
/**
 * This class represents a material in the materials table
 */
class Material extends fActiveRecord {

    /**
     * TODO: return html img?
     *
     * Will return the path to the material image.<br>
     * If no images was found it will return the default image.
     *
     * @param $tp_name
     *
     * @return string
     */
    public static function getMaterialImg($tp_name) {
        $path = __ROOT__ . 'img/materials/';
        $img = $path . $tp_name . '.png';

        if(file_exists($img))
            return $img;
        else
            return $path . 'default.png';
    }

    public function getImage($size = 25) {
        return '<img src="' . Material::getMaterialImg($this->getTpName()) . '" alt="' .
               fText::compose($this->getTpName()) . '" style="width: ' . $size . 'px; height: ' . $size . 'px"';
    }
}
