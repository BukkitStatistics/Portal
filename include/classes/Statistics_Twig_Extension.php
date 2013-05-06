<?php
class Statistics_Twig_Extension extends Twig_Extension {

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName() {
        return 'Statistics';
    }

    /**
     * @inheritdoc
     *
     * @return array
     */
    public function getGlobals() {
        global $lang;

        return array(
            'lang'            => $lang,
            'ServerStatistic' => new ServerStatistic(),
            'Util'            => new Util()
        );
    }

    /**
     * @inheritdoc
     *
     * @return array
     */
    public function getFunctions() {
        return array(
            'staticCall'   => new Twig_Function_Function(array($this, 'staticCall')),
            'fTimestamp'   => new Twig_Function_Function(array($this, 'fTimestamp')),
            'Player'       => new Twig_Function_Function(array($this, 'Player')),
            'Entity'       => new Twig_Function_Function(array($this, 'Entity')),
            'Material'     => new Twig_Function_Function(array($this, 'Material')),
            'showChecked'  => new Twig_Function_Function(array($this, 'showChecked')),
            'printOption'  => new Twig_Function_Function(array($this, 'printOption')),
            'phpInclude'   => new Twig_Function_Function(array($this, 'phpInclude')),
            'checkMessage' => new Twig_Function_Function(array($this, 'checkMessage'))
        );
    }

    /**
     * @inheritdoc
     *
     * @return array
     */
    public function getFilters() {
        return array(
            new Twig_SimpleFilter('date', array($this, 'dateFilter')),
            new Twig_SimpleFilter('ffNumber', array($this, 'formatFNumber'))
        );
    }

    /**
     * Called by |date<br>
     * Overridden twig date filter. This one uses fTimestamp
     *
     * @param        $ts
     * @param string $format
     * @param null   $timezone
     *
     * @return string
     */
    public function dateFilter($ts, $format = 'std', $timezone = null) {
        $tmp = new fTimestamp($ts, $timezone);

        return $tmp->format($format);
    }

    /**
     * Called by |ffNumber<br>
     * Will properly format an fNumber
     *
     * @param fNumber $fNumber
     * @param bool    $remove_zero_fraction
     *
     * @return string
     */
    public function formatFNumber(fNumber $fNumber, $remove_zero_fraction = false) {
        return $fNumber->format($remove_zero_fraction);
    }

    /**
     * Called by staticCall()<br>
     * Will call an static class function with arguments.
     *
     * @param       $class
     * @param       $function
     * @param array $args
     *
     * @return mixed|null
     */
    public function staticCall($class, $function, $args = array()) {
        if(class_exists($class) && method_exists($class, $function))
            return call_user_func_array(array($class, $function), $args);

        return null;
    }

    /**
     * Called by showChecked()<br>
     * Returns true if $value is equal to $checked_value
     *
     * @param $value
     * @param $checked_value
     *
     * @return bool
     */
    public function showChecked($value, $checked_value) {
        return fHTML::showChecked($value, $checked_value);
    }

    /**
     * Called by printOption()<br>
     * Will output an proper <option> tag.
     *
     * @param $text
     * @param $value
     * @param $selected_value
     */
    public function printOption($text, $value, $selected_value) {
        fHTML::printOption($text, $value, $selected_value);
    }

    /**
     * Called by checkMessage()<br>
     * Returns true if the fMessaging message existis
     *
     * @param      $name
     * @param null $recipient
     *
     * @return bool
     */
    public function checkMessage($name, $recipient = null) {
        return fMessaging::check($name, $recipient);
    }

    /**
     * Called by fTimestamp()<br>
     * Returns an new fTimestamp object
     *
     * @param      $ts
     * @param null $timezone
     *
     * @return fTimestamp
     */
    public function fTimestamp($ts, $timezone = null) {
        return new fTimestamp($ts, $timezone);
    }

    /**
     * Called by Player()<br>
     * Returns an new Player object
     *
     * @param null $id
     *
     * @return Player
     */
    public function Player($id = null) {
        return new Player($id);
    }

    /**
     * Called by Entity()<br>
     * Returns an new Entity object
     *
     * @param null $id
     *
     * @return Entity
     */
    public function Entity($id = null) {
        return new Entity($id);
    }

    /**
     * Called by Material()<br>
     * Returns an new Material object
     *
     * @param null $id
     *
     * @return Material
     */
    public function Material($id = null) {
        return new Material($id);
    }
}