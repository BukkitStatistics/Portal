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
     */public static function getImg($tp_name) {
        $path = __ROOT__ . 'img/materials/';
        $img = $path . $tp_name . '.png';

        if(file_exists($img))
            return $img;
        else
            return $path . 'default.png';
}

    /**
     * Counts all placed blocks
     *
     * @return fNumber
     */public static function countAllPlacedBlocks() {
        $res = fORMDatabase::retrieve()->translatedQuery('
                        SELECT COUNT(placed)
                        FROM "prefix_total_blocks"
        ');

        return new fNumber($res->fetchScalar());
}

    /**
     * Counts all destroyed blocks
     *
     * @return fNumber
     */public static function countAllDestroyedBlocks() {
        $res = fORMDatabase::retrieve()->translatedQuery('
                        SELECT COUNT(destroyed)
                        FROM "prefix_total_blocks"
        ');

        return new fNumber($res->fetchScalar());
}

    /**
     * Gets the most placed block.<br>
     * The first array value is an fNumber which is the count. The second one is the block name.
     *
     * @return array
     */public static function getMostPlacedBlock() {
        $res = fORMDatabase::retrieve()->translatedQuery('
                        SELECT MAX(b.placed) AS placed, m.tp_name AS tp_name
                        FROM "prefix_total_blocks" b, "prefix_materials" m
                        WHERE (
                            b.material_id = m.material_id
                            AND b.material_data = m.data
                            )
        ');

        $row = $res->fetchRow();
        $num = new fNumber($row['placed']);

        return array($num->format(), $row['tp_name']);
}

    /**
     * Gets the most destroyed block.<br>
     * The first array value is an fNumber which is the count. The second one is the block name.
     *
     * @return array
     */public static function getMostDestroyedBlock() {
        $res = fORMDatabase::retrieve()->translatedQuery('
                        SELECT MAX(b.destroyed) AS destroyed, m.tp_name AS tp_name
                        FROM "prefix_total_blocks" b, "prefix_materials" m
                        WHERE (
                            b.material_id = m.material_id
                            AND b.material_data = m.data
                            )
        ');

        $row = $res->fetchRow();
        $num = new fNumber($row['destroyed']);

        return array($num->format(), $row['tp_name']);
    }

}
