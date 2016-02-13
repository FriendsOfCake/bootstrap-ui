<?php
namespace BootstrapUI\View\Widget;

use Cake\View\Form\ContextInterface;

class CheckboxWidget extends \Cake\View\Widget\CheckboxWidget
{
    /**
     * Render a checkbox element.
     *
     * Data supports the following keys:
     *
     * - `name` - The name of the input.
     * - `inline` - The alignement to use.
     * - `value` - The value attribute. Defaults to '1'.
     * - `val` - The current value. If it matches `value` the checkbox will be checked.
     *   You can also use the 'checked' attribute to make the checkbox checked.
     * - `disabled` - Whether or not the checkbox should be disabled.
     *
     * Any other attributes passed in will be treated as HTML attributes.
     *
     * @deprecated 0.4 This widget is no longer used.
     * @param array $data The data to create a checkbox with.
     * @param \Cake\View\Form\ContextInterface $context The current form context.
     * @return string Generated HTML string.
     */
    public function render(array $data, ContextInterface $context)
    {
        $data += [
            'inline' => false,
        ];

        if ($data['inline']) {
            $this->_templates->add(['checkboxContainer' => '{{content}}']);
        }

        unset($data['inline']);

        return parent::render($data, $context);
    }
}
