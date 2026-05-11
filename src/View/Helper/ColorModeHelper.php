<?php
declare(strict_types=1);

namespace BootstrapUI\View\Helper;

use BootstrapUI\View\Helper\Enum\ColorMode;
use Cake\View\Helper;
use function Cake\Core\h;

/**
 * ColorModeHelper renders Bootstrap 5.3 color mode (`data-bs-theme`)
 * support: an inline script that applies the user's stored preference on
 * page load (preventing FOUC), and a switcher widget the user can interact
 * with.
 *
 * Drop `$this->ColorMode->script()` near the top of `<head>` and
 * `$this->ColorMode->toggle()` wherever you want the switcher (e.g. navbar).
 *
 * @extends \Cake\View\Helper<\Cake\View\View>
 */
class ColorModeHelper extends Helper
{
    /**
     * @var array<string, mixed>
     */
    protected array $_defaultConfig = [
        // localStorage key under which the user's choice is persisted.
        'storageKey' => 'bs-theme',
        // Mode used when nothing is stored yet. Accepts either a ColorMode
        // case or its string value ("light", "dark", "auto").
        'default' => ColorMode::Auto,
        // CSS selector for the element that carries `data-bs-theme`.
        // Default `html` matches the BS5.3 documentation pattern.
        'target' => 'html',
        // Modes (and their order) shown in the toggle. Each entry may be a
        // ColorMode case or a string.
        'modes' => [ColorMode::Light, ColorMode::Dark, ColorMode::Auto],
        // Labels shown on the toggle buttons. Keyed by the mode's string
        // value. Override for i18n.
        'labels' => [
            'light' => 'Light',
            'dark' => 'Dark',
            'auto' => 'Auto',
        ],
        // ARIA label for the toggle group.
        'ariaLabel' => 'Color mode',
        // Default CSS classes for the toggle wrapper (BS5 btn-group).
        'wrapperClass' => 'btn-group btn-group-sm',
        // Default CSS classes applied to each toggle button (without active state).
        'buttonClass' => 'btn btn-outline-secondary',
        // Class added to the currently-selected button. Bootstrap's `.active`
        // pairs naturally with `btn-outline-*`.
        'activeClass' => 'active',
    ];

    /**
     * Emit an inline `<script>` that:
     *
     * - reads the stored theme from `localStorage` (key: `storageKey` config),
     * - resolves `auto` against the user's OS preference,
     * - sets `data-bs-theme` on the target element (default `<html>`),
     * - re-resolves on `prefers-color-scheme` changes while in auto mode,
     * - exposes a tiny global API: `window.BootstrapUIColorMode.{get,set}(mode)`.
     *
     * Place this near the top of `<head>` to avoid a flash of unstyled theme.
     *
     * @param array<string, mixed> $options Per-call overrides for the helper config.
     * @return string
     */
    public function script(array $options = []): string
    {
        $config = $options + $this->getConfig();

        $storageKey = json_encode($config['storageKey']);
        $default = json_encode($this->_modeValue($config['default']));
        $target = json_encode($config['target']);

        // Inline IIFE; ASCII-only so it survives any reasonable CSP/serializer.
        $js = '(function(){'
            . 'var k=' . $storageKey . ',d=' . $default . ',t=' . $target . ';'
            . 'var el=document.querySelector(t)||document.documentElement;'
            . 'var media=window.matchMedia("(prefers-color-scheme: dark)");'
            . 'function stored(){return localStorage.getItem(k);}'
            . 'function resolve(m){return m==="auto"?(media.matches?"dark":"light"):m;}'
            . 'function apply(m){var r=resolve(m);el.setAttribute("data-bs-theme",r);'
            . 'document.dispatchEvent(new CustomEvent("bs-theme-changed",{detail:{mode:m,resolved:r}}));}'
            . 'apply(stored()||d);'
            . 'media.addEventListener("change",function(){if((stored()||d)==="auto"){apply("auto");}});'
            . 'window.BootstrapUIColorMode={get:function(){return stored()||d;},'
            . 'set:function(m){localStorage.setItem(k,m);apply(m);}};'
            . '})();';

        return '<script>' . $js . '</script>';
    }

