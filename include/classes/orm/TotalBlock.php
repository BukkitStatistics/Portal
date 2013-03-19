<?php
class TotalBlock extends fActiveRecord {

    /**
     * Returns the count of the specified block type.
     *
     * @param $type
     *
     * @return fNumber
     */
    public static function countAllOfType($type) {
        try {
            $res = fORMDatabase::retrieve()->translatedQuery('
                        SELECT SUM(' . $type . ')
                        FROM "prefix_total_blocks"
        ');

            return new fNumber($res->fetchScalar());
        } catch(fSQLException $e) {
            return new fNumber(0);
        }
    }

    /**
     * Gets the most block of the specified type.<br>
     * The first array value is an fNumber which is the count. The second one is the block name.
     *
     * @param $type
     *
     * @return array|bool
     */
    public static function getMostOfType($type) {
        try {
            $res = fORMDatabase::retrieve()->translatedQuery('
                        SELECT SUM(b.' . $type . ') AS total, m.tp_name
                        FROM "prefix_total_blocks" b, "prefix_materials" m
                        WHERE (
                            b.material_id = m.material_id
                            AND b.material_data = m.data
                            )
                        GROUP BY b.material_id, b.material_data
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
