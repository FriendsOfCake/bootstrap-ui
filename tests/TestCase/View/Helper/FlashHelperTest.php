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
                    [
                        'key' => 'flash',
                        'message' => 'This is a calling',
                        'element' => 'Flash/default',
                        'params' => []
                    ]
                ],
                'error' => [
                    [
                        'key' => 'error',
                        'message' => 'This is error',
                        'element' => 'Flash/error',
                        'params' => []
                    ]
                ],
                'custom1' => [
                    [
                        'key' => 'custom1',
                        'message' => 'This is custom1',
                        'element' => 'Flash/warning',
                        'params' => []
                    ]
                ],
                'custom2' => [
                    [
                        'key' => 'custom2',
                        'message' => 'This is custom2',
                        'element' => 'Flash/default',
                        'params' => ['class' => 'foobar']
                    ]
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
        $this->assertContains('<div role="alert" class="alert alert-dismissible fade in alert-info">', $result);
        $this->assertContains('<button type="button" class="close" data-dismiss="alert" aria-label="Close">', $result);
        $this->assertContains('<span aria-hidden="true">&times;</span></button>', $result);
        $this->assertContains('This is a calling', $result);

        $result = $this->Flash->render('error');
        $this->assertContains('<div role="alert" class="alert alert-dismissible fade in alert-danger">', $result);
        $this->assertContains('<button type="button" class="close" data-dismiss="alert" aria-label="Close">', $result);
        $this->assertContains('This is error', $result);

        $result = $this->Flash->render('custom1', ['params' => ['class' => ['alert']]]);
        $this->assertContains('<div role="alert" class="alert alert-warning">', $result);
        $this->assertNotContains('<span aria-hidden="true">&times;</span></button>', $result);
        $this->assertContains('This is custom1', $result);

        $result = $this->Flash->render('custom2');
        $this->assertContains('<div role="alert" class="foobar">', $result);
        $this->assertContains('This is custom2', $result);
    }
}
