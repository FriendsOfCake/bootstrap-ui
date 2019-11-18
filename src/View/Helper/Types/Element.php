<?php

namespace BootstrapUI\View\Helper\Types;

use ReflectionClass;
use ReflectionException;

/**
 * Element
 *
 * All available bootstrap elements
 */
final class Element extends Type
{
    /** @var string The alert element */
    const ALERT = 'alert';
    /** @var string The badge element */
    const BADGE = 'badge';
    /** @var string The bg (background) element */
    const BG = 'bg';
    /** @var string The border element */
    const BORDER = 'border';
    /** @var string The button element */
    const BTN = 'btn';
    /** @var string The outline button element */
    const BTN_OUTLINE = 'btn-outline';
    /** @var string The list group item element */
    const LIST_GROUP_ITEM = 'list-group-item';
    /** @var string The input group element */
    const INPUT_GROUP = 'input-group';
}
