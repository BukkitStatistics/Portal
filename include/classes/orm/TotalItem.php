<?php
class TotalItem extends fActiveRecord {

    /**
     * Returns the count of the specified item type.
     *
     * @param string   $type
     *
     * @param Material $material
     *
     * @return fNumber
     */
    public static function countAllOfType($type, $material = null) {
        try {
            if($material == null)
                $res = Util::getDatabase()->translatedQuery('
                        SELECT SUM(%r)
                        FROM "prefix_total_items"
                ', $type);
            else
                $res = Util::getDatabase()->translatedQuery('
                        SELECT SUM(%r)
                        FROM "prefix_total_items"
                        WHERE material_id = %s
                ', $type, $material->getMaterialId());

            $count = $res->fetchScalar();
            if(is_null($count))
                return new fNumber(0);

            return new fNumber($count);
        } catch(fException $e) {
            fCore::debug($e);
        }

        return new fNumber(0);
    }

    /**
     * Gets the most item of the specified type.<br>
     * The first array value is an fNumber which is the count. The second one is the material_id.
     *
     * @param $type
     *
     * @return array
     */
    public static function getMostOfType($type) {
        try {
            $res = Util::getDatabase()->translatedQuery('
                        SELECT SUM(i.%r) AS total, m.material_id
                        FROM "prefix_total_items" i, "prefix_materials" m
                        WHERE i.material_id = m.material_id

                        GROUP BY i.material_id
                        ORDER BY SUM(i.%r) DESC LIMIT 0,1
        ', $type, $type);

            $row = $res->fetchRow();
            $num = new fNumber($row['total']);

            return array($num->format(), $row['material_id']);
        } catch(fException $e) {
            fCore::debug($e);
        }

        return array(0, 'none');
    }
}
