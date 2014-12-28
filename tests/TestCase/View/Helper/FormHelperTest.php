<?php

namespace Gourmet\TwitterBootstrap\Test\TestCase\View\Helper;

use Cake\Core\Configure;
use Cake\Network\Request;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\TestSuite\TestCase;
use Cake\Utility\Security;
use Cake\View\View;
use Gourmet\TwitterBootstrap\View\Helper\FormHelper;

class FormHelperTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        Configure::write('Config.language', 'eng');
        Configure::write('App.base', '');
        Configure::write('App.namespace', 'Gourmet\TwitterBootstrap\Test\TestCase\View\Helper');
        Configure::delete('Asset');
        $this->View = new View();

        $this->Form = new FormHelper($this->View);
        $request = new Request('articles/add');
        $request->here = '/articles/add';
        $request['controller'] = 'articles';
        $request['action'] = 'add';
        $request->webroot = '';
        $request->base = '';
        $this->Form->Url->request = $this->Form->request = $request;

        $this->article = [
            'schema' => [
                'id' => ['type' => 'integer'],
                'author_id' => ['type' => 'integer', 'null' => true],
                'title' => ['type' => 'string', 'null' => true],
                'body' => 'text',
                'published' => ['type' => 'boolean', 'length' => 1, 'default' => 0],
                '_constraints' => ['primary' => ['type' => 'primary', 'columns' => ['id']]]
            ],
            'required' => [
                'author_id' => true,
                'title' => true,
            ]
        ];

        Security::salt('foo!');
        Router::connect('/:controller', array('action' => 'index'));
        Router::connect('/:controller/:action/*');
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->Form, $this->View);
        TableRegistry::clear();
    }

    public function testBasicTextInput()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article);

        $result = $this->Form->input('title');
        $expected = [
            'div' => ['class' => 'form-group'],
            'label' => ['for' => 'title'],
            'Title',
            '/label',
            'input' => [
                'type' => 'text',
                'name' => 'title',
                'id' => 'title',
                'class' => 'form-control',
            ],
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testBasicPasswordInput()
    {
        $this->article['schema']['password'] = ['type' => 'string'];
        $this->Form->create($this->article);

        $result = $this->Form->input('password');
        $expected = [
            'div' => ['class' => 'form-group'],
            'label' => ['for' => 'password'],
            'Password',
            '/label',
            'input' => [
                'type' => 'password',
                'name' => 'password',
                'id' => 'password',
                'class' => 'form-control',
            ],
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testRequiredTextInput()
    {
        $this->Form->create($this->article);

        $result = $this->Form->input('title');
        $expected = [
            'div' => ['class' => 'form-group'],
            'label' => ['for' => 'title'],
            'Title',
            '/label',
            'input' => [
                'type' => 'text',
                'name' => 'title',
                'id' => 'title',
                'class' => 'form-control',
                'required' => 'required'
            ],
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testErroredTextInput()
    {
        $this->article['errors'] = [
            'title' => ['error message']
        ];
        $this->Form->create($this->article);

        $result = $this->Form->input('title');
        $expected = [
            'div' => ['class' => 'form-group has-error'],
            'label' => ['for' => 'title'],
            'Title',
            '/label',
            'input' => [
                'type' => 'text',
                'name' => 'title',
                'id' => 'title',
                'class' => 'form-control ',
                'required' => 'required'
            ],
            ['div' => ['class' => 'text-danger']],
            'error message',
            '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testBasicCheckboxInput()
    {
        $this->Form->create($this->article);

        $result = $this->Form->input('published');
        $expected = [
            'div' => ['class' => 'form-group'],
            'input' => [
                'type' => 'hidden',
                'name' => 'published',
                'value' => 0,
            ],
            'label' => ['for' => 'published'],
            ['input' => [
                'type' => 'checkbox',
                'name' => 'published',
                'id' => 'published',
                'value' => 1,
                'class' => 'form-control',
            ]],
            'Published',
            '/label',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }
}
