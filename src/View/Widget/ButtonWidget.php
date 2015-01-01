<?php

namespace BootstrapUI\View\Widget;

use Cake\View\Form\ContextInterface;
use BootstrapUI\View\Helper\OptionsAwareTrait;

class ButtonWidget extends \Cake\View\Widget\ButtonWidget
{

    use OptionsAwareTrait;

    /**
     * Renders a button.
     *
     * @param array $data The data to build a button with.
     * @param \Cake\View\Form\ContextInterface $context The current form context.
     * @return string
     */
    public function render(array $data, ContextInterface $context)
    {
        return parent::render($this->injectClasses('btn', $data), $context);
    }
}
