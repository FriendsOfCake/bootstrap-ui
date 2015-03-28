<?php

namespace BootstrapUI\View\Helper;

use Cake\View\Helper\FormHelper as Helper;
use Cake\View\View;

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
     * Construct the widgets and binds the default context providers.
     *
     * @param \Cake\View\View $View The View this helper is being attached to.
     * @param array $config Configuration settings for the helper.
     */
    public function __construct(View $View, array $config = [])
    {
        $this->_defaultConfig['errorClass'] = null;
        $this->_defaultConfig['templates'] = [
            'error' => '<p class="help-block">{{content}}</p>',
            'help' => '<p class="help-block">{{content}}</p>',
            'inputContainer' => '<div class="form-group{{required}}">{{content}}{{help}}</div>',
            'inputContainerError' => '<div class="form-group{{required}} has-error">{{content}}{{error}}{{help}}</div>',
            'checkboxWrapper' => '<div class="checkbox"><label>{{input}}{{label}}</label></div>',
            'radioWrapper' => '<div class="radio"><label>{{input}}{{label}}</label></div>',
        ] + $this->_defaultConfig['templates'];

        $this->_defaultWidgets = array_merge($this->_defaultWidgets, [
            'button' => 'BootstrapUI\View\Widget\ButtonWidget',
            '_default' => 'BootstrapUI\View\Widget\BasicWidget',
        ]);

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
        $options += [
            'role' => 'form',
            'horizontal' => $this->checkClasses('form-horizontal', $options),
            'templates' => [],
        ];

        if (!empty($options['horizontal'])) {
            $this->_align = 'horizontal';
            $options = $this->injectClasses('form-horizontal', $options);
            $options['horizontal'] = (array)$options['horizontal'];
            $options['horizontal'] += [
                'left' => 'col-md-2',
                'right' => 'col-md-10',
                'combined' => 'col-md-offset-2 col-md-10'
            ];

            if (strpos($options['horizontal']['left'], 'control-label') === false) {
                $options['horizontal']['left'] = 'control-label ' . $options['horizontal']['left'];
            }

            $options['templates'] += [
                'label' => '<label class="' . $options['horizontal']['left'] . '"{{attrs}}>{{text}}</label>',
                'formGroup' => '{{label}}<div class="' . $options['horizontal']['right'] . '">{{input}}</div>',
                'checkboxFormGroup' => '<div class="' . $options['horizontal']['combined'] . '">' .
                                        '<div class="checkbox">{{label}}</div></div>',
            ];
        }

        unset($options['horizontal']);
        return parent::create($model, $options);
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
                $this->templates(['label' => '{{text}}']);

                if (!isset($options['inline'])) {
                    $options['inline'] = $this->checkClasses('checkbox-inline', (array)$options['label'])
                        || $this->checkClasses('radio-inline', (array)$options['label']);

                    if (!$this->_align) {
                        $this->templates([
                            'checkboxContainer' => '<div class="checkbox">{{content}}{{help}}</div>',
                            'checkboxContainerError' => '<div class="checkbox has-error">{{content}}{{error}}{{help}}</div>',
                        ]);
                    }
                }

                if ($options['inline']) {
                    $options['label'] = $this->injectClasses('checkbox-inline', (array)$options['label']);
                    $this->templates(['inputContainer' => '{{content}}']);
                }

                unset($options['inline']);

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
     * @param array $secureAttributes Secure attibutes which will be passed as HTML attributes
     *   into the hidden input elements generated for the Security Component.
     * @return string A closing FORM tag.
     */
    public function end(array $secureAttributes = [])
    {
        $this->_align = null;
        return parent::end($secureAttributes);
    }

    /**
     * Generates an input element.
     *
     * Overrides parent method to unset 'help' key.
     *
     * @param string $fieldName the field name
     * @param array $options The options for the input element
     * @return string The generated input element
     */
    protected function _getInput($fieldName, $options)
    {
        unset($options['help']);
        return parent::_getInput($fieldName, $options);
    }

    /**
     * Generates an input container template
     *
     * @param array $options The options for input container template
     * @return string The generated input container template
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
}
