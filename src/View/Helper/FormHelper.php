<?php

namespace BootstrapUI\View\Helper;

use Cake\View\Helper\FormHelper as Helper;
use Cake\View\View;
use InvalidArgumentException;

class FormHelper extends Helper
{

    use OptionsAwareTrait;

    /**
     * Set on `Form::create()` to tell if the type of alignement used (i.e. horinzatal).
     *
     * @var string
     */
    protected $_align;

    /**
     * Default Bootstrap string templates.
     *
     * @var array
     */
    protected $_templates = [
        'error' => '<p class="help-block">{{content}}</p>',
        'help' => '<p class="help-block">{{content}}</p>',
        'inputContainer' => '<div class="form-group{{required}}">{{content}}{{help}}</div>',
        'inputContainerError' => '<div class="form-group{{required}} has-error">{{content}}{{error}}{{help}}</div>',
        'checkboxWrapper' => '<div class="checkbox"><label>{{input}}{{label}}</label></div>',
        'radioWrapper' => '<div class="radio"><label>{{input}}{{label}}</label></div>',
    ];

    /**
     * Default Bootstrap widgets.
     *
     * @var array
     */
    protected $_widgets = [
        'button' => 'BootstrapUI\View\Widget\ButtonWidget',
        'checkbox' => 'BootstrapUI\View\Widget\CheckboxWidget',
        'radio' => 'BootstrapUI\View\Widget\RadioWidget',
        '_default' => 'BootstrapUI\View\Widget\BasicWidget',
    ];

    /**
     * Construct the widgets and binds the default context providers.
     *
     * @param \Cake\View\View $View The View this helper is being attached to.
     * @param array $config Configuration settings for the helper.
     */
    public function __construct(View $View, array $config = [])
    {
        $this->_defaultConfig = [
            'align' => 'default',
            'errorClass' => null,
            'grid' => [
                'left' => 2,
                'middle' => 6,
                'right' => 4
            ],
            'templates' => array_merge($this->_defaultConfig['templates'], $this->_templates),
        ] + $this->_defaultConfig;

        $this->_defaultWidgets = $this->_widgets + $this->_defaultWidgets;

        parent::__construct($View, $config);
    }

     /**
      * Returns an HTML FORM element.
      *
      * @param mixed $model The context for which the form is being defined. Can
      *   be an ORM entity, ORM resultset, or an array of meta data. You can use false or null
      *   to make a model-less form.
      * @param array $options An array of html attributes and options.
      * @return string An formatted opening FORM tag.
      */
    public function create($model = null, array $options = [])
    {
        if (isset($options['horizontal'])) {
            if ($options['horizontal'] === true) {
                $options['horizontal'] = 'horizontal';
            }
            $options['align'] = $options['horizontal'];
            unset($options['horizontal']);
            trigger_error('The `horizontal` option is deprecated. Use `align` instead.');
        }

        $options += [
            'class' => null,
            'role' => 'form',
            'align' => null,
            'templates' => [],
        ];

        return parent::create($model, $this->_formAlignement($options));
    }

    /**
     * Generates a form input element complete with label and wrapper div.
     *
     * Adds extra option besides the ones supported by parent class method:
     * - `help` - Help text of include in the input container.
     *
     * @param string $fieldName This should be "Modelname.fieldname".
     * @param array $options Each type of input takes different options.
     * @return string Completed form widget.
     */
    public function input($fieldName, array $options = [])
    {
        $options += [
            'prepend' => null,
            'append' => null,
            'type' => null,
            'label' => null,
            'error' => null,
            'required' => null,
            'options' => null,
            'help' => null,
            'templates' => []
        ];
        $options = $this->_parseOptions($fieldName, $options);
        $reset = $this->templates();

        switch ($options['type']) {
            case 'checkbox':
            case 'radio':
                if (!isset($options['inline'])) {
                    $options['inline'] = $this->checkClasses($options['type'] . '-inline', (array)$options['label']);
                }

                if ($options['inline']) {
                    $options['label'] = $this->injectClasses($options['type'] . '-inline', (array)$options['label']);
                }

                break;
            case 'select':
                if (isset($options['multiple']) && $options['multiple'] === 'checkbox') {
                    $this->templates(['checkboxWrapper' => '<div class="checkbox">{{label}}</div>']);
                    $options['type'] = 'multicheckbox';
                }
                break;
            case 'multiselect':
            case 'textarea':
                break;
            default:
                if ($options['label'] !== false && strpos($this->templates('label'), 'class=') === false) {
                    $options['label'] = $this->injectClasses('control-label', (array)$options['label']);
                }
        }

        if (!in_array($options['type'], ['checkbox', 'radio'])) {
            $options = $this->injectClasses('form-control', $options);
        }

        $result = parent::input($fieldName, $options);
        $this->templates($reset);
        return $result;
    }

    /**
     * Closes an HTML form, cleans up values set by FormHelper::create(), and writes hidden
     * input fields where appropriate.
     *
     * Overrides parent method to reset the form alignement and grid size.
     *
     * @param array $secureAttributes Secure attibutes which will be passed as HTML attributes
     *   into the hidden input elements generated for the Security Component.
     * @return string A closing FORM tag.
     */
    public function end(array $secureAttributes = [])
    {
        $this->_align = $this->_grid = null;
        return parent::end($secureAttributes);
    }

