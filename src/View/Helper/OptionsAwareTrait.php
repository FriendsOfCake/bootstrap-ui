<?php

namespace BootstrapUI\View\Helper;

trait OptionsAwareTrait
{
    /**
     * A list of allowed styles for buttons.
     *
     * @var array
     */
    public $buttonClasses = [
        'default', 'btn-default',
        'success', 'btn-success',
        'warning', 'btn-warning',
        'danger', 'btn-danger',
        'info', 'btn-info',
        'primary', 'btn-primary'
    ];

    /**
     * A mapping of aliases for button styles.
     *
     * @var array
     */
    public $buttonClassAliases = [
        'default' => 'btn-default',
        'success' => 'btn-success',
        'warning' => 'btn-warning',
        'danger' => 'btn-danger',
        'info' => 'btn-info',
        'primary' => 'btn-primary'
    ];

    /**
     * Contains the logic for applying style classes for buttons.
     *
     * @param array $data An array of HTML attributes and options.
     * @return array An array of HTML attributes and options.
     */
    public function applyButtonClasses(array $data)
    {
        if ($this->hasAnyClass($this->buttonClasses, $data)) {
            $data = $this->injectClasses(['btn'], $data);
        } else {
            $data = $this->injectClasses(['btn', 'btn-default'], $data);
        }

        return $this->renameClasses($this->buttonClassAliases, $data);
    }

    /**
     * Renames any CSS classes found in the options.
     *
     * @param array $classMap Key/Value pair of class(es) to be renamed.
     * @param array $options An array of HTML attributes and options.
     * @return array An array of HTML attributes and options.
     */
    public function renameClasses(array $classMap, array $options)
    {
        $options += ['class' => []];
        $options['class'] = $this->_toClassArray($options['class']);
        $classes = [];
        foreach ($options['class'] as $name) {
            $classes[] = array_key_exists($name, $classMap)
                ? $classMap[$name]
                : $name;
        }
        $options['class'] = trim(implode(' ', $classes));

        return $options;
    }

    /**
     * Checks if `$options['class']` contains any one of the class names.
     *
     * @param array|string $classes Name of class(es) to check.
     * @param array $options An array of HTML attributes and options.
     * @return bool True if any one of the class names was found.
     */
    public function hasAnyClass($classes, array $options)
    {
        $options += ['class' => []];

        $options['class'] = $this->_toClassArray($options['class']);
        $classes = $this->_toClassArray($classes);

        foreach ($classes as $class) {
            if (in_array($class, $options['class'])) {
                return true;
            }
        }

        return false;
    }

    /**
     * Injects classes into `$options['class']` when they don't already exist. If a class is defined
     * in `$options['skip']` then it will not be injected. This method removes `$options['skip']` before
     * returning.
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
