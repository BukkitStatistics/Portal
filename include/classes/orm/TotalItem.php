<?php
class TotalItem extends fActiveRecord {

    protected function configure() {
        fORMColumn::configureNumberColumn($this, 'picked_up');
        fORMColumn::configureNumberColumn($this, 'dropped');
        fORMColumn::configureNumberColumn($this, 'used');
        fORMColumn::configureNumberColumn($this, 'crafted');
        fORMColumn::configureNumberColumn($this, 'smelted');
        fORMColumn::configureNumberColumn($this, 'broken');
        fORMColumn::configureNumberColumn($this, 'enchanted');
    }

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
                $res = fORMDatabase::retrieve()->translatedQuery('
                        SELECT SUM(%r)
                        FROM "prefix_total_items"
                ', $type);
            else
                $res = fORMDatabase::retrieve()->translatedQuery('
                        SELECT SUM(%r)
                        FROM "prefix_total_items"
                        WHERE material_id = %s
                ', $type, $material->getMaterialId());

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
                        SELECT SUM(i.%r) AS total, m.tp_name
                        FROM "prefix_total_items" i, "prefix_materials" m
                        WHERE i.material_id = m.material_id

                        GROUP BY i.material_id
                        ORDER BY SUM(i.%r) DESC LIMIT 0,1
        ', $type, $type);

            $row = $res->fetchRow();
            $num = new fNumber($row['total']);

            return array($num->format(), $row['tp_name']);
        } catch(fSQLException $e) {
            fCore::debug($e->getMessage());
        } catch(fNoRowsException $e) {
            fCore::debug($e->getMessage());
        }

        return array(0, 'none');
    }
}
