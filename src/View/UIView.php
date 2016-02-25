<?php

namespace BootstrapUI\View;

use Cake\View\View;

/**
 * UIView: BootstrapUI customised view class.
 *
 * - Customises the $layout to the BootstrapUI's one
 * - Initialize the View with the BootstrapUI's helpers
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
