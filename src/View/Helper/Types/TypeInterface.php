<?php
declare(strict_types=1);

namespace BootstrapUI\View\Helper\Types;

/**
 * TypeInterface
 */
interface TypeInterface
{
    /**
     * Get all defined constant values of a class.
     *
     * Bundles all available constants within a class and
     * returns them as an array like
     *
     * [0 => "value1", 1 => "value2"]
     *
     * @return array An array of all constants
     */
    public static function values();
}
