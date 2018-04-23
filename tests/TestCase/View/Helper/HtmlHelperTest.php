<?php

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

    public function setUp()
    {
        parent::setUp();

        $this->View = new View();
        $this->Html = new HtmlHelper($this->View);
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->Html, $this->View);
    }

    public function testBadge()
    {
        $result = $this->Html->badge('foo');
        $expected = [
            'span' => ['class' => 'badge badge-secondary'],
            'foo',
            '/span'
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Html->badge('foo', ['class' => 'primary']);
        $expected = [
            'span' => ['class' => 'badge-primary badge'],
            'foo',
            '/span'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testIcon()
    {
        $result = $this->Html->icon('foo');
        $expected = [
            'i' => ['class' => 'fas fa-foo'],
            '/i'
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Html->icon('foo', ['iconSet' => 'fa']);
        $expected = [
            'i' => ['class' => 'fa fa-foo'],
            '/i'
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Html->icon('foo', ['tag' => 'span', 'size' => 'lg']);
        $expected = [
            'span' => ['class' => 'fas fa-foo fa-lg'],
            '/span'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testLabel()
    {
        $result = $this->Html->label('foo');
        $expected = [
            'span' => ['class' => 'badge badge-secondary'],
            'foo',
            '/span'
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Html->label('foo', ['class' => 'primary']);
        $expected = [
            'span' => ['class' => 'badge-primary badge'],
            'foo',
            '/span'
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Html->label('foo', 'primary');
        $expected = [
            'span' => ['class' => 'badge-primary badge'],
            'foo',
            '/span'
        ];
        $this->assertHtml($expected, $result);
    }
}
