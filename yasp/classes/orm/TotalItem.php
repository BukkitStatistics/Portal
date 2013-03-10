<?php
class TotalItem extends fActiveRecord {

    /**
     * Returns the count of the specified item type.
     *
     * @param $type
     *
     * @return fNumber
     */
    public static function countAllOfType($type) {
        try {
            $res = fORMDatabase::retrieve()->translatedQuery('
                        SELECT SUM(' . $type . ')
                        FROM "prefix_total_items"
        ');

            return new fNumber($res->fetchScalar());
        } catch(fSQLException $e) {
            return new fNumber(0);
        }
    }

    /**
     * Gets the most item of the specified type.<br>
     * The first array value is an fNumber which is the count. The second one is the block name.
     *
     * @param $type
     *
     * @return array
     */
    public static function getMostOfType($type) {
        try {
            $res = fORMDatabase::retrieve()->translatedQuery('
                        SELECT SUM(i.' . $type . ') AS total, m.tp_name
                        FROM "prefix_total_items" i, "prefix_materials" m
                        WHERE (
                            i.material_id = m.material_id
                            AND i.material_data = m.data
                            )
                        GROUP BY i.material_id, i.material_data
                        ORDER BY SUM(i.' . $type . ') DESC LIMIT 0,1
        ');

            $row = $res->fetchRow();
            $num = new fNumber($row['total']);

            return array($num->format(), $row['tp_name']);
        } catch(fSQLException $e) {
            return array(0, 'none');
        }
    }

    /**
     * Overrides the original create function because of the strange behaviour of flourish with two or more primary keys.
     *
     * @return Material
     */
    public function createMaterial() {
        return new Material(
            array(
                 'material_id' => $this->getMaterialId(),
                 'data'        => $this->getMaterialData()
            )
        );
    }
}
