<?php

namespace BootstrapUI\View;

use Cake\View\View;

/**
 * UIView, the customised BootstrapUI View class.
 *
 * customises the $layout to the BootstrapUI's layout
 * and initialize the View with the BootstrapUI's helpers
 */
class UIView extends View
{
    use UIViewTrait;

    /**
     * Initialization hook method.
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        //render the initializeUI method from the UIViewTrait
        $this->initializeUI();
    }
}
