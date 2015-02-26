<?php

namespace BootstrapUI\View\Helper;

use Cake\View\Helper;

/**
 * FlashHelper class to render flash messages.
 *
 */
class FlashHelper extends Helper
{

    /**
     * Default config
     *
     * - class: List of classes to be applied to the div containing message
     * - attributes: Additional attributes for the div containing message
     *
     * @var array
     */
    protected $_defaultConfig = [
        'class' => ['alert', 'alert-dismissible', 'fade', 'in'],
        'attributes' => ['role' => 'alert']
    ];

    /**
     * Similar to the core's FlashHelper used to render the message set in FlashComponent::set().
     *
     * If the flash element configured is one of "default", "error", "info", "success" or "warning"
     * "BootstrapUI." is prepended to the name so that the element is used from this plugin.
     *
     * @param string $key The [Flash.]key you are rendering in the view.
     * @param array $options Additional options to use for the creation of this flash message.
     *    Supports the 'params', and 'element' keys that are used in the helper.
     * @return string|null Rendered flash message or null if flash key does not exist
     *   in session.
     * @throws \UnexpectedValueException If value for flash settings key is not an array.
     */
    public function render($key = 'flash', array $options = [])
    {
        if (!$this->request->session()->check("Flash.$key")) {
            return null;
        }

        $flash = $this->request->session()->read("Flash.$key");
        if (!is_array($flash)) {
            throw new \UnexpectedValueException(sprintf(
                'Value for flash setting key "%s" must be an array.',
                $key
            ));
        }

        $flash = $options + $flash;
        $flash['params'] += $this->_config;
        $this->request->session()->delete("Flash.$key");

        $element = $flash['element'];
        if (strpos($element, '.') === false &&
            preg_match('#Flash/(default|success|error|info|warning)$#', $element, $matches)
        ) {
            $class = $matches[1];
            $class = str_replace(['default', 'error'], ['info', 'danger'], $class);

            if (is_array($flash['params']['class'])) {
                $flash['params']['class'][] = 'alert-' . $class;
            }
            $element = 'BootstrapUI.Flash/default';
        }

        return $this->_View->element($element, $flash);
    }

    /**
     * Event listeners.
     *
     * @return array
     */
    public function implementedEvents()
    {
        return [];
    }
}
