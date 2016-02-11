<?php

namespace BootstrapUI\View;

use Cake\View\View;

/**
 * UIView: the customised BootstrapUI View class.
 *
 * It customises the View::$layout to the BootstrapUI's layout and loads
 * BootstrapUI's helpers.
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

        $this->initializeUI();
    }
}
