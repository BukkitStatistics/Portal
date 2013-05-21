<?php
class Statistics_Twig_Template extends Twig_Template {
    /**
     * The context which will be rendered
     *
     * @var array
     */
    private $context;

    public function __construct(Twig_Environment $env) {
        parent::__construct($env);

        $this->context = array();
    }

    /**
     * Returns the template name.
     *
     * @return string The template name
     */
    public function getTemplateName() {
        return 'Statistics';
    }

    /**
     * Auto-generated method to display the template with the given context.
     *
     * @param array $context An array of parameters to pass to the template
     * @param array $blocks  An array of blocks to pass to the template
     */
    protected function doDisplay(array $context, array $blocks = array()) {
    }

    /**
     * @inheritdoc
     *
     * @param array $context
     * @param array $blocks
     */
    public function display(array $context = null, array $blocks = array()) {
        if($context == null)
            $context = $this->context;
        else
            $context = array_merge($context, $this->context);

        parent::display($context, $blocks);
    }

    /**
     * @inheritdoc
     *
     * @param string $name
     * @param array  $context
     * @param array  $blocks
     */
    public function displayBlock($name, array $context = null, array $blocks = array()) {
        if($context == null)
            $context = $this->context;
        else
            $context = array_merge($context, $this->context);

        parent::displayBlock($name, $context, $blocks);
    }

    /**
     * Set elements to be displayed.<br>
     * If $element already exists the old one will be overridden.
     *
     * @param $element
     * @param $value
     *
     * @return Statistics_Twig_Template $this
     */
    public function set($element, $value = null) {
        // code borrowed from fTemplating
        if($value === NULL && is_array($element)) {
            foreach($element as $key => $value) {
                $this->set($key, $value);
            }
            return $this;
        }

        $tip =& $this->context;

        if($bracket_pos = strpos($element, '[')) {
            $array_dereference = substr($element, $bracket_pos);
            $element = substr($element, 0, $bracket_pos);

            preg_match_all('#(?<=\[)[^\[\]]+(?=\])#', $array_dereference, $array_keys, PREG_SET_ORDER);
            $array_keys = array_map('current', $array_keys);
            array_unshift($array_keys, $element);

            foreach(array_slice($array_keys, 0, -1) as $array_key) {
                if(!isset($tip[$array_key]) || !is_array($tip[$array_key])) {
                    $tip[$array_key] = array();
                }
                $tip =& $tip[$array_key];
            }
            $element = end($array_keys);
        }

        $tip[$element] = $value;

        return $this;
    }

    /**
     * Get elements of this template.
     *
     * @param      $element
     * @param null $default_value
     *
     * @return array|null
     */
    public function get($element, $default_value = null) {
        // code borrowed from fTemplating
        if(is_array($element)) {
            $elements = $element;

            // Turn an array of elements into an array of elements with NULL default values
            if(array_values($elements) === $elements) {
                $elements = array_combine($elements, array_fill(0, count($elements), NULL));
            }

            $output = array();
            foreach($elements as $element => $default_value) {
                $output[$element] = $this->get($element, $default_value);
            }
            return $output;
        }

        $array_dereference = NULL;
        if($bracket_pos = strpos($element, '[')) {
            $array_dereference = substr($element, $bracket_pos);
            $element = substr($element, 0, $bracket_pos);
        }

        if(!isset($this->context[$element])) {
            return $default_value;
        }
        $value = $this->context[$element];

        if($array_dereference) {
            preg_match_all('#(?<=\[)[^\[\]]+(?=\])#', $array_dereference, $array_keys, PREG_SET_ORDER);
            $array_keys = array_map('current', $array_keys);
            foreach($array_keys as $array_key) {
                if(!is_array($value) || !isset($value[$array_key])) {
                    $value = $default_value;
                    break;
                }
                $value = $value[$array_key];
            }
        }

        return $value;
    }

    /**
     * Add elements to the template.<br>
     * If $element already exists the new value will be append.
     *
     * @param $element
     * @param $value
     *
     * @throws fProgrammerException
     */
    public function add($element, $value) {
        $tip =& $this->context;

        if(!isset($tip[$element])) {
            $tip[$element] = array();
        }
        elseif(!is_array($tip[$element])) {
            throw new fProgrammerException(
                '%1$s was called for an element, %2$s, which is not an array',
                'add()',
                $element
            );
        }

        $tip[$element][] = $value;
    }

    /**
     * Remove an element from this template.
     *
     * @param      $element
     * @param bool $beginning
     *
     * @return mixed|null
     * @throws fProgrammerException
     */
    public function remove($element, $beginning = false) {
        // code borrowed from fTemplating
        $tip =& $this->context;

        if($bracket_pos = strpos($element, '[')) {
            $original_element = $element;
            $array_dereference = substr($element, $bracket_pos);
            $element = substr($element, 0, $bracket_pos);

            preg_match_all('#(?<=\[)[^\[\]]+(?=\])#', $array_dereference, $array_keys, PREG_SET_ORDER);
            $array_keys = array_map('current', $array_keys);
            array_unshift($array_keys, $element);

            foreach(array_slice($array_keys, 0, -1) as $array_key) {
                if(!isset($tip[$array_key])) {
                    return NULL;
                }
                elseif(!is_array($tip[$array_key])) {
                    throw new fProgrammerException(
                        '%1$s was called for an element, %2$s, which is not an array',
                        'remove()',
                        $original_element
                    );
                }
                $tip =& $tip[$array_key];
            }
            $element = end($array_keys);
        }


        if(!isset($tip[$element])) {
            return NULL;
        }
        elseif(!is_array($tip[$element])) {
            throw new fProgrammerException(
                '%1$s was called for an element, %2$s, which is not an array',
                'remove()',
                $element
            );
        }

        if($beginning) {
            return array_shift($tip[$element]);
        }

        return array_pop($tip[$element]);
    }
}