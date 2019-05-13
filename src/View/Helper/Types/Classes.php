<?php

namespace BootstrapUI\View\Helper\Types;

use ReflectionClass;
use ReflectionException;

/**
 * Classes
 *
 * All available bootstrap classes
 */
final class Classes extends Type
{
    /** @var string The primary class */
    const PRIMARY = 'primary';
    /** @var string The secondary clss */
    const SECONDARY = 'secondary';
    /** @var string The success class */
    const SUCCESS = 'success';
    /** @var string The danger class */
    const DANGER = 'danger';
    /** @var string The warning class */
    const WARNING = 'warning';
    /** @var string The info class */
    const INFO = 'info';
    /** @var string The light class */
    const LIGHT = 'light';
    /** @var string The dark class */
    const DARK = 'dark';
    /** @var string The link class */
    const LINK = 'link';
    /** @var string The small class */
    const SM = 'sm';
    /** @var string The large class */
    const LG = 'lg';
}
