<?php
declare(strict_types=1);

namespace BootstrapUI\View\Widget;

use BootstrapUI\View\Helper\OptionsAwareTrait;
use Cake\View\Form\ContextInterface;

trait InputGroupTrait
{
    use OptionsAwareTrait;

    /**
     * Render a widget with input group wrapper if required.
     *
     * Apart from the standard data keys used by a widget you can use following
     * extra keys:
     *
     * - `append` Append addon to input.
     * - `prepend` Prepend addon to input.
     * - `size` Append/Prepend can have option size (sm/lg) for wrapping container
     * - `input` If set it will be used as input tag between append and prepend addons.
     *   By default parent::render() will be called to get input tag.
     *
     * @param array $data The data to build an input with.
     * @param \Cake\View\Form\ContextInterface $context The current form context.
     * @return string
     */
    protected function _withInputGroup(array $data, ContextInterface $context): string
    {
        $data += [
            'type' => null,
            'prepend' => null,
            'append' => null,
            'injectFormControl' => true,
            'injectErrorClass' => null,
            'input' => null,
            'templateVars' => null,
        ];

        if ($data['injectFormControl'] && $data['type'] !== 'hidden') {
            $data = $this->injectClasses('form-control', $data);
        }

        $prepend = $data['prepend'];
        $append = $data['append'];
        $errorClass = $data['injectErrorClass'];
        unset($data['append'], $data['prepend'], $data['injectFormControl'], $data['injectErrorClass']);

        if (isset($data['input'])) {
            $input = $data['input'];
            unset($data['input']);
        } else {
            $input = parent::render($data, $context);
        }

        $attrs = [];

        if ($prepend) {
            $prepend = $this->_checkForOptions($prepend);
            $attrs = $this->_processOptions($prepend, $attrs);
            $prepend = $this->_addon($prepend['content'], $data);
        }

        if ($append) {
            $append = $this->_checkForOptions($append);
            $attrs = $this->_processOptions($append, $attrs);
            $append = $this->_addon($append['content'], $data);
        }

        if ($prepend || $append) {
            if (
                $errorClass &&
                $context->hasError($data['fieldName'])
            ) {
                $attrs['class'][] = $errorClass;
            }

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
     * @param string[] $addons Addon content.
     * @param array $data Widget data.
     * @return string
     */
    protected function _addon(array $addons, array $data): string
    {
        $content = [];

        foreach ($addons as $addon) {
            if ($this->_isButton($addon)) {
                $content[] = $addon;
            } else {
                $content[] = $this->_templates->format('inputGroupText', [
                    'content' => $addon,
                ]);
            }
        }

        return implode('', $content);
    }

    /**
     * Checks if an HTML markup is for a button.
     *
     * @param string $html Markup to check.
     * @return bool TRUE if it's a button.
     */
    protected function _isButton(string $html): bool
    {
        return strpos($html, '<button') !== false || strpos($html, 'type="submit"') !== false;
    }

    /**
     * Checks, if prepend/append has options and formats them
     *
     * @param array|string $attachment prepend or append element. Can be a string or array, if contains options
     * @return array
     */
    protected function _checkForOptions($attachment): array
    {
        $ret = [];

        if (is_array($attachment)) {
            $content = $attachment;
            $options = [];

            $possiblyOptions = end($attachment);
            if (is_array($possiblyOptions)) {
                $content = array_slice($content, 0, count($content) - 1);
                $options = $possiblyOptions;
            }

            $ret['content'] = $content;
            $ret['options'] = $options;
        } else {
            $ret['content'] = [$attachment];
            $ret['options'] = [];
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
    protected function _processOptions(array $attachment, array $attrs): array
    {
        $attrs['class'][] = 'input-group';
        if (isset($attachment['options']['size']) && $attachment['options']['size'] != null) {
            $attrs['class'][] = $this->genClassName('input-group', $attachment['options']['size']);
            $attrs['class'] = $this->_toClassArray($attrs['class']);
        }

        if (isset($attachment['options']['class'])) {
            $attrs = $this->injectClasses($attachment['options']['class'], $attrs);
        }

        unset(
            $attachment['options']['size'],
            $attachment['options']['class']
        );

        $attrs += $attachment['options'];

        return $attrs;
    }
}
