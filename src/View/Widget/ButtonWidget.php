<?php

namespace BootstrapUI\View\Widget;

use BootstrapUI\View\Helper\OptionsAwareTrait;
use Cake\View\Form\ContextInterface;

class ButtonWidget extends \Cake\View\Widget\ButtonWidget
{

    use OptionsAwareTrait;

    protected $_styles = [
        'default',
        'success',
        'warning',
        'danger',
        'info',
    ];

    /**
     * Renders a button.
     *
     * @param array $data The data to build a button with.
     * @param \Cake\View\Form\ContextInterface $context The current form context.
     * @return string
     */
    public function render(array $data, ContextInterface $context)
    {
        $data = $this->injectClasses('btn', $data);
        $data['class'] = explode(' ', $data['class']);

        foreach ($data['class'] as &$class) {
            if (in_array($class, $this->_styles)) {
                $class = 'btn-' . $class;
                break;
            }
        }

        $data['class'] = implode(' ', $data['class']);
        return parent::render($data, $context);
    }
}
