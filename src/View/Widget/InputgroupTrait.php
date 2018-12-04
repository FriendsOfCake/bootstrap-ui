<?php
namespace BootstrapUI\View\Widget;

use BootstrapUI\View\Helper\OptionsAwareTrait;
use Cake\View\Form\ContextInterface;
use Cake\View\View;

trait InputgroupTrait
{
    use OptionsAwareTrait;

    /**
     * Render a widget with input group wrapper if requried.
     *
     * Apart from the standard data keys used by a widget you can use following
     * extra keys:
     *
     * - `append` Append addon to input.
     * - `prepend` Prepend addon to input.
     * - `size` Append/Prepend can have option size (sm/lg) for wrapping container
     *
     * @param array $data The data to build an input with.
     * @param \Cake\View\Form\ContextInterface $context The current form context.
     * @return string
     */
    protected function _withInputGroup(array $data, ContextInterface $context)
    {
        $data += [
            'type' => null,
            'prepend' => null,
            'append' => null,
            'injectFormControl' => true,
        ];

        if ($data['injectFormControl'] && $data['type'] !== 'hidden') {
            $data = $this->injectClasses('form-control', $data);
        }

        $prepend = $data['prepend'];
        $append = $data['append'];
        unset($data['append'], $data['prepend'], $data['injectFormControl']);

        $input = parent::render($data, $context);
        $attrs[] = null;

        if ($prepend) {
            $prepend = $this->_checkForOptions($prepend);
            $attrs = $this->_processOptions($prepend, $attrs);
            $data['inputClass'] = 'input-group-prepend';
            $prepend = $this->_addon($prepend['content'], $data);
        }

        if ($append) {
            $append = $this->_checkForOptions($append);
            $attrs = $this->_processOptions($append, $attrs);
            $data['inputClass'] = 'input-group-append';
            $append = $this->_addon($append['content'], $data);
        }

        if ($prepend || $append) {
            $input = $this->_templates->format('inputGroupContainer', [
                'attrs' => $this->_templates->formatAttributes($attrs),
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
        if ($this->_isButton($addon)) {
            $element = $addon;
        } else {
            $element = $this->_templates->format('inputGroupText', [
                'content' => $addon,
            ]);
        }

        $addon = $this->_templates->format('inputGroupAddon', [
            'class' => $data['inputClass'],
            'content' => $element,
            'templateVars' => $data['templateVars'],
        ]);

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

    /**
     * Checks, if prepend/append has options and formats them
     *
     * @param array|string $attachment prepend or append element. Can be a string or array, if contains options
     * @return mixed
     */
    protected function _checkForOptions($attachment)
    {
        if (is_array($attachment)) {
            $ret['content'] = $attachment[0];
            $ret['options'] = $attachment[1];
        } else {
            $ret['content'] = $attachment;
        }

        return $ret;
    }

    /**
     * Processes options given by prepend/append and adds them to wrapping container
     *
     * @param array $attachment prepend/append content and options
     * @param array $attrs of wrapping container
     * @return array attrs with classes
     */
    protected function _processOptions(array $attachment, array $attrs)
    {
        $attrs['class'][] = 'input-group';
        if (isset($attachment['options']['size']) && $attachment['options']['size'] != null) {
            $attrs['class'][] = $this->genClassName('input-group', $attachment['options']['size']);
            $attrs['class'] = $this->_toClassArray($attrs['class']);
        }

        return $attrs;
    }
}
