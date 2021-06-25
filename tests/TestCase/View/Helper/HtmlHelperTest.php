<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper;

use BootstrapUI\View\Helper\HtmlHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

class HtmlHelperTest extends TestCase
{
    /**
     * @var View
     */
    public $View;

    /**
     * @var HtmlHelper
     */
    public $Html;

    public function setUp(): void
    {
        parent::setUp();

        $this->View = new View();
        $this->Html = new HtmlHelper($this->View);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->Html, $this->View);
    }

    public function testBadge()
    {
        $result = $this->Html->badge('foo');
        $expected = [
            'span' => ['class' => 'badge bg-secondary'],
            'foo',
            '/span',
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Html->badge('foo', ['class' => 'primary']);
        $expected = [
            'span' => ['class' => 'bg-primary badge'],
            'foo',
            '/span',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testIcon()
    {
        $result = $this->Html->icon('foo');
        $expected = [
            'i' => ['class' => 'bi bi-foo'],
            '/i',
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Html->icon('foo', ['iconSet' => 'fas', 'prefix' => 'fa']);
        $expected = [
            'i' => ['class' => 'fas fa-foo'],
            '/i',
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Html->icon('foo', ['tag' => 'span', 'size' => 'lg']);
        $expected = [
            'span' => ['class' => 'bi bi-foo bi-lg'],
            '/span',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testLabel()
    {
        $result = $this->Html->label('foo');
        $expected = [
            'span' => ['class' => 'badge bg-secondary'],
            'foo',
            '/span',
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Html->label('foo', ['type' => 'primary']);
        $expected = [
            'span' => ['class' => 'bg-primary badge'],
            'foo',
            '/span',
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Html->label('foo', 'primary');
        $expected = [
            'span' => ['class' => 'bg-primary badge'],
            'foo',
            '/span',
        ];
        $this->assertHtml($expected, $result);
    }
}
