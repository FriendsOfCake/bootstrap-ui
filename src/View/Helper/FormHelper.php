<?php

namespace Gourmet\TwitterBootstrap\View\Helper;

use Cake\View\Helper\FormHelper as Helper;
use Cake\View\View;

class FormHelper extends Helper
{

    public function __construct(View $View, array $config = [])
    {
        $this->_defaultConfig['errorClass'] = null;
        $this->_defaultConfig['templates'] = array_merge($this->_defaultConfig['templates'], [
            'error' => '<div class="text-danger">{{content}}</div>',
            'inputContainer' => '<div class="form-group">{{content}}</div>',
            'inputContainerError' => '<div class="form-group has-error">{{content}}{{error}}</div>',
        ]);
        parent::__construct($View, $config);
    }

    public function button($title, array $options = array())
    {
        return parent::button($title, $this->_injectStyles($options, 'btn'));
    }

    public function create($model = null, array $options = [])
    {
        $options += ['role' => 'form', 'horizontal' => false];

        if ($this->_checkStyles($options, 'form-horizontal')) {
            $options['horizontal'] = true;
        }

        if (!empty($options['horizontal'])) {
            $options = $this->_injectStyles($options, 'form-horizontal');
            $options['horizontal'] = (array) $options['horizontal'];
            $options['horizontal'] += ['left' => 'col-md-2', 'right' => 'col-md-10'];
            $options += ['templates' => []];
            $options['templates'] += [
                'label' => '<label class="' . $options['horizontal']['left'] . '"{{attrs}}>{{text}}</label>',
                'formGroup' => '{{label}}<div class="' . $options['horizontal']['right'] . '">{{input}}</div>',
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
                $options['templates']['checkboxWrapper'] = '<div class="checkbox"><label>{{input}}{{label}}</label></div>';
                $options['templates']['label'] = '{{text}}';
                break;
            case 'radio':
                $options['templates']['radioWrapper'] = '<div class="radio"><label>{{input}}{{label}}</label></div>';
                $options['templates']['label'] = '{{text}}';
                break;
            default:
        }

        return parent::input($fieldName, $this->_injectStyles($options, 'form-control'));
    }

    public function textarea($fieldName, array $options = array())
    {
        $options += ['rows' => 3];
        return parent::textarea($fieldName, $options);
    }

    protected function _injectStyles($options, $styles)
    {
        $options += ['class' => [], 'skip' => []];
        if (!is_array($options['class'])) {
            $options['class'] = explode(' ', $options['class']);
        }

        if (!is_array($styles)) {
            $styles = explode(' ', $styles);
        }

        foreach ($styles as $style) {
            if (!in_array($style, $options['class']) && !in_array($style, (array) $options['skip'])) {
                array_push($options['class'], $style);
            }
        }

        unset($options['skip']);
        $options['class'] = trim(implode(' ', $options['class']));
        return $options;
    }

    protected function _mergeStyles($current, $new)
    {
        $current = explode(' ', $current);
        $new = explode(' ', $new);

        foreach ($new as $style) {
            if (!in_array($style, $current)) {
                array_push($current, $style);
            }
        }

        return $current;
    }

    protected function _checkStyles($options, $styles)
    {
        if (!is_array($styles)) {
            $styles = explode(' ', $styles);
        }

        if (empty($options['class'])) {
            return false;
        }

        if (!is_array($options['class'])) {
            $options['class'] = explode(' ', $options['class']);
        }

        foreach ($styles as $style) {
            if (!in_array($style, $options['class'])) {
                return false;
            }
        }

        return true;
    }
}
