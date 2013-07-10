<?php
class Module {

    /**
     * Reference to the main design.
     *
     * @var Design
     */
    private $design;

    /**
     * Reference to the main template of the module.
     *
     * @var Statistics_Twig_Template
     */
    private $main_tpl;

    /**
     * Path to the content folder.
     *
     * @var array
     */
    private $content_folders;

    function __construct($content, $content_folders, $design) {
        $this->design = $design;
        $this->content_folders = $content_folders;
        $this->main_tpl = null;

        $path = '';

        foreach($this->content_folders as $folder) {
            if(file_exists($folder . $content)) {
                $path = $folder . $content;
                break;
            }
        }

        include $path;
    }

    /**
     * Loads an the given $template.<br>
     * If it is the first or $name is null it will be used as the main template for this module and as 'tpl' for the design (regardless of the given $name).
     *
     * @param string $template
     * @param string $name
     *
     * @return Statistics_Twig_Template
     */
    public function loadTemplate($template, $name = null) {
        if($name == null || !$this->design->isTplSet())
            $name = 'tpl';

        if(DEVELOPMENT || fMessaging::check('no-cache', '{cache}') || fMessaging::check('*', '{errors}'))
            $this->design->getEnvironment()->setCache(false);

        $tmp = $this->design->loadTemplate($template, $name);

        if($this->main_tpl != null && $name != null)
            $this->main_tpl->set($name, $tmp);

        if($this->main_tpl == null)
            $this->main_tpl = $tmp;

        return $tmp;
    }

    /**
     * Adds more header tags to the design
     *
     * @param string $value
     */
    public function addHeaderAddition($value) {
        $this->design->getIndex()->add('header_additions', $value);
    }

    /**
     * Adds more js tags to the design
     *
     * @param string $path
     */
    public function addJs($path) {
        $this->design->getIndex()->add('js', $path);
    }

    /**
     * Adds more css tags to the design
     *
     * @param string $path
     */
    public function addCss($path) {
        $this->design->getIndex()->add('css', $path);
    }

    /**
     * Loads an new module to the language class
     *
     * @param string $module
     */
    public function loadLangModule($module) {
        global $lang;

        $lang->load($module);
    }

    /**
     * Loads an sub module which could use all the functionality of the parent module.
     *
     * @param string $sub
     *
     * @throws fEnvironmentException
     * @throws fProgrammerException
     */
    public function loadSubModule($sub) {
        if(strpos($sub, '.php') === false)
            $sub .= '.php';

        $path = '';

        foreach($this->content_folders as $folder) {
            if(file_exists($folder . $sub)) {
                $path = $folder . $sub;
                break;
            }
        }

        if(!file_exists($path)) {
            throw new fProgrammerException(
                'The path specified for %1$s, %2$s, does not exist on the filesystem',
                $sub,
                $path
            );
        }

        if(!is_readable($path)) {
            throw new fEnvironmentException(
                'The path specified for %1$s, %2$s, is not readable',
                $sub,
                $path
            );
        }

        include $path;

    }

    /**
     * Returns the design template
     *
     * @return Statistics_Twig_Template
     */
    public function getDesignTpl() {
        return $this->design->getIndex();
    }
}