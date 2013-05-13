<?php
/**
 * This class represents a material in the materials table
 */
class Material extends fActiveRecord {

    /**
     *
     * Returns the html code to the material image.<br>
     * If no images was found it will return the default image.
     * Set $tooltip to show the bootstrap tooltip instead of the browser alt tag.<br>
     * If the material got enchantments an popover will be displayed.
     *
     * @param Material|string $material
     * @param int             $size
     * @param String          $classes
     * @param bool            $tooltip
     *
     * @return string
     */
    public static function getMaterialImg($material, $size = 32, $classes = null, $tooltip = false) {
        global $lang;

        if(is_string($material)) {
            try {
                $material = new Material($material);
            } catch(fNotFoundException $e) {
                fCore::debug($e);
                $material = new Material('-1:0');
            }
        }

        $tp_name = $material->getTpName();

        $path = 'media/img/materials/';
        $img = $path . $tp_name . '.png';

        if(!file_exists($img))
            $img = $path . 'none.png';

        if(!is_null($classes))
            $class = 'class="' . $classes . '"';
        else
            $class = '';

        if($tooltip)
            $tooltip = 'rel="tooltip"';
        else
            $tooltip = '';

        $title = 'title="' . $material->getName() . '"';

        $tooltip_data = '';
        if(is_object($material) && count($material->getEnchantments())) {
            // load enchantment translation
            $lang->load('enchantments');

            $title = '';
            $tooltip_data = 'data-original-title="';
            $tooltip_data .= $material->getName() . '<br>';

            foreach($material->getEnchantments() as $enchant) {
                $tooltip_data .= fText::compose('enchantment_' . $enchant['enchantment_id']);
                $tooltip_data .= ' ' . Util::getRomanNumber($enchant['enchantment_level']);
                $tooltip_data .= '<br>';
            }

            $tooltip_data .= '"';
        }

        return
            '<img ' . $class . ' src="' . fFilesystem::translateToWebPath($img) . '" alt="' .
            fText::compose($tp_name) . '" ' . $title . ' style="width: ' . $size . 'px; height: ' . $size . 'px" ' .
            $tooltip . ' ' .
            $tooltip_data . '>';
    }

    /**
     * Returns the css class for the current durability percentage.<br>
     * <ul>
     *     <li>$perc >= 70 - good</li>
     *     <li>$perc < 70 and >= 30 - medium</li>
     *     <li>$perc < 30 and >= 10 - bad</li>
     *     <li>$perc < 10 - critical</li>
     * </ul>
     *
     * @param $perc
     *
     * @return string
     */
    public static function calcDurability($perc) {
        $perc = $perc * 100;

        if($perc >= 70)
            return 'good';
        elseif($perc < 70 && $perc >= 30)
            return 'medium';
        elseif($perc < 30 && $perc >= 10)
            return 'bad';
        else
            return 'critical';
    }

    /**
     * Gets the most dangerous material.<br>
     * The first array value is an fNumber which is the count. The second one is the material_id.<br>
     *
     * This function is incredibly slow with large tables.
     *
     * @deprecated
     * @return array
     */
    public static function getMostDangerous() {
        // TODO need to be optimized
        $res = fORMDatabase::retrieve('name:' . DB_TYPE)->translatedQuery('
                    SELECT SUM(pve.creature_killed) + SUM(pvp.times) AS total,
                        m.material_id
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

            return array($num->format(), $row['material_id']);
        } catch(fNoRowsException $e) {
            return array(0, 'none');
        }
    }

    /**
     * Enchantment array of this material
     *
     * @var array
     */
    private $enchantments = array();


    /**
     * Calls the parent constructor and loads the material language file.
     *
     * @param null $key
     */
    public function __construct($key = NULL) {
        global $lang;
        parent::__construct($key);

        $lang->load('materials');
    }

    /**
     * Stores the enchantments in the $enchantments array.<br>
     * Needs an json string
     *
     * @param array $enchants
     */
    public function setEnchantments($enchants) {
        if(!is_array($enchants) || empty($enchants))
            return;

        $this->enchantments = $enchants;
    }

    /**
     * Returns the enchantment array
     *
     * @return array
     */
    public function getEnchantments() {
        return $this->enchantments;
    }

    /**
     * Returns the image of this material.
     *
     * @param int    $size
     * @param String $classes
     * @param bool   $tooltip
     *
     * @return string
     */
    public function getImage($size = 32, $classes = null, $tooltip = false) {
        return Material::getMaterialImg($this, $size, $classes, $tooltip);
    }

    /**
     * Returns the translated material name.
     *
     * @return string
     */
    public function getName() {
        $name = fText::compose($this->getTpName());

        if($name != $this->getTpName())
            return $name;

        if(stripos($name, 'custom_') !== false)
            $name = substr($name, 7); // remove custom_ from name

        $name = fGrammar::humanize($name);

        return $name;
    }
}
