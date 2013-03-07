<?php
class Material extends fActiveRecord {

    public static function getImg($tp_name) {
        $path = __ROOT__ . 'img/materials/';
        $img = $path . $tp_name . '.png';

        if(file_exists($img))
            return $img;
        else
            return $path . 'default.png';
    }

    public static function countAllPlacedBlocks() {
        $res = fORMDatabase::retrieve()->translatedQuery('
                        SELECT COUNT(placed)
                        FROM "prefix_total_blocks"
        ');

        return $res->fetchScalar();
    }

    public static function countAllDestroyedBlocks() {
        $res = fORMDatabase::retrieve()->translatedQuery('
                        SELECT COUNT(destroyed)
                        FROM "prefix_total_blocks"
        ');

        return $res->fetchScalar();
    }

    public static function getMostPlacedBlock() {
        $res = fORMDatabase::retrieve()->translatedQuery('
                        SELECT MAX(b.placed) AS placed, m.tp_name AS tp_name
                        FROM "prefix_total_blocks" b, "prefix_materials" m
                        WHERE (
                            b.material_id = m.material_id
                            AND b.material_data = m.data
                            )
        ');

        $row = $res->fetchRow();

        return array($row['placed'], $row['tp_name']);
    }

    public static function getMostDestroyedBlock() {
        $res = fORMDatabase::retrieve()->translatedQuery('
                        SELECT MAX(b.destroyed) AS destroyed, m.tp_name AS tp_name
                        FROM "prefix_total_blocks" b, "prefix_materials" m
                        WHERE (
                            b.material_id = m.material_id
                            AND b.material_data = m.data
                            )
        ');

        $row = $res->fetchRow();

        return array($row['destroyed'], $row['tp_name']);
    }

}
