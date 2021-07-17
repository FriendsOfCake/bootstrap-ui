<?php
declare(strict_types=1);

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
     * @return array
     * @throws \ReflectionException
     */
    public static function values(): array
    {
        $called = static::class;
        $reflection = new ReflectionClass($called);
        $elements = $reflection->getConstants();

        return array_values($elements);
    }
}
