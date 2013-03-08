<?php
class Entity extends fActiveRecord {


    /**
     *
     * Will return the path to the entity image.<br>
     * If no images was found it will return the default image.
     *
     * @param     $tp_name
     *
     * @param int $size
     *
     * @return string
     */
    public static function getEntityImg($tp_name, $size = 25) {
        $path = __ROOT__ . 'media/img/entities/';
        $img = $path . $tp_name . '.png';

        if(!file_exists($img))
            $img = $path . 'none.png';

        return
            '<img src="' . fFilesystem::translateToWebPath($img) . '" title="' . fText::compose($tp_name) . '" alt="' .
            fText::compose($tp_name) . '" style="width: ' . $size . 'px; height: ' . $size . 'px">';
    }

    /**
     * Gets the most dangerous entity.<br>
     * The first array value is an fNumber which is the count. The second one is the block name.
     *
     * @return array
     */
    public static function getMostDangerous() {
        $res = fORMDatabase::retrieve()->translatedQuery('
                    SELECT SUM(pve.player_killed) AS total, e.tp_name
                    FROM "prefix_total_pve_kills" pve, "prefix_entities" e
                    WHERE pve.entity_id = e.entity_id
                    GROUP BY pve.entity_id
                    ORDER BY SUM(pve.player_killed) DESC
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
     * Gets the most killed entity.<br>
     * The first array value is an fNumber which is the count. The second one is the block name.
     *
     * @return array
     */
    public static function getMostKilled() {
        $res = fORMDatabase::retrieve()->translatedQuery('
                    SELECT SUM(pve.creature_killed) AS total, e.tp_name
                    FROM "prefix_total_pve_kills" pve, "prefix_entities" e
                    WHERE pve.entity_id = e.entity_id
                    GROUP BY pve.entity_id
                    ORDER BY SUM(pve.creature_killed) DESC
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

}
