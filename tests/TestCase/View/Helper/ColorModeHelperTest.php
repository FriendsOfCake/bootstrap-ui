<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper;

use BootstrapUI\View\Helper\ColorModeHelper;
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

    public function testToggleCustomModesAndLabels(): void
    {
        $html = $this->ColorMode->toggle([
            'modes' => ['dark', 'light'],
            'labels' => ['dark' => 'Nacht', 'light' => 'Tag'],
            'wrapperClass' => 'btn-group',
            'ariaLabel' => 'Farbschema',
        ]);

        $this->assertStringContainsString('aria-label="Farbschema"', $html);
        $this->assertStringContainsString('class="btn-group"', $html);
        $this->assertStringContainsString('>Nacht<', $html);
        $this->assertStringContainsString('>Tag<', $html);
        // `auto` is intentionally omitted by config.
        $this->assertStringNotContainsString('data-bs-theme-value="auto"', $html);
    }

    public function testToggleEscapesUserSuppliedLabel(): void
    {
        $html = $this->ColorMode->toggle([
            'modes' => ['light'],
            'labels' => ['light' => 'Light<script>alert(1)</script>'],
        ]);

        $this->assertStringNotContainsString('<script>alert(1)</script>', $html);
        $this->assertStringContainsString('&lt;script&gt;alert(1)&lt;/script&gt;', $html);
    }
}
