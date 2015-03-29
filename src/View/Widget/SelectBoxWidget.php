<?php
namespace BootstrapUI\View\Widget;

use BootstrapUI\View\Helper\OptionsAwareTrait;
use Cake\View\Form\ContextInterface;

class SelectBoxWidget extends \Cake\View\Widget\SelectBoxWidget
{

    use OptionsAwareTrait;

    /**
     * Renders a select.
     *
     * @param array $data The data to build a select with.
     * @param \Cake\View\Form\ContextInterface $context The current form context.
     * @return string
     */
    public function render(array $data, ContextInterface $context)
    {
        return parent::render($this->injectClasses('form-control', $data), $context);
    }
}
