<?php

namespace BootstrapUI\View\Helper;

use Cake\View\Helper\FormHelper as Helper;
use Cake\View\View;

class FormHelper extends Helper
{

    use OptionsAwareTrait;

    /**
     * Construct the widgets and binds the default context providers.
     *
     * @param \Cake\View\View $View The View this helper is being attached to.
     * @param array $config Configuration settings for the helper.
     */
    public function __construct(View $View, array $config = [])
    {
        $this->_defaultConfig['errorClass'] = null;
        $this->_defaultConfig['templates'] = array_merge($this->_defaultConfig['templates'], [
            'error' => '<div class="text-danger">{{content}}</div>',
            'inputContainer' => '<div class="form-group">{{content}}</div>',
            'inputContainerError' => '<div class="form-group has-error">{{content}}{{error}}</div>',
            'checkboxWrapper' => '<div class="checkbox"><label>{{input}}{{label}}</label></div>',
            'radioWrapper' => '<div class="radio"><label>{{input}}{{label}}</label></div>',
        ]);

        $this->_defaultWidgets = array_merge($this->_defaultWidgets, [
            'button' => 'BootstrapUI\View\Widget\ButtonWidget',
            'textarea' => 'BootstrapUI\View\Widget\TextareaWidget',
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
                'checkboxFormGroup' => '<div class="' . $options['horizontal']['combined'] . '">{{label}}</div>',
            ];
        }

        unset($options['horizontal']);
        return parent::create($model, $options);
    }

    /**
     * Generates a form input element complete with label and wrapper div.
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
            'templates' => []
        ];
        $options = $this->_parseOptions($fieldName, $options);
        $options += ['id' => $this->_domId($fieldName)];
        $reset = $this->templates();

        switch ($options['type']) {
            case 'checkbox':
            case 'radio':
                $this->templates(['label' => '{{text}}']);

                if (!isset($options['inline'])) {
                    $options['inline'] = $this->checkClasses('checkbox-inline', (array)$options['label'])
                        || $this->checkClasses('radio-inline', (array)$options['label']);
                }

                if ($options['inline']) {
                    $options['label'] = $this->injectClasses('checkbox-inline', (array)$options['label']);
                    $this->templates(['inputContainer' => '{{content}}']);
                }

                unset($options['inline']);

                break;

            case 'select':
            case 'multiselect':
            case 'textarea':
                break;

            default:
                if ($options['label'] !== false && strpos($this->templates('label'), 'class=') === false) {
                    $options['label'] = $this->injectClasses('control-label', (array)$options['label']);
                }

                $prepend = $options['prepend'];
                $append = $options['append'];

                if (empty($prepend) && empty($append)) {
                    break;
                }

                $input = $reset['input'];

                if ($prepend) {
                    if (is_string($prepend)) {
                        $class = 'input-group-' . ($this->_isButton($prepend) ? 'btn' : 'addon');
                        $input = $this->Html->tag('span', $prepend, compact('class')) . $input;
                    } else {
                        $class = 'input-group-btn';
                        $input = $this->Html->tag('span', implode('', $prepend), compact('class')) . $input;
                    }
                }
                if ($append) {
                    if (is_string($append)) {
                        $class = 'input-group-' . ($this->_isButton($append) ? 'btn' : 'addon');
                        $input .= $this->Html->tag('span', $append, compact('class'));
                    } else {
                        $class = 'input-group-btn';
                        $input .= $this->Html->tag('span', implode('', $append), compact('class'));
                    }
                }

                $input = $this->Html->div('input-group', $input, ['escape' => false]);
                $this->templates(compact('input'));
        }

        unset($options['prepend'], $options['append']);
        $result = parent::input($fieldName, $this->injectClasses('form-control', $options));
        $this->templates($reset);
        return $result;
    }

    /**
     * Checks if a given HTML string is a `<button>` or `<input type=submit>`.
     *
     * @param string $html HTML string.
     * @return bool True if it's some sort of button.
     */
    protected function _isButton($html)
    {
        return strpos($html, '<button') !== false || strpos($html, 'type="submit"') !== false;
    }
}
