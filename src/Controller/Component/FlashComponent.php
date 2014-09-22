<?php

namespace Gourmet\TwitterBootstrap\Controller\Component;

use Cake\Controller\Component\FlashComponent as CakeFlashComponent;
use Cake\Network\Exception\InternalErrorException;
use Cake\Utility\Inflector;

class FlashComponent extends CakeFlashComponent {

	public function __call($name, $args) {
		if ('error' == $name) {
			$name = 'danger';
		}

		$options = ['element' => 'Gourmet/TwitterBootstrap.' . Inflector::underscore($name)];

		if (count($args) < 1) {
			throw new InternalErrorException('Flash message missing.');
		}

		if (!empty($args[1])) {
			$options += (array)$args[1];
		}

		$this->set($args[0], $options);
	}

}
