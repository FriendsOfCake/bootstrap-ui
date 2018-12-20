<?php

namespace BootstrapUI\Test\TestCase\View\Helper;

use BootstrapUI\TestSuite\TestCase;
use BootstrapUI\View\Helper\FlashHelper;
use Cake\Core\Plugin;
use Cake\Http\ServerRequest;
use Cake\Network\Session;
use Cake\View\View;

/**
 * FlashHelperTest class
 *
 */
class FlashHelperTest extends TestCase
{
    /**
     * @var View
     */
    public $View;

    /**
     * @var FlashHelper
     */
    public $Flash;

    /**
     * @var Session
     */
    public $session;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->deprecated(function () {
            Plugin::load('BootstrapUI', ['path' => ROOT . DS]);
            $this->session = new Session();
        });

        $this->View = new View(new ServerRequest(['session' => $this->session]));
        $this->Flash = new FlashHelper($this->View, []);

        $this->session->write([
            'Flash' => [
                'flash' => [
                    'key' => 'flash',
                    'message' => 'This is a calling',
                    'element' => 'Flash/default',
                    'params' => []
                ],
                'error' => [
                    'key' => 'error',
                    'message' => 'This is error',
                    'element' => 'Flash/error',
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
                'custom3' => [
                    'key' => 'custom3',
                    'message' => 'This is <a href="#">custom3</a>',
                    'element' => 'Flash/default',
                    'params' => ['escape' => false]
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

        $result = $this->Flash->render('custom3');
        $this->assertContains('This is <a href="#">custom3</a>', $result);
    }

    /**
     * In CakePHP 3.1 you multple message per key
     *
     * @return void
     */
    public function testRenderForMultipleMessages()
    {
        $this->session->write([
            'Flash' => [
                'flash' => [
                    [
                        'key' => 'flash',
                        'message' => 'This is a calling',
                        'element' => 'Flash/default',
                        'params' => []
                    ],
                    [
                        'key' => 'flash',
                        'message' => 'This is a second message',
                        'element' => 'Flash/default',
                        'params' => ['class' => ['extra']]
                    ],
                ],
                'error' => [
                    [
                        'key' => 'error',
                        'message' => 'This is error',
                        'element' => 'Flash/error',
                        'params' => []
                    ]
                ]
            ]
        ]);

        $result = $this->Flash->render();
        $this->assertContains('<div role="alert" class="alert alert-dismissible fade in alert-info">', $result);
        $this->assertContains('<button type="button" class="close" data-dismiss="alert" aria-label="Close">', $result);
        $this->assertContains('<span aria-hidden="true">&times;</span></button>', $result);
        $this->assertContains('This is a calling', $result);

        $this->assertContains('<div role="alert" class="extra alert-info">', $result);
        $this->assertContains('This is a second message', $result);

        $result = $this->Flash->render('error');
        $this->assertContains('<div role="alert" class="alert alert-dismissible fade in alert-danger">', $result);
        $this->assertContains('<button type="button" class="close" data-dismiss="alert" aria-label="Close">', $result);
        $this->assertContains('This is error', $result);
    }
}
