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

        $expected = '<nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item" aria-current="page"><span>jadb</span></li><li class="breadcrumb-item" aria-current="page"><span>admad</span></li><li class="breadcrumb-item" aria-current="page"><span>joe</span></li></ol></nav>';
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

        $expected = '<nav aria-label="breadcrumb"><ol class="wrapper-class breadcrumb"><li class="itemWithoutLink-class breadcrumb-item" aria-current="page"><span class="itemWithoutLink-inner-class">joe</span></li><li class="itemWithoutLink-class breadcrumb-item"><a href="/foo/bar" class="itemWithoutLink-inner-class">black</a></li></ol></nav>';
        $this->assertEquals($expected, $result);
    }
}
