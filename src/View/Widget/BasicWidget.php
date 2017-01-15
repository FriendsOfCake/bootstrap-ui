<?php
namespace BootstrapUI\View\Widget;

use BootstrapUI\View\Widget\InputgroupTrait;
use Cake\View\Form\ContextInterface;

class BasicWidget extends \Cake\View\Widget\BasicWidget
{
    use InputgroupTrait;

    /**
     * Render a text widget or other simple widget like email/tel/number.
     *
     * This method accepts a number of keys:
     *
     * - `name` The name attribute.
     * - `val` The value attribute.
     * - `escape` Set to false to disable escaping on all attributes.
     * - `append` Append addon to input.
     * - `prepend` Prepend addon to input.
     *
     * Any other keys provided in $data will be converted into HTML attributes.
     *
     * @param array $data The data to build an input with.
     * @param \Cake\View\Form\ContextInterface $context The current form context.
     * @return string
     */
    public function render(array $data, ContextInterface $context)
    {
        return $this->_withInputGroup($data, $context);
    }
}
