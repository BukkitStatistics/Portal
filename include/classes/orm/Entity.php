<?php
class Entity extends fActiveRecord {


    /**
     *
     * Returns the html code to the entity image.<br>
     * If no images was found it will return the default image.<br>
     * Set $tooltip to show the bootstrap tooltip instead of the browser alt tag.
     *
     * @param String|Entity $entity
     * @param int    $size
     * @param String $classes
     * @param bool   $tooltip
     *
     * @return string
     */
    public static function getEntityImg($entity, $size = 32, $classes = null, $tooltip = false) {
        if(is_string($entity)) {
            try {
                $entity = new Entity($entity);
            } catch(fNotFoundException $e) {
                fCore::debug($e);
                $entity = new Entity();
                $entity->setTpName('unknown');
            }
        }
        $tp_name = $entity->getTpName();

        $path = 'media/img/entities/';
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

        return
            '<img ' . $class . ' src="' . fFilesystem::translateToWebPath($img) . '" title="' .
            $entity->getName() . '" alt="' .
            $entity->getName() . '" style="width: ' . $size . 'px; height: ' . $size . 'px" ' . $tooltip . '>';
    }

    /**
     * Gets the most dangerous entity.<br>
     * The first array value is an fNumber which is the count. The second one is the entity name.
     *
     * @return array
     */
    public static function getMostDangerous() {
        $res = fORMDatabase::retrieve('name:' . DB_TYPE)->translatedQuery('
                    SELECT SUM(pve.player_killed) AS total, e.entity_id
                    FROM "prefix_total_pve_kills" pve, "prefix_entities" e
                    WHERE pve.entity_id = e.entity_id
                    GROUP BY pve.entity_id
                    ORDER BY SUM(pve.player_killed) DESC
                    LIMIT 0,1
        ');

        try {
            $row = $res->fetchRow();
            $num = new fNumber($row['total']);

            return array($num->format(), $row['entity_id']);
        } catch(fNoRowsException $e) {
            return array(0, 'none');
        }
    }

    /**
     * Gets the most killed entity.<br>
     * The first array value is an fNumber which is the count. The second one is the entity name.
     *
     * @return array
     */
    public static function getMostKilled() {
        $res = fORMDatabase::retrieve('name:' . DB_TYPE)->translatedQuery('
                    SELECT SUM(pve.creature_killed) AS total, e.entity_id
                    FROM "prefix_total_pve_kills" pve, "prefix_entities" e
                    WHERE pve.entity_id = e.entity_id
                    GROUP BY pve.entity_id
                    ORDER BY SUM(pve.creature_killed) DESC
                    LIMIT 0,1
        ');

        try {
            $row = $res->fetchRow();
            $num = new fNumber($row['total']);

            return array($num->format(), $row['entity_id']);
        } catch(fNoRowsException $e) {
            return array(0, 'none');
        }
    }

    protected function configure() {
        global $lang;

        $lang->load('entities');
        parent::configure();
    }

    /**
     * Returns the html code to the entity.<br>
     * If no image was found it will return the default image.
     *
     * @param int    $size
     * @param String $classes
     * @param bool   $tooltip
     *
     * @return string
     */
    public function getImage($size = 32, $classes = null, $tooltip = false) {
        return Entity::getEntityImg($this, $size, $classes, $tooltip);
    }

    /**
     * Returns the translated entity name.
     *
     * @return string
     */
    public function getName() {
        $name = fText::compose($this->getTpName());

        if($name != $this->getTpName())
            return $name;

        if(stripos($name, 'custom') !== false)
            $name = substr($name, 7); // remove custom_ from name

        $name = fGrammar::humanize($name);

        return $name;
    }

    /**
     * Returns the translated encoded entity name.
     *
     * @return string
     */
    public function encodeName() {
        return fHTML::encode($this->getName());
    }

    /**
     * Returns the translated prepared entity name.
     *
     * @return string
     */
    public function prepareName() {
        return fHTML::encode($this->getName());
    }

}
