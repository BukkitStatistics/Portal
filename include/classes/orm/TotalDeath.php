<?php
class TotalDeath extends fActiveRecord {

    /**
     * Counts all player deaths
     *
     * @return fNumber
     */
    public static function countAllDeaths() {
        $res = fORMDatabase::retrieve('name:' . DB_TYPE)->translatedQuery('
                        SELECT SUM(times)
                        FROM "prefix_total_deaths"
        ');

        try {
            return new fNumber($res->fetchScalar());
        } catch(fException $e) {
            fCore::debug($e);
        }

        return new fNumber(0);
    }

    protected function configure() {
        fORMColumn::configureNumberColumn($this, 'times');
    }

    /**
     * Returns the translated death cause.
     *
     * @return string
     */
    public function getName() {
        return fText::compose($this->getCause());
    }


}