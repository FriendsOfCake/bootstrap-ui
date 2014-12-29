<?php

namespace Gourmet\TwitterBootstrap\Test\TestCase\Controller\Component;

use Cake\Controller\ComponentRegistry;
use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Network\Request;
use Cake\Network\Session;
use Cake\TestSuite\TestCase;
use Gourmet\TwitterBootstrap\Controller\Component\FlashComponent;

class FlashComponentTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        Configure::write('App.namespace', 'TestApp');
        $this->Controller = new Controller(new Request(['session' => new Session()]));
        $this->ComponentRegistry = new ComponentRegistry($this->Controller);
        $this->Flash = new FlashComponent($this->ComponentRegistry);
        $this->Session = new Session();
    }

    public function tearDown()
    {
        parent::tearDown();
        $this->Session->destroy();
    }

    public function testError()
    {
        $this->assertNull($this->Session->read('Flash'));

        $this->Flash->error('This is a test message');
        $result = $this->Session->read('Flash.flash');
        $expected = [
            'message' => 'This is a test message',
            'key' => 'flash',
            'element' => 'Gourmet/TwitterBootstrap.Flash/danger',
            'params' => []
        ];
        $this->assertEquals($expected, $result);
    }

    public function testSuccess()
    {
        $this->assertNull($this->Session->read('Flash'));

        $this->Flash->success('This is a test message');
        $result = $this->Session->read('Flash.flash');
        $expected = [
            'message' => 'This is a test message',
            'key' => 'flash',
            'element' => 'Gourmet/TwitterBootstrap.Flash/success',
            'params' => []
        ];
        $this->assertEquals($expected, $result);
    }
}
