<?php
namespace BootstrapUI\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;

class BreadcrumbsHelperTest extends TestCase
{
    /**
     * @var View
     */
    public $View;

    /**
     * @var HtmlHelper
     */
    public $Breadcrumbs;

    public function setUp()
    {
        parent::setUp();

        $this->View = new View();
        if (class_exists('\Cake\View\Helper\BreadcrumbsHelper')) {
            $this->Breadcrumbs = new \BootstrapUI\View\Helper\BreadcrumbsHelper($this->View);
        } else {
            $this->Breadcrumbs = null;
        }
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->Breadcrumbs, $this->View);
    }

    public function testCrumbList()
    {
        if (!class_exists('\Cake\View\Helper\BreadcrumbsHelper')) {
            $this->markTestSkipped('BreadcrumbsHelper cannot be tested when core BreadcrumbsHelper class does not exist');
        }

        $result = $this->Breadcrumbs
            ->add('jadb')
            ->add('admad')
            ->add('joe')
            ->render();

        $expected = '<ol class="breadcrumb"><li><span>jadb</span></li><li><span>admad</span></li><li><span>joe</span></li></ol>';
        $this->assertEquals($expected, $result);
    }

    public function testAttributes()
    {
        if (!class_exists('\Cake\View\Helper\BreadcrumbsHelper')) {
            $this->markTestSkipped('BreadcrumbsHelper cannot be tested when core BreadcrumbsHelper class does not exist');
        }

        $attributes = [
            'wrapper' => ['class' => 'wrapper-class'],
            'separator' => ['class' => 'separator-class', 'innerAttrs' => ['class' => 'separator-inner-class']],
            'item' => ['class' => 'item-class', 'innerAttrs' => ['class' => 'item-inner-class']],
            'itemWithoutLink' => ['class' => 'itemWithoutLink-class', 'innerAttrs' => ['class' => 'itemWithoutLink-inner-class']],
        ];

        $result = $this->Breadcrumbs
            ->add('joe', null, $attributes['itemWithoutLink'])
            ->add('black', '/foo/bar', $attributes['itemWithoutLink'])
            ->render($attributes['wrapper'], $attributes['separator']);

        $expected = '<ol class="wrapper-class"><li class="itemWithoutLink-class"><span class="itemWithoutLink-inner-class">joe</span></li><li class="separator-class"><span class="separator-inner-class"></span></li><li class="itemWithoutLink-class"><a href="/foo/bar" class="itemWithoutLink-inner-class">black</a></li></ol>';
        $this->assertEquals($expected, $result);
    }
}
