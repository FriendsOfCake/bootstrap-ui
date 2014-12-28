<?php

namespace Gourmet\TwitterBootstrap\View\Widget;

use Cake\View\Form\ContextInterface;
use Gourmet\TwitterBootstrap\View\Helper\OptionsAwareTrait;

class ButtonWidget extends \Cake\View\Widget\ButtonWidget {

	use OptionsAwareTrait;

	public function render(array $data, ContextInterface $context) {
		return parent::render($this->injectClasses('btn', $data), $context);
	}
}
