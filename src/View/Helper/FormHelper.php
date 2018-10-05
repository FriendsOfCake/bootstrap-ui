<?php

namespace BootstrapUI\View\Helper;

use Cake\Core\Configure\Engine\PhpConfig;
use Cake\Utility\Hash;
use Cake\View\Helper\FormHelper as Helper;
use Cake\View\View;
use InvalidArgumentException;

class FormHelper extends Helper
{

    use OptionsAwareTrait;

    /**
     * Set on `Form::create()` to tell if the type of alignment used (i.e. horizontal).
     *
     * @var string|null
     */
    protected $_align;

    /**
     * Set on `Form::create()` to tell grid type.
     *
     * @var array|null
     */
    protected $_grid;

    /**
     * The method to use when creating a control element for a form
     *
     * @var string
     */
    protected $_controlMethod = 'input';

    /**
     * Default Bootstrap string templates.
     *
     * @var array
     */
    protected $_templates = [
        'dateWidget' => '<ul class="list-inline"><li class="year">{{year}}</li><li class="month">{{month}}</li><li class="day">{{day}}</li><li class="hour">{{hour}}</li><li class="minute">{{minute}}</li><li class="second">{{second}}</li><li class="meridian">{{meridian}}</li></ul>',
        'error' => '<div class="invalid-feedback">{{content}}</div>',
        'label' => '<label{{attrs}}>{{text}}{{tooltip}}</label>',
        'help' => '<small{{attrs}} class="form-text text-muted">{{content}}</small>',
        'tooltip' => '<span data-toggle="tooltip" title="{{content}}" class="fas fa-info-circle"></span>',
        'inputContainer' => '<div class="form-group {{type}}{{required}}">{{content}}{{help}}</div>',
        'inputContainerError' => '<div class="form-group {{type}}{{required}} is-invalid">{{content}}{{error}}{{help}}</div>',
        'checkboxContainer' => '<div class="form-group form-check {{type}}{{required}}">{{content}}{{help}}</div>',
        'checkboxContainerError' => '<div class="form-group form-check {{type}}{{required}} is-invalid">{{content}}{{error}}{{help}}</div>',
        'checkboxFormGroup' => '{{input}}{{label}}',
        'radioWrapper' => '<div class="form-check">{{hidden}}{{input}}{{label}}</div>',
        'radioInlineFormGroup' => '{{label}}<div class="form-check form-check-inline">{{input}}</div>',
        'radioNestingLabel' => '<div class="form-check">{{hidden}}<label{{attrs}}>{{input}}{{text}}{{tooltip}}</label></div>',
        'staticControl' => '<p class="form-control-plaintext">{{content}}</p>',
        'inputGroupAddon' => '<div class="{{class}}">{{content}}</div>',
        'inputGroupContainer' => '<div{{attrs}}>{{prepend}}{{content}}{{append}}</div>',
        'inputGroupText' => '<span class="input-group-text">{{content}}</span>',
        'file' => '<input type="file" class="form-control-file" name="{{name}}"{{attrs}}>'
    ];

    /**
     * Templates set per alignment type
     *
     * @var array
     */
    protected $_templateSet = [
        'default' => [
        ],
        'inline' => [
            'label' => '<label class="sr-only"{{attrs}}>{{text}}{{tooltip}}</label>',
            'inputContainer' => '{{content}}'
        ],
        'horizontal' => [
            'label' => '<label class="col-form-label %s"{{attrs}}>{{text}}{{tooltip}}</label>',
            'checkboxLabel' => '<label {{attrs}}>{{text}}{{tooltip}}</label>',
            'formGroup' => '{{label}}<div class="%s">{{input}}{{error}}{{help}}</div>',
            'checkboxFormGroup' => '<div class="%s"><div class="form-check">{{input}}{{label}}</div>{{error}}{{help}}</div>',
            'submitContainer' => '<div class="form-group"><div class="%s">{{content}}</div></div>',
            'inputContainer' => '<div class="form-group row {{type}}{{required}}">{{content}}</div>',
            'inputContainerError' => '<div class="form-group row {{type}}{{required}} is-invalid">{{content}}</div>',
            'checkboxContainer' => '<div class="form-group row {{type}}{{required}}">{{content}}</div>',
            'checkboxContainerError' => '<div class="form-group row {{type}}{{required}} is-invalid">{{content}}</div>',
            'radioContainer' => '<div class="form-group row {{type}}{{required}}">{{content}}</div>',
            'radioContainerError' => '<div class="form-group row {{type}}{{required}} is-invalid">{{content}}</div>',
            'radioInlineWrapper' => '<div class="form-check form-check-inline">{{hidden}}{{input}}{{label}}</div>',
        ]
    ];

