<?php

namespace BootstrapUI\View\Widget;

use Cake\View\Form\ContextInterface;

class TextareaWidget extends \Cake\View\Widget\TextareaWidget
{
    /**
     * Renders a textarea.
     *
     * @param array $data The data to build a button with.
     * @param \Cake\View\Form\ContextInterface $context The current form context.
     * @return string
     */
    public function render(array $data, ContextInterface $context)
    {
        return parent::render($data + ['rows' => 3], $context);
    }
}
