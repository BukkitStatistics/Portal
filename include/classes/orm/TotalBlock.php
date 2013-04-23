<?php
class TotalBlock extends fActiveRecord {

    protected function configure() {
        fORMColumn::configureNumberColumn($this, 'placed');
        fORMColumn::configureNumberColumn($this, 'destroyed');
    }


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
                $res = fORMDatabase::retrieve('name:' . DB_TYPE)->translatedQuery('
                        SELECT SUM(%r)
                        FROM "prefix_total_blocks"
                ', $type);
            else
                $res = fORMDatabase::retrieve('name:' . DB_TYPE)->translatedQuery('
                        SELECT SUM(%r)
                        FROM "prefix_total_blocks"
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
     * Gets the most block of the specified type.<br>
     * The first array value is an fNumber which is the count. The second one is the material_id.
     *
     * @param string   $type
     *
     * @return array|bool
     */
    public static function getMostOfType($type) {
        try {
            $res = fORMDatabase::retrieve('name:' . DB_TYPE)->translatedQuery('
                        SELECT SUM(b.%r) AS total, m.material_id
                        FROM "prefix_total_blocks" b, "prefix_materials" m
                        WHERE b.material_id = m.material_id
                        GROUP BY b.material_id
                        ORDER BY SUM(b.%r) DESC LIMIT 0,1
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