    /**
     * Default Bootstrap widgets.
     *
     * @var array
     */
    protected $_widgets = [
        'button' => 'BootstrapUI\View\Widget\ButtonWidget',
        'radio' => ['BootstrapUI\View\Widget\RadioWidget', 'nestingLabel'],
        'select' => 'BootstrapUI\View\Widget\SelectBoxWidget',
        'textarea' => 'BootstrapUI\View\Widget\TextareaWidget',
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
            'errorClass' => 'is-invalid',
            'grid' => [
                'left' => 2,
                'middle' => 10,
                'right' => 0,
            ],
            'templates' => $this->_templates + $this->_defaultConfig['templates'],
        ] + $this->_defaultConfig;

        if (isset($this->_defaultConfig['templateSet'])) {
            $this->_defaultConfig['templateSet'] = Hash::merge($this->_templateSet, $this->_defaultConfig['templateSet']);
        } else {
            $this->_defaultConfig['templateSet'] = $this->_templateSet;
        }

        $this->_defaultWidgets = $this->_widgets + $this->_defaultWidgets;

        if (method_exists('Cake\View\Helper\FormHelper', 'control')) {
            $this->_controlMethod = 'control';
        }

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
        // @codeCoverageIgnoreStart
        if (isset($options['horizontal'])) {
            if ($options['horizontal'] === true) {
                $options['horizontal'] = 'horizontal';
            }
            $options['align'] = $options['horizontal'];
            unset($options['horizontal']);
            trigger_error('The `horizontal` option is deprecated. Use `align` instead.');
        }
        // @codeCoverageIgnoreEnd

        $options += [
            'class' => null,
            'role' => 'form',
            'align' => null,
            'templates' => [],
        ];

        if ($options['align'] === 'inline') {
            trigger_error(
                'Support for inline forms is currently broken. Patches to fix it are welcome.',
                E_USER_WARNING
            );
        }

