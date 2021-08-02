<?php
declare(strict_types=1);

namespace BootstrapUI\View\Widget;

use BootstrapUI\View\Helper\OptionsAwareTrait;
use Cake\View\Form\ContextInterface;

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
    public function render(array $data, ContextInterface $context): string
    {
        $data = $this->applyButtonClasses($data);

        return parent::render($data, $context);
    }
}
