<?php

namespace BootstrapUI\View\Helper;

trait OptionsAwareTrait
{
    /**
     * Injects classes into `$options['class']` when they don't already exist.
     *
     * @param array|string $classes Name of class(es) to inject.
     * @param array $options An array of HTML attributes and options.
     * @return array An array of HTML attributes and options.
     */
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
        $options['class'] = trim(implode(' ', $options['class']));
        return $options;
    }

    /**
     * Checks if `$classes` are part of the `$options['class']`.
     *
     * @param array|string $classes Name of class(es) to check.
     * @param array $options An array of HTML attributes and options.
     * @return bool False if one or more class(es) do not exist.
     */
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

    /**
     * Normalizes class strings/arrays.
     *
     * @param mixed $mixed One or more classes.
     * @return array Classes as array.
     */
    protected function _toClassArray($mixed)
    {
        if (!is_array($mixed)) {
            $mixed = explode(' ', $mixed);
        }
        return $mixed;
    }
}
