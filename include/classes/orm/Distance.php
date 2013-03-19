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
        } catch(fNoRowsException $e) {
            fCore::debug($e->getMessage());
        } catch(fNoRemainingException $e) {
            fCore::debug($e->getMessage());
        } catch(fSQLException $e) {
            fCore::debug($e->getMessage());
        } catch(fValidationException $e) {
            fCore::debug($e->getMessage());
        }

        return new fNumber(0);
    }

    protected function configure() {
        fORMColumn::configureNumberColumn($this, 'foot');
        fORMColumn::configureNumberColumn($this, 'minecart');
        fORMColumn::configureNumberColumn($this, 'boat');
        fORMColumn::configureNumberColumn($this, 'pig');
        fORMColumn::configureNumberColumn($this, 'swimmed');
    }

    /**
     * Returns the total distance of the associated player.
     *
     * @return fNumber
     */
    public function getTotal() {
        return Distance::getDistanceOfType('total', $this->getPlayerId());
    }

}