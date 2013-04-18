<?php
class Distance extends fActiveRecord {

    /**
     * Gets the total distance of the specified type.<br>
     * To get the real total set $type to 'total'.
     *
     * @param String $type
     *
     * @param int    $playerId
     *
     * @return fNumber
     */
    public static function getDistanceOfType($type, $playerId = null) {
        try {
            if(!is_null($playerId))
                $where = 'WHERE player_id = ' . $playerId;
            else
                $where = '';

            if($type == 'total') {
                $count = 0;
                $res = fORMDatabase::retrieve()->translatedQuery('
                        SHOW COLUMNS
                        FROM "prefix_distances"
                        WHERE Field != %s
                        AND Field != %s
                ', 'distance_player_id', 'player_id');

                foreach($res as $col) {
                    $col_res = fORMDatabase::retrieve()->translatedQuery('
                        SELECT SUM(' . $col['Field'] . ')
                        FROM "prefix_distances"
                        ' . $where . '
                    ');

                    $count += $col_res->fetchScalar();
                }
            }
            else {
                $res = fORMDatabase::retrieve()->translatedQuery('
                        SELECT SUM(' . $type . ')
                        FROM "prefix_distances"
                        ' . $where . '
                ');

                $count = $res->fetchScalar();
            }

            return new fNumber($count);
        } catch(fException $e) {
            fCore::debug($e);
        }

        return new fNumber(0);
    }

    /**
     * Returns the total distance of the associated player.
     *
     * @return int
     */
    public function getTotal() {
        return (int)Distance::getDistanceOfType('total', $this->getPlayerId())->__toString();
    }

    /**
     * Returns the formatted total distance of the associated player
     *
     * @return string
     */
    public function prepareTotal() {
        return Distance::getDistanceOfType('total', $this->getPlayerId())->format();
    }

}