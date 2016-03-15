<?php
namespace BootstrapUI\View\Widget;

use BootstrapUI\View\Helper\OptionsAwareTrait;
use Cake\View\Form\ContextInterface;

class BasicWidget extends \Cake\View\Widget\BasicWidget
{
    use OptionsAwareTrait;

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
            'type' => 'text',
            'prepend' => null,
            'append' => null,
        ];
        if ($data['type'] !== 'hidden') {
            $data = $this->injectClasses('form-control', $data);
        }

        $prepend = $data['prepend'];
        $append = $data['append'];
        unset($data['append'], $data['prepend']);

        $input = parent::render($data, $context);

        if ($prepend) {
            $prepend = $this->_addon($prepend, $data);
        }
        if ($append) {
            $append = $this->_addon($append, $data);
        }

        if ($prepend || $append) {
            $input = $this->_templates->format('inputGroupContainer', [
                'append' => $append,
                'prepend' => $prepend,
                'content' => $input,
                'templateVars' => $data['templateVars'],
            ]);
        }

        return $input;
    }

    /**
     * Get addon HTML.
     *
     * @param string|array $addon Addon content.
     * @param array $data Widget data.
     * @return string
     */
    protected function _addon($addon, $data)
    {
        if (is_string($addon)) {
            $class = 'input-group-' . ($this->_isButton($addon) ? 'btn' : 'addon');
            $addon = $this->_templates->format('inputGroupAddon', [
                'class' => $class,
                'content' => $addon,
                'templateVars' => $data['templateVars'],
            ]);
        } else {
            $class = 'input-group-btn';
            $addon = $this->_templates->format('inputGroupAddon', [
                'class' => $class,
                'content' => implode('', $addon),
                'templateVars' => $data['templateVars'],
            ]);
        }

        return $addon;
    }

    /**
     * Checks if an HTML markup is for a button.
     *
     * @param string $html Markup to check.
     * @return bool TRUE if it's a button.
     */
    protected function _isButton($html)
    {
        return strpos($html, '<button') !== false || strpos($html, 'type="submit"') !== false;
    }
}
