<?php
declare(strict_types=1);

namespace BootstrapUI\View\Helper\Enum;

/**
 * Bootstrap 5.3 color mode values.
 *
 * Used by `ColorModeHelper` for the `default` config key, the `modes` list,
 * and the persisted `data-bs-theme` attribute. String-backed so existing
 * string-based config still works ("light", "dark", "auto").
 */
enum ColorMode: string
{
    case Light = 'light';
    case Dark = 'dark';
    case Auto = 'auto';
}
