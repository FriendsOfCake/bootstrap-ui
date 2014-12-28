<?php

namespace Gourmet\TwitterBootstrap\View\Widget;

use Cake\View\Form\ContextInterface;

class TextareaWidget extends \Cake\View\Widget\TextareaWidget {
	public function render(array $data, ContextInterface $context) {
		return parent::render($data + ['rows' => 3], $context);
	}
}
