<?php

namespace BootstrapUI\View;

use Cake\Core\Configure;
use Cake\TestSuite\TestCase;

class UIViewTraitTest extends TestCase
{
    use UIViewTrait;

    /**
     * @var UIView
     */
    public $View;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        Configure::write('App.namespace', 'TestApp');
        $this->View = new UIView();
        $this->View->layout = 'default';
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();
        unset($this->View);
    }

    /**
     * testInitializeUI method
     *
     * @return void
     */
    public function testInitializeUI()
    {
        $this->View->initializeUI();
        $this->assertEquals('BootstrapUI.default', $this->View->layout);

        $this->View->initializeUI([
            'layout' => true
        ]);
        $this->assertEquals('BootstrapUI.default', $this->View->layout);

        $this->View->initializeUI([
            'layout' => 'myLayout'
        ]);
        $this->assertEquals('myLayout', $this->View->layout);

        $this->View->layout = 'other_layout';
        $this->View->initializeUI([
            'layout' => false
        ]);
        $this->assertEquals('other_layout', $this->View->layout);

        $this->View->initializeUI([
            'layout' => ''
        ]);
        $this->assertSame('', $this->View->layout);
    }

    public function testCellRendering()
    {
        $cell = $this->View->cell('Articles');

        $this->assertEquals('display', $cell->template);
        // 2016-03-28: used trim() to remove LF. assert was failing on Windows.
        $this->assertEquals("articles cell display", trim($cell));
    }
}
