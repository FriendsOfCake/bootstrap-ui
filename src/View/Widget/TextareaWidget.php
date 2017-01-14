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
        $data += [
            'type' => 'textarea',
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
