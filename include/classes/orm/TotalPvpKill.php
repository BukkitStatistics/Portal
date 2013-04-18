<?php
class TotalPvpKill extends fActiveRecord {

    protected function configure() {
        fORMColumn::configureNumberColumn($this, 'times');
    }


    /**
     * Gets the most dangerous material.<br>
     * The first array value is an fNumber which is the count. The second one is the block name.
     *
     * @return array
     */
    public static function getMostDangerousWeapon() {
        $res = fORMDatabase::retrieve()->translatedQuery('
                    SELECT SUM(pvp.times) AS total,
                        m.material_id
                    FROM "prefix_total_pvp_kills" pvp, "prefix_materials" m
                    WHERE pvp.material_id != "-1:0"
                    AND m.material_id = pvp.material_id
                    GROUP BY pvp.material_id
                    ORDER BY SUM(pvp.times) DESC
                    LIMIT 0,1
        ');

        try {
            $row = $res->fetchRow();
            $num = new fNumber($row['total']);

            return array($num->format(), $row['material_id']);
        } catch(fNoRowsException $e) {
            return array(0, 'none');
        }
    }

}