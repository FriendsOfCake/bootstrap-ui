<?php
declare(strict_types=1);

namespace BootstrapUI\View\Helper\Enum;

use Cake\Database\Type\EnumLabelInterface;
use function Cake\I18n\__;

/**
 * Bootstrap 5.3 color mode values.
 *
 * Used by `ColorModeHelper` for the `default` config key, the `modes` list,
 * and the persisted `data-bs-theme` attribute. String-backed so existing
 * string-based config still works ("light", "dark", "auto").
 *
 * Implements `EnumLabelInterface` so the rendered label can be translated
 * via the standard `__()` catalog and reused by `FormHelper` when the enum
 * is bound to a form control.
 */
enum ColorMode: string implements EnumLabelInterface
{
    case Light = 'light';
    case Dark = 'dark';
    case Auto = 'auto';

    /**
     * @return string
     */
    public function label(): string
    {
        return match ($this) {
            self::Light => __('Light'),
            self::Dark => __('Dark'),
            self::Auto => __('Auto'),
        };
    }
}
