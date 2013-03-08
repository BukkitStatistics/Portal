<?php
/**
 * This class represents a material in the materials table
 */
class Material extends fActiveRecord {

    /**
     *
     * Will return the path to the material image.<br>
     * If no images was found it will return the default image.
     *
     * @param     $tp_name
     *
     * @param int $size
     *
     * @return string
     */
    public static function getMaterialImg($tp_name, $size = 25) {
        $path = __ROOT__ . 'media/img/materials/';
        $img = $path . $tp_name . '.png';

        if(!file_exists($img))
            $img = $path . 'none.png';

        return '<img src="' . fFilesystem::translateToWebPath($img) . '" title="' . fText::compose($tp_name) . '" alt="' .
               fText::compose($tp_name) . '" style="width: ' . $size . 'px; height: ' . $size . 'px">';
    }

    public function getImage($size = 25) {
        return Material::getMaterialImg($this->getTpName(), $size);
    }
}
