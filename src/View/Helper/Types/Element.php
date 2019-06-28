<?php
declare(strict_types=1);

namespace BootstrapUI\View\Helper\Types;

/**
 * Element
 *
 * All available bootstrap elements
 */
final class Element extends Type
{
    /** @var string The alert element */
    public const ALERT = 'alert';
    /** @var string The badge element */
    public const BADGE = 'badge';
    /** @var string The bg (background) element */
    public const BG = 'bg';
    /** @var string The border element */
    public const BORDER = 'border';
    /** @var string The button element */
    public const BTN = 'btn';
    /** @var string The outline button element */
    public const BTN_OUTLINE = 'btn-outline';
    /** @var string The list group item element */
    public const LIST_GROUP_ITEM = 'list-group-item';
    /** @var string The input group element */
    public const INPUT_GROUP = 'input-group';
}
