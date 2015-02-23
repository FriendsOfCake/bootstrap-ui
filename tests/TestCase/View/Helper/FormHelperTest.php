<?php

namespace BootstrapUI\Test\TestCase\View\Helper;

use BootstrapUI\View\Helper\FormHelper;
use Cake\Core\Configure;
use Cake\Network\Request;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\TestSuite\TestCase;
use Cake\Utility\Security;
use Cake\View\View;

class FormHelperTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        Configure::write('Config.language', 'eng');
        Configure::write('App.base', '');
        Configure::write('App.namespace', 'BootstrapUI\Test\TestCase\View\Helper');
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
            'label' => ['class' => 'control-label', 'for' => 'title'],
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

    public function testNoLabelTextInput()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article);

        $result = $this->Form->input('title', ['label' => false]);
        $expected = [
            'div' => ['class' => 'form-group'],
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

    public function testLabelledTextInput()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article);

        $result = $this->Form->input('title', ['label' => 'Custom Title']);
        $expected = [
            'div' => ['class' => 'form-group'],
            'label' => ['class' => 'control-label', 'for' => 'title'],
            'Custom Title',
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

    public function testArrayLabelledTextInput()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article);

        $result = $this->Form->input('title', ['label' => ['foo' => 'bar', 'text' => 'Custom Title']]);
        $expected = [
            'div' => ['class' => 'form-group'],
            'label' => ['class' => 'control-label', 'for' => 'title', 'foo' => 'bar'],
            'Custom Title',
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
            'label' => ['class' => 'control-label', 'for' => 'password'],
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
            'label' => ['class' => 'control-label', 'for' => 'title'],
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
            'label' => ['class' => 'control-label', 'for' => 'title'],
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

    public function testAddonPrependedInput()
    {
        $this->Form->create($this->article);

        $result = $this->Form->input('title', ['prepend' => '@']);
        $expected = [
            'div' => ['class' => 'form-group'],
            'label' => ['class' => 'control-label', 'for' => 'title'],
            'Title',
            '/label',
            ['div' => ['class' => 'input-group']],
            'span' => ['class' => 'input-group-addon'],
            '@',
            '/span',
            'input' => [
                'type' => 'text',
                'name' => 'title',
                'id' => 'title',
                'class' => 'form-control',
                'required' => 'required'
            ],
            '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testAddonAppendedInput()
    {
        $this->Form->create($this->article);

        $result = $this->Form->input('title', ['append' => '@']);
        $expected = [
            'div' => ['class' => 'form-group'],
            'label' => ['class' => 'control-label', 'for' => 'title'],
            'Title',
            '/label',
            ['div' => ['class' => 'input-group']],
            'input' => [
                'type' => 'text',
                'name' => 'title',
                'id' => 'title',
                'class' => 'form-control',
                'required' => 'required'
            ],
            'span' => ['class' => 'input-group-addon'],
            '@',
            '/span',
            '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testButtonPrependedInput()
    {
        $this->Form->create($this->article);

        $result = $this->Form->input('title', ['prepend' => $this->Form->button('GO')]);
        $expected = [
            'div' => ['class' => 'form-group'],
            'label' => ['class' => 'control-label', 'for' => 'title'],
            'Title',
            '/label',
            ['div' => ['class' => 'input-group']],
            'span' => ['class' => 'input-group-btn'],
            'button' => ['type' => 'submit', 'class' => 'btn'],
            'GO',
            '/button',
            '/span',
            'input' => [
                'type' => 'text',
                'name' => 'title',
                'id' => 'title',
                'class' => 'form-control',
                'required' => 'required'
            ],
            '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testButtonAppendedInput()
    {
        $this->Form->create($this->article);

        $result = $this->Form->input('title', ['append' => $this->Form->button('GO')]);
        $expected = [
            'div' => ['class' => 'form-group'],
            'label' => ['class' => 'control-label', 'for' => 'title'],
            'Title',
            '/label',
            ['div' => ['class' => 'input-group']],
            'input' => [
                'type' => 'text',
                'name' => 'title',
                'id' => 'title',
                'class' => 'form-control',
                'required' => 'required'
            ],
            'span' => ['class' => 'input-group-btn'],
            'button' => ['type' => 'submit', 'class' => 'btn'],
            'GO',
            '/button',
            '/span',
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

    public function testInlineCheckboxInput()
    {
        $this->Form->create($this->article);

        $result = $this->Form->input('published', ['inline' => true]);
        $expected = [
            'input' => [
                'type' => 'hidden',
                'name' => 'published',
                'value' => 0,
            ],
            'label' => ['class' => 'checkbox-inline', 'for' => 'published'],
            ['input' => [
                'type' => 'checkbox',
                'name' => 'published',
                'id' => 'published',
                'value' => 1,
                'class' => 'form-control',
            ]],
            'Published',
            '/label'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testBasicFormCreate()
    {
        $result = $this->Form->create($this->article);
        $expected = [
            'form' => [
                'method' => 'post',
                'accept-charset' => 'utf-8',
                'role' => 'form',
                'action' => '/articles/add',
            ],
            'div' => ['style' => 'display:none;'],
            'input' => [
                'type' => 'hidden',
                'name' => '_method',
                'value' => 'POST'
            ],
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineFormCreate()
    {
        $result = $this->Form->create($this->article, ['class' => 'form-inline']);
        $expected = [
            'form' => [
                'method' => 'post',
                'accept-charset' => 'utf-8',
                'role' => 'form',
                'action' => '/articles/add',
                'class' => 'form-inline',
            ],
            'div' => ['style' => 'display:none;'],
            'input' => [
                'type' => 'hidden',
                'name' => '_method',
                'value' => 'POST'
            ],
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalFormCreate()
    {
        $result = $this->Form->create($this->article, ['horizontal' => true]);
        $expected = [
            'form' => [
                'method' => 'post',
                'accept-charset' => 'utf-8',
                'role' => 'form',
                'action' => '/articles/add',
                'class' => 'form-horizontal',
            ],
            'div' => ['style' => 'display:none;'],
            'input' => [
                'type' => 'hidden',
                'name' => '_method',
                'value' => 'POST'
            ],
            '/div'
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Form->input('title');
        $expected = [
            'div' => ['class' => 'form-group'],
            'label' => [
                'class' => 'control-label col-md-2',
                'for' => 'title'
            ],
            'Title',
            '/label',
            ['div' => ['class' => 'col-md-10']],
            'input' => [
                'type' => 'text',
                'name' => 'title',
                'id' => 'title',
                'class' => 'form-control',
                'required' => 'required',
            ],
            '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Form->input('published');
        $expected = [
            'div' => ['class' => 'form-group'],
            ['div' => ['class' => 'col-md-offset-2 col-md-10']],
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
            '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testBasicButton()
    {
        $result = $this->Form->button('Submit');
        $expected = [
            'button' => ['class' => 'btn', 'type' => 'submit'],
            'Submit',
            '/button'
        ];
        $this->assertHtml($expected, $result);
    }
}
