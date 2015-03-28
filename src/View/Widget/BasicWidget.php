<?php
namespace BootstrapUI\View\Widget;

use BootstrapUI\View\Helper\OptionsAwareTrait;
use Cake\View\Form\ContextInterface;

class BasicWidget extends \Cake\View\Widget\BasicWidget
{
    public function render(array $data, ContextInterface $context)
    {
    	$data += [
    		'prepend' => null,
    		'append' => null,
    	];

    	$input = $this->_templates->get('input');

        if ($data['prepend']) {
            if (is_string($data['prepend'])) {
                $class = 'input-group-' . ($this->_isButton($data['prepend']) ? 'btn' : 'addon');
                $input = '<span class="' . $class . '">' . $data['prepend'] . '</span>' . $input;
            } else {
                $class = 'input-group-btn';
                $input = '<span class="' . $class . '">' . implode('', $data['prepend']) . '</span>' . $input;
            }
        }
        if ($data['append']) {
            if (is_string($data['append'])) {
                $class = 'input-group-' . ($this->_isButton($data['append']) ? 'btn' : 'addon');
                $input .= '<span class="' . $class . '">' . $data['append'] . '</span>';
            } else {
                $class = 'input-group-btn';
                $input .= '<span class="' . $class . '">' . implode('', $data['append']) . '</span>';
            }
        }

        if ($data['prepend'] || $data['append']) {
	        $input = '<div class="input-group">' . $input . '</div>';
	        $this->_templates->add(compact('input'));
	    }

	    unset($data['append'], $data['prepend']);

    	return parent::render($data, $context);
    }

    protected function _isButton($html)
    {
        return strpos($html, '<button') !== false || strpos($html, 'type="submit"') !== false;
    }
}