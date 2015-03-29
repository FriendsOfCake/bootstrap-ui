<?php
namespace BootstrapUI\View\Widget;

use Cake\View\Form\ContextInterface;

class CheckboxWidget extends \Cake\View\Widget\CheckboxWidget
{

    public function render(array $data, ContextInterface $context)
    {
        $data += [
            'inline' => false,
        ];

        if ($data['inline']) {
            $this->_templates->add(['checkboxContainer' => '{{content}}']);
        }

        unset($data['inline']);

        return parent::render($data, $context);
    }
}