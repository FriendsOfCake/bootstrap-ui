<?php
/**
 * Created by PhpStorm.
 * User: ngirardet
 * Date: 30.05.2017
 * Time: 12:34
 */

namespace BootstrapUI\Test\TestCase\View\Helper;

use BootstrapUI\View\Helper\BreadcrumbsHelper;
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
        $this->Breadcrumbs = new BreadcrumbsHelper($this->View);
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->Breadcrumbs, $this->View);
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
