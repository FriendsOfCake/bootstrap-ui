<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper;

use BootstrapUI\View\Helper\ColorModeHelper;
use BootstrapUI\View\Helper\Enum\ColorMode;
use Cake\TestSuite\TestCase;
use Cake\View\View;

class ColorModeHelperTest extends TestCase
{
    /**
     * @var \BootstrapUI\View\Helper\ColorModeHelper
     */
    protected ColorModeHelper $ColorMode;

    public function setUp(): void
    {
        parent::setUp();
        $this->ColorMode = new ColorModeHelper(new View());
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->ColorMode);
    }

    public function testScriptDefaults(): void
    {
        $html = $this->ColorMode->script();

        $this->assertStringStartsWith('<script>', $html);
        $this->assertStringEndsWith('</script>', $html);
        // Default config tokens are baked into the inline JS.
        $this->assertStringContainsString('"bs-theme"', $html);
        $this->assertStringContainsString('"auto"', $html);
        $this->assertStringContainsString('"html"', $html);
        // Public API surface is exposed.
        $this->assertStringContainsString('window.BootstrapUIColorMode', $html);
        // Storage / OS preference wiring is present.
        $this->assertStringContainsString('localStorage', $html);
        $this->assertStringContainsString('prefers-color-scheme', $html);
        // The actual theme attribute is set on the target.
        $this->assertStringContainsString('data-bs-theme', $html);
    }

    public function testScriptCustomConfigViaCallArgs(): void
    {
        $html = $this->ColorMode->script([
            'storageKey' => 'mytheme',
            'default' => 'dark',
            'target' => 'body',
        ]);

        $this->assertStringContainsString('"mytheme"', $html);
        $this->assertStringContainsString('"dark"', $html);
        $this->assertStringContainsString('"body"', $html);
        // The shipped defaults should not leak through when overridden.
        $this->assertStringNotContainsString('"bs-theme"', $html);
    }

    public function testScriptHonoursHelperSetConfig(): void
    {
        $this->ColorMode->setConfig('storageKey', 'persistent-key');
        $html = $this->ColorMode->script();

        $this->assertStringContainsString('"persistent-key"', $html);
    }

    public function testToggleDefaults(): void
    {
        $html = $this->ColorMode->toggle();

        // Wrapper + ARIA semantics
        $this->assertStringContainsString('data-bs-theme-toggle', $html);
        $this->assertStringContainsString('role="group"', $html);
        $this->assertStringContainsString('aria-label="Color mode"', $html);
        $this->assertStringContainsString('class="btn-group btn-group-sm"', $html);

        // All three default modes rendered, in order, with default labels.
        $this->assertMatchesRegularExpression(
            '/data-bs-theme-value="light"[^>]*>Light<.*'
                . 'data-bs-theme-value="dark"[^>]*>Dark<.*'
                . 'data-bs-theme-value="auto"[^>]*>Auto</s',
            $html,
        );

        // Each button carries an aria-pressed attribute initially false; the
        // init script flips the one matching the active mode.
        $this->assertSame(3, substr_count($html, 'aria-pressed="false"'));

        // A trailing inline script wires up clicks.
        $this->assertStringContainsString('BootstrapUIColorMode.set', $html);
    }

    public function testToggleCustomModesAndAria(): void
    {
        $html = $this->ColorMode->toggle([
            'modes' => ['dark', 'light'],
            'wrapperClass' => 'btn-group',
            'ariaLabel' => 'Farbschema',
        ]);

        $this->assertStringContainsString('aria-label="Farbschema"', $html);
        $this->assertStringContainsString('class="btn-group"', $html);
        // Default mode order is overridden; `auto` is intentionally omitted.
        $this->assertMatchesRegularExpression(
            '/data-bs-theme-value="dark".*data-bs-theme-value="light"/s',
            $html,
        );
        $this->assertStringNotContainsString('data-bs-theme-value="auto"', $html);
    }

    /**
     * Custom theme strings (non-enum modes) are escaped both in the attribute
     * value and the rendered label (which falls back to `ucfirst($mode)`).
     */
    public function testToggleEscapesCustomModeString(): void
    {
        $html = $this->ColorMode->toggle([
            'modes' => ['light<script>alert(1)</script>'],
        ]);

        $this->assertStringNotContainsString('<script>alert(1)</script>', $html);
        $this->assertStringContainsString('&lt;script&gt;alert(1)&lt;/script&gt;', $html);
    }

    /**
     * The enum exposes labels via `EnumLabelInterface`, so the helper picks
     * them up automatically — no `labels` config involved.
     */
    public function testEnumProvidesLabels(): void
    {
        $this->assertSame('Light', ColorMode::Light->label());
        $this->assertSame('Dark', ColorMode::Dark->label());
        $this->assertSame('Auto', ColorMode::Auto->label());
    }

    /**
     * Modes accept ColorMode enum cases interchangeably with their string
     * values. The rendered markup uses the string value either way.
     */
    public function testModesAcceptEnumCases(): void
    {
        $html = $this->ColorMode->toggle([
            'modes' => [ColorMode::Dark, ColorMode::Light],
            'default' => ColorMode::Dark,
        ]);

        $this->assertStringContainsString('data-bs-theme-value="dark"', $html);
        $this->assertStringContainsString('data-bs-theme-value="light"', $html);
        // No `auto` because the config omits it.
        $this->assertStringNotContainsString('data-bs-theme-value="auto"', $html);
    }

    /**
     * The `script()` output is unchanged when the default mode is passed as
     * an enum case vs the equivalent string.
     */
    public function testScriptDefaultAcceptsEnumCase(): void
    {
        $fromEnum = $this->ColorMode->script(['default' => ColorMode::Dark]);
        $fromString = $this->ColorMode->script(['default' => 'dark']);

        $this->assertSame($fromEnum, $fromString);
        $this->assertStringContainsString('"dark"', $fromEnum);
    }
}
