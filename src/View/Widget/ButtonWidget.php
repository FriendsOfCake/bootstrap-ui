<?php

namespace BootstrapUI\View\Widget;

use BootstrapUI\View\Helper\OptionsAwareTrait;
use Cake\View\Form\ContextInterface;

class ButtonWidget extends \Cake\View\Widget\ButtonWidget
{

    use OptionsAwareTrait;

    protected static $_styles = [
        'default', 'btn-default',
        'success', 'btn-success',
        'warning', 'btn-warning',
        'danger', 'btn-danger',
        'info', 'btn-info',
        'primary', 'btn-primary'
    ];

    /**
     * Applies the button CSS styles for an array of CSS classnames.
     *
     * @param array $classes
     * @return string
     */
    public static function applyStyle(array $classes) {
        $default = true;
        foreach ($classes as &$class) {
            if (in_array($class, self::$_styles)) {
                if(strpos($class, 'btn-') !== 0) {
                    $class = 'btn-' . $class;
                }
                $default = false;
                break;
            }
        }
        if($default) {
            $classes[] = 'btn-default';
        }
        return implode(' ', $classes);
    }

    /**
     * Renders a button.
     *
     * @param array $data The data to build a button with.
     * @param \Cake\View\Form\ContextInterface $context The current form context.
     * @return string
     */
    public function render(array $data, ContextInterface $context)
    {
        $data = $this->injectClasses('btn', $data);
        $data['class'] = self::applyStyle(explode(' ', $data['class']));
        return parent::render($data, $context);
    }
}
