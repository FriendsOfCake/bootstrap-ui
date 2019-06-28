<?php
declare(strict_types=1);

namespace BootstrapUI\View\Helper;

use BootstrapUI\View\Helper\Types\Classes;
use BootstrapUI\View\Helper\Types\Element;

trait OptionsAwareTrait
{
    /**
     * Contains the logic for applying style classes for buttons.
     *
     * @param array $data An array of HTML attributes and options.
     * @return array An array of HTML attributes and options.
     */
    public function applyButtonClasses(array $data): array
    {
        $allClasses = $this->genAllClassNames(Element::BTN);

        if ($this->hasAnyClass($allClasses, $data)) {
            $data = $this->injectClasses(Element::BTN, $data);
        } else {
            $data = $this->injectClasses([Element::BTN, Classes::SECONDARY], $data);
        }

        return $this->renameClasses(Element::BTN, $data);
    }

    /**
     * Renames any CSS classes found in the options.
     *
     * @param string $element UI element to which the classname is applied.
     * @param array $options An array of HTML attributes and options.
     * @return array An array of HTML attributes and options.
     */
    public function renameClasses(string $element, array $options): array
    {
        $options += ['class' => []];

        $options['class'] = $this->_toClassArray($options['class']);
        $classes = [];
        foreach ($options['class'] as $name) {
            $classes[] = in_array($name, Classes::values())
                ? $this->genClassName($element, $name)
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
    public function hasAnyClass($classes, array $options): bool
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
    public function injectClasses($classes, array $options): array
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
     * Removes classes from `$options['class']`.
     *
     * @param array|string $classes Name of class(es) to remove.
     * @param array $options An array of HTML attributes and options.
     * @return array An array of HTML attributes and options.
     */
    public function removeClasses($classes, array $options): array
    {
        $options += ['class' => []];

        $options['class'] = $this->_toClassArray($options['class']);
        $classes = $this->_toClassArray($classes);

        foreach ($classes as $class) {
            $indices = array_keys($options['class'], $class);
            foreach ($indices as $index) {
                if ($index !== false) {
                    unset($options['class'][$index]);
                }
            }
        }

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
    public function checkClasses($classes, array $options): bool
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
    protected function _toClassArray($mixed): array
    {
        if ($mixed === null) {
            return [];
        }
        if (!is_array($mixed)) {
            $mixed = explode(' ', $mixed);
        }

        return $mixed;
    }

    /**
     * Generates the classname of the given element
     *
     * @param string $element UI element to which the class can be applied (e.g. btn).
     * @param string $class CSS class, which can be applied to the element.
     * @return bool|string String of generated class, false if element/class not in list.
     */
    public function genClassName(string $element, string $class)
    {
        if (!in_array($element, Element::values())) {
            return false;
        }

        if (!in_array($class, Classes::values())) {
            return false;
        }

        return $element . '-' . $class;
    }

    /**
     * Generates a list of all classnames of a element
     *
     * @param string $element UI element
     * @return array Array of all generated and raw styles
     */
    public function genAllClassNames(string $element): array
    {
        $classes = [];
        foreach (Classes::values() as $class) {
            $classes[] = $this->genClassName($element, $class);
        }

        if ($element === Element::BTN) {
            foreach (Classes::values() as $class) {
                $classes[] = $this->genClassName(Element::BTN_OUTLINE, $class);
            }
        }

        return array_merge(Classes::values(), $classes);
    }
}
