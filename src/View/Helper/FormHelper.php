<?php

namespace Gourmet\TwitterBootstrap\View\Helper;

use Cake\View\Helper\FormHelper as CakeFormHelper;
use Cake\View\View;

class FormHelper extends CakeFormHelper {

	public function __construct(View $View, array $config = []) {
		$this->_defaultConfig['templates'] = array_merge($this->_defaultConfig['templates'], [
			'error' => '<div class="text-danger">{{content}}</div>',
			'inputContainer' => '<div class="form-group {{type}}{{required}}">{{content}}</div>',
			'inputContainerError' => '<div class="form-group {{type}}{{required}} error">{{content}}{{error}}</div>',
		]);
		parent::__construct($View, $config);
	}

	public function button($title, array $options = array()) {
		return parent::button($title, $this->_injectStyles($options, 'btn'));
	}

	public function create($model = null, array $options = []) {
		$options += ['role' => 'form'];
		return parent::create($model, $options);
	}

	public function input($fieldName, array $options = []) {
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
				$options['templates']['label'] = '{text}';
				break;
			case 'radio':
				$options['templates']['radioWrapper'] = '<div class="radio"><label>{{input}}{{label}}</label></div>';
				$options['templates']['label'] = '{text}';
				break;
			default:
		}

		return parent::input($fieldName, $this->_injectStyles($options, 'form-control'));
	}

	public function textarea($fieldName, array $options = array()) {
		$options += ['rows' => 3];
		return parent::textarea($fieldName, $options);
	}

	protected function _injectStyles($options, $styles) {
		$options += ['class' => []];
		if (!is_array($options['class'])) {
			$options['class'] = explode(' ', $options['class']);
		}

		if (!is_array($styles)) {
			$styles = explode(' ', $styles);
		}

		foreach ($styles as $style) {
			if (!in_array($style, $options['class'])) {
				array_push($options['class'], $style);
			}
		}

		return $options;
	}

	protected function _mergeStyles($current, $new) {
		$current = explode(' ', $current);
		$new = explode(' ', $new);

		foreach ($new as $style) {
			if (!in_array($style, $current)) {
				array_push($current, $style);
			}
		}

		return $current;
	}
}
