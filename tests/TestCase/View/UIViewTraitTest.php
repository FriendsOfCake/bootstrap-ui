<?php

namespace BootstrapUI\View;

use Cake\TestSuite\TestCase;

class UIViewTraitTest extends TestCase
{
    use UIViewTrait;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->View = new UIView();
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
        $this->View->layout = 'default';
        $this->View->initializeUI();
        $this->assertEquals('BootstrapUI.default', $this->View->layout);

        $this->View->layout = 'default';
        $this->View->initializeUI([
            'layout' => true
        ]);
        $this->assertEquals('BootstrapUI.default', $this->View->layout);

        $this->View->layout = 'default';
        $this->View->initializeUI([
            'layout' => 'myLayout'
        ]);
        $this->assertEquals('myLayout', $this->View->layout);

        $this->View->layout = 'other_layout';
        $this->View->initializeUI([
            'layout' => false
        ]);
        $this->assertEquals('other_layout', $this->View->layout);

        $this->View->layout = 'default';
        $this->View->initializeUI([
            'layout' => ''
        ]);
        $this->assertEquals('', $this->View->layout);
    }
}
