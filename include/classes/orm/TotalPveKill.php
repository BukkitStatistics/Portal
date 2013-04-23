<?php
class TotalPveKill extends fActiveRecord {

    protected function configure() {
        fORMColumn::configureNumberColumn($this, 'player_killed');
        fORMColumn::configureNumberColumn($this, 'creature_killed');
    }

    /**
     * Gets the most dangerous material.<br>
     * The first array value is an fNumber which is the count. The second one is the material_id.
     *
     * @return array
     */
    public static function getMostDangerousWeapon() {
        $res = fORMDatabase::retrieve('name:' . DB_TYPE)->translatedQuery('
                    SELECT SUM(pve.creature_killed) AS total,
                        m.material_id
                    FROM "prefix_total_pve_kills" pve, "prefix_materials" m
                    WHERE pve.material_id != %s
                    AND m.material_id = pve.material_id
                    GROUP BY pve.material_id
                    ORDER BY SUM(pve.creature_killed) DESC
                    LIMIT 0,1
        ', '-1:0');

        try {
            $row = $res->fetchRow();
            $num = new fNumber($row['total']);

            return array($num->format(), $row['material_id']);
        } catch(fNoRowsException $e) {
            return array(0, 'none');
        }
    }

}