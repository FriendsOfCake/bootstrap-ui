<?php

namespace BootstrapUI\View;

use Cake\TestSuite\TestCase;

class UIViewTest extends TestCase
{
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

        $this->View = new UIView();
        $this->View->setLayout('default');
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
     * tearDown method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->View->initialize();
        $this->assertEquals('BootstrapUI.default', $this->View->getLayout());
    }

    /**
     * testHelperConfig
     *
     * @return void
     */
    public function testHelperConfig()
    {
        $View = new UIView(null, null, null, [
            'helpers' => [
                'Form' => [
                    'className' => 'BootstrapUI.Form',
                    'foo' => 'bar',
                ],
            ],
        ]);

        $this->assertEquals('bar', $View->Form->getConfig('foo'));
    }
}
