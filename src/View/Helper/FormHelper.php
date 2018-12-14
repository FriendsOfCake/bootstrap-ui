<?php

namespace BootstrapUI\View\Helper;

use Cake\Core\Configure\Engine\PhpConfig;
use Cake\Utility\Hash;
use Cake\Utility\Inflector;
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
     * Default Bootstrap string templates.
     *
     * @var array
     */
    protected $_templates = [
        'error' => '<div class="invalid-feedback">{{content}}</div>',
        'label' => '<label{{attrs}}>{{text}}{{tooltip}}</label>',
        'help' => '<small{{attrs}} class="form-text text-muted">{{content}}</small>',
        'tooltip' => '<span data-toggle="tooltip" title="{{content}}" class="fas fa-info-circle"></span>',
        'dateWidget' => '<ul class="list-inline mb-0">{{year}}{{month}}{{day}}{{hour}}{{minute}}{{second}}{{meridian}}</ul>',
        'dateWidgetPart' => '<li class="list-inline-item {{part}}"><select name="{{name}}"{{attrs}}>{{content}}</select></li>',
        'datetimeContainer' => '<div class="form-group {{type}}{{required}}" role="group" aria-labelledby="{{groupId}}">{{content}}{{help}}</div>',
        'datetimeContainerError' => '<div class="form-group {{type}}{{required}} is-invalid" role="group" aria-labelledby="{{groupId}}">{{content}}{{error}}{{help}}</div>',
        'datetimeLabel' => '<label id="{{groupId}}">{{text}}</label>',
        'inputContainer' => '<div class="form-group {{type}}{{required}}">{{content}}{{help}}</div>',
        'inputContainerError' => '<div class="form-group {{type}}{{required}} is-invalid">{{content}}{{error}}{{help}}</div>',
        'checkboxContainer' => '<div class="form-group form-check {{type}}{{required}}">{{content}}{{help}}</div>',
        'checkboxContainerError' => '<div class="form-group form-check {{type}}{{required}} is-invalid">{{content}}{{error}}{{help}}</div>',
        'customCheckboxContainer' => '<div class="form-group custom-control custom-checkbox {{type}}{{required}}">{{content}}{{help}}</div>',
        'customCheckboxContainerError' => '<div class="form-group custom-control custom-checkbox {{type}}{{required}} is-invalid">{{content}}{{error}}{{help}}</div>',
        'checkboxInlineContainer' => '<div class="form-check form-check-inline {{type}}{{required}}">{{content}}</div>',
        'checkboxInlineContainerError' => '<div class="form-check form-check-inline {{type}}{{required}} is-invalid">{{content}}</div>',
        'customCheckboxInlineContainer' => '<div class="form-group custom-control custom-checkbox custom-control-inline {{type}}{{required}}">{{content}}</div>',
        'customCheckboxInlineContainerError' => '<div class="form-group custom-control custom-checkbox custom-control-inline {{type}}{{required}} is-invalid">{{content}}</div>',
        'checkboxFormGroup' => '{{input}}{{label}}',
        'checkboxWrapper' => '<div class="form-check">{{label}}</div>',
        'checkboxInlineWrapper' => '<div class="form-check form-check-inline">{{label}}</div>',
        'customCheckboxWrapper' => '<div class="custom-control custom-checkbox">{{label}}</div>',
        'customCheckboxInlineWrapper' => '<div class="custom-control custom-checkbox custom-control-inline">{{label}}</div>',
        'radioContainer' => '<div class="form-group {{type}}{{required}}" role="group" aria-labelledby="{{groupId}}">{{content}}{{help}}</div>',
        'radioContainerError' => '<div class="form-group {{type}}{{required}} is-invalid" role="group" aria-labelledby="{{groupId}}">{{content}}{{error}}{{help}}</div>',
        'radioLabel' => '<label id="{{groupId}}" class="d-block">{{text}}</label>',
        'radioWrapper' => '<div class="form-check">{{hidden}}{{label}}</div>',
        'radioInlineWrapper' => '<div class="form-check form-check-inline">{{label}}</div>',
        'customRadioWrapper' => '<div class="custom-control custom-radio">{{hidden}}{{label}}</div>',
        'customRadioInlineWrapper' => '<div class="custom-control custom-radio custom-control-inline">{{hidden}}{{label}}</div>',
        'staticControl' => '<p class="form-control-plaintext">{{content}}</p>',
        'inputGroupAddon' => '<div class="{{class}}">{{content}}</div>',
        'inputGroupContainer' => '<div{{attrs}}>{{prepend}}{{content}}{{append}}</div>',
        'inputGroupText' => '<span class="input-group-text">{{content}}</span>',
        'multicheckboxContainer' => '<div class="form-group {{type}}{{required}}" role="group" aria-labelledby="{{groupId}}">{{content}}{{help}}</div>',
        'multicheckboxContainerError' => '<div class="form-group {{type}}{{required}} is-invalid" role="group" aria-labelledby="{{groupId}}">{{content}}{{error}}{{help}}</div>',
        'multicheckboxLabel' => '<label id="{{groupId}}" class="d-block">{{text}}</label>',
        'multicheckboxWrapper' => '<fieldset class="form-group">{{content}}</fieldset>',
        'multicheckboxTitle' => '<legend class="col-form-label pt-0">{{text}}</legend>',
        'customFileLabel' => '<label class="custom-file-label"{{attrs}}>{{text}}{{tooltip}}</label>',
        'customFileFormGroup' => '<div class="custom-file">{{input}}{{label}}</div>',
        'customFileInputGroupFormGroup' => '{{input}}',
        'customFileInputGroupContainer' => '<div{{attrs}}>{{prepend}}<div class="custom-file">{{content}}{{label}}</div>{{append}}</div>',
        'nestingLabel' => '{{hidden}}{{input}}<label{{attrs}}>{{text}}{{tooltip}}</label>',
        'nestingLabelNestedInput' => '{{hidden}}<label{{attrs}}>{{input}}{{text}}{{tooltip}}</label>',
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
            'datetimeContainer' => '<div class="form-group {{type}}{{required}}" role="group" aria-labelledby="{{groupId}}">{{content}}</div>',
            'datetimeContainerError' => '<div class="form-group {{type}}{{required}} is-invalid" role="group" aria-labelledby="{{groupId}}">{{content}}</div>',
            'datetimeLabel' => '<span id="{{groupId}}" class="sr-only">{{text}}</span>',
            'radioContainer' => '<div class="form-group {{type}}{{required}}" role="group" aria-labelledby="{{groupId}}">{{content}}</div>',
            'radioContainerError' => '<div class="form-group {{type}}{{required}} is-invalid" role="group" aria-labelledby="{{groupId}}">{{content}}</div>',
            'radioLabel' => '<span id="{{groupId}}" class="sr-only">{{text}}</span>',
            'multicheckboxContainer' => '<div class="form-group {{type}}{{required}}" role="group" aria-labelledby="{{groupId}}">{{content}}</div>',
            'multicheckboxContainerError' => '<div class="form-group {{type}}{{required}} is-invalid" role="group" aria-labelledby="{{groupId}}">{{content}}</div>',
            'multicheckboxLabel' => '<span id="{{groupId}}" class="sr-only">{{text}}</span>',
        ],
        'horizontal' => [
            'label' => '<label class="col-form-label %s"{{attrs}}>{{text}}{{tooltip}}</label>',
            'fileLabel' => '<label class="col-form-label pt-1 %s"{{attrs}}>{{text}}{{tooltip}}</label>',
            'formGroup' => '{{label}}<div class="%s">{{input}}{{error}}{{help}}</div>',
            'customFileFormGroup' => '<div class="%s"><div class="custom-file">{{input}}{{label}}</div>{{error}}{{help}}</div>',
            'customFileInputGroupFormGroup' => '<div class="%s">{{input}}{{error}}{{help}}</div>',
            'checkboxFormGroup' => '<div class="%s"><div class="form-check">{{input}}{{label}}</div>{{error}}{{help}}</div>',
            'customCheckboxFormGroup' => '<div class="%s"><div class="custom-control custom-checkbox">{{input}}{{label}}</div>{{error}}{{help}}</div>',
            'datetimeContainer' => '<div class="form-group row {{type}}{{required}}" role="group" aria-labelledby="{{groupId}}">{{content}}</div>',
            'datetimeContainerError' => '<div class="form-group row {{type}}{{required}} is-invalid" role="group" aria-labelledby="{{groupId}}">{{content}}</div>',
            'datetimeLabel' => '<label id="{{groupId}}" class="col-form-label %s">{{text}}</label>',
            'checkboxInlineFormGroup' => '<div class="%s"><div class="form-check form-check-inline">{{input}}{{label}}</div></div>',
            'submitContainer' => '<div class="form-group row"><div class="%s">{{content}}</div></div>',
            'inputContainer' => '<div class="form-group row {{type}}{{required}}">{{content}}</div>',
            'inputContainerError' => '<div class="form-group row {{type}}{{required}} is-invalid">{{content}}</div>',
            'checkboxContainer' => '<div class="form-group row {{type}}{{required}}">{{content}}</div>',
            'checkboxContainerError' => '<div class="form-group row {{type}}{{required}} is-invalid">{{content}}</div>',
            'radioContainer' => '<div class="form-group row {{type}}{{required}}" role="group" aria-labelledby="{{groupId}}">{{content}}</div>',
            'radioContainerError' => '<div class="form-group row {{type}}{{required}} is-invalid" role="group" aria-labelledby="{{groupId}}">{{content}}</div>',
            'radioLabel' => '<label id="{{groupId}}" class="col-form-label d-block pt-0 %s">{{text}}</label>',
            'multicheckboxContainer' => '<div class="form-group row {{type}}{{required}}" role="group" aria-labelledby="{{groupId}}">{{content}}</div>',
            'multicheckboxContainerError' => '<div class="form-group row {{type}}{{required}} is-invalid" role="group" aria-labelledby="{{groupId}}">{{content}}</div>',
            'multicheckboxLabel' => '<label id="{{groupId}}" class="col-form-label d-block pt-0 %s">{{text}}</label>',
        ]
    ];

    /**
     * Default Bootstrap widgets.
     *
     * @var array
     */
    protected $_widgets = [
        'button' => 'BootstrapUI\View\Widget\ButtonWidget',
        'file' => ['BootstrapUI\View\Widget\FileWidget', 'label'],
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
            'custom' => false,
            'prepend' => null,
            'append' => null,
            'inline' => null,
            'nestedInput' => false,
            'type' => null,
            'label' => null,
            'error' => null,
            'required' => null,
            'options' => null,
            'help' => null,
            'tooltip' => null,
            'templates' => [],
            'templateVars' => [],
            'labelOptions' => true,
        ];
        $options = $this->_parseOptions($fieldName, $options);

        $custom = $options['custom'];
        $inline = $options['inline'];
        $nestedInput = $options['nestedInput'];
        unset($options['custom'], $options['inline'], $options['nestedInput']);

        $newTemplates = $options['templates'];
        if ($newTemplates) {
            $this->templater()->push();
            $templateMethod = is_string($options['templates']) ? 'load' : 'add';
            $this->templater()->{$templateMethod}($options['templates']);
            $options['templates'] = [];
        }

        switch ($options['type']) {
            case 'datetime':
            case 'date':
            case 'time':
                $options['hasError'] = $this->_getContext()->hasError($fieldName);

                $options['templateVars']['groupId'] = $this->_domId($fieldName . '-group-label');
                $options['templates']['label'] = $this->templater()->get('datetimeLabel');
                $options['templates']['select'] = $this->templater()->get('dateWidgetPart');
                $options['templates']['inputContainer'] = $this->templater()->get('datetimeContainer');
                $options['templates']['inputContainerError'] = $this->templater()->get('datetimeContainerError');
                break;

            case 'checkbox':
                if (!$custom) {
                    $options['label'] = $this->injectClasses('form-check-label', (array)$options['label']);
                    $options = $this->injectClasses('form-check-input', $options);
                } else {
                    $options['label'] = $this->injectClasses('custom-control-label', (array)$options['label']);
                    $options = $this->injectClasses('custom-control-input', $options);

                    if ($this->_align === 'horizontal') {
                        $options['templates']['checkboxFormGroup'] = $this->templater()->get('customCheckboxFormGroup');
                    } else {
                        $options['templates']['checkboxContainer'] = $this->templater()->get('customCheckboxContainer');
                        $options['templates']['checkboxContainerError'] = $this->templater()->get('customCheckboxContainerError');
                    }
                }

                if ($this->_align === 'horizontal') {
                    $inline = false;
                }

                if ($inline ||
                    $this->_align === 'inline'
                ) {
                    if (!$custom) {
                        $options['templates']['checkboxContainer'] = $this->templater()->get('checkboxInlineContainer');
                        $options['templates']['checkboxContainerError'] = $this->templater()->get('checkboxInlineContainerError');
                    } else {
                        $options['templates']['checkboxContainer'] = $this->templater()->get('customCheckboxInlineContainer');
                        $options['templates']['checkboxContainerError'] = $this->templater()->get('customCheckboxInlineContainerError');
                    }
                }

                if ($nestedInput) {
                    $options['templates']['nestingLabel'] = $this->templater()->get('nestingLabelNestedInput');
                }
                break;

            case 'radio':
                if (!$custom) {
                    $options = $this->injectClasses('form-check-input', $options);
                } else {
                    $options['custom'] = true;
                    $options['templates']['radioWrapper'] = $this->templater()->get('customRadioWrapper');
                }

                $options['templateVars']['groupId'] = $this->_domId($fieldName . '-group-label');
                $options['templates']['label'] = $this->templater()->get('radioLabel');

                if ($inline ||
                    $this->_align === 'inline'
                ) {
                    if (!$custom) {
                        $options['templates']['radioWrapper'] = $this->templater()->get('radioInlineWrapper');
                    } else {
                        $options['templates']['radioWrapper'] = $this->templater()->get('customRadioInlineWrapper');
                    }
                }

                if ($nestedInput) {
                    $options['templates']['nestingLabel'] = $this->templater()->get('nestingLabelNestedInput');
                }
                break;

            case 'select':
                if (isset($options['multiple']) && $options['multiple'] === 'checkbox') {
                    $options['type'] = 'multicheckbox';

                    $options['templateVars']['groupId'] = $this->_domId($fieldName . '-group-label');
                    $options['templates']['label'] = $this->templater()->get('multicheckboxLabel');

                    if (!$custom) {
                        $options = $this->injectClasses('form-check-input', $options);
                    } else {
                        $options['custom'] = true;
                        $options['templates']['checkboxWrapper'] = $this->templater()->get('customCheckboxWrapper');
                    }

                    if ($inline ||
                        $this->_align === 'inline'
                    ) {
                        if (!$custom) {
                            $options['templates']['checkboxWrapper'] = $this->templater()->get('checkboxInlineWrapper');
                        } else {
                            $options['templates']['checkboxWrapper'] = $this->templater()->get('customCheckboxInlineWrapper');
                        }
                    }

                    if ($nestedInput) {
                        $options['templates']['nestingLabel'] = $this->templater()->get('nestingLabelNestedInput');
                    }
                }

                if ($custom &&
                    $options['type'] !== 'multicheckbox'
                ) {
                    $options['injectFormControl'] = false;
                    $options = $this->injectClasses('custom-select', $options);
                }
                break;

            case 'file':
                if (!$custom) {
                    if ($this->_align === 'horizontal') {
                        $options['templates']['label'] = $this->templater()->get('fileLabel');
                    }
                } else {
                    $options['custom'] = true;

                    $options['templates']['label'] = $this->templater()->get('customFileLabel');
                    $options['templates']['formGroup'] = $this->templater()->get('customFileFormGroup');

                    if ($options['prepend'] ||
                        $options['append']
                    ) {
                        if ($options['label'] === null) {
                            $options['label'] = [];
                        }
                        if ($options['label'] !== false &&
                            !isset($options['label']['text'])
                        ) {
                            $text = $fieldName;
                            if (strpos($text, '.') !== false) {
                                $fieldElements = explode('.', $text);
                                $text = array_pop($fieldElements);
                            }
                            $options['label']['text'] = __(Inflector::humanize(Inflector::underscore($text)));
                        }
                        $options['inputGroupLabel'] = $options['label'];
                        $options['label'] = false;

                        $options['templates']['formGroup'] = $this->templater()->get('customFileInputGroupFormGroup');
                        $options['templates']['inputGroupContainer'] = $this->templater()->get('customFileInputGroupContainer');
                    }
                }
                break;

            case 'range':
                if ($custom) {
                    $options['injectFormControl'] = false;
                    $options = $this->injectClasses('custom-range', $options);
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

        $result = parent::control($fieldName, $options);

        if ($newTemplates) {
            $this->templater()->pop();
        }

        return $result;
    }

    /**
     * Creates a set of radio widgets.
     *
     * ### Attributes:
     *
     * - `value` - Indicates the value when this radio button is checked.
     * - `label` - Either `false` to disable label around the widget or an array of attributes for
     *    the label tag. `selected` will be added to any classes e.g. `'class' => 'myclass'` where widget
     *    is checked
     * - `hiddenField` - boolean to indicate if you want the results of radio() to include
     *    a hidden input with a value of ''. This is useful for creating radio sets that are non-continuous.
     * - `disabled` - Set to `true` or `disabled` to disable all the radio buttons. Use an array of
     *   values to disable specific radio buttons.
     * - `empty` - Set to `true` to create an input with the value '' as the first option. When `true`
     *   the radio label will be 'empty'. Set this option to a string to control the label value.
     *
     * @param string $fieldName Name of a field, like this "modelname.fieldname"
     * @param array|\Traversable $options Radio button options array.
     * @param array $attributes Array of attributes.
     * @return string Completed radio widget set.
     * @link https://book.cakephp.org/3.0/en/views/helpers/form.html#creating-radio-buttons
     */
    public function radio($fieldName, $options = [], array $attributes = [])
    {
        $attributes = $this->multiInputAttributes($attributes);

        return parent::radio($fieldName, $options, $attributes);
    }

    /**
     * Creates a set of checkboxes out of options.
     *
     * ### Options
     *
     * - `escape` - If true contents of options will be HTML entity encoded. Defaults to true.
     * - `val` The selected value of the input.
     * - `class` - When using multiple = checkbox the class name to apply to the divs. Defaults to 'checkbox'.
     * - `disabled` - Control the disabled attribute. When creating checkboxes, `true` will disable all checkboxes.
     *   You can also set disabled to a list of values you want to disable when creating checkboxes.
     * - `hiddenField` - Set to false to remove the hidden field that ensures a value
     *   is always submitted.
     * - `label` - Either `false` to disable label around the widget or an array of attributes for
     *   the label tag. `selected` will be added to any classes e.g. `'class' => 'myclass'` where
     *   widget is checked
     *
     * Can be used in place of a select box with the multiple attribute.
     *
     * @param string $fieldName Name attribute of the SELECT
     * @param array|\Traversable $options Array of the OPTION elements
     *   (as 'value'=>'Text' pairs) to be used in the checkboxes element.
     * @param array $attributes The HTML attributes of the select element.
     * @return string Formatted SELECT element
     * @see \Cake\View\Helper\FormHelper::select() for supported option formats.
     */
    public function multiCheckbox($fieldName, $options, array $attributes = [])
    {
        $attributes = $this->multiInputAttributes($attributes);

        return parent::multiCheckbox($fieldName, $options, $attributes);
    }

    /**
     * Set options for radio and multi checkbox inputs.
     *
     * @param array $attributes Attributes
     * @return array
     */
    protected function multiInputAttributes(array $attributes)
    {
        $classPrefix = 'form-check';
        if (isset($attributes['custom']) &&
            $attributes['custom']
        ) {
            $classPrefix = 'custom-control';
        }
        unset($attributes['custom']);

        $attributes += ['label' => true];

        $attributes = $this->injectClasses($classPrefix . '-input', $attributes);
        if ($attributes['label'] === true) {
            $attributes['label'] = [];
        }
        if ($attributes['label'] !== false) {
            $attributes['label'] = $this->injectClasses($classPrefix . '-label', $attributes['label']);
        }

        return $attributes;
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
     * {@inheritdoc}
     */
    protected function _datetimeOptions($options)
    {
        $options = parent::_datetimeOptions($options);

        $errorClass = $this->getConfig('errorClass');
        $hasError = isset($options['hasError']) && $options['hasError'] === true;
        unset($options['hasError']);

        foreach ($this->_datetimeParts as $part) {
            if (isset($options[$part]) &&
                $options[$part] !== false
            ) {
                if ($hasError) {
                    $options[$part] = $this->addClass($options[$part], $errorClass);
                }

                $options[$part] += ['templateVars' => []];
                $options[$part]['templateVars'] += [
                    'part' => $part
                ];
            }
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
        $templates['datetimeLabel'] = sprintf($templates['datetimeLabel'], $this->_gridClass('left'));
        $templates['radioLabel'] = sprintf($templates['radioLabel'], $this->_gridClass('left'));
        $templates['fileLabel'] = sprintf($templates['fileLabel'], $this->_gridClass('left'));
        $templates['multicheckboxLabel'] = sprintf($templates['multicheckboxLabel'], $this->_gridClass('left'));
        $templates['formGroup'] = sprintf($templates['formGroup'], $this->_gridClass('middle'));
        foreach (['customFileFormGroup', 'customFileInputGroupFormGroup', 'checkboxFormGroup', 'checkboxInlineFormGroup', 'customCheckboxFormGroup', 'submitContainer'] as $value) {
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
