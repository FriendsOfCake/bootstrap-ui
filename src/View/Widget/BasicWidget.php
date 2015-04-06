<?php
namespace BootstrapUI\View\Widget;

use BootstrapUI\View\Helper\OptionsAwareTrait;
use Cake\View\Form\ContextInterface;

class BasicWidget extends \Cake\View\Widget\BasicWidget
{
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
        $data += [
            'prepend' => null,
            'append' => null,
        ];

        $input = $this->_templates->get('input');

        if ($data['prepend']) {
            if (is_string($data['prepend'])) {
                $class = 'input-group-' . ($this->_isButton($data['prepend']) ? 'btn' : 'addon');
                $input = '<span class="' . $class . '">' . $data['prepend'] . '</span>' . $input;
            } else {
                $class = 'input-group-btn';
                $input = '<span class="' . $class . '">' . implode('', $data['prepend']) . '</span>' . $input;
            }
        }
        if ($data['append']) {
            if (is_string($data['append'])) {
                $class = 'input-group-' . ($this->_isButton($data['append']) ? 'btn' : 'addon');
                $input .= '<span class="' . $class . '">' . $data['append'] . '</span>';
            } else {
                $class = 'input-group-btn';
                $input .= '<span class="' . $class . '">' . implode('', $data['append']) . '</span>';
            }
        }

        if ($data['prepend'] || $data['append']) {
            $input = '<div class="input-group">' . $input . '</div>';
            $this->_templates->add(compact('input'));
        }

        unset($data['append'], $data['prepend']);

        return parent::render($data, $context);
    }

    /**
     * Checks if an HTML markup is for a button.
     *
     * @param string $html Markup to check.
     * @return boolean TRUE if it's a button.
     */
    protected function _isButton($html)
    {
        return strpos($html, '<button') !== false || strpos($html, 'type="submit"') !== false;
    }
}
