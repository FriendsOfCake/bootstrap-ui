<?php
namespace BootstrapUI\Controller;

use BootstrapUI\Form\BasicExampleForm;
use Cake\Controller\Controller;

class StyleguideController extends Controller
{
    public $layout = 'BootstrapUI.default';

    public $plugin = 'BootstrapUI';

    public function initialize()
    {
        $this->loadHelper('Html', ['className' => 'BootstrapUI.Html']);
        $this->loadHelper('Form', ['className' => 'BootstrapUI.Form']);
        $this->loadHelper('Flash', ['className' => 'BootstrapUI.Flash']);
        $this->loadHelper('Paginator', ['className' => 'BootstrapUI.Paginator']);
    }

    public function index()
    {
        $basicExampleForm = new BasicExampleForm();
        $this->set(compact(
            'basicExampleForm'
        ));
    }
}