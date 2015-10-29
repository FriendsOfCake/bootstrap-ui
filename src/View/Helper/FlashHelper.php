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

        $messages = $this->request->session()->read("Flash.$key");

        if (!is_array($messages)) {
            throw new \UnexpectedValueException(sprintf(
                'Value for flash setting key "%s" must be an array.',
                $key
            ));
        }

        $this->request->session()->delete("Flash.$key");

        $out = '';
        foreach ($messages as $message) {
            $message = $options + $message;
            $message['params'] += $this->_config;

            $element = $message['element'];
            if (strpos($element, '.') === false &&
                preg_match('#Flash/(default|success|error|info|warning)$#', $element, $matches)
            ) {
                $class = $matches[1];
                $class = str_replace(['default', 'error'], ['info', 'danger'], $class);

                if (is_array($message['params']['class'])) {
                    $message['params']['class'][] = 'alert-' . $class;
                }
                $element = 'BootstrapUI.Flash/default';
            }

            $out .= $this->_View->element($element, $message);
        }

        return $out;
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
