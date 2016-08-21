<?php
namespace BootstrapUI\View\Widget;

use BootstrapUI\View\Helper\OptionsAwareTrait;
use Cake\View\Form\ContextInterface;

/**
 * Input widget class for generating a textarea control.
 *
 * This class is intended as an internal implementation detail
 * of Cake\View\Helper\FormHelper and is not intended for direct use.
 */
class TextareaWidget extends \Cake\View\Widget\TextareaWidget
{
    use OptionsAwareTrait;

    /**
     * Render a text area form widget.
     *
     * Data supports the following keys:
     *
     * - `name` - Set the input name.
     * - `val` - A string of the option to mark as selected.
     * - `escape` - Set to false to disable HTML escaping.
     *
     * All other keys will be converted into HTML attributes.
     *
     * @param array $data The data to build a textarea with.
     * @param \Cake\View\Form\ContextInterface $context The current form context.
     * @return string HTML elements.
     */
    public function render(array $data, ContextInterface $context)
    {
        $data = $this->injectClasses('form-control', $data);

        return parent::render($data, $context);
    }
}
