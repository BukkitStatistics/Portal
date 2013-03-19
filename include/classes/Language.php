<?php
class Language {
    /*
     * stores the language files
     */
    private $lang_files = array();

    /*
    * the chosen language
    */
    private $lang = '';

    /*
    * language path
    */
    private $path = '';

    /*
    * languages keys => values
    */
    private $translations = array();

    /*
    * loaded moduls
    */
    private $modules = array();

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
        else throw new fNotFoundException('The language file ' . $file . ' could not be loaded');
    }

    /**
     * Loads an additional modul to the translations
     *
     * @param string $modul
     *
     * @return void
     */
    public function load($modul) {
        $this->modules[] = $modul;
        $this->lang_files[$modul] = $this->path . $modul . '.php';
        $this->translations = $this->loadFile($this->lang_files[$modul], $this->translations);
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
            $default = $this->loadFile(__INC__ . 'languages/en/en.php');
            foreach($this->modules as $modul) {
                $default = $this->loadFile(__INC__ . 'languages/en/' . $modul . '.php', $default);
            }
            if(isset($default[$string]))
                return $default[$string];
        }
        return $string;
    }
}