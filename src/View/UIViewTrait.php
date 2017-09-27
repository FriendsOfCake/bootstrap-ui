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
     *  - `loadHelpers`
     *      - If true, load the BootstrapUI helpers (default)
     *      - If false, don't load them. This allows the developer to extend them without having to unload them first.
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

        $loadHelpers = true;
        if(isset($options['loadHelpers']) and $options['loadHelpers'] === false) {
            $loadHelpers = false;
        }

        if($loadHelpers === true) {
            $this->loadHelper('Html', ['className' => 'BootstrapUI.Html']);
            $this->loadHelper('Form', ['className' => 'BootstrapUI.Form']);
            $this->loadHelper('Flash', ['className' => 'BootstrapUI.Flash']);
            $this->loadHelper('Paginator', ['className' => 'BootstrapUI.Paginator']);
            if (class_exists('\Cake\View\Helper\BreadcrumbsHelper')) {
                $this->loadHelper('Breadcrumbs', ['className' => 'BootstrapUI.Breadcrumbs']);
            }
        }
    }
}
