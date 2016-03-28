<?php

namespace BootstrapUI\View;

use Cake\View\View;

/**
 * UIView: the customised BootstrapUI View class.
 *
 * It customises the View::$layout to the BootstrapUI's layout and loads
 * BootstrapUI's helpers.
 *
 * @property \BootstrapUI\View\Helper\FlashHelper $Flash
 * @property \BootstrapUI\View\Helper\FormHelper $Form
 * @property \BootstrapUI\View\Helper\HtmlHelper $Html
 * @property \BootstrapUI\View\Helper\PaginatorHelper $Paginator
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
