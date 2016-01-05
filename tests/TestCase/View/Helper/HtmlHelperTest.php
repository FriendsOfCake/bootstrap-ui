<?php

namespace BootstrapUI\Test\TestCase\View\Helper;

use BootstrapUI\View\Helper\HtmlHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

class HtmlHelperTest extends TestCase
{
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
            'span' => ['class' => 'badge'],
            'foo',
            '/span',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testIcon()
    {
        $result = $this->Html->icon('foo');
        $expected = [
            'i' => ['class' => 'glyphicon glyphicon-foo'],
            '/i',
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Html->icon('foo', ['iconSet' => 'fa']);
        $expected = [
            'i' => ['class' => 'fa fa-foo'],
            '/i',
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Html->icon('foo', ['tag' => 'span']);
        $expected = [
            'span' => ['class' => 'glyphicon glyphicon-foo'],
            '/span',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testLabel()
    {
        $result = $this->Html->label('foo');
        $expected = [
            'span' => ['class' => 'label label-default'],
            'foo',
            '/span',
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Html->label('foo', 'warning');
        $expected = [
            'span' => ['class' => 'label label-warning'],
            'foo',
            '/span',
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Html->label('foo', ['type' => 'custom']);
        $expected = [
            'span' => ['class' => 'label label-custom'],
            'foo',
            '/span',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testCrumbList()
    {
        $result = $this->Html
            ->addCrumb('jadb')
            ->addCrumb('admad')
            ->addCrumb('joe')
            ->getCrumbList();

        $expected = [
            'ul' => ['class' => 'breadcrumb'],
            ['li' => ['class' => 'first']],
            'jadb',
            '/li',
            '<li',
            'admad',
            '/li',
            ['li' => ['class' => 'last']],
            'joe',
            '/li',
            '/ul',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testGrid()
    {
        $result = $this->Html
            ->gridContent('test 1')
            ->gridConfig(['size' => 3])
            ->gridConfig(['type' => 'xs', 'size' => 12])
            ->gridContent('test 2')
            ->gridConfig(['size' => 9])
            ->gridConfig(['type' => 'xs', 'size' => 12])
            ->gridRender();

        $expected = [
            'div' => ['class' => 'row'],
            ['div' => ['class' => 'col-md-3 col-xs-12']],
            'test 1',
            '/div',
            ['div' => ['class' => 'col-md-9 col-xs-12']],
            'test 2',
            '/div',
            '/div',
        ];

        $this->assertHtml($expected, $result);
    }
}
