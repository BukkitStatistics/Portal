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
     * @var string
     */
    private $content_folder;

    function __construct($content, $content_folder, $design) {
        $this->design = $design;
        $this->content_folder = $content_folder;
        $this->main_tpl = null;

        include $this->content_folder . $content;
    }

    /**
     * Loads an the given $template.<br>
     * If it is the first it will be used as the main template for this module.
     *
     * @param string $template
     * @param null   $name
     *
     * @return Statistics_Twig_Template
     */
    public function loadTemplate($template, $name = null) {
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

        $path = $this->content_folder . $sub;

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