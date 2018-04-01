<?php

namespace BootstrapUI\Test\TestCase\View\Helper;

use BootstrapUI\View\Helper\BreadcrumbsHelper;
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

    /**
     * @var BreadcrumbsHelper
     */
    public $Breadcrumbs;

    public function setUp()
    {
        parent::setUp();

        $this->View = new View();
        $this->Html = new HtmlHelper($this->View);
        $this->Breadcrumbs = new BreadcrumbsHelper($this->View);
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
            '/span'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testIcon()
    {
        $result = $this->Html->icon('foo');
        $expected = [
            'i' => ['class' => 'glyphicon glyphicon-foo'],
            '/i'
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Html->icon('foo', ['iconSet' => 'fa']);
        $expected = [
            'i' => ['class' => 'fa fa-foo'],
            '/i'
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Html->icon('foo', ['tag' => 'span']);
        $expected = [
            'span' => ['class' => 'glyphicon glyphicon-foo'],
            '/span'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testLabel()
    {
        $result = $this->Html->label('foo');
        $expected = [
            'span' => ['class' => 'label label-default'],
            'foo',
            '/span'
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Html->label('foo', 'warning');
        $expected = [
            'span' => ['class' => 'label label-warning'],
            'foo',
            '/span'
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Html->label('foo', ['type' => 'custom']);
        $expected = [
            'span' => ['class' => 'label label-custom'],
            'foo',
            '/span'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testCrumbList()
    {
        $result = $this->Breadcrumbs
            ->add('jadb')
            ->add('admad')
            ->add('joe')
            ->render();

        $expected = '<ol class="breadcrumb"><li><span>jadb</span></li><li><span>admad</span></li><li><span>joe</span></li></ol>';
        $this->assertEquals($expected, $result);
    }
}
