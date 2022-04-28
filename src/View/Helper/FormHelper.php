<?php
declare(strict_types=1);

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
     * The default feedback style.
     *
     * @var string
     */
    public const FEEDBACK_STYLE_DEFAULT = 'default';

    /**
     * The tooltip feedback style.
     *
     * @var string
     */
    public const FEEDBACK_STYLE_TOOLTIP = 'tooltip';

    /**
     * Absolute positioning.
     *
     * @var string
     */
    public const POSITION_ABSOLUTE = 'absolute';

    /**
     * Fixed positioning.
     *
     * @var string
     */
    public const POSITION_FIXED = 'fixed';

    /**
     * Relative positioning.
     *
     * @var string
     */
    public const POSITION_RELATIVE = 'relative';

    /**
     * Static positioning.
     *
     * @var string
     */
    public const POSITION_STATIC = 'static';

    /**
     * Sticky positioning.
     *
     * @var string
     */
    public const POSITION_STICKY = 'sticky';

    /**
     * Form alignment types.
     *
     * @var array
     */
    public const ALIGN_TYPES = ['default', 'horizontal', 'inline'];

    /**
     * Default alignment.
     *
     * @var string
     */
    public const ALIGN_DEFAULT = 'default';

    /**
     * Horizontal alignment.
     *
     * @var string
     */
    public const ALIGN_HORIZONTAL = 'horizontal';

    /**
     * Inlline alignment.
     *
     * @var string
     */
    public const ALIGN_INLINE = 'inline';

    /**
     * First grid column.
     *
     * @var int
     */
    public const GRID_COLUMN_ONE = 0;

    /**
     * Second grid column.
     *
     * @var int
     */
    public const GRID_COLUMN_TWO = 1;

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
     * Set on `Form::create()` to tell the spacing type.
     *
     * @var string|false|null
     */
    protected $_spacing;

    /**
     * Default Bootstrap string templates.
     *
     * @var array
     */
    protected $_templates = [
        'error' =>
            '<div id="{{id}}" class="ms-0 invalid-feedback">{{content}}</div>',
        'errorTooltip' =>
            '<div id="{{id}}" class="invalid-tooltip">{{content}}</div>',
        'label' =>
            '<label{{attrs}}>{{text}}{{tooltip}}</label>',
        'help' =>
            '<small{{attrs}}>{{content}}</small>',
        'tooltip' =>
            '<span data-bs-toggle="tooltip" title="{{content}}" class="bi bi-info-circle-fill"></span>',
        'formGroupFloatingLabel' =>
            '{{input}}{{label}}',
        'datetimeContainer' =>
            '<div{{containerAttrs}} ' .
                'class="{{containerClass}}form-group {{type}}{{required}}">{{content}}{{help}}</div>',
        'datetimeContainerError' =>
            '<div{{containerAttrs}} ' .
                'class="{{containerClass}}form-group {{formGroupPosition}}{{type}}{{required}} is-invalid">' .
                    '{{content}}{{error}}{{help}}</div>',
        'datetimeLabel' =>
            '<label{{attrs}}>{{text}}{{tooltip}}</label>',
        'inputContainer' =>
            '<div{{containerAttrs}} ' .
                'class="{{containerClass}}form-group {{type}}{{required}}">{{content}}{{help}}</div>',
        'inputContainerError' =>
            '<div{{containerAttrs}} ' .
                'class="{{containerClass}}form-group {{formGroupPosition}}{{type}}{{required}} is-invalid">' .
                    '{{content}}{{error}}{{help}}</div>',
        'checkboxContainer' =>
            '<div{{containerAttrs}} ' .
                'class="{{containerClass}}form-group form-check{{variant}} ' .
                    '{{type}}{{required}}">{{content}}{{help}}</div>',
        'checkboxContainerError' =>
            '<div{{containerAttrs}} ' .
                'class="{{containerClass}}form-group form-check{{variant}} ' .
                    '{{formGroupPosition}}{{type}}{{required}} is-invalid">{{content}}{{error}}{{help}}</div>',
        'checkboxInlineContainer' =>
            '<div{{containerAttrs}} ' .
                'class="{{containerClass}}form-check{{variant}} form-check-inline align-top {{type}}{{required}}">' .
                    '{{content}}{{help}}</div>',
        'checkboxInlineContainerError' =>
            '<div{{containerAttrs}} ' .
                'class="{{containerClass}}form-check{{variant}} form-check-inline align-top ' .
                    '{{formGroupPosition}}{{type}}{{required}} is-invalid">{{content}}{{error}}{{help}}</div>',
        'checkboxFormGroup' =>
            '{{input}}{{label}}',
        'checkboxWrapper' =>
            '<div class="form-check{{variant}}">{{label}}</div>',
        'checkboxInlineWrapper' =>
            '<div class="form-check{{variant}} form-check-inline">{{label}}</div>',
        'radioContainer' =>
            '<div{{containerAttrs}} class="{{containerClass}}form-group {{type}}{{required}}" role="group" ' .
                'aria-labelledby="{{groupId}}">{{content}}{{help}}</div>',
        'radioContainerError' =>
            '<div{{containerAttrs}} ' .
                'class="{{containerClass}}form-group {{formGroupPosition}}{{type}}{{required}} is-invalid" ' .
                    'role="group" aria-labelledby="{{groupId}}">{{content}}{{error}}{{help}}</div>',
        'radioLabel' =>
            '<label{{attrs}}>{{text}}{{tooltip}}</label>',
        'radioWrapper' =>
            '<div class="form-check">{{hidden}}{{label}}</div>',
        'radioInlineWrapper' =>
            '<div class="form-check form-check-inline">{{label}}</div>',
        'staticControl' =>
            '<p class="form-control-plaintext">{{content}}</p>',
        'inputGroupContainer' =>
            '<div{{attrs}}>{{prepend}}{{content}}{{append}}</div>',
        'inputGroupText' =>
            '<span class="input-group-text">{{content}}</span>',
        'multicheckboxContainer' =>
            '<div{{containerAttrs}} class="{{containerClass}}form-group {{type}}{{required}}" role="group" ' .
                'aria-labelledby="{{groupId}}">{{content}}{{help}}</div>',
        'multicheckboxContainerError' =>
            '<div{{containerAttrs}} ' .
                'class="{{containerClass}}form-group {{formGroupPosition}}{{type}}{{required}} is-invalid" ' .
                    'role="group" aria-labelledby="{{groupId}}">{{content}}{{error}}{{help}}</div>',
        'multicheckboxLabel' =>
            '<label{{attrs}}>{{text}}{{tooltip}}</label>',
        'multicheckboxWrapper' =>
            '<fieldset class="%s form-group">{{content}}</fieldset>',
        'multicheckboxTitle' =>
            '<legend class="col-form-label pt-0">{{text}}</legend>',
        'nestingLabel' =>
            '{{hidden}}{{input}}<label{{attrs}}>{{text}}{{tooltip}}</label>',
        'nestingLabelNestedInput' =>
            '{{hidden}}<label{{attrs}}>{{input}}{{text}}{{tooltip}}</label>',
        'submitContainer' =>
            '<div{{containerAttrs}} class="{{containerClass}}submit">{{content}}</div>',
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
            'elementWrapper' =>
                '<div class="col-auto">{{content}}</div>',
            'checkboxInlineContainer' =>
                '<div{{containerAttrs}} class="{{containerClass}}form-check{{variant}} {{type}}{{required}}">' .
                    '{{content}}{{help}}</div>',
            'checkboxInlineContainerError' =>
                '<div{{containerAttrs}} ' .
                    'class="{{containerClass}}form-check{{variant}} ' .
                        '{{formGroupPosition}}{{type}}{{required}} is-invalid">{{content}}{{error}}{{help}}</div>',
            'datetimeContainer' =>
                '<div{{containerAttrs}} ' .
                    'class="{{containerClass}}form-group {{formGroupPosition}}{{type}}{{required}}">' .
                        '{{content}}{{help}}</div>',
            'datetimeContainerError' =>
                '<div{{containerAttrs}} ' .
                    'class="{{containerClass}}form-group {{formGroupPosition}}{{type}}{{required}} is-invalid">' .
                        '{{content}}{{error}}{{help}}</div>',
            'datetimeLabel' =>
                '<label{{attrs}}>{{text}}{{tooltip}}</label>',
            'radioContainer' =>
                '<div{{containerAttrs}} ' .
                    'class="{{containerClass}}form-group {{formGroupPosition}}{{type}}{{required}}" role="group" ' .
                        'aria-labelledby="{{groupId}}">{{content}}{{help}}</div>',
            'radioContainerError' =>
                '<div{{containerAttrs}} ' .
                    'class="{{containerClass}}form-group {{formGroupPosition}}{{type}}{{required}} is-invalid" ' .
                        'role="group" aria-labelledby="{{groupId}}">{{content}}{{error}}{{help}}</div>',
            'radioLabel' =>
                '<span{{attrs}}>{{text}}{{tooltip}}</span>',
            'multicheckboxContainer' =>
                '<div{{containerAttrs}} ' .
                    'class="{{containerClass}}form-group d-flex {{formGroupPosition}}{{type}}{{required}}" ' .
                        'role="group" aria-labelledby="{{groupId}}">{{content}}{{help}}</div>',
            'multicheckboxContainerError' =>
                '<div{{containerAttrs}} ' .
                    'class="{{containerClass}}form-group d-flex ' .
                        '{{formGroupPosition}}{{type}}{{required}} is-invalid" ' .
                            'role="group" aria-labelledby="{{groupId}}">{{content}}{{error}}{{help}}</div>',
            'multicheckboxLabel' =>
                '<span{{attrs}}>{{text}}{{tooltip}}</span>',
            'multicheckboxWrapper' =>
                '<fieldset class="form-group">{{content}}</fieldset>',
            'multicheckboxTitle' =>
                '<legend class="col-form-label float-none pt-0">{{text}}</legend>',
        ],
        'horizontal' => [
            'label' =>
                '<label{{attrs}}>{{text}}{{tooltip}}</label>',
            'formGroup' =>
                '{{label}}<div class="%s">{{input}}{{error}}{{help}}</div>',
            'formGroupFloatingLabel' =>
                '<div class="%s form-floating">{{input}}{{label}}{{error}}{{help}}</div>',
            'checkboxFormGroup' =>
                '<div class="%s"><div class="form-check{{variant}}">{{input}}{{label}}{{error}}{{help}}</div></div>',
            'datetimeContainer' =>
                '<div{{containerAttrs}} ' .
                    'class="{{containerClass}}form-group row {{type}}{{required}}">{{content}}</div>',
            'datetimeContainerError' =>
                '<div{{containerAttrs}} ' .
                    'class="{{containerClass}}form-group row {{formGroupPosition}}{{type}}{{required}} is-invalid">' .
                        '{{content}}</div>',
            'datetimeLabel' =>
                '<label{{attrs}}>{{text}}{{tooltip}}</label>',
            'checkboxInlineFormGroup' =>
                '<div class="%s"><div class="form-check{{variant}} form-check-inline">{{input}}{{label}}</div></div>',
            'submitContainer' =>
                '<div{{containerAttrs}} class="{{containerClass}}form-group row">' .
                    '<div class="%s">{{content}}</div></div>',
            'inputContainer' =>
                '<div{{containerAttrs}} class="{{containerClass}}form-group row {{type}}{{required}}">' .
                    '{{content}}</div>',
            'inputContainerError' =>
                '<div{{containerAttrs}} ' .
                    'class="{{containerClass}}form-group row {{formGroupPosition}}{{type}}{{required}} is-invalid">' .
                        '{{content}}</div>',
            'checkboxContainer' =>
                '<div{{containerAttrs}} class="{{containerClass}}form-group row {{type}}{{required}}">' .
                    '{{content}}</div>',
            'checkboxContainerError' =>
                '<div{{containerAttrs}} ' .
                    'class="{{containerClass}}form-group row {{formGroupPosition}}{{type}}{{required}} is-invalid">' .
                        '{{content}}</div>',
            'radioContainer' =>
                '<div{{containerAttrs}} class="{{containerClass}}form-group row {{type}}{{required}}" role="group" ' .
                    'aria-labelledby="{{groupId}}">{{content}}</div>',
            'radioContainerError' =>
                '<div{{containerAttrs}} ' .
                    'class="{{containerClass}}form-group row {{formGroupPosition}}{{type}}{{required}} is-invalid" ' .
                        'role="group" aria-labelledby="{{groupId}}">{{content}}</div>',
            'radioLabel' =>
                '<label{{attrs}}>{{text}}{{tooltip}}</label>',
            'multicheckboxContainer' =>
                '<div{{containerAttrs}} class="{{containerClass}}form-group row {{type}}{{required}}" role="group" ' .
                    'aria-labelledby="{{groupId}}">{{content}}</div>',
            'multicheckboxContainerError' =>
                '<div{{containerAttrs}} ' .
                    'class="{{containerClass}}form-group row {{formGroupPosition}}{{type}}{{required}} is-invalid" ' .
                        'role="group" aria-labelledby="{{groupId}}">{{content}}</div>',
            'multicheckboxLabel' =>
                '<label{{attrs}}>{{text}}{{tooltip}}</label>',
        ],
    ];

    /**
     * Default Bootstrap widgets.
     *
     * @var array
     */
    protected $_widgets = [
        'button' => 'BootstrapUI\View\Widget\ButtonWidget',
        'datetime' => 'BootstrapUI\View\Widget\DateTimeWidget',
        'file' => ['BootstrapUI\View\Widget\FileWidget', 'label'],
        'select' => 'BootstrapUI\View\Widget\SelectBoxWidget',
        'textarea' => 'BootstrapUI\View\Widget\TextareaWidget',
        '_default' => 'BootstrapUI\View\Widget\BasicWidget',
    ];

    /**
     * The name of the field for which the current error is being generated.
     *
     * @var string|null
     */
    private $_errorFieldName = null;

    /**
     * {@inheritDoc}
     *
     * Additionally to the core form helper options, the following BootstrapUI related options are supported:
     *
     * - `align` - The default alignment to use for all forms.
     * - `grid` - The default grid setup to use for all horizontal forms.
     * - `spacing` - The spacing to use for all forms. Can be either a string to define a class that will be
     *   used for all form alignments, or an array of strings, keyed by the alignment type to define individual
     *   classes to use per alignment. Set to `false` to disable automatic spacing class usage.
     * - `templateSet` - An array of template sets, keyed by the alignment type.
     */
    public function __construct(View $View, array $config = [])
    {
        $this->_defaultConfig = [
            'align' => 'default',
            'errorClass' => 'is-invalid',
            'grid' => [
                static::GRID_COLUMN_ONE => 2,
                static::GRID_COLUMN_TWO => 10,
            ],
            'spacing' => null,
            'templates' => $this->_templates + $this->_defaultConfig['templates'],
        ] + $this->_defaultConfig;

        if (isset($this->_defaultConfig['templateSet'])) {
            $templateSet = Hash::merge($this->_templateSet, $this->_defaultConfig['templateSet']);
        } else {
            $templateSet = $this->_templateSet;
        }
        $this->_defaultConfig['templateSet'] = $templateSet;

        $this->_defaultWidgets = $this->_widgets + $this->_defaultWidgets;

        parent::__construct($View, $config);
    }

    /**
     * {@inheritDoc}
     *
     * Additionally to the core form helper create options, the following BootstrapUI related options are supported:
     *
     * - `spacing` - The spacing to use for the form. Can be either a string to define a class, or boolean `false` to
     *   disable automatic spacing class usage.
     */
    public function create($context = null, array $options = []): string
    {
        $options += [
            'class' => null,
            'role' => 'form',
            'align' => null,
            'templates' => [],
            'spacing' => null,
        ];

        return parent::create($context, $this->_processFormOptions($options));
    }

    /**
     * @inheritDoc
     */
    public function error(string $field, $text = null, array $options = []): string
    {
        $this->_errorFieldName = $field;
        $error = parent::error($field, $text, $options);
        $this->_errorFieldName = null;

        return $error;
    }

    /**
     * @inheritDoc
     */
    public function formatTemplate(string $name, array $data): string
    {
        // Injects the `id` attribute value for the error template.
        // This is done for backwards compatibility reasons, as the
        // core form helper only introduced this behavior with
        // CakePHP 4.3. This can be removed once the required minimum
        // CakePHP version is bumped accordingly.

        if (
            $name === 'error' &&
            !isset($data['id']) &&
            $this->_errorFieldName !== null
        ) {
            $data['id'] = $this->_domId($this->_errorFieldName . '-error');
        }

        return parent::formatTemplate($name, $data);
    }

    /**
     * @inheritDoc
     */
    public function label(string $fieldName, ?string $text = null, array $options = []): string
    {
        unset($options['floating']);

        return parent::label($fieldName, $text, $options);
    }

    /**
     * @inheritDoc
     */
    public function button(string $title, array $options = []): string
    {
        $result = parent::button($title, $options);

        return $this->_postProcessElement($result, null, $options);
    }

    /**
     * @inheritDoc
     */
    public function submit(?string $caption = null, array $options = []): string
    {
        $options += [
            'class' => 'primary',
        ];
        $options = $this->applyButtonClasses($options);
        $options = $this->_containerOptions(null, $options);

        $result = parent::submit($caption, $options);

        return $this->_postProcessElement($result, null, $options);
    }

    /**
     * @inheritDoc
     */
    public function select(string $fieldName, iterable $options = [], array $attributes = []): string
    {
        $attributes['injectFormControl'] = false;
        $attributes = $this->injectClasses('form-select', $attributes);

        return parent::select($fieldName, $options, $attributes);
    }

    /**
     * {@inheritDoc}
     *
     * Additionally to the core form helper options, the following BootstrapUI related options are supported:
     *
     * - `container` - An array of container attributes, with `class` being a special case, prepending the value to
     *   the existing list of classes instead of replacing them.
     * - `append` - Append addon to input.
     * - `prepend` - Prepend addon to input.
     * - `inline` - Boolean for generating inline checkbox/radio.
     * - `switch` - Boolean for generating switch style checkboxes.
     * - `help` - Help text to include in the input container.
     * - `tooltip` - Tooltip text to include in the control's label.
     * - `feedbackStyle` - The feedback style to use, `default`, or `tooltip` (will cause `formGroupPosition` to be set
     *   to `relative` unless explicitly configured otherwise).
     * - `formGroupPosition` - CSS positioning of form groups, `absolute`, `fixed`, `relative`, `static`, or `sticky`.
     * - `spacing` - The spacing to use for the control. Can be either a string to define a class, or boolean `false`
     *   to disable automatic spacing class usage.
     */
    public function control(string $fieldName, array $options = []): string
    {
        $options += [
            'feedbackStyle' => null,
            'formGroupPosition' => null,
            'prepend' => null,
            'append' => null,
            'inline' => null,
            'nestedInput' => false,
            'switch' => null,
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
            'container' => null,
            'spacing' => null,
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
            case 'datetime-local':
            case 'datetime':
            case 'date':
            case 'time':
                $options = $this->_dateTimeOptions($fieldName, $options);
                break;

            case 'checkbox':
            case 'radio':
            case 'select':
            case 'range':
                $function = '_' . $options['type'] . 'Options';
                $options = $this->{$function}($fieldName, $options);
                break;

            default:
                $options = $this->_labelOptions($fieldName, $options);
                break;
        }

        $options = $this->_spacingOptions($fieldName, $options);
        $options = $this->_containerOptions($fieldName, $options);
        $options = $this->_feedbackStyleOptions($fieldName, $options);
        $options = $this->_ariaOptions($fieldName, $options);
        $options = $this->_placeholderOptions($fieldName, $options);
        $options = $this->_helpOptions($fieldName, $options);
        $options = $this->_tooltipOptions($fieldName, $options);

        if (
            isset($options['append']) ||
            isset($options['prepend'])
        ) {
            $options['injectErrorClass'] = $this->_config['errorClass'];
        }

        unset(
            $options['formGroupPosition'],
            $options['feedbackStyle'],
            $options['spacing'],
            $options['inline'],
            $options['nestedInput'],
            $options['switch']
        );

        $result = parent::control($fieldName, $options);

        $result = $this->_postProcessElement($result, $fieldName, $options);

        if ($newTemplates) {
            $this->templater()->pop();
        }

        return $result;
    }

    /**
     * Modify options and templates based on spacing.
     *
     * @param string $fieldName Field name.
     * @param array $options Options. See `$options` argument of `control()` method.
     * @return array
     */
    protected function _spacingOptions(string $fieldName, array $options): array
    {
        if (!isset($options['spacing'])) {
            $options['spacing'] = $this->_spacing;
        }

        if ($options['spacing'] === false) {
            return $options;
        }

        if ($this->_align !== static::ALIGN_INLINE) {
            $options['templates'] += [
                'multicheckboxWrapper' => sprintf(
                    $this->templater()->getConfig('multicheckboxWrapper'),
                    $options['spacing']
                ),
            ];
        }

        return $options;
    }

    /**
     * Modify the options for container templates.
     *
     * @param string|null $fieldName Field name.
     * @param array $options Options. See `$options` argument of `control()` method.
     * @return array
     */
    protected function _containerOptions(?string $fieldName, array $options): array
    {
        if (
            $this->_align !== static::ALIGN_INLINE &&
            isset($options['type']) &&
            $options['spacing'] !== false
        ) {
            $options['container'] = $this->injectClasses($options['spacing'], (array)($options['container'] ?? []));
        }

        if (
            $this->_align !== static::ALIGN_HORIZONTAL &&
            isset($options['label']['floating']) &&
            $options['label']['floating']
        ) {
            $options['container'] = $this->injectClasses('form-floating', (array)($options['container'] ?? []));
        }

        if (!isset($options['container'])) {
            return $options;
        }

        $containerOptions = $options['container'];
        unset($options['container']);

        if (isset($containerOptions['class'])) {
            $options['templateVars']['containerClass'] = $containerOptions['class'] . ' ';
            unset($containerOptions['class']);
        }
        if (!empty($containerOptions)) {
            $options['templateVars']['containerAttrs'] = $this->templater()->formatAttributes($containerOptions);
        }

        return $options;
    }

    /**
     * Modify options for date time controls.
     *
     * @param string $fieldName Field name.
     * @param array $options Options. See `$options` argument of `control()` method.
     * @return array
     */
    protected function _dateTimeOptions(string $fieldName, array $options): array
    {
        $options = $this->_labelOptions($fieldName, $options);

        // group IDs are no longer required for date/time controls,
        // this is just kept for backwards compatibility

        $groupId =
        $options['templateVars']['groupId'] =
            $this->_domId($fieldName . '-group-label');

        if ($options['label'] !== false) {
            $options['label']['templateVars']['groupId'] = $groupId;
        }

        $options['templates']['label'] = $this->templater()->get('datetimeLabel');
        $options['templates']['inputContainer'] = $this->templater()->get('datetimeContainer');
        $options['templates']['inputContainerError'] = $this->templater()->get('datetimeContainerError');

        return $options;
    }

    /**
     * Modify options for checkbox controls.
     *
     * @param string $fieldName Field name.
     * @param array $options Options. See `$options` argument of `control()` method.
     * @return array
     */
    protected function _checkboxOptions(string $fieldName, array $options): array
    {
        if ($options['label'] !== false) {
            $options['label'] = $this->injectClasses('form-check-label', (array)$options['label']);
        }

        if ($this->_align === static::ALIGN_HORIZONTAL) {
            $options['inline'] = false;
        }

        if (
            $options['inline'] ||
            $this->_align === static::ALIGN_INLINE
        ) {
            $checkboxContainer = $this->templater()->get('checkboxInlineContainer');
            $checkboxContainerError = $this->templater()->get('checkboxInlineContainerError');

            $options['templates']['checkboxContainer'] = $checkboxContainer;
            $options['templates']['checkboxContainerError'] = $checkboxContainerError;
        }

        if ($options['nestedInput']) {
            $options['templates']['nestingLabel'] = $this->templater()->get('nestingLabelNestedInput');
        }

        if ($options['switch']) {
            $options['templateVars']['variant'] = ' form-switch';
        }

        return $options;
    }

    /**
     * Modify options for radio controls.
     *
     * @param string $fieldName Field name.
     * @param array $options Options. See `$options` argument of `control()` method.
     * @return array
     */
    protected function _radioOptions(string $fieldName, array $options): array
    {
        $options = $this->_labelOptions($fieldName, $options);

        $options = $this->injectClasses('form-check-input', $options);

        $groupId =
        $options['templateVars']['groupId'] =
            $this->_domId($fieldName . '-group-label');

        if ($options['label'] !== false) {
            $options['label']['templateVars']['groupId'] = $groupId;
            $options['label']['id'] = $groupId;
        }

        if ($options['label'] !== false) {
            $labelClasses = [];
            if ($this->_align !== static::ALIGN_INLINE) {
                $labelClasses[] = 'd-block';
            }
            if ($this->_align === static::ALIGN_HORIZONTAL) {
                $labelClasses[] = 'pt-0';
            }
            if ($labelClasses) {
                $options['label'] = $this->injectClasses($labelClasses, (array)$options['label']);
            }
        }

        $options['templates']['label'] = $this->templater()->get('radioLabel');

        if (
            $options['inline'] ||
            $this->_align === static::ALIGN_INLINE
        ) {
            $options['templates']['radioWrapper'] = $this->templater()->get('radioInlineWrapper');
        }

        if ($options['nestedInput']) {
            $options['templates']['nestingLabel'] = $this->templater()->get('nestingLabelNestedInput');
        }

        return $options;
    }

    /**
     * Modify options for select controls.
     *
     * @param string $fieldName Field name.
     * @param array $options Options. See `$options` argument of `control()` method.
     * @return array
     */
    protected function _selectOptions(string $fieldName, array $options): array
    {
        $options = $this->_labelOptions($fieldName, $options);

        $labelClasses = [];

        if (isset($options['multiple']) && $options['multiple'] === 'checkbox') {
            $options['type'] = 'multicheckbox';

            $groupId =
            $options['templateVars']['groupId'] =
                $this->_domId($fieldName . '-group-label');

            if ($options['label'] !== false) {
                $options['label']['templateVars']['groupId'] = $groupId;
                $options['label']['id'] = $groupId;
            }

            if ($options['label'] !== false) {
                if ($this->_align !== static::ALIGN_INLINE) {
                    $labelClasses[] = 'd-block';
                }
                if ($this->_align === static::ALIGN_HORIZONTAL) {
                    $labelClasses[] = 'pt-0';
                }
            }

            $options['templates']['label'] = $this->templater()->get('multicheckboxLabel');

            $options = $this->injectClasses('form-check-input', $options);

            if (
                $options['inline'] ||
                $this->_align === static::ALIGN_INLINE
            ) {
                $wrapper = $this->templater()->get('checkboxInlineWrapper');
                $options['templates']['checkboxWrapper'] = $wrapper;
            }

            if ($options['nestedInput']) {
                $options['templates']['nestingLabel'] = $this->templater()->get('nestingLabelNestedInput');
            }

            if ($options['switch']) {
                $options['templateVars']['variant'] = ' form-switch';
            }
        }

        if (
            $this->_align === static::ALIGN_INLINE &&
            $options['label'] !== false &&
            !$options['label']['floating']
        ) {
            $labelClasses[] = 'visually-hidden';
        }

        if ($labelClasses) {
            $options['label'] = $this->injectClasses($labelClasses, (array)$options['label']);
        }

        return $options;
    }

    /**
     * Modify options for range controls.
     *
     * @param string $fieldName Field name.
     * @param array $options Options. See `$options` argument of `control()` method.
     * @return array
     */
    protected function _rangeOptions(string $fieldName, array $options): array
    {
        $options = $this->_labelOptions($fieldName, $options);
        $options['injectFormControl'] = false;

        if (
            $options['label'] !== false &&
            $this->_align === static::ALIGN_HORIZONTAL
        ) {
            $options['label'] = $this->injectClasses('pt-0', (array)$options['label']);
        }

        return $this->injectClasses('form-range', $options);
    }

    /**
     * Modify the options for labels.
     *
     * @param string|null $fieldName Field name.
     * @param array $options Options. See `$options` argument of `control()` method.
     * @return array
     */
    protected function _labelOptions(?string $fieldName, array $options): array
    {
        if ($options['label'] !== false) {
            $options['label'] = (array)$options['label'] + [
                'floating' => false,
            ];

            $labelClasses = [];
            if ($options['label']['floating']) {
                $options['templates']['formGroup'] = $this->templater()->get('formGroupFloatingLabel');
            }

            if (
                $this->_align !== static::ALIGN_HORIZONTAL &&
                !$options['label']['floating']
            ) {
                $labelClasses[] = 'form-label';
            }

            if ($this->_align === static::ALIGN_HORIZONTAL) {
                if (!$options['label']['floating']) {
                    $size = $this->_gridClass(static::GRID_COLUMN_ONE);
                    $labelClasses[] = "col-form-label $size";
                } else {
                    $labelClasses[] = 'ps-4';
                }
            }

            if (
                $this->_align === static::ALIGN_INLINE &&
                !$options['label']['floating']
            ) {
                $labelClasses[] = 'visually-hidden';
            }

            if ($labelClasses) {
                $options['label'] = $this->injectClasses($labelClasses, (array)$options['label']);
            }
        }

        return $options;
    }

    /**
     * Modify templates based on error style.
     *
     * @param string $fieldName Field name.
     * @param array $options Options. See `$options` argument of `control()` method.
     * @return array
     */
    protected function _feedbackStyleOptions(string $fieldName, array $options): array
    {
        $formGroupPosition = $options['formGroupPosition'] ?: $this->getConfig('formGroupPosition');
        $feedbackStyle = $options['feedbackStyle'] ?: $this->getConfig('feedbackStyle');

        if (
            $this->_align === static::ALIGN_INLINE &&
            $feedbackStyle === null
        ) {
            $feedbackStyle = static::FEEDBACK_STYLE_TOOLTIP;
        }

        if ($feedbackStyle === static::FEEDBACK_STYLE_TOOLTIP) {
            $options['templates']['error'] = $this->templater()->get('errorTooltip');
        }

        if (
            $formGroupPosition === null &&
            $feedbackStyle === static::FEEDBACK_STYLE_TOOLTIP
        ) {
            $formGroupPosition = static::POSITION_RELATIVE;
        }

        if ($formGroupPosition !== null) {
            $options['templateVars']['formGroupPosition'] = 'position-' . $formGroupPosition . ' ';
        }

        return $options;
    }

    /**
     * Modify options for aria attributes.
     *
     * @param string $fieldName Field name.
     * @param array $options Options. See `$options` argument of `control()` method.
     * @return array
     */
    protected function _ariaOptions(string $fieldName, array $options): array
    {
        if (
            $options['type'] === 'hidden' ||
            (
                isset($options['aria-required']) &&
                isset($options['aria-describedby']) &&
                isset($options['aria-invalid'])
            )
        ) {
            return $options;
        }

        $isError =
            $options['error'] !== false &&
            $this->isFieldError($fieldName);

        // `aria-invalid` and `aria-required` are injected for backwards
        // compatibility reasons, as support for this has only been
        // introduced in the core form helper with CakePHP 4.3. This can
        // be removed once the required minimum CakePHP version is bumped
        // accordingly.

        if (
            $isError &&
            !isset($options['aria-invalid'])
        ) {
            $options['aria-invalid'] = 'true';
        }

        if (
            $options['required'] &&
            !isset($options['aria-required'])
        ) {
            $options['aria-required'] = 'true';
        }

        if (isset($options['aria-describedby'])) {
            return $options;
        }

        $describedByIds = [];

        if ($isError) {
            $describedByIds[] = $this->_domId($fieldName . '-error');
        }

        if ($options['help']) {
            if (
                is_array($options['help']) &&
                isset($options['help']['id'])
            ) {
                $descriptorId = $options['help']['id'];
            } else {
                $descriptorId = $this->_domId($fieldName . '-help');
            }

            $describedByIds[] = $descriptorId;
        }

        if ($describedByIds) {
            $options['aria-describedby'] = $describedByIds;
        }

        return $options;
    }

    /**
     * Modify options for placeholders.
     *
     * @param string $fieldName Field name.
     * @param array $options Options. See `$options` argument of `control()` method.
     * @return array
     */
    protected function _placeholderOptions(string $fieldName, array $options): array
    {
        if (
            !isset($options['placeholder']) &&
            isset($options['label']['floating']) &&
            $options['label']['floating'] &&
            in_array($options['type'], ['text', 'textarea'], true)
        ) {
            if (isset($options['label']['text'])) {
                $options['placeholder'] = $options['label']['text'];
            } else {
                $text = $fieldName;
                if (strpos($text, '.') !== false) {
                    $fieldElements = explode('.', $text);
                    $text = array_pop($fieldElements);
                }
                if (substr($text, -3) === '_id') {
                    $text = substr($text, 0, -3);
                }

                $options['placeholder'] = __(Inflector::humanize(Inflector::underscore($text)));
            }
        }

        return $options;
    }

    /**
     * Modify options for control's help.
     *
     * @param string $fieldName Field name.
     * @param array $options Options. See `$options` argument of `control()` method.
     * @return array
     */
    protected function _helpOptions(string $fieldName, array $options): array
    {
        if ($options['help']) {
            if (!is_array($options['help'])) {
                $options['help'] = [
                    'content' => $options['help'],
                ];
            }

            if (!isset($options['help']['id'])) {
                $options['help']['id'] = $this->_domId($fieldName . '-help');
            }

            $helpClasses = [];
            if ($this->_align === static::ALIGN_INLINE) {
                $helpClasses[] = 'visually-hidden';
            } else {
                $helpClasses[] = 'd-block';
            }

            $helpClasses[] = 'form-text';
            if ($this->_align !== static::ALIGN_INLINE) {
                $helpClasses[] = 'text-muted';
            }

            $options['help'] = $this->injectClasses($helpClasses, $options['help']);

            $options['help'] = $this->templater()->format('help', [
                'content' => $options['help']['content'],
                'attrs' => $this->templater()->formatAttributes($options['help'], ['content']),
            ]);
        }

        return $options;
    }

    /**
     * Modify options for control's tooltip.
     *
     * @param string $fieldName Field name.
     * @param array $options Options. See `$options` argument of `control()` method.
     * @return array
     */
    protected function _tooltipOptions(string $fieldName, array $options): array
    {
        if (
            $options['tooltip'] &&
            $options['label'] !== false &&
            !($options['label']['floating'] ?? false)
        ) {
            $tooltip = $this->templater()->format(
                'tooltip',
                ['content' => $options['tooltip']]
            );
            $options['label']['templateVars']['tooltip'] = ' ' . $tooltip;
        }
        unset($options['tooltip']);

        return $options;
    }

    /**
     * Post processes a generated form element.
     *
     * @param string $html The form element HTML.
     * @param string|null $fieldName The field name.
     * @param array $options The element generation options (see `$options` argument for `button()`, `submit()`, and
     *  `control()`).
     * @return string
     * @see button()
     * @see submit()
     * @see control()
     */
    protected function _postProcessElement(string $html, ?string $fieldName, array $options): string
    {
        if ($this->_align === static::ALIGN_INLINE) {
            $html = $this->templater()->format('elementWrapper', [
                'content' => $html,
            ]);
        }

        return $html;
    }

    /**
     * @inheritDoc
     */
    public function checkbox(string $fieldName, array $options = [])
    {
        $options = $this->injectClasses('form-check-input', $options);

        return parent::checkbox($fieldName, $options);
    }

    /**
     * @inheritDoc
     */
    public function radio(string $fieldName, iterable $options = [], array $attributes = []): string
    {
        $attributes = $this->multiInputAttributes($attributes);

        return parent::radio($fieldName, $options, $attributes);
    }

    /**
     * @inheritDoc
     */
    public function multiCheckbox(string $fieldName, iterable $options, array $attributes = []): string
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
    protected function multiInputAttributes(array $attributes): array
    {
        $classPrefix = 'form-check';

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
     * Creates a color input.
     *
     * @param string $fieldName The field name.
     * @param array $options Array of options or HTML attributes.
     * @return string
     */
    public function color(string $fieldName, array $options = []): string
    {
        $options['injectFormControl'] = false;
        $options = $this->injectClasses('form-control form-control-color', $options);

        return $this->text($fieldName, ['type' => 'color'] + $options);
    }

    /**
     * @inheritDoc
     */
    public function end(array $secureAttributes = []): string
    {
        $this->_clearFormState();

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
    public function staticControl(string $fieldName, array $options = []): string
    {
        $options += [
            'escape' => true,
            'required' => false,
            'secure' => true,
            'hiddenField' => true,
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
            'content' => $content,
        ]);

        if (!$hiddenField) {
            return $static;
        }

        if ($secure === true && $this->formProtector) {
            /** @psalm-suppress InternalMethod */
            $this->formProtector->addField(
                $options['name'],
                true,
                (string)$options['val']
            );
        }

        $options['type'] = 'hidden';

        return $static . $this->widget('hidden', $options);
    }

    /**
     * @inheritDoc
     */
    protected function _getInput(string $fieldName, array $options)
    {
        unset($options['help']);

        return parent::_getInput($fieldName, $options);
    }

    /**
     * @inheritDoc
     */
    protected function _groupTemplate(array $options): string
    {
        $groupTemplate = $options['options']['type'] . 'FormGroup';
        if (!$this->templater()->get($groupTemplate)) {
            $groupTemplate = 'formGroup';
        }

        return $this->templater()->format($groupTemplate, [
            'input' => $options['input'] ?? [],
            'label' => $options['label'],
            'error' => $options['error'],
            'templateVars' => $options['options']['templateVars'] ?? [],
            'help' => $options['options']['help'],
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function _inputContainerTemplate(array $options): string
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
            'templateVars' => $options['options']['templateVars'] ?? [],
            'help' => $options['options']['help'],
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function _parseOptions(string $fieldName, array $options): array
    {
        $options = parent::_parseOptions($fieldName, $options);
        $options += ['id' => $this->_domId($fieldName)];
        if (is_string($options['label'])) {
            $options['label'] = ['text' => $options['label']];
        }

        return $options;
    }

    /**
     * Processes form creation options.
     *
     * Handles per-form scoped tasks like form alignment detection/switching.
     *
     * @param array $options Options.
     * @return array Modified options.
     */
    protected function _processFormOptions(array $options): array
    {
        if (!$options['align']) {
            $options['align'] = $this->_detectFormAlignment($options);
        }

        if (is_array($options['align'])) {
            $this->_grid = $options['align'];
            $options['align'] = static::ALIGN_HORIZONTAL;
        } elseif ($options['align'] === static::ALIGN_HORIZONTAL) {
            $this->_grid = $this->getConfig('grid');
        }

        if (!in_array($options['align'], static::ALIGN_TYPES)) {
            throw new InvalidArgumentException(
                'Invalid valid for `align` option. Valid values are: ' . implode(', ', static::ALIGN_TYPES)
            );
        }

        $this->_align = $options['align'];

        unset($options['align']);

        if (!isset($options['spacing'])) {
            $options['spacing'] = $this->_getSpacingForAlignment($this->_align);
        }
        $this->_spacing = $options['spacing'];
        unset($options['spacing']);

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
            $options = $this->injectClasses(
                [
                    'row',
                    $this->_spacing,
                    'align-items-center',
                ],
                $options
            );
            $options['templates'] += $templates;

            return $options;
        }

        $templates['label'] = sprintf(
            $templates['label'],
            $this->_gridClass(static::GRID_COLUMN_ONE)
        );
        $templates['datetimeLabel'] = sprintf(
            $templates['datetimeLabel'],
            $this->_gridClass(static::GRID_COLUMN_ONE)
        );
        $templates['radioLabel'] = sprintf(
            $templates['radioLabel'],
            $this->_gridClass(static::GRID_COLUMN_ONE)
        );
        $templates['multicheckboxLabel'] = sprintf(
            $templates['multicheckboxLabel'],
            $this->_gridClass(static::GRID_COLUMN_ONE)
        );
        $templates['formGroup'] = sprintf(
            $templates['formGroup'],
            $this->_gridClass(static::GRID_COLUMN_TWO)
        );

        $offsetGridClass = implode(' ', [
            $this->_gridClass(static::GRID_COLUMN_ONE, true),
            $this->_gridClass(static::GRID_COLUMN_TWO),
        ]);
        $containers = [
            'checkboxFormGroup',
            'checkboxInlineFormGroup',
            'formGroupFloatingLabel',
            'submitContainer',
        ];
        foreach ($containers as $value) {
            $templates[$value] = sprintf($templates[$value], $offsetGridClass);
        }

        $options['templates'] += $templates;

        return $options;
    }

    /**
     * Returns a Bootstrap grid class (i.e. `col-md-2`).
     *
     * @param int $columnIndex The zero-based column index.
     * @param bool $offset If true, will append `offset-` to the class.
     * @return string Classes.
     */
    protected function _gridClass(int $columnIndex, bool $offset = false): string
    {
        if ($this->_grid === null) {
            return '';
        }

        $class = 'col-%s-';
        if ($offset) {
            $class = 'offset-%s-';
        }

        if (isset($this->_grid[$columnIndex])) {
            return sprintf($class, 'md') . $this->_grid[$columnIndex];
        }

        $classes = [];
        foreach ($this->_grid as $screen => $positions) {
            if (isset($positions[$columnIndex])) {
                array_push($classes, sprintf($class, $screen) . $positions[$columnIndex]);
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
    protected function _detectFormAlignment(array $options): string
    {
        foreach ([static::ALIGN_HORIZONTAL, static::ALIGN_INLINE] as $align) {
            if ($this->checkClasses('form-' . $align, (array)$options['class'])) {
                return $align;
            }
        }

        return $this->getConfig('align');
    }

    /**
     * Returns the spacing class for the given alignment.
     *
     * If no spacing classes have been explicitly configured via the helper's `spacing` option, this method will by
     * default return `g-3` for inline alignment, and `mb-3` for horizontal and default alignments.
     *
     * May return `false` to indicate that no spacing should be used.
     *
     * @param string $align The alignment type for which to retrieve the spacing class.
     * @return string|bool
     */
    protected function _getSpacingForAlignment(string $align)
    {
        $spacing = $this->getConfig('spacing');

        if ($spacing === false) {
            return false;
        }

        if (
            $spacing !== null &&
            !is_array($spacing)
        ) {
            $spacing = [
                static::ALIGN_DEFAULT => $spacing,
                static::ALIGN_HORIZONTAL => $spacing,
                static::ALIGN_INLINE => $spacing,
            ];
        }
        $spacing = (array)$spacing + [
            static::ALIGN_DEFAULT => 'mb-3',
            static::ALIGN_HORIZONTAL => 'mb-3',
            static::ALIGN_INLINE => 'g-3',
        ];

        return $spacing[$align];
    }

    /**
     * Clears per-form scoped state.
     *
     * @return void
     */
    protected function _clearFormState()
    {
        $this->_align =
        $this->_grid =
        $this->_spacing =
            null;
    }
}
