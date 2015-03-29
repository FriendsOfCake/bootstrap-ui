<?php
namespace BootstrapUI\View\Widget;

use Cake\View\Form\ContextInterface;

class RadioWidget extends \Cake\View\Widget\RadioWidget
{

    public function render(array $data, ContextInterface $context)
    {
        $data += [
            'inline' => false,
        ];

        if ($data['inline']) {
            $this->_templates->add(['radioContainer' => '{{content}}']);
        }

        unset($data['inline']);

        return parent::render($data, $context);
    }
}