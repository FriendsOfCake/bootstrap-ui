<?php

namespace BootstrapUI\View;

/**
 * ## UIViewTrait:
 *
 * - loading the custom UIBootstrap helpers.
 * - setting the View layout to the UIBootstrap's one.
 */
trait UIViewTrait
{
    /**
     * Initialization hook method.
     *
     * ### Options: an array of keys, available keys are:
     * - `layout`:
     *      - If empty or true will use the plugin's layout
     *      - If a layout name passed it will be used
     *      - If false do nothing ( will keep your layout )
     *
     * @return  void
     */
    public function initializeUI(array $options = [])
    {
        if (!array_key_exists('layout', $options)) {
            $this->layout = 'BootstrapUI.default';
        } elseif ($options['layout'] === true) {
            $this->layout = 'BootstrapUI.default';
        } elseif (is_string($options['layout'])) {
            $this->layout = $options['layout'];
        }

        $this->loadHelper('Html', ['className' => 'BootstrapUI.Html']);
        $this->loadHelper('Form', ['className' => 'BootstrapUI.Form']);
        $this->loadHelper('Flash', ['className' => 'BootstrapUI.Flash']);
        $this->loadHelper('Paginator', ['className' => 'BootstrapUI.Paginator']);
    }
}
