<?php

namespace BootstrapUI\View\Helper\Types;

use ReflectionClass;

/**
 * Type
 */
abstract class Type implements TypeInterface
{
    /**
     * Get all constant values of a class
     *
     * @return array|mixed
     * @throws \ReflectionException
     */
    public static function values()
    {
        $called = get_called_class();
        $reflection = new ReflectionClass($called);
        $elements = $reflection->getConstants();

        return array_values($elements);
    }
}
