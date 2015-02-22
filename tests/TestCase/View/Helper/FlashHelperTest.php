<?php

namespace BootstrapUI\Test\TestCase\View\Helper;

use BootstrapUI\View\Helper\FlashHelper;
use Cake\Controller\Controller;
use Cake\Network\Request;
use Cake\Network\Session;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * FlashHelperTest class
 *
 */
class FlashHelperTest extends TestCase
{

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->View = new View();
        $session = new Session();
        $this->View->request = new Request(['session' => $session]);
        $this->Flash = new FlashHelper($this->View);

        $session->write([
            'Flash' => [
                'flash' => [
                    'key' => 'flash',
                    'message' => 'This is a calling',
                    'element' => 'Flash/default',
                    'params' => []
                ],
                'custom1' => [
                    'key' => 'custom1',
                    'message' => 'This is custom1',
                    'element' => 'Flash/warning',
                    'params' => []
                ],
                'custom2' => [
                    'key' => 'custom2',
                    'message' => 'This is custom2',
                    'element' => 'Flash/default',
                    'params' => ['class' => 'foobar']
                ],
            ]
        ]);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();
        unset($this->View, $this->Flash);
    }

    /**
     * testFlash method
     *
     * @return void
     */
    public function testRender()
    {
        $result = $this->Flash->render();
        $this->assertContains('<div class="alert alert-info">', $result);
        $this->assertContains('This is a calling', $result);

        $result = $this->Flash->render('custom1');
        $this->assertContains('<div class="alert alert-warning">', $result);
        $this->assertContains('This is custom1', $result);

        $result = $this->Flash->render('custom2');
        $this->assertContains('<div class="alert foobar">', $result);
        $this->assertContains('This is custom2', $result);
    }
}