        return parent::create($model, $this->_formAlignment($options));
    }

    /**
     * Creates a submit button element.
     *
     * Overrides parent method to add CSS class `btn`, to the element.
     *
     * @param string $caption The label appearing on the button OR if string contains :// or the
     *  extension .jpg, .jpe, .jpeg, .gif, .png use an image if the extension
     *  exists, AND the first character is /, image is relative to webroot,
     *  OR if the first character is not /, image is relative to webroot/img.
     * @param array $options Array of options. See above.
     * @return string A HTML submit button
     * @link http://book.cakephp.org/3.0/en/views/helpers/form.html#creating-buttons-and-submit-elements
     */
    public function submit($caption = null, array $options = [])
    {
        $options += [
            'class' => 'primary'
        ];
        $options = $this->applyButtonClasses($options);

        return parent::submit($caption, $options);
    }

    /**
     * Generates a form input element complete with label and wrapper div.
     *
     * Adds extra option besides the ones supported by parent class method:
     * - `append` - Append addon to input.
     * - `prepend` - Prepend addon to input.
     * - `inline` - Boolean for generating inline checkbox/radio.
     * - `help` - Help text of include in the input container.
     *
     * @param string $fieldName This should be "Modelname.fieldname".
     * @param array $options Each type of input takes different options.
     * @return string Completed form widget.
     * @deprecated Use control() instead.
     */
    public function input($fieldName, array $options = [])
    {
        return $this->control($fieldName, $options);
    }

    /**
     * Generates a form input element complete with label and wrapper div.
     *
     * Adds extra option besides the ones supported by parent class method:
     * - `append` - Append addon to input.
     * - `prepend` - Prepend addon to input.
     * - `inline` - Boolean for generating inline checkbox/radio.
     * - `help` - Help text of include in the input container.
     *
     * @param string $fieldName This should be "Modelname.fieldname".
     * @param array $options Each type of input takes different options.
     * @return string Completed form widget.
     */
    public function control($fieldName, array $options = [])
    {
        $options += [
            'prepend' => null,
            'append' => null,
            'inline' => null,
            'type' => null,
            'label' => null,
            'error' => null,
            'required' => null,
            'options' => null,
            'help' => null,
            'tooltip' => null,
            'templates' => [],
            'templateVars' => []
        ];
        $options = $this->_parseOptions($fieldName, $options);

        $newTemplates = $options['templates'];
        if ($newTemplates) {
            $this->templater()->push();
            $templateMethod = is_string($options['templates']) ? 'load' : 'add';
            $this->templater()->{$templateMethod}($options['templates']);
            $options['templates'] = [];
        }

        switch ($options['type']) {
            case 'checkbox':
                if (!isset($options['nestedInput'])) {
                    $options['nestedInput'] = false;
                }

                $options['label'] = $this->injectClasses('form-check-label', (array)$options['label']);
                $options = $this->injectClasses('form-check-input', $options);

                if ($this->_align === 'horizontal') {
                    $options['templates']['label'] = $this->templater()->get('checkboxLabel');
                }

                if (!isset($options['inline'])) {
                    $options['inline'] = $this->checkClasses($options['type'] . '-inline', (array)$options['label']);
                }

                if ($options['inline']) {
                    $options['label'] = $this->injectClasses($options['type'] . '-inline', (array)$options['label']);
                    if (!isset($newTemplates['checkboxContainer'])) {
                        $options['templates']['checkboxContainer'] = '{{content}}';
                    }
                }
                unset($options['inline']);
                break;

            case 'radio':
                $options = $this->injectClasses('form-check-input', $options);
                if ($this->_align !== 'horizontal') {
                    $options['label'] = $this->injectClasses('form-check-label', (array)$options['label']);
                }

                $options['labelOptions'] = isset($options['labelOptions']) ? $options['labelOptions'] : [];
                if (!isset($options['labelOptions']['input'])) {
                    $options['labelOptions']['input'] = false;
                }
                $options['labelOptions'] = $this->injectClasses('form-check-label', $options['labelOptions']);

                if ($options['inline'] && $this->_align === 'horizontal') {
                    $options['templates']['radioWrapper'] = $this->templater()->get('radioInlineWrapper');
                }

                if ($options['inline'] && $this->_align !== 'horizontal') {
                    $options['templates']['formGroup'] = $this->templater()->get('radioInlineFormGroup');
                }
                break;

            case 'select':
                if (isset($options['multiple']) && $options['multiple'] === 'checkbox') {
                    $options['type'] = 'multicheckbox';
                }
                break;
        }

        if ($options['help']) {
            if (is_string($options['help'])) {
                $options['help'] = $this->templater()->format(
                    'help',
                    ['content' => $options['help']]
                );
            } elseif (is_array($options['help'])) {
                $options['help'] = $this->templater()->format(
                    'help',
                    [
                        'content' => $options['help']['content'],
                        'attrs' => $this->templater()->formatAttributes($options['help'], ['class', 'content']),
                    ]
                );
            }
        }

        if ($options['tooltip']) {
            $tooltip = $this->templater()->format(
                'tooltip',
                ['content' => $options['tooltip']]
            );
            $options['label']['templateVars']['tooltip'] = ' ' . $tooltip;
            unset($options['tooltip']);
        }

        $controlMethod = $this->_controlMethod;
        $result = parent::$controlMethod($fieldName, $options);

        if ($newTemplates) {
            $this->templater()->pop();
        }

        return $result;
    }

    /**
     * Closes an HTML form, cleans up values set by FormHelper::create(), and writes hidden
     * input fields where appropriate.
     *
     * Overrides parent method to reset the form alignment and grid size.
     *
     * @param array $secureAttributes Secure attributes which will be passed as HTML attributes
     *   into the hidden input elements generated for the Security Component.
     * @return string A closing FORM tag.
     */
    public function end(array $secureAttributes = [])
    {
        $this->_align = $this->_grid = null;

        return parent::end($secureAttributes);
    }

    /**
     * Used to place plain text next to label within a form.
     *
     * ### Options:
     *
     * - `hiddenField` - boolean to indicate if you want value for field included
     *    in a hidden input. Defaults to true.
     *
     * @param string $fieldName Name of a field, like this "modelname.fieldname"
     * @param array $options Array of HTML attributes.
     * @return string An HTML text input element.
     */
    public function staticControl($fieldName, array $options = [])
    {
        $options += [
            'escape' => true,
            'required' => false,
            'secure' => true,
            'hiddenField' => true
        ];

        $secure = $options['secure'];
        $hiddenField = $options['hiddenField'];
        unset($options['secure'], $options['hiddenField']);

        $options = $this->_initInputField(
            $fieldName,
            ['secure' => static::SECURE_SKIP] + $options
        );

        $content = $options['escape'] ? h($options['val']) : $options['val'];
        $static = $this->formatTemplate('staticControl', [
            'content' => $content
        ]);

        if (!$hiddenField) {
            return $static;
        }

        if ($secure === true) {
            $this->_secure(true, $this->_secureFieldName($options['name']), (string)$options['val']);
        }

        $options['type'] = 'hidden';

        return $static . $this->widget('hidden', $options);
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
     * Generates an group template element
     *
     * @param array $options The options for group template
     * @return string The generated group template
     */
    protected function _groupTemplate($options)
    {
        $groupTemplate = $options['options']['type'] . 'FormGroup';
        if (!$this->templater()->get($groupTemplate)) {
            $groupTemplate = 'formGroup';
        }

        return $this->templater()->format($groupTemplate, [
            'input' => isset($options['input']) ? $options['input'] : [],
            'label' => $options['label'],
            'error' => $options['error'],
            'templateVars' => isset($options['options']['templateVars']) ? $options['options']['templateVars'] : [],
            'help' => $options['options']['help'],
        ]);
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

        return $this->templater()->format($inputContainerTemplate, [
            'content' => $options['content'],
            'error' => $options['error'],
            'required' => $options['options']['required'] ? ' required' : '',
            'type' => $options['options']['type'],
            'templateVars' => isset($options['options']['templateVars']) ? $options['options']['templateVars'] : [],
            'help' => $options['options']['help'],
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
     * Form alignment detector/switcher.
     *
     * @param array $options Options.
     * @return array Modified options.
     */
    protected function _formAlignment($options)
    {
        if (!$options['align']) {
            $options['align'] = $this->_detectFormAlignment($options);
        }

        if (is_array($options['align'])) {
            $this->_grid = $options['align'];
            $options['align'] = 'horizontal';
        } elseif ($options['align'] === 'horizontal') {
            $this->_grid = $this->getConfig('grid');
        }

        if (!in_array($options['align'], ['default', 'horizontal', 'inline'])) {
            throw new InvalidArgumentException('Invalid `align` option value.');
        }

        $this->_align = $options['align'];

        unset($options['align']);

        $templates = $this->_config['templateSet'][$this->_align];
        if (is_string($options['templates'])) {
            $options['templates'] = (new PhpConfig())->read($options['templates']);
        }

        if ($this->_align === 'default') {
            $options['templates'] += $templates;

            return $options;
        }

        $options = $this->injectClasses('form-' . $this->_align, $options);

        if ($this->_align === 'inline') {
            $options['templates'] += $templates;

            return $options;
        }

        $offsetedGridClass = implode(' ', [$this->_gridClass('left', true), $this->_gridClass('middle')]);

        $templates['label'] = sprintf($templates['label'], $this->_gridClass('left'));
        $templates['formGroup'] = sprintf($templates['formGroup'], $this->_gridClass('middle'));
        foreach (['checkboxFormGroup', 'submitContainer'] as $value) {
            $templates[$value] = sprintf($templates[$value], $offsetedGridClass);
        }

        $options['templates'] += $templates;

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
            $class = 'offset-%s-';
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
     * Detects the form alignment when possible.
     *
     * @param array $options Options.
     * @return string Form alignment type. One of `default`, `horizontal` or `inline`.
     */
    protected function _detectFormAlignment($options)
    {
        foreach (['horizontal', 'inline'] as $align) {
            if ($this->checkClasses('form-' . $align, (array)$options['class'])) {
                return $align;
            }
        }

        return $this->getConfig('align');
    }
}
