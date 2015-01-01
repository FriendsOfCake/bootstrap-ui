<?php

namespace BootstrapUI\Controller\Component;

use Cake\Controller\Component\FlashComponent as Component;
use Cake\Network\Exception\InternalErrorException;
use Cake\Utility\Inflector;

class FlashComponent extends Component
{
    /**
     * Magic method for verbose flash methods based on element names.
     *
     * @param string $name Element name to use.
     * @param array $args Parameters to pass when calling `FlashComponent::set()`.
     * @return void
     * @throws \Cake\Network\Exception\InternalErrorException If missing the flash message.
     */
    public function __call($name, $args)
    {
        if ('error' == $name) {
            $name = 'danger';
        }

        $options = ['element' => 'BootstrapUI.' . Inflector::underscore($name)];

        if (count($args) < 1) {
            throw new InternalErrorException('Flash message missing.');
        }

        if (!empty($args[1])) {
            $options += (array)$args[1];
        }

        $this->set($args[0], $options);
    }
}