    /**
     * Generates an input element.
     *
     * Overrides parent method to unset 'help' key.
     *
     * @param string $fieldName The field's name.
     * @param array $options The options for the input element.
     * @return string The generated input element.
     */
    protected function _getInput($fieldName, $options)
    {
        unset($options['help']);
        return parent::_getInput($fieldName, $options);
    }

    /**
     * Generates an input container template
     *
     * @param array $options The options for input container template.
     * @return string The generated input container template.
     */
    protected function _inputContainerTemplate($options)
    {
        $inputContainerTemplate = $options['options']['type'] . 'Container' . $options['errorSuffix'];
        if (!$this->templater()->get($inputContainerTemplate)) {
            $inputContainerTemplate = 'inputContainer' . $options['errorSuffix'];
        }

        $help = '';
        if ($options['options']['help']) {
            $help = $this->templater()->format('help', ['content' => $options['options']['help']]);
        }

        return $this->templater()->format($inputContainerTemplate, [
            'content' => $options['content'],
            'error' => $options['error'],
            'required' => $options['options']['required'] ? ' required' : '',
            'type' => $options['options']['type'],
            'help' => $help
        ]);
    }

    /**
     * Generates input options array
     *
     * @param string $fieldName The name of the field to parse options for.
     * @param array $options Options list.
     * @return array Options
     */
    protected function _parseOptions($fieldName, $options)
    {
        $options = parent::_parseOptions($fieldName, $options);
        $options += ['id' => $this->_domId($fieldName)];
        if (is_string($options['label'])) {
            $options['label'] = ['text' => $options['label']];
        }
        return $options;
    }

    /**
     * Form alignement detector/switcher.
     *
     * @param array $options Options.
     * @return array Modified options.
     */
    protected function _formAlignement($options)
    {
        if (!$options['align']) {
            $options['align'] = $this->_detectFormAlignement($options);
        }

        if (is_array($options['align'])) {
            $this->_grid = $options['align'];
            $options['align'] = 'horizontal';
        } elseif ($options['align'] === 'horizontal') {
            $this->_grid = $this->config('grid');
        }

        if (!in_array($options['align'], ['default', 'horizontal', 'inline'])) {
            throw new InvalidArgumentException('Invalid `align` option value.');
        }

         $this->_align = $options['align'];

         unset($options['align']);

        if ($this->_align === 'default') {
            $options['templates'] += [
               'checkboxContainer' => '<div class="checkbox">{{content}}{{help}}</div>',
               'checkboxContainerError' => '<div class="checkbox has-error">{{content}}{{error}}{{help}}</div>',
            ];
            return $options;
        }

         $options = $this->injectClasses('form-' . $this->_align, $options);

        if ($this->_align === 'inline') {
            $options['templates'] += [
               'label' => '<label class="sr-only"{{attrs}}>{{text}}</label>',
               'inputContainer' => '{{content}}'
            ];
            return $options;
        }

         $offsetedGridClass = implode(' ', [$this->_gridClass('left', true), $this->_gridClass('middle')]);
         $options['templates'] += [
            'label' => sprintf(
                '<label class="control-label %s"{{attrs}}>{{text}}</label>',
                $this->_gridClass('left')
            ),
            'error' => sprintf(
                '<p class="%s">{{content}}</p>',
                $this->_gridClass('right')
            ),
            'formGroup' => sprintf(
                '{{label}}<div class="%s">{{input}}</div>',
                $this->_gridClass('middle')
            ),
            'checkboxFormGroup' => sprintf(
                '<div class="%s"><div class="checkbox">{{label}}</div></div>',
                $offsetedGridClass
            ),
            'radioFormGroup' => sprintf(
                '<div class="%s"><div class="radio">{{label}}</div></div>',
                $offsetedGridClass
            ),
            'submitContainer' => sprintf(
                '<div class="%s">{{content}}</div>',
                $offsetedGridClass
            ),
         ];

         return $options;
    }

    /**
     * Returns a Bootstrap grid class (i.e. `col-md-2`).
     *
     * @param string $position One of `left`, `middle` or `right`.
     * @param bool $offset If true, will append `offset-` to the class.
     * @return string Classes.
     */
    protected function _gridClass($position, $offset = false)
    {
        $class = 'col-%s-';
        if ($offset) {
            $class .= 'offset-';
        }

        if (isset($this->_grid[$position])) {
            return sprintf($class, 'md') . $this->_grid[$position];
        }

        $classes = [];
        foreach ($this->_grid as $screen => $positions) {
            if (isset($positions[$position])) {
                array_push($classes, sprintf($class, $screen) . $positions[$position]);
            }
        }
        return implode(' ', $classes);
    }

    /**
     * Detects the form alignement when possible.
     *
     * @param array $options Options.
     * @return string Form alignement type. One of `default`, `horizontal` or `inline`.
     */
    protected function _detectFormAlignement($options)
    {
        foreach (['horizontal', 'inline'] as $align) {
            if ($this->checkClasses('form-' . $align, (array)$options['class'])) {
                return $align;
            }
        }

        return $this->config('align');
    }
}
