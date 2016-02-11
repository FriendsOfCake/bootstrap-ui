<?php

namespace BootstrapUI\View;

/**
 * UIViewTrait: Trait that aims to:
 *
 * loading the custom UIBootstrap helpers.
 * setting the View layout to the UIBootstrap's one.
 */
trait UIViewTrait
{
    /**
     * Initialization hook method.
     *
     * @return void
     */
    public function initializeUI()
    {
        if (empty($this->layout) || $this->layout === 'default') {
            //Set the layout to BootstrapUI's layout
            $this->layout = 'BootstrapUI.default';
        }
        //Load BootstrapUI's helpers
        $this->loadHelper('Html', ['className' => 'BootstrapUI.Html']);
        $this->loadHelper('Form', ['className' => 'BootstrapUI.Form']);
        $this->loadHelper('Flash', ['className' => 'BootstrapUI.Flash']);
        $this->loadHelper('Paginator', ['className' => 'BootstrapUI.Paginator']);
    }
}
