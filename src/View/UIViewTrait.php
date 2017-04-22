<?php

namespace BootstrapUI\View;

/**
 * UIViewTrait: Trait that loads the custom UIBootstrap helpers and sets View
 * layout to the UIBootstrap's one.
 */
trait UIViewTrait
{
    /**
     * Initialization hook method.
     *
     * @param array $options Associative array with valid keys:
     *   - `layout`:
     *      - If not set or true will use the plugin's layout
     *      - If a layout name passed it will be used
     *      - If false do nothing (will keep your layout)
     *
     * @return void
     */
    public function initializeUI(array $options = [])
    {
        if ((!isset($options['layout']) || $options['layout'] === true) &&
            $this->layout === 'default'
        ) {
            $this->layout = 'BootstrapUI.default';
        } elseif (isset($options['layout']) && is_string($options['layout'])) {
            $this->layout = $options['layout'];
        }

        if (!$this->helpers()->has('Html')) {
            $this->loadHelper('Html', ['className' => 'BootstrapUI.Html']);
        }
        if (!$this->helpers()->has('Form')) {
            $this->loadHelper('Form', ['className' => 'BootstrapUI.Form']);
        }
        if (!$this->helpers()->has('Flash')) {
            $this->loadHelper('Flash', ['className' => 'BootstrapUI.Flash']);
        }
        if (!$this->helpers()->has('Paginator')) {
            $this->loadHelper('Paginator', ['className' => 'BootstrapUI.Paginator']);
        }
    }
}
