<?php
/**
 * This class represents a material in the materials table
 */
class Material extends fActiveRecord {

    /**
     *
     * Returns the html code to the material image.<br>
     * If no images was found it will return the default image.
     *
     * @param String $tp_name
     * @param int    $size
     * @param String $classes
     *
     * @return string
     */
    public static function getMaterialImg($tp_name, $size = 32, $classes = null) {
        $path = __ROOT__ . 'media/img/materials/';
        $img = $path . $tp_name . '.png';

        if(!file_exists($img))
            $img = $path . 'none.png';

        if(!is_null($classes))
            $class = 'class="' . $classes . '"';
        else
            $class = '';

        return
            '<img ' . $class . ' src="' . fFilesystem::translateToWebPath($img) . '" title="' .
            fText::compose($tp_name) . '" alt="' .
            fText::compose($tp_name) . '" style="width: ' . $size . 'px; height: ' . $size . 'px">';
    }

    /**
     * Gets the most dangerous material.<br>
     * The first array value is an fNumber which is the count. The second one is the block name.
     *
     * @return array
     */
    public static function getMostDangerous() {
        // need to be optimized
        $res = fORMDatabase::retrieve()->translatedQuery('
                    SELECT SUM(pve.creature_killed) + SUM(pvp.times) AS total,
                        m.tp_name
                    FROM "prefix_total_pve_kills" pve
                            INNER JOIN "prefix_total_pvp_kills" pvp ON pve.material_id = pvp.material_id,
                        "prefix_materials" m
                    WHERE pve.material_id != -1
                    AND pve.material_id = m.material_id
                    GROUP BY pve.material_id
                    ORDER BY SUM(pve.creature_killed) + SUM(pvp.times) DESC
                    LIMIT 0,1
        ');

        try {
            $row = $res->fetchRow();
            $num = new fNumber($row['total']);

            return array($num->format(), $row['tp_name']);
        } catch(fNoRowsException $e) {
            return array(0, 'none');
        }
    }

    /**
     * Returns the image of this material.
     *
     * @param int    $size
     * @param String $classes
     *
     * @return string
     */
    public function getImage($size = 32, $classes = null) {
        return Material::getMaterialImg($this->getTpName(), $size, $classes);
    }

    /**
     * Returns the translated material name.
     *
     * @return string
     */
    public function getName() {
        return fText::compose($this->getTpName());
    }
}