    /**
     * Render a Bootstrap button-group color-mode toggle. Clicking a button
     * calls `BootstrapUIColorMode.set('light'|'dark'|'auto')`, which both
     * persists the choice and applies it. The selected button is rendered with
     * the configured active class so screen readers and visual users agree on
     * the current state.
     *
     * @param array<string, mixed> $options Per-call overrides for the helper config.
     * @return string
     */
    public function toggle(array $options = []): string
    {
        $config = $options + $this->getConfig();
        $modes = (array)$config['modes'];
        $labels = (array)$config['labels'];

        $wrapperAttrs = [
            'class' => $config['wrapperClass'],
            'role' => 'group',
            'aria-label' => $config['ariaLabel'],
            'data-bs-theme-toggle' => '1',
        ];

        $buttons = '';
        foreach ($modes as $mode) {
            $value = $this->_modeValue($mode);
            $label = $labels[$value] ?? ucfirst($value);
            $buttons .= $this->_button($value, (string)$label, (string)$config['buttonClass']);
        }

        $initJs = '(function(){'
            . 'var w=document.currentScript&&document.currentScript.previousElementSibling;'
            . 'if(!w||!w.matches("[data-bs-theme-toggle]")){return;}'
            . 'var active=(window.BootstrapUIColorMode&&BootstrapUIColorMode.get())||'
            . json_encode($this->_modeValue($config['default']))
            . ';'
            . 'var ac=' . json_encode($config['activeClass']) . ';'
            . 'w.querySelectorAll("[data-bs-theme-value]").forEach(function(b){'
            . 'b.addEventListener("click",function(){if(window.BootstrapUIColorMode){'
            . 'BootstrapUIColorMode.set(b.getAttribute("data-bs-theme-value"));}'
            . 'w.querySelectorAll("[data-bs-theme-value]").forEach(function(x){x.classList.toggle(ac,x===b);});});'
            . 'if(b.getAttribute("data-bs-theme-value")===active){'
            . 'b.classList.add(ac);b.setAttribute("aria-pressed","true");}'
            . 'else{b.setAttribute("aria-pressed","false");}'
            . '});'
            . '})();';

        return $this->_wrap($wrapperAttrs, $buttons) . '<script>' . $initJs . '</script>';
    }

    /**
     * Render the wrapper element for the toggle.
     *
     * @param array<string, string> $attrs Wrapper attributes.
     * @param string $content Inner HTML.
     * @return string
     */
    protected function _wrap(array $attrs, string $content): string
    {
        $rendered = '';
        foreach ($attrs as $name => $value) {
            $rendered .= ' ' . $name . '="' . h($value) . '"';
        }

        return '<div' . $rendered . '>' . $content . '</div>';
    }

    /**
     * Render a single toggle button.
     *
     * @param string $value The data-bs-theme-value (also the storage value).
     * @param string $label Visible label.
     * @param string $buttonClass Button CSS classes (without active state).
     * @return string
     */
    protected function _button(string $value, string $label, string $buttonClass): string
    {
        return '<button type="button"'
            . ' class="' . h($buttonClass) . '"'
            . ' data-bs-theme-value="' . h($value) . '"'
            . ' aria-pressed="false">'
            . h($label)
            . '</button>';
    }

    /**
     * Coerce a mode value to its string form. Accepts a ColorMode case or a
     * raw string ("light", "dark", "auto", or a custom string for apps that
     * register additional themes via the `modes` config).
     *
     * @param \BootstrapUI\View\Helper\Enum\ColorMode|string $mode Mode value.
     * @return string Lower-case string identifier (e.g. `'light'`).
     */
    protected function _modeValue(ColorMode|string $mode): string
    {
        return $mode instanceof ColorMode ? $mode->value : $mode;
    }
}
