<?php
class Language {
    /**
     * stores the language files
     */
    private $lang_files = array();

    /**
     * the chosen language
     */
    private $lang = '';

    /**
     * language path
     */
    private $path = '';

    /**
     * languages keys => values
     */
    private $translations = array();

    /**
     * loaded modules
     */
    private $modules = array();

    /**
     * unloadable modules
     */
    private $err_modules = array();

    /**
     * unset strings
     */
    private $err_strings = array();

    /**
     * Initializes a new Language class
     * autoloads the english language and with the default path inc/languages/default/
     *
     * @param string $lang
     * @param string $path
     */
    public function __construct($lang = 'en', $path = '') {
        $this->lang = $lang;

        if($path == '')
            $this->path = __INC__ . 'languages/' . $this->lang . '/';
        else $this->path = $path;

        $this->lang_files['global'] = $this->path . $this->lang . '.php';

        $this->translations = $this->loadFile($this->lang_files['global']);
    }

    private function loadFile($file, $array = array()) {
        if(file_exists($file)) {
            include $file;
            return array_merge($array, $translations); // $translations form the given file
        }
        else {
            $this->err_modules[end($this->modules)] = true;
            unset($this->lang_files[end($this->modules)]);
            unset($this->modules[count($this->modules) - 1]);
        }

        return $array;
    }

    /**
     * Loads an additional modul to the translations
     *
     * @param string $module
     *
     * @return void
     */
    public function load($module) {
        if(in_array($module, $this->modules) || isset($this->err_modules[$module]))
            return;

        $this->modules[] = $module;
        $this->lang_files[$module] = $this->path . $module . '.php';
        $this->translations = $this->loadFile($this->lang_files[$module], $this->translations);
    }

    /**
     * Returns the translated string if it exsists
     * If the string does not exsist it returns the default string or the input string
     *
     * @param string $string
     *
     * @return string
     */
    public function translate($string) {
        if(isset($this->translations[$string]))
            return $this->translations[$string];
        else {
            if(!isset($this->err_strings[$string]))
                $this->err_strings[$string] = true;

            $default = $this->loadFile(__INC__ . 'languages/en/en.php');
            foreach($this->modules as $module) {
                $default = $this->loadFile(__INC__ . 'languages/en/' . $module . '.php', $default);
            }
            if(isset($default[$string]))
                return $default[$string];
        }
        return $string;
    }

    function __destruct() {
        fCore::debug(array('unset strings:', $this->err_strings));
        fCore::debug(array('loaded lang modules: ', $this->modules));
        fCore::debug(array('unloadable lang modules: ', $this->err_modules));
    }
}