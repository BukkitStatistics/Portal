<?php
class TotalBlock extends fActiveRecord {

    /**
     * Returns the count of the specified block type.
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
                $where = '';
            else
                $where = 'WHERE material_id = ' . $material->getMaterialId();

            $res = fORMDatabase::retrieve()->translatedQuery('
                        SELECT SUM(' . $type . ')
                        FROM "prefix_total_blocks"
                        ' . $where . '
            ');

            $count = $res->fetchScalar();
            if(is_null($count))
                return new fNumber(0);

            return new fNumber($count);
        } catch(fSQLException $e) {
            fCore::debug($e->getMessage());
        }

        return new fNumber(0);
    }

    /**
     * Gets the most block of the specified type.<br>
     * The first array value is an fNumber which is the count. The second one is the block name.
     *
     * @param string   $type
     *
     * @return array|bool
     */
    public static function getMostOfType($type) {
        try {
            $res = fORMDatabase::retrieve()->translatedQuery('
                        SELECT SUM(b.' . $type . ') AS total, m.tp_name
                        FROM "prefix_total_blocks" b, "prefix_materials" m
                        WHERE b.material_id = m.material_id
                        GROUP BY b.material_id
                        ORDER BY SUM(b.' . $type . ') DESC LIMIT 0,1
        ');

            $row = $res->fetchRow();
            $num = new fNumber($row['total']);

            return array($num->format(), $row['tp_name']);
        } catch(fSQLException $e) {
            return array(0, 'none');
        }
    }
}
