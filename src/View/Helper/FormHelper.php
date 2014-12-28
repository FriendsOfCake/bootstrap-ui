<?php

namespace Gourmet\TwitterBootstrap\View\Helper;

use Cake\View\Helper\FormHelper as Helper;
use Cake\View\View;

class FormHelper extends Helper
{

    use OptionsAwareTrait;

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
        parent::__construct($View, $config);
    }

    public function button($title, array $options = array())
    {
        return parent::button($title, $this->injectClasses('btn', $options));
    }

    public function create($model = null, array $options = [])
    {
        $options += [
            'role' => 'form',
            'horizontal' => $this->checkClasses('form-horizontal', $options),
            'templates' => [],
        ];

        if (!empty($options['horizontal'])) {
            $options = $this->injectClasses('form-horizontal', $options);
            $options['horizontal'] = (array) $options['horizontal'];
            $options['horizontal'] += [
                'left' => 'col-md-2',
                'right' => 'col-md-10',
                'combined' => 'col-md-offset-2 col-md-10'
            ];
            $options['templates'] += [
                'label' => '<label class="' . $options['horizontal']['left'] . '"{{attrs}}>{{text}}</label>',
                'formGroup' => '{{label}}<div class="' . $options['horizontal']['right'] . '">{{input}}</div>',
                'checkboxFormGroup' => '<div class="' . $options['horizontal']['combined'] . '">{{label}}</div>',
            ];
        }

        unset($options['horizontal']);
        return parent::create($model, $options);
    }

    public function input($fieldName, array $options = [])
    {
        $options += [
            'type' => null,
            'label' => null,
            'error' => null,
            'required' => null,
            'options' => null,
            'templates' => []
        ];
        $options = $this->_parseOptions($fieldName, $options);
        $options += ['id' => $this->_domId($fieldName)];

        switch ($options['type']) {
            case 'checkbox':
            case 'radio':
                $options['templates']['label'] = '{{text}}';

                if (!isset($options['inline'])) {
                    $options['inline'] = $this->checkClasses('checkbox-inline', (array) $options['label'])
                        || $this->checkClasses('radio-inline', (array) $options['label']);
                }

                if ($options['inline']) {
                    $options['label'] = $this->injectClasses('checkbox-inline', (array) $options['label']);
                    $options['templates'] += ['inputContainer' => '{{content}}'];
                }

                unset($options['inline']);

                break;
            default:
        }

        return parent::input($fieldName, $this->injectClasses('form-control', $options));
    }

    public function textarea($fieldName, array $options = array())
    {
        $options += ['rows' => 3];
        return parent::textarea($fieldName, $options);
    }
}
