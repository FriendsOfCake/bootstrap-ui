<?php

namespace Gourmet\TwitterBootstrap\View\Helper;

trait OptionsAwareTrait
{
    public function injectClasses($classes, array $options)
    {
        $options += ['class' => [], 'skip' => []];

        $options['class'] = $this->_toClassArray($options['class']);
        $options['skip'] = $this->_toClassArray($options['skip']);
        $classes = $this->_toClassArray($classes);

        foreach ($classes as $class) {
            if (!in_array($class, $options['class']) && !in_array($class, $options['skip'])) {
                array_push($options['class'], $class);
            }
        }

        unset($options['skip']);
        // array_walk($options['class'], 'trim');
        $options['class'] = implode(' ', $options['class']);
        return $options;
    }

    public function checkClasses($classes, array $options)
    {
        if (empty($options['class'])) {
            return false;
        }

        $options['class'] = $this->_toClassArray($options['class']);
        $classes = $this->_toClassArray($classes);

        foreach ($classes as $class) {
            if (!in_array($class, $options['class'])) {
                return false;
            }
        }

        return true;
    }

    protected function _toClassArray($mixed)
    {
        if (!is_array($mixed)) {
            $mixed = explode(' ', $mixed);
        }
        return $mixed;
    }
}
