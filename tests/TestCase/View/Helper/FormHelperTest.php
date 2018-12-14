<?php

namespace BootstrapUI\Test\TestCase\View\Helper;

use BootstrapUI\View\Helper\FormHelper;
use Cake\Core\Configure;
use Cake\Http\ServerRequest;
use Cake\I18n\I18n;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\TestSuite\TestCase;
use Cake\Utility\Security;
use Cake\View\View;
use InvalidArgumentException;

class FormHelperTest extends TestCase
{
    /**
     * @var View
     */
    public $View;

    /**
     * @var FormHelper
     */
    public $Form;

    /**
     * @var array
     */
    public $article;

    /**
     * @var array
     */
    public $dateRegex = [
        'daysRegex' => 'preg:/(?:<option value="0?([\d]+)">\\1<\/option>[\r\n]*)*/',
        'monthsRegex' => 'preg:/(?:<option value="[\d]+">[\w]+<\/option>[\r\n]*)*/',
        'yearsRegex' => 'preg:/(?:<option value="([\d]+)">\\1<\/option>[\r\n]*)*/',
        'hoursRegex' => 'preg:/(?:<option value="0?([\d]+)">\\1<\/option>[\r\n]*)*/',
        'minutesRegex' => 'preg:/(?:<option value="([\d]+)">0?\\1<\/option>[\r\n]*)*/',
        'secondsRegex' => 'preg:/(?:<option value="([\d]+)">0?\\1<\/option>[\r\n]*)*/',
        'meridianRegex' => 'preg:/(?:<option value="(am|pm)">\\1<\/option>[\r\n]*)*/',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        Configure::write('Config.language', 'eng');
        Configure::write('App.base', '');
        Configure::write('App.namespace', 'BootstrapUI\Test\TestCase\View\Helper');
        Configure::delete('Asset');

        $request = new ServerRequest('articles/add');
        $request = $request
                ->withRequestTarget('/articles/add')
                ->withParam('controller', 'articles')
                ->withParam('action', 'add')
                ->withAttribute('webroot', '')
                ->withAttribute('base', '');
        $this->View = new View($request);
        $this->Form = new FormHelper($this->View);

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

        Security::setSalt('foo!');
        Router::connect('/:controller', ['action' => 'index']);
        Router::connect('/:controller/:action/*');

        $this->locale = I18n::getLocale();
        I18n::setLocale('eng');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();
        unset($this->Form, $this->View);
        TableRegistry::clear();
        I18n::setLocale($this->locale);
    }

    /**
     * testBasicControl method
     *
     * @return void
     */
    public function testBasicTextControl()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article);

        $result = $this->Form->control('title');
        $expected = [
            'div' => ['class' => 'form-group text'],
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

    /**
     * testFileControl method
     *
     * @return void
     */
    public function testFileControl()
    {
        $this->Form->create();

        $result = $this->Form->control('file', ['type' => 'file']);
        $expected = [
            'div' => ['class' => 'form-group file'],
            'label' => ['for' => 'file'],
            'File',
            '/label',
            'input' => [
                'type' => 'file',
                'name' => 'file',
                'id' => 'file',
                'class' => 'form-control-file',
            ],
            '/div'
        ];

        $this->assertHtml($expected, $result);
    }

    /**
     * testSelectControl method
     *
     * @return void
     */
    public function testSelectControl()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('foreign_key', [
            'type' => 'select',
            'class' => 'my-class'
        ]);
        $expected = [
            'div' => ['class' => 'form-group select'],
            'label' => ['for' => 'foreign-key'],
            'Foreign Key',
            '/label',
            'select' => [
                'name' => 'foreign_key',
                'id' => 'foreign-key',
                'class' => 'my-class form-control',
            ],
            '/select',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * testStaticControl method
     *
     * @return void
     */
    public function testStaticControl()
    {
        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'foo <u>bar</u>';
        $this->Form->create($this->article);

        $result = $this->Form->control('title', ['type' => 'staticControl']);
        $expected = [
            'div' => ['class' => 'form-group staticControl'],
            'label' => ['for' => 'title'],
            'Title',
            '/label',
            'p' => ['class' => 'form-control-plaintext'],
            'foo &lt;u&gt;bar&lt;/u&gt;',
            '/p',
            'input' => [
                'type' => 'hidden',
                'name' => 'title',
                'id' => 'title',
                'value' => 'foo &lt;u&gt;bar&lt;/u&gt;',
            ],
            '/div'
        ];
        $this->assertHtml($expected, $result);
        $this->assertSame(['title' => 'foo <u>bar</u>'], $this->Form->fields);

        $this->Form->fields = [];

        $result = $this->Form->control('title', ['type' => 'staticControl', 'hiddenField' => false, 'escape' => false]);
        $expected = [
            'div' => ['class' => 'form-group staticControl'],
            'label' => ['for' => 'title'],
            'Title',
            '/label',
            'p' => ['class' => 'form-control-plaintext'],
            'foo',
            'u' => [],
            'bar',
            '/u',
            '/p',
            '/div'
        ];
        $this->assertHtml($expected, $result);
        $this->assertEmpty($this->Form->fields);
    }

    /**
     * testNoLabelTextControl method
     *
     * @return void
     */
    public function testNoLabelTextControl()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article);

        $result = $this->Form->control('title', ['label' => false]);
        $expected = [
            'div' => ['class' => 'form-group text'],
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

    /**
     * testLabelledTextControl method
     *
     * @return void
     */
    public function testLabelledTextControl()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article);

        $result = $this->Form->control('title', ['label' => 'Custom Title']);
        $expected = [
            'div' => ['class' => 'form-group text'],
            'label' => ['for' => 'title'],
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

    /**
     * testArrayLabelledTextControl method
     *
     * @return void
     */
    public function testArrayLabelledTextControl()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article);

        $result = $this->Form->control('title', ['label' => ['foo' => 'bar', 'text' => 'Custom Title']]);
        $expected = [
            'div' => ['class' => 'form-group text'],
            'label' => ['for' => 'title', 'foo' => 'bar'],
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

    /**
     * testBasicPasswordControl method
     *
     * @return void
     */
    public function testBasicPasswordControl()
    {
        $this->article['schema']['password'] = ['type' => 'string'];
        $this->Form->create($this->article);

        $result = $this->Form->control('password');
        $expected = [
            'div' => ['class' => 'form-group password'],
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

    /**
     * testRequiredTextControl method
     *
     * @return void
     */
    public function testRequiredTextControl()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('title');
        $expected = [
            'div' => ['class' => 'form-group text required'],
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

    /**
     * testErroredControl method
     *
     * @return void
     */
    public function testErroredControl()
    {
        $this->article['errors'] = [
            'title' => ['error message'],
            'published' => ['error message'],
            'foreign_key' => ['error msg'],
            'file' => ['upload error'],
        ];
        $this->Form->create($this->article);

        $result = $this->Form->control('title');
        $expected = [
            'div' => ['class' => 'form-group text required is-invalid'],
            'label' => ['for' => 'title'],
            'Title',
            '/label',
            'input' => [
                'type' => 'text',
                'name' => 'title',
                'id' => 'title',
                'class' => 'is-invalid form-control',
                'required' => 'required'
            ],
            ['div' => ['class' => 'invalid-feedback']],
            'error message',
            '/div',
            '/div'
        ];

        $this->assertHtml($expected, $result);

        $result = $this->Form->control('published');
        $expected = [
            ['div' => ['class' => 'form-group form-check checkbox is-invalid']],
            ['input' => ['type' => 'hidden', 'name' => 'published', 'class' => 'is-invalid', 'value' => '0']],
            ['input' => ['type' => 'checkbox', 'name' => 'published', 'value' => '1', 'id' => 'published', 'class' => 'form-check-input is-invalid']],
            ['label' => ['class' => 'form-check-label', 'for' => 'published']],
            'Published',
            '/label',
            ['div' => ['class' => 'invalid-feedback']], 'error message', '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Form->control('foreign_key', [
            'type' => 'select',
        ]);
        $expected = [
            'div' => ['class' => 'form-group select is-invalid'],
            'label' => ['for' => 'foreign-key'],
            'Foreign Key',
            '/label',
            'select' => [
                'name' => 'foreign_key',
                'id' => 'foreign-key',
                'class' => 'is-invalid form-control',
            ],
            '/select',
            ['div' => ['class' => 'invalid-feedback']],
            'error msg',
            '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Form->control('file', ['type' => 'file']);
        $expected = [
            'div' => ['class' => 'form-group file is-invalid'],
            'label' => ['for' => 'file'],
            'File',
            '/label',
            'input' => [
                'type' => 'file',
                'name' => 'file',
                'id' => 'file',
                'class' => 'is-invalid form-control-file',
            ],
            ['div' => ['class' => 'invalid-feedback']],
            'upload error',
            '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);

        $this->Form->create($this->article, ['align' => 'horizontal']);

        $result = $this->Form->control('title');
        $expected = [
            'div' => ['class' => 'form-group row text required is-invalid'],
            'label' => ['class' => 'col-form-label col-md-2', 'for' => 'title'],
            'Title',
            '/label',
            ['div' => ['class' => 'col-md-10']],
            'input' => [
                'type' => 'text',
                'name' => 'title',
                'id' => 'title',
                'class' => 'is-invalid form-control',
                'required' => 'required'
            ],
            ['div' => ['class' => 'invalid-feedback']],
            'error message',
            '/div',
            '/div',
            '/div'
        ];

        $this->assertHtml($expected, $result);

        $result = $this->Form->control('published');
        $expected = [
            ['div' => ['class' => 'form-group row checkbox is-invalid']],
            ['div' => ['class' => 'offset-md-2 col-md-10']],
            ['div' => ['class' => 'form-check']],
            ['input' => ['type' => 'hidden', 'name' => 'published', 'class' => 'is-invalid', 'value' => '0']],
            ['input' => ['type' => 'checkbox', 'name' => 'published', 'value' => '1', 'id' => 'published', 'class' => 'form-check-input is-invalid']],
            ['label' => ['class' => 'form-check-label', 'for' => 'published']],
            'Published',
            '/label',
            '/div',
            ['div' => ['class' => 'invalid-feedback']], 'error message', '/div',
            '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * testAddOnPrependedControl method
     *
     * @return void
     */
    public function testAddOnPrependedConrol()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('title', ['prepend' => '@']);
        $expected = [
            'div' => ['class' => 'form-group text required'],
            'label' => ['for' => 'title'],
            'Title',
            '/label',
            ['div' => ['class' => 'input-group']],
            ['div' => ['class' => 'input-group-prepend']],
            'span' => ['class' => 'input-group-text'],
            '@',
            '/span',
            '/div',
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

        $result = $this->Form->control('url', ['prepend' => 'http://']);
        $expected = [
            'div' => ['class' => 'form-group text'],
            'label' => ['for' => 'url'],
            'Url',
            '/label',
            ['div' => ['class' => 'input-group']],
            ['div' => ['class' => 'input-group-prepend']],
            'span' => ['class' => 'input-group-text'],
            'http://',
            '/span',
            '/div',
            'input' => [
                'type' => 'text',
                'name' => 'url',
                'id' => 'url',
                'class' => 'form-control'
            ],
            '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * testAddOnAppendedControl method
     *
     * @return void
     */
    public function testAddOnAppendedControl()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('title', ['append' => '@']);
        $expected = [
            'div' => ['class' => 'form-group text required'],
            'label' => ['for' => 'title'],
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
            ['div' => ['class' => 'input-group-append']],
            'span' => ['class' => 'input-group-text'],
            '@',
            '/span',
            '/div',
            '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Form->control('title', ['append' => ['@', ['size' => 'lg']]]);
        $expected = [
            'div' => ['class' => 'form-group text required'],
            'label' => ['for' => 'title'],
            'Title',
            '/label',
            ['div' => ['class' => 'input-group input-group-lg']],
            'input' => [
                'type' => 'text',
                'name' => 'title',
                'id' => 'title',
                'class' => 'form-control',
                'required' => 'required'
            ],
            ['div' => ['class' => 'input-group-append']],
            'span' => ['class' => 'input-group-text'],
            '@',
            '/span',
            '/div',
            '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * testAddOnAppendedSelect method
     *
     * @return void
     */
    public function testAddOnAppendedSelect()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('author_id', ['append' => '@']);
        $expected = [
            'div' => ['class' => 'form-group select required'],
            'label' => ['for' => 'author-id'],
            'Author',
            '/label',
            ['div' => ['class' => 'input-group']],
            'select' => [
                'name' => 'author_id',
                'id' => 'author-id',
                'required' => 'required',
                'class' => 'form-control'
            ],
            '/select',
            ['div' => ['class' => 'input-group-append']],
            'span' => ['class' => 'input-group-text'],
            '@',
            '/span',
            '/div',
            '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * testAddOnAppendedTextarea method
     *
     * @return void
     */
    public function testAddOnAppendedTextarea()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('body', [
            'type' => 'textarea',
            'append' => $this->Form->button('GO')
        ]);
        $expected = [
            'div' => ['class' => 'form-group textarea'],
            'label' => ['for' => 'body'],
            'Body',
            '/label',
            ['div' => ['class' => 'input-group']],
            'textarea' => [
                'name' => 'body',
                'id' => 'body',
                'class' => 'form-control',
                'rows' => '5'
            ],
            '/textarea',
            ['div' => ['class' => 'input-group-append']],
            'button' => ['type' => 'submit', 'class' => 'btn btn-secondary'],
            'GO',
            '/button',
            '/div',
            '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * testButtonPrependedControl method
     *
     * @return void
     */
    public function testButtonPrependedControl()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('title', ['prepend' => $this->Form->button('GO')]);
        $expected = [
            'div' => ['class' => 'form-group text required'],
            'label' => ['for' => 'title'],
            'Title',
            '/label',
            ['div' => ['class' => 'input-group']],
            ['div' => ['class' => 'input-group-prepend']],
            'button' => ['type' => 'submit', 'class' => 'btn btn-secondary'],
            'GO',
            '/button',
            '/div',
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

    /**
     * testButtonAppendedControl method
     *
     * @return void
     */
    public function testButtonAppendedControl()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('title', ['append' => $this->Form->button('GO')]);
        $expected = [
            'div' => ['class' => 'form-group text required'],
            'label' => ['for' => 'title'],
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
            ['div' => ['class' => 'input-group-append']],
            'button' => ['type' => 'submit', 'class' => 'btn btn-secondary'],
            'GO',
            '/button',
            '/div',
            '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * testRadio method
     *
     * @return void
     */
    public function testRadio()
    {
        $this->Form->create($this->article);

        $result = $this->Form->radio('published', ['Yes', 'No']);
        $expected = [
            ['input' => [
                'type' => 'hidden',
                'name' => 'published',
                'value' => '',
            ]],
            ['div' => ['class' => 'form-check']],
            ['input' => [
                'type' => 'radio',
                'name' => 'published',
                'value' => 0,
                'id' => 'published-0',
                'class' => 'form-check-input'
            ]],
            ['label' => ['for' => 'published-0', 'class' => 'form-check-label']],
            'Yes',
            '/label',
            '/div',
            ['div' => ['class' => 'form-check']],
            ['input' => [
                'type' => 'radio',
                'name' => 'published',
                'value' => 1,
                'id' => 'published-1',
                'class' => 'form-check-input'
            ]],
            ['label' => ['for' => 'published-1', 'class' => 'form-check-label']],
            'No',
            '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * testInlineRadioControl method
     *
     * @return void
     */
    public function testInlineRadioControl()
    {
        $this->markTestSkipped('Inline forms are broken right now');

        $this->Form->create($this->article);

        $result = $this->Form->control('published', [
            'inline' => true,
            'type' => 'radio',
            'options' => ['Yes', 'No']
        ]);
        $expected = [
            ['div' => ['class' => 'form-group radio']],
            ['label' => true],
            'Published',
            '/label',
            ['div' => ['class' => 'form-check form-check-inline']],
            ['input' => [
                'type' => 'hidden',
                'name' => 'published',
                'value' => ''
            ]],
            ['label' => [
                'class' => 'radio-inline',
                'for' => 'published-0'
            ]],
            ['input' => [
                'type' => 'radio',
                'name' => 'published',
                'value' => 0,
                'id' => 'published-0'
            ]],
            'Yes',
            '/label',
            ['label' => [
                'class' => 'radio-inline',
                'for' => 'published-1'
            ]],
            ['input' => [
                'type' => 'radio',
                'name' => 'published',
                'value' => 1,
                'id' => 'published-1'
            ]],
            'No',
            '/label',
            '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * testBasicCheckboxControl method
     *
     * @return void
     */
    public function testBasicCheckboxControl()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('published');
        $expected = [
            'div' => ['class' => 'form-group form-check checkbox'],
            'input' => [
                'type' => 'hidden',
                'name' => 'published',
                'value' => 0,
            ],
            ['input' => [
                'type' => 'checkbox',
                'name' => 'published',
                'id' => 'published',
                'value' => 1,
                'class' => 'form-check-input'
            ]],
            'label' => ['for' => 'published', 'class' => 'form-check-label'],
            'Published',
            '/label',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * testBasicFormCreate method
     *
     * @return void
     */
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

        $result = $this->Form->create($this->article, ['align' => 'horizontal']);
    }

    /**
     * testBasicFormEnd method
     *
     * @return void
     */
    public function testBasicFormEnd()
    {
        $this->Form->create($this->article);
        $this->assertHtml('/form', $this->Form->end());
    }

    /**
     * testFormCreateWithTemplatesFile method
     *
     * @return void
     */
    public function testFormCreateWithTemplatesFile()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article, ['templates' => 'custom_templates']);

        $result = $this->Form->control('title');
        $expected = [
            'div' => ['class' => 'custom-container form-group'],
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

    /**
     * testInlineFormCreate method
     *
     * @return void
     */
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

    /**
     * testHorizontalFormCreate method
     *
     * @return void
     */
    public function testHorizontalFormCreate()
    {
        $result = $this->Form->create($this->article, ['align' => 'horizontal']);
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

        $result = $this->Form->control('title');
        $expected = [
            'div' => ['class' => 'form-group row text required'],
            'label' => [
                'class' => 'col-form-label col-md-2',
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

        $result = $this->Form->control('file', ['type' => 'file']);
        $expected = [
            'div' => ['class' => 'form-group row file'],
            'label' => [
                'class' => 'col-form-label pt-1 col-md-2',
                'for' => 'file'
            ],
            'File',
            '/label',
            ['div' => ['class' => 'col-md-10']],
            'input' => [
                'type' => 'file',
                'name' => 'file',
                'id' => 'file',
                'class' => 'form-control-file',
            ],
            '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Form->control('published');
        $expected = [
            'div' => ['class' => 'form-group row checkbox'],
            ['div' => ['class' => 'offset-md-2 col-md-10']],
            ['div' => ['class' => 'form-check']],
            'input' => [
                'type' => 'hidden',
                'name' => 'published',
                'value' => 0,
            ],
            ['input' => [
                'type' => 'checkbox',
                'name' => 'published',
                'id' => 'published',
                'value' => 1,
                'class' => 'form-check-input'
            ]],
            'label' => ['for' => 'published', 'class' => 'form-check-label'],
            'Published',
            '/label',
            '/div',
            '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * testCustomGrid method
     *
     * @return void
     */
    public function testCustomGrid()
    {
        $this->Form->create($this->article, [
            'align' => [
                'left' => 3,
                'middle' => 5,
                'right' => 4
            ]
        ]);

        $result = $this->Form->control('title');
        $expected = [
            'div' => ['class' => 'form-group row text required'],
            'label' => [
                'class' => 'col-form-label col-md-3',
                'for' => 'title'
            ],
            'Title',
            '/label',
            ['div' => ['class' => 'col-md-5']],
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
    }

    /**
     * testHorizontalFormCreateFromConfig method
     *
     * @return void
     */
    public function testHorizontalFormCreateFromConfig()
    {
        $this->Form->setConfig([
            'align' => 'horizontal',
            'templateSet' => [
                'horizontal' => [
                    'checkboxFormGroup' => '<div class="%s"><div class="form-check my-checkbox">{{input}}{{label}}</div>{{error}}{{help}}</div>'
                ]
            ]
        ]);
        $result = $this->Form->create($this->article);
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

        $result = $this->Form->control('title');
        $expected = [
            'div' => ['class' => 'form-group row text required'],
            'label' => [
                'class' => 'col-form-label col-md-2',
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

        $result = $this->Form->control('published');
        $expected = [
            'div' => ['class' => 'form-group row checkbox'],
            ['div' => ['class' => 'offset-md-2 col-md-10']],
            ['div' => ['class' => 'form-check my-checkbox']],
            'input' => [
                'type' => 'hidden',
                'name' => 'published',
                'value' => 0,
            ],
            ['input' => [
                'type' => 'checkbox',
                'name' => 'published',
                'id' => 'published',
                'value' => 1,
                'class' => 'form-check-input',
            ]],
            'label' => ['for' => 'published', 'class' => 'form-check-label'],
            'Published',
            '/label',
            '/div',
            '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * testBasicButton method
     *
     * @return void
     */
    public function testBasicButton()
    {
        $result = $this->Form->button('Submit');
        $expected = [
            'button' => ['class' => 'btn btn-secondary', 'type' => 'submit'],
            'Submit',
            '/button'
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * testStyledFormSubmi method
     *
     * @return void
     */
    public function testStyledFormSubmit()
    {
        $result = $this->Form->submit('Submit', ['class' => 'btn btn-block']);
        $expected = [
            'div' => ['class' => 'submit'],
            'input' => [
                'type' => 'submit',
                'value' => 'Submit',
                'class' => 'btn btn-block btn-secondary',
            ]
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Form->submit('Submit', ['class' => ['btn', 'btn-block']]);
        $expected = [
            'div' => ['class' => 'submit'],
            'input' => [
                'type' => 'submit',
                'value' => 'Submit',
                'class' => 'btn btn-block btn-secondary',
            ]
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * testStyledButton method
     *
     * @return void
     */
    public function testStyledButton()
    {
        $result = $this->Form->button('Submit', ['class' => 'success']);
        $expected = [
            'button' => ['class' => 'btn-success btn', 'type' => 'submit'],
            'Submit',
            '/button'
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * testPrimaryStyledButton method
     *
     * @return void
     */
    public function testPrimaryStyledButton()
    {
        $result = $this->Form->button('Submit', ['class' => 'primary']);
        $expected = [
            'button' => ['class' => 'btn-primary btn', 'type' => 'submit'],
            'Submit',
            '/button'
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * testMultipleCheckboxSelect method
     *
     * @return void
     */
    public function testMultipleCheckboxSelect()
    {
        $options = [
            'Value 1' => 'Label 1',
            'Value 2' => 'Label 2'
        ];
        $result = $this->Form->select('field', $options, ['multiple' => 'checkbox']);

        $expected = [
            'input' => [
                'type' => 'hidden',
                'name' => 'field',
                'value' => '',
            ],
            ['div' => ['class' => 'form-check']],
            [
                'input' => [
                    'type' => 'checkbox',
                    'name' => 'field[]',
                    'id' => 'field-value-1',
                    'value' => 'Value 1',
                    'class' => 'form-check-input'
                ]
            ],
            ['label' => ['for' => 'field-value-1', 'class' => 'form-check-label']],
            'Label 1',
            '/label',
            '/div',
            ['div' => ['class' => 'form-check']],
            [
                'input' => [
                    'type' => 'checkbox',
                    'name' => 'field[]',
                    'id' => 'field-value-2',
                    'value' => 'Value 2',
                    'class' => 'form-check-input'
                ]
            ],
            ['label' => ['for' => 'field-value-2', 'class' => 'form-check-label']],
            'Label 2',
            '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * testHelpText method
     *
     * @return void
     */
    public function testHelpText()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('title', ['help' => 'help text']);
        $expected = [
            'div' => ['class' => 'form-group text required'],
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
            ['small' => ['class' => 'form-text text-muted']],
            'help text',
            '/small',
            '/div'
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Form->control('title', ['help' => ['content' => 'help text', 'id' => 'test']]);
        $expected = [
            'div' => ['class' => 'form-group text required'],
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
            ['small' => ['id' => 'test', 'class' => 'form-text text-muted']],
            'help text',
            '/small',
            '/div'
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Form->control('published', ['help' => 'help text']);
        $expected = [
            'div' => ['class' => 'form-group form-check checkbox'],
            'input' => [
                'type' => 'hidden',
                'name' => 'published',
                'value' => 0,
            ],
            ['input' => [
                'type' => 'checkbox',
                'name' => 'published',
                'id' => 'published',
                'value' => 1,
                'class' => 'form-check-input'
            ]],
            'label' => ['for' => 'published', 'class' => 'form-check-label'],
            'Published',
            '/label',
            ['small' => ['class' => 'form-text text-muted']],
            'help text',
            '/small',
            '/div'
        ];
        $this->assertHtml($expected, $result);

        $this->article['errors'] = [
            'title' => ['error message']
        ];
        $this->Form->create($this->article);

        $result = $this->Form->control('title', ['help' => 'help text']);
        $expected = [
            'div' => ['class' => 'form-group text required is-invalid'],
            'label' => ['for' => 'title'],
            'Title',
            '/label',
            'input' => [
                'type' => 'text',
                'name' => 'title',
                'id' => 'title',
                'class' => 'is-invalid form-control',
                'required' => 'required'
            ],
            ['div' => ['class' => 'invalid-feedback']],
            'error message',
            '/div',
            ['small' => ['class' => 'form-text text-muted']],
            'help text',
            '/small',
            '/div'
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Form->control('title', [
            'help' => 'help text',
            'templates' => ['help' => '<div class="custom-help-block">{{content}}</div>']
        ]);
        $expected = [
            'div' => ['class' => 'form-group text required is-invalid'],
            'label' => ['for' => 'title'],
            'Title',
            '/label',
            'input' => [
                'type' => 'text',
                'name' => 'title',
                'id' => 'title',
                'class' => 'is-invalid form-control',
                'required' => 'required'
            ],
            ['div' => ['class' => 'invalid-feedback']],
            'error message',
            '/div',
            ['div' => ['class' => 'custom-help-block']],
            'help text',
            '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * testHelpTextHorizontal method
     *
     * @return void
     */
    public function testHelpTextHorizontal()
    {
        $this->Form->create($this->article, ['align' => 'horizontal']);

        $result = $this->Form->control('title', ['help' => 'help text']);
        $expected = [
            'div' => ['class' => 'form-group row text required'],
            'label' => ['class' => 'col-form-label col-md-2', 'for' => 'title'],
            'Title',
            '/label',
            ['div' => ['class' => 'col-md-10']],
            'input' => [
                'type' => 'text',
                'name' => 'title',
                'id' => 'title',
                'class' => 'form-control',
                'required' => 'required'
            ],
            ['small' => ['class' => 'form-text text-muted']],
            'help text',
            '/small',
            '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Form->control('published', ['help' => 'help text']);
        $expected = [
            'div' => ['class' => 'form-group row checkbox'],
            ['div' => ['class' => 'offset-md-2 col-md-10']],
            ['div' => ['class' => 'form-check']],
            'input' => [
                'type' => 'hidden',
                'name' => 'published',
                'value' => 0,
            ],
            ['input' => [
                'type' => 'checkbox',
                'name' => 'published',
                'id' => 'published',
                'value' => 1,
                'class' => 'form-check-input'
            ]],
            'label' => ['for' => 'published', 'class' => 'form-check-label'],
            'Published',
            '/label',
            '/div',
            ['small' => ['class' => 'form-text text-muted']],
            'help text',
            '/small',
            '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);

        $this->article['errors'] = [
            'title' => ['error message']
        ];
        $this->Form->create($this->article, ['align' => 'horizontal']);

        $result = $this->Form->control('title', ['help' => 'help text']);
        $expected = [
            'div' => ['class' => 'form-group row text required is-invalid'],
            'label' => ['class' => 'col-form-label col-md-2', 'for' => 'title'],
            'Title',
            '/label',
            ['div' => ['class' => 'col-md-10']],
            'input' => [
                'type' => 'text',
                'name' => 'title',
                'id' => 'title',
                'class' => 'is-invalid form-control',
                'required' => 'required'
            ],
            ['div' => ['class' => 'invalid-feedback']],
            'error message',
            '/div',
            ['small' => ['class' => 'form-text text-muted']],
            'help text',
            '/small',
            '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * testTooltip method
     *
     * @return void
     */
    public function testTooltip()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('title', ['tooltip' => 'Some important additional notes.']);
        $expected = [
            'div' => ['class' => 'form-group text required'],
            'label' => ['for' => 'title'],
            'Title',
            'span' => ['data-toggle' => 'tooltip', 'title' => 'Some important additional notes.', 'class' => 'fas fa-info-circle'],
            '/span',
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

    /**
     * testTooltipHorizontal method
     *
     * @return void
     */
    public function testTooltipHorizontal()
    {
        $this->Form->create($this->article, ['align' => 'horizontal']);

        $result = $this->Form->control('title', ['tooltip' => 'Some important additional notes.']);
        $expected = [
            'div' => ['class' => 'form-group row text required'],
            'label' => ['class' => 'col-form-label col-md-2', 'for' => 'title'],
            'Title ',
            'span' => ['data-toggle' => 'tooltip', 'title' => 'Some important additional notes.', 'class' => 'fas fa-info-circle'],
            '/span',
            '/label',
            ['div' => ['class' => 'col-md-10']],
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

    /**
     * Test that "form-control" class is added when using methods for specific input.
     *
     * @return void
     */
    public function testFormControlClassInjection()
    {
        $result = $this->Form->text('foo');
        $this->assertContains('class="form-control"', $result);

        $result = $this->Form->text('foo', ['class' => 'custom']);
        $this->assertContains('class="custom form-control"', $result);

        $result = $this->Form->select('foo');
        $this->assertContains('class="form-control"', $result);

        $result = $this->Form->textarea('foo');
        $this->assertContains('class="form-control"', $result);

        $result = $this->Form->dateTime('foo');
        $this->assertContains('class="form-control"', $result);

        $result = $this->Form->file('foo');
        $this->assertNotContains('"form-control"', $result);

        $result = $this->Form->checkbox('foo');
        $this->assertNotContains('"form-control"', $result);

        $result = $this->Form->radio('foo', ['1' => 'Opt 1', '2' => 'Opt 2']);
        $this->assertNotContains('"form-control"', $result);
    }

    /**
     * testFormAlignment method
     *
     * @return void
     */
    public function testFormAlignment()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->Form->create($this->article, ['align' => 'foo']);
    }

    public function testDefaultAlignDatetimeControl()
    {
        $this->Form->create($this->article);

        $now = time();

        $result = $this->Form->control('created', [
            'type' => 'datetime',
            'timeFormat' => 12,
            'second' => true,
            'value' => $now,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group datetime', 'role' => 'group', 'aria-labelledby' => 'created-group-label']],
                ['label' => ['id' => 'created-group-label']],
                    'Created',
                '/label',
                ['ul' => ['class' => 'list-inline mb-0']],
                    ['li' => ['class' => 'list-inline-item year']],
                        ['select' => ['name' => 'created[year]', 'class' => 'form-control']],
                            $this->dateRegex['yearsRegex'],
                            ['option' => ['value' => date('Y', $now), 'selected' => 'selected']],
                                date('Y', $now),
                            '/option',
                        '*/select',
                    '/li',
                    ['li' => ['class' => 'list-inline-item month']],
                        ['select' => ['name' => 'created[month]', 'class' => 'form-control']],
                            $this->dateRegex['monthsRegex'],
                            ['option' => ['value' => date('m', $now), 'selected' => 'selected']],
                                date('F', $now),
                            '/option',
                        '*/select',
                    '/li',
                    ['li' => ['class' => 'list-inline-item day']],
                        ['select' => ['name' => 'created[day]', 'class' => 'form-control']],
                            $this->dateRegex['daysRegex'],
                            ['option' => ['value' => date('d', $now), 'selected' => 'selected']],
                                date('j', $now),
                            '/option',
                        '*/select',
                    '/li',
                    ['li' => ['class' => 'list-inline-item hour']],
                        ['select' => ['name' => 'created[hour]', 'class' => 'form-control']],
                            $this->dateRegex['hoursRegex'],
                            ['option' => ['value' => date('h', $now), 'selected' => 'selected']],
                                date('g', $now),
                            '/option',
                        '*/select',
                    '/li',
                    ['li' => ['class' => 'list-inline-item minute']],
                        ['select' => ['name' => 'created[minute]', 'class' => 'form-control']],
                            $this->dateRegex['minutesRegex'],
                            ['option' => ['value' => date('i', $now), 'selected' => 'selected']],
                                date('i', $now),
                            '/option',
                        '*/select',
                    '/li',
                    ['li' => ['class' => 'list-inline-item second']],
                        ['select' => ['name' => 'created[second]', 'class' => 'form-control']],
                            $this->dateRegex['secondsRegex'],
                            ['option' => ['value' => date('s', $now), 'selected' => 'selected']],
                                date('s', $now),
                            '/option',
                        '*/select',
                    '/li',
                    ['li' => ['class' => 'list-inline-item meridian']],
                        ['select' => ['name' => 'created[meridian]', 'class' => 'form-control']],
                            $this->dateRegex['meridianRegex'],
                            ['option' => ['value' => date('a', $now), 'selected' => 'selected']],
                                date('a', $now),
                            '/option',
                        '*/select',
                    '/li',
                '/ul',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignDatetimeControlDate()
    {
        $this->Form->create($this->article);

        $now = time();

        $result = $this->Form->control('created', [
            'type' => 'date',
            'value' => $now,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group date', 'role' => 'group', 'aria-labelledby' => 'created-group-label']],
                ['label' => ['id' => 'created-group-label']],
                    'Created',
                '/label',
                ['ul' => ['class' => 'list-inline mb-0']],
                    ['li' => ['class' => 'list-inline-item year']],
                        ['select' => ['name' => 'created[year]', 'class' => 'form-control']],
                            $this->dateRegex['yearsRegex'],
                            ['option' => ['value' => date('Y', $now), 'selected' => 'selected']],
                                date('Y', $now),
                            '/option',
                        '*/select',
                    '/li',
                    ['li' => ['class' => 'list-inline-item month']],
                        ['select' => ['name' => 'created[month]', 'class' => 'form-control']],
                            $this->dateRegex['monthsRegex'],
                            ['option' => ['value' => date('m', $now), 'selected' => 'selected']],
                                date('F', $now),
                            '/option',
                        '*/select',
                    '/li',
                    ['li' => ['class' => 'list-inline-item day']],
                        ['select' => ['name' => 'created[day]', 'class' => 'form-control']],
                            $this->dateRegex['daysRegex'],
                            ['option' => ['value' => date('d', $now), 'selected' => 'selected']],
                                date('j', $now),
                            '/option',
                        '*/select',
                    '/li',
                '/ul',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignDatetimeControlTime()
    {
        $this->Form->create($this->article);

        $now = time();

        $result = $this->Form->control('created', [
            'type' => 'time',
            'timeFormat' => 12,
            'second' => true,
            'value' => $now,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group time', 'role' => 'group', 'aria-labelledby' => 'created-group-label']],
                ['label' => ['id' => 'created-group-label']],
                    'Created',
                '/label',
                ['ul' => ['class' => 'list-inline mb-0']],
                    ['li' => ['class' => 'list-inline-item hour']],
                        ['select' => ['name' => 'created[hour]', 'class' => 'form-control']],
                            $this->dateRegex['hoursRegex'],
                            ['option' => ['value' => date('h', $now), 'selected' => 'selected']],
                                date('g', $now),
                            '/option',
                        '*/select',
                    '/li',
                    ['li' => ['class' => 'list-inline-item minute']],
                        ['select' => ['name' => 'created[minute]', 'class' => 'form-control']],
                            $this->dateRegex['minutesRegex'],
                            ['option' => ['value' => date('i', $now), 'selected' => 'selected']],
                                date('i', $now),
                            '/option',
                        '*/select',
                    '/li',
                    ['li' => ['class' => 'list-inline-item second']],
                        ['select' => ['name' => 'created[second]', 'class' => 'form-control']],
                            $this->dateRegex['secondsRegex'],
                            ['option' => ['value' => date('s', $now), 'selected' => 'selected']],
                                date('s', $now),
                            '/option',
                        '*/select',
                    '/li',
                    ['li' => ['class' => 'list-inline-item meridian']],
                        ['select' => ['name' => 'created[meridian]', 'class' => 'form-control']],
                            $this->dateRegex['meridianRegex'],
                            ['option' => ['value' => date('a', $now), 'selected' => 'selected']],
                                date('a', $now),
                            '/option',
                        '*/select',
                    '/li',
                '/ul',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignDatetimeControlCustomContainerTemplateViaTemplater()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('created', [
            'type' => 'datetime',
        ]);
        $this->assertContains('<div class="form-group datetime" role="group" aria-labelledby="created-group-label">', $result);

        $result = $this->Form->control('created', [
            'type' => 'date',
        ]);
        $this->assertContains('<div class="form-group date" role="group" aria-labelledby="created-group-label">', $result);

        $result = $this->Form->control('created', [
            'type' => 'time',
        ]);
        $this->assertContains('<div class="form-group time" role="group" aria-labelledby="created-group-label">', $result);

        $this->Form->setTemplates([
            'datetimeContainer' => '<div class="custom datetimeContainer {{type}}{{required}}" role="group" aria-labelledby="{{groupId}}">{{content}}</div>',
            'dateContainer' => '<div class="custom dateContainer {{type}}{{required}}" role="group" aria-labelledby="{{groupId}}">{{content}}</div>',
            'timeContainer' => '<div class="custom timeContainer {{type}}{{required}}" role="group" aria-labelledby="{{groupId}}">{{content}}</div>',
        ]);
        $result = $this->Form->control('created', [
            'type' => 'datetime',
        ]);
        $this->assertContains('<div class="custom datetimeContainer datetime" role="group" aria-labelledby="created-group-label">', $result);

        $result = $this->Form->control('created', [
            'type' => 'date',
        ]);
        $this->assertContains('<div class="custom dateContainer date" role="group" aria-labelledby="created-group-label">', $result);

        $result = $this->Form->control('created', [
            'type' => 'time',
        ]);
        $this->assertContains('<div class="custom timeContainer time" role="group" aria-labelledby="created-group-label">', $result);
    }

    public function testDefaultAlignDatetimeControlCustomContainerErrorTemplateViaOptions()
    {
        $this->article['errors'] = [
            'created' => [
                'foo' => 'bar'
            ]
        ];
        $this->Form->create($this->article);

        $result = $this->Form->control('created', [
            'type' => 'datetime',
        ]);
        $this->assertContains('<div class="form-group datetime is-invalid" role="group" aria-labelledby="created-group-label">', $result);

        $result = $this->Form->control('created', [
            'type' => 'date',
        ]);
        $this->assertContains('<div class="form-group date is-invalid" role="group" aria-labelledby="created-group-label">', $result);

        $result = $this->Form->control('created', [
            'type' => 'time',
        ]);
        $this->assertContains('<div class="form-group time is-invalid" role="group" aria-labelledby="created-group-label">', $result);

        $result = $this->Form->control('created', [
            'type' => 'datetime',
            'templates' => [
                'datetimeContainerError' => '<div class="custom datetimeContainerError {{type}}{{required}}" role="group" aria-labelledby="{{groupId}}">{{content}}</div>'
            ]
        ]);
        $this->assertContains('<div class="custom datetimeContainerError datetime" role="group" aria-labelledby="created-group-label">', $result);

        $result = $this->Form->control('created', [
            'type' => 'date',
            'templates' => [
                'dateContainerError' => '<div class="custom dateContainerError {{type}}{{required}}" role="group" aria-labelledby="{{groupId}}">{{content}}</div>'
            ]
        ]);
        $this->assertContains('<div class="custom dateContainerError date" role="group" aria-labelledby="created-group-label">', $result);

        $result = $this->Form->control('created', [
            'type' => 'time',
            'templates' => [
                'timeContainerError' => '<div class="custom timeContainerError {{type}}{{required}}" role="group" aria-labelledby="{{groupId}}">{{content}}</div>'
            ]
        ]);
        $this->assertContains('<div class="custom timeContainerError time" role="group" aria-labelledby="created-group-label">', $result);
    }

    public function testHorizontalAlignDatetimeControl()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $now = time();

        $result = $this->Form->control('created', [
            'type' => 'datetime',
            'timeFormat' => 12,
            'second' => true,
            'value' => $now,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row datetime', 'role' => 'group', 'aria-labelledby' => 'created-group-label']],
                ['label' => ['id' => 'created-group-label', 'class' => 'col-form-label col-sm-5']],
                    'Created',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['ul' => ['class' => 'list-inline mb-0']],
                        ['li' => ['class' => 'list-inline-item year']],
                            ['select' => ['name' => 'created[year]', 'class' => 'form-control']],
                                $this->dateRegex['yearsRegex'],
                                ['option' => ['value' => date('Y', $now), 'selected' => 'selected']],
                                    date('Y', $now),
                                '/option',
                            '*/select',
                        '/li',
                        ['li' => ['class' => 'list-inline-item month']],
                            ['select' => ['name' => 'created[month]', 'class' => 'form-control']],
                                $this->dateRegex['monthsRegex'],
                                ['option' => ['value' => date('m', $now), 'selected' => 'selected']],
                                    date('F', $now),
                                '/option',
                            '*/select',
                        '/li',
                        ['li' => ['class' => 'list-inline-item day']],
                            ['select' => ['name' => 'created[day]', 'class' => 'form-control']],
                                $this->dateRegex['daysRegex'],
                                ['option' => ['value' => date('d', $now), 'selected' => 'selected']],
                                    date('j', $now),
                                '/option',
                            '*/select',
                        '/li',
                        ['li' => ['class' => 'list-inline-item hour']],
                            ['select' => ['name' => 'created[hour]', 'class' => 'form-control']],
                                $this->dateRegex['hoursRegex'],
                                ['option' => ['value' => date('h', $now), 'selected' => 'selected']],
                                    date('g', $now),
                                '/option',
                            '*/select',
                        '/li',
                        ['li' => ['class' => 'list-inline-item minute']],
                            ['select' => ['name' => 'created[minute]', 'class' => 'form-control']],
                                $this->dateRegex['minutesRegex'],
                                ['option' => ['value' => date('i', $now), 'selected' => 'selected']],
                                    date('i', $now),
                                '/option',
                            '*/select',
                        '/li',
                        ['li' => ['class' => 'list-inline-item second']],
                            ['select' => ['name' => 'created[second]', 'class' => 'form-control']],
                                $this->dateRegex['secondsRegex'],
                                ['option' => ['value' => date('s', $now), 'selected' => 'selected']],
                                    date('s', $now),
                                '/option',
                            '*/select',
                        '/li',
                        ['li' => ['class' => 'list-inline-item meridian']],
                            ['select' => ['name' => 'created[meridian]', 'class' => 'form-control']],
                                $this->dateRegex['meridianRegex'],
                                ['option' => ['value' => date('a', $now), 'selected' => 'selected']],
                                    date('a', $now),
                                '/option',
                            '*/select',
                        '/li',
                    '/ul',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignDatetimeControlDate()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $now = time();

        $result = $this->Form->control('created', [
            'type' => 'date',
            'value' => $now,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row date', 'role' => 'group', 'aria-labelledby' => 'created-group-label']],
                ['label' => ['id' => 'created-group-label', 'class' => 'col-form-label col-sm-5']],
                    'Created',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['ul' => ['class' => 'list-inline mb-0']],
                        ['li' => ['class' => 'list-inline-item year']],
                            ['select' => ['name' => 'created[year]', 'class' => 'form-control']],
                                $this->dateRegex['yearsRegex'],
                                ['option' => ['value' => date('Y', $now), 'selected' => 'selected']],
                                    date('Y', $now),
                                '/option',
                            '*/select',
                        '/li',
                        ['li' => ['class' => 'list-inline-item month']],
                            ['select' => ['name' => 'created[month]', 'class' => 'form-control']],
                                $this->dateRegex['monthsRegex'],
                                ['option' => ['value' => date('m', $now), 'selected' => 'selected']],
                                    date('F', $now),
                                '/option',
                            '*/select',
                        '/li',
                        ['li' => ['class' => 'list-inline-item day']],
                            ['select' => ['name' => 'created[day]', 'class' => 'form-control']],
                                $this->dateRegex['daysRegex'],
                                ['option' => ['value' => date('d', $now), 'selected' => 'selected']],
                                    date('j', $now),
                                '/option',
                            '*/select',
                        '/li',
                    '/ul',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignDatetimeControlTime()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $now = time();

        $result = $this->Form->control('created', [
            'type' => 'time',
            'timeFormat' => 12,
            'second' => true,
            'value' => $now,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row time', 'role' => 'group', 'aria-labelledby' => 'created-group-label']],
                ['label' => ['id' => 'created-group-label', 'class' => 'col-form-label col-sm-5']],
                    'Created',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['ul' => ['class' => 'list-inline mb-0']],
                        ['li' => ['class' => 'list-inline-item hour']],
                            ['select' => ['name' => 'created[hour]', 'class' => 'form-control']],
                                $this->dateRegex['hoursRegex'],
                                ['option' => ['value' => date('h', $now), 'selected' => 'selected']],
                                    date('g', $now),
                                '/option',
                            '*/select',
                        '/li',
                        ['li' => ['class' => 'list-inline-item minute']],
                            ['select' => ['name' => 'created[minute]', 'class' => 'form-control']],
                                $this->dateRegex['minutesRegex'],
                                ['option' => ['value' => date('i', $now), 'selected' => 'selected']],
                                    date('i', $now),
                                '/option',
                            '*/select',
                        '/li',
                        ['li' => ['class' => 'list-inline-item second']],
                            ['select' => ['name' => 'created[second]', 'class' => 'form-control']],
                                $this->dateRegex['secondsRegex'],
                                ['option' => ['value' => date('s', $now), 'selected' => 'selected']],
                                    date('s', $now),
                                '/option',
                            '*/select',
                        '/li',
                        ['li' => ['class' => 'list-inline-item meridian']],
                            ['select' => ['name' => 'created[meridian]', 'class' => 'form-control']],
                                $this->dateRegex['meridianRegex'],
                                ['option' => ['value' => date('a', $now), 'selected' => 'selected']],
                                    date('a', $now),
                                '/option',
                            '*/select',
                        '/li',
                    '/ul',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignDatetimeControlCustomContainerTemplateViaTemplater()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('created', [
            'type' => 'datetime',
        ]);
        $this->assertContains('<div class="form-group row datetime" role="group" aria-labelledby="created-group-label">', $result);

        $result = $this->Form->control('created', [
            'type' => 'date',
        ]);
        $this->assertContains('<div class="form-group row date" role="group" aria-labelledby="created-group-label">', $result);

        $result = $this->Form->control('created', [
            'type' => 'time',
        ]);
        $this->assertContains('<div class="form-group row time" role="group" aria-labelledby="created-group-label">', $result);

        $this->Form->setTemplates([
            'datetimeContainer' => '<div class="custom datetimeContainer {{type}}{{required}}" role="group" aria-labelledby="{{groupId}}">{{content}}</div>',
            'dateContainer' => '<div class="custom dateContainer {{type}}{{required}}" role="group" aria-labelledby="{{groupId}}">{{content}}</div>',
            'timeContainer' => '<div class="custom timeContainer {{type}}{{required}}" role="group" aria-labelledby="{{groupId}}">{{content}}</div>',
        ]);
        $result = $this->Form->control('created', [
            'type' => 'datetime',
        ]);
        $this->assertContains('<div class="custom datetimeContainer datetime" role="group" aria-labelledby="created-group-label">', $result);

        $result = $this->Form->control('created', [
            'type' => 'date',
        ]);
        $this->assertContains('<div class="custom dateContainer date" role="group" aria-labelledby="created-group-label">', $result);

        $result = $this->Form->control('created', [
            'type' => 'time',
        ]);
        $this->assertContains('<div class="custom timeContainer time" role="group" aria-labelledby="created-group-label">', $result);
    }

    public function testHorizontalAlignDatetimeControlCustomContainerErrorTemplateViaOptions()
    {
        $this->article['errors'] = [
            'created' => [
                'foo' => 'bar'
            ]
        ];
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('created', [
            'type' => 'datetime',
        ]);
        $this->assertContains('<div class="form-group row datetime is-invalid" role="group" aria-labelledby="created-group-label">', $result);

        $result = $this->Form->control('created', [
            'type' => 'date',
        ]);
        $this->assertContains('<div class="form-group row date is-invalid" role="group" aria-labelledby="created-group-label">', $result);

        $result = $this->Form->control('created', [
            'type' => 'time',
        ]);
        $this->assertContains('<div class="form-group row time is-invalid" role="group" aria-labelledby="created-group-label">', $result);

        $result = $this->Form->control('created', [
            'type' => 'datetime',
            'templates' => [
                'datetimeContainerError' => '<div class="custom datetimeContainerError {{type}}{{required}}" role="group" aria-labelledby="{{groupId}}">{{content}}</div>'
            ]
        ]);
        $this->assertContains('<div class="custom datetimeContainerError datetime" role="group" aria-labelledby="created-group-label">', $result);

        $result = $this->Form->control('created', [
            'type' => 'date',
            'templates' => [
                'dateContainerError' => '<div class="custom dateContainerError {{type}}{{required}}" role="group" aria-labelledby="{{groupId}}">{{content}}</div>'
            ]
        ]);
        $this->assertContains('<div class="custom dateContainerError date" role="group" aria-labelledby="created-group-label">', $result);

        $result = $this->Form->control('created', [
            'type' => 'time',
            'templates' => [
                'timeContainerError' => '<div class="custom timeContainerError {{type}}{{required}}" role="group" aria-labelledby="{{groupId}}">{{content}}</div>'
            ]
        ]);
        $this->assertContains('<div class="custom timeContainerError time" role="group" aria-labelledby="created-group-label">', $result);
    }

    public function testInlineAlignDatetimeControl()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline'
            ]);
        });

        $now = time();

        $result = $this->Form->control('created', [
            'type' => 'datetime',
            'timeFormat' => 12,
            'second' => true,
            'value' => $now,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group datetime', 'role' => 'group', 'aria-labelledby' => 'created-group-label']],
                ['span' => ['id' => 'created-group-label', 'class' => 'sr-only']],
                    'Created',
                '/span',
                ['ul' => ['class' => 'list-inline mb-0']],
                    ['li' => ['class' => 'list-inline-item year']],
                        ['select' => ['name' => 'created[year]', 'class' => 'form-control']],
                            $this->dateRegex['yearsRegex'],
                            ['option' => ['value' => date('Y', $now), 'selected' => 'selected']],
                                date('Y', $now),
                            '/option',
                        '*/select',
                    '/li',
                    ['li' => ['class' => 'list-inline-item month']],
                        ['select' => ['name' => 'created[month]', 'class' => 'form-control']],
                            $this->dateRegex['monthsRegex'],
                            ['option' => ['value' => date('m', $now), 'selected' => 'selected']],
                                date('F', $now),
                            '/option',
                        '*/select',
                    '/li',
                    ['li' => ['class' => 'list-inline-item day']],
                        ['select' => ['name' => 'created[day]', 'class' => 'form-control']],
                            $this->dateRegex['daysRegex'],
                            ['option' => ['value' => date('d', $now), 'selected' => 'selected']],
                                date('j', $now),
                            '/option',
                        '*/select',
                    '/li',
                    ['li' => ['class' => 'list-inline-item hour']],
                        ['select' => ['name' => 'created[hour]', 'class' => 'form-control']],
                            $this->dateRegex['hoursRegex'],
                            ['option' => ['value' => date('h', $now), 'selected' => 'selected']],
                                date('g', $now),
                            '/option',
                        '*/select',
                    '/li',
                    ['li' => ['class' => 'list-inline-item minute']],
                        ['select' => ['name' => 'created[minute]', 'class' => 'form-control']],
                            $this->dateRegex['minutesRegex'],
                            ['option' => ['value' => date('i', $now), 'selected' => 'selected']],
                                date('i', $now),
                            '/option',
                        '*/select',
                    '/li',
                    ['li' => ['class' => 'list-inline-item second']],
                        ['select' => ['name' => 'created[second]', 'class' => 'form-control']],
                            $this->dateRegex['secondsRegex'],
                            ['option' => ['value' => date('s', $now), 'selected' => 'selected']],
                                date('s', $now),
                            '/option',
                        '*/select',
                    '/li',
                    ['li' => ['class' => 'list-inline-item meridian']],
                        ['select' => ['name' => 'created[meridian]', 'class' => 'form-control']],
                            $this->dateRegex['meridianRegex'],
                            ['option' => ['value' => date('a', $now), 'selected' => 'selected']],
                                date('a', $now),
                            '/option',
                        '*/select',
                    '/li',
                '/ul',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignDatetimeControlDate()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline'
            ]);
        });

        $now = time();

        $result = $this->Form->control('created', [
            'type' => 'date',
            'value' => $now,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group date', 'role' => 'group', 'aria-labelledby' => 'created-group-label']],
                ['span' => ['id' => 'created-group-label', 'class' => 'sr-only']],
                    'Created',
                '/span',
                ['ul' => ['class' => 'list-inline mb-0']],
                    ['li' => ['class' => 'list-inline-item year']],
                        ['select' => ['name' => 'created[year]', 'class' => 'form-control']],
                            $this->dateRegex['yearsRegex'],
                            ['option' => ['value' => date('Y', $now), 'selected' => 'selected']],
                                date('Y', $now),
                            '/option',
                        '*/select',
                    '/li',
                    ['li' => ['class' => 'list-inline-item month']],
                        ['select' => ['name' => 'created[month]', 'class' => 'form-control']],
                            $this->dateRegex['monthsRegex'],
                            ['option' => ['value' => date('m', $now), 'selected' => 'selected']],
                                date('F', $now),
                            '/option',
                        '*/select',
                    '/li',
                    ['li' => ['class' => 'list-inline-item day']],
                        ['select' => ['name' => 'created[day]', 'class' => 'form-control']],
                            $this->dateRegex['daysRegex'],
                            ['option' => ['value' => date('d', $now), 'selected' => 'selected']],
                                date('j', $now),
                            '/option',
                        '*/select',
                    '/li',
                '/ul',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignDatetimeControlTime()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline'
            ]);
        });

        $now = time();

        $result = $this->Form->control('created', [
            'type' => 'time',
            'timeFormat' => 12,
            'second' => true,
            'value' => $now,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group time', 'role' => 'group', 'aria-labelledby' => 'created-group-label']],
                ['span' => ['id' => 'created-group-label', 'class' => 'sr-only']],
                    'Created',
                '/span',
                ['ul' => ['class' => 'list-inline mb-0']],
                    ['li' => ['class' => 'list-inline-item hour']],
                        ['select' => ['name' => 'created[hour]', 'class' => 'form-control']],
                            $this->dateRegex['hoursRegex'],
                            ['option' => ['value' => date('h', $now), 'selected' => 'selected']],
                                date('g', $now),
                            '/option',
                        '*/select',
                    '/li',
                    ['li' => ['class' => 'list-inline-item minute']],
                        ['select' => ['name' => 'created[minute]', 'class' => 'form-control']],
                            $this->dateRegex['minutesRegex'],
                            ['option' => ['value' => date('i', $now), 'selected' => 'selected']],
                                date('i', $now),
                            '/option',
                        '*/select',
                    '/li',
                    ['li' => ['class' => 'list-inline-item second']],
                        ['select' => ['name' => 'created[second]', 'class' => 'form-control']],
                            $this->dateRegex['secondsRegex'],
                            ['option' => ['value' => date('s', $now), 'selected' => 'selected']],
                                date('s', $now),
                            '/option',
                        '*/select',
                    '/li',
                    ['li' => ['class' => 'list-inline-item meridian']],
                        ['select' => ['name' => 'created[meridian]', 'class' => 'form-control']],
                            $this->dateRegex['meridianRegex'],
                            ['option' => ['value' => date('a', $now), 'selected' => 'selected']],
                                date('a', $now),
                            '/option',
                        '*/select',
                    '/li',
                '/ul',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignDatetimeControlCustomContainerTemplateViaTemplater()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline'
            ]);
        });

        $result = $this->Form->control('created', [
            'type' => 'datetime',
        ]);
        $this->assertContains('<div class="form-group datetime" role="group" aria-labelledby="created-group-label">', $result);

        $result = $this->Form->control('created', [
            'type' => 'date',
        ]);
        $this->assertContains('<div class="form-group date" role="group" aria-labelledby="created-group-label">', $result);

        $result = $this->Form->control('created', [
            'type' => 'time',
        ]);
        $this->assertContains('<div class="form-group time" role="group" aria-labelledby="created-group-label">', $result);

        $this->Form->setTemplates([
            'datetimeContainer' => '<div class="custom datetimeContainer {{type}}{{required}}" role="group" aria-labelledby="{{groupId}}">{{content}}</div>',
            'dateContainer' => '<div class="custom dateContainer {{type}}{{required}}" role="group" aria-labelledby="{{groupId}}">{{content}}</div>',
            'timeContainer' => '<div class="custom timeContainer {{type}}{{required}}" role="group" aria-labelledby="{{groupId}}">{{content}}</div>',
        ]);
        $result = $this->Form->control('created', [
            'type' => 'datetime',
        ]);
        $this->assertContains('<div class="custom datetimeContainer datetime" role="group" aria-labelledby="created-group-label">', $result);

        $result = $this->Form->control('created', [
            'type' => 'date',
        ]);
        $this->assertContains('<div class="custom dateContainer date" role="group" aria-labelledby="created-group-label">', $result);

        $result = $this->Form->control('created', [
            'type' => 'time',
        ]);
        $this->assertContains('<div class="custom timeContainer time" role="group" aria-labelledby="created-group-label">', $result);
    }

    public function testInlineAlignDatetimeControlCustomContainerErrorTemplateViaOptions()
    {
        $this->article['errors'] = [
            'created' => [
                'foo' => 'bar'
            ]
        ];
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline'
            ]);
        });

        $result = $this->Form->control('created', [
            'type' => 'datetime',
        ]);
        $this->assertContains('<div class="form-group datetime is-invalid" role="group" aria-labelledby="created-group-label">', $result);

        $result = $this->Form->control('created', [
            'type' => 'date',
        ]);
        $this->assertContains('<div class="form-group date is-invalid" role="group" aria-labelledby="created-group-label">', $result);

        $result = $this->Form->control('created', [
            'type' => 'time',
        ]);
        $this->assertContains('<div class="form-group time is-invalid" role="group" aria-labelledby="created-group-label">', $result);

        $result = $this->Form->control('created', [
            'type' => 'datetime',
            'templates' => [
                'datetimeContainerError' => '<div class="custom datetimeContainerError {{type}}{{required}}" role="group" aria-labelledby="{{groupId}}">{{content}}</div>'
            ]
        ]);
        $this->assertContains('<div class="custom datetimeContainerError datetime" role="group" aria-labelledby="created-group-label">', $result);

        $result = $this->Form->control('created', [
            'type' => 'date',
            'templates' => [
                'dateContainerError' => '<div class="custom dateContainerError {{type}}{{required}}" role="group" aria-labelledby="{{groupId}}">{{content}}</div>'
            ]
        ]);
        $this->assertContains('<div class="custom dateContainerError date" role="group" aria-labelledby="created-group-label">', $result);

        $result = $this->Form->control('created', [
            'type' => 'time',
            'templates' => [
                'timeContainerError' => '<div class="custom timeContainerError {{type}}{{required}}" role="group" aria-labelledby="{{groupId}}">{{content}}</div>'
            ]
        ]);
        $this->assertContains('<div class="custom timeContainerError time" role="group" aria-labelledby="created-group-label">', $result);
    }

    public function testDefaultAlignCheckboxControl()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group form-check checkbox']],
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => 0,
                ]],
                ['input' => [
                    'class' => 'form-check-input',
                    'type' => 'checkbox',
                    'name' => 'users',
                    'id' => 'users',
                    'value' => 1
                ]],
                ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                    'Users',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCheckboxControlNestedInput()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'nestedInput' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group form-check checkbox']],
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => 0,
                ]],
                ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users',
                        'id' => 'users',
                        'value' => 1
                    ]],
                    'Users',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCheckboxControlInline()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'inline' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-check form-check-inline checkbox']],
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => 0,
                ]],
                ['input' => [
                    'class' => 'form-check-input',
                    'type' => 'checkbox',
                    'name' => 'users',
                    'id' => 'users',
                    'value' => 1
                ]],
                ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                    'Users',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCheckboxControlInlineNestedInput()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'inline' => true,
            'nestedInput' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-check form-check-inline checkbox']],
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => 0,
                ]],
                ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users',
                        'id' => 'users',
                        'value' => 1
                    ]],
                    'Users',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCheckboxControl()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row checkbox']],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users',
                            'id' => 'users',
                            'value' => 1
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                            'Users',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCheckboxControlNestedInput()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'nestedInput' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row checkbox']],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users',
                                'id' => 'users',
                                'value' => 1
                            ]],
                            'Users',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCheckboxControlInline()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'inline' => true
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row checkbox']],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users',
                            'id' => 'users',
                            'value' => 1
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                            'Users',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCheckboxControlInlineNestedInput()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'inline' => true,
            'nestedInput' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row checkbox']],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users',
                                'id' => 'users',
                                'value' => 1
                            ]],
                            'Users',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCheckboxControl()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline'
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
        ]);
        $expected = [
            ['div' => ['class' => 'form-check form-check-inline checkbox']],
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => 0,
                ]],
                ['input' => [
                    'class' => 'form-check-input',
                    'type' => 'checkbox',
                    'name' => 'users',
                    'id' => 'users',
                    'value' => 1
                ]],
                ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                    'Users',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCheckboxControlNestedInput()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline'
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'nestedInput' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-check form-check-inline checkbox']],
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => 0,
                ]],
                ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users',
                        'id' => 'users',
                        'value' => 1
                    ]],
                    'Users',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCheckboxControlInline()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline'
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'inline' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-check form-check-inline checkbox']],
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => 0,
                ]],
                ['input' => [
                    'class' => 'form-check-input',
                    'type' => 'checkbox',
                    'name' => 'users',
                    'id' => 'users',
                    'value' => 1
                ]],
                ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                    'Users',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCheckboxControlInlineNestedInput()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline'
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'inline' => true,
            'nestedInput' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-check form-check-inline checkbox']],
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => 0,
                ]],
                ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users',
                        'id' => 'users',
                        'value' => 1
                    ]],
                    'Users',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignRadioControl()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2'
            ]
        ]);
        $expected = [
            ['div' => ['class' => 'form-group radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-1',
                        'value' => 1
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'value' => 2
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignRadioControlNestedInput()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2'
            ],
            'nestedInput' => true
        ]);
        $expected = [
            ['div' => ['class' => 'form-group radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-1',
                            'value' => 1
                        ]],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-2',
                            'value' => 2
                        ]],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignRadioControlInline()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2'
            ],
            'inline' => true
        ]);
        $expected = [
            ['div' => ['class' => 'form-group radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-1',
                        'value' => 1
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'value' => 2
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignRadioControlInlineNestedInput()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2'
            ],
            'inline' => true,
            'nestedInput' => true
        ]);
        $expected = [
            ['div' => ['class' => 'form-group radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-1',
                            'value' => 1
                        ]],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-2',
                            'value' => 2
                        ]],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignRadioPerOptionConfiguration()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
                4 => [
                    'text' => 'option 3',
                    'value' => 12,
                    'class' => 'custominputclass',
                    'label' => [
                        'class' => 'customlabelclass'
                    ]
                ],
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'form-group radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-1',
                        'value' => 1
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'value' => 2
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'custominputclass',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-12',
                        'value' => 12
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-12']],
                        'option 3',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignRadioPerOptionConfigurationInline()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
                4 => [
                    'text' => 'option 3',
                    'value' => 12,
                    'class' => 'custominputclass',
                    'label' => [
                        'class' => 'customlabelclass'
                    ]
                ],
            ],
            'inline' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-1',
                        'value' => 1
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'value' => 2
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'custominputclass',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-12',
                        'value' => 12
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-12']],
                        'option 3',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignRadioPerOptionConfigurationInlineNestedInput()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
                4 => [
                    'text' => 'option 3',
                    'value' => 12,
                    'class' => 'custominputclass',
                    'label' => [
                        'class' => 'customlabelclass'
                    ]
                ],
            ],
            'inline' => true,
            'nestedInput' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-1',
                            'value' => 1
                        ]],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-2',
                            'value' => 2
                        ]],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-12']],
                        ['input' => [
                            'class' => 'custominputclass',
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-12',
                            'value' => 12
                        ]],
                        'option 3',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRadioControl()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2'
            ]
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label d-block pt-0 col-sm-5']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'hidden',
                        'name' => 'users',
                        'value' => '',
                    ]],
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-1',
                            'value' => 1
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                            'option 1',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-2',
                            'value' => 2
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                            'option 2',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRadioControlNestedInput()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2'
            ],
            'nestedInput' => true
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                 ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label d-block pt-0 col-sm-5']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'hidden',
                        'name' => 'users',
                        'value' => '',
                    ]],
                    ['div' => ['class' => 'form-check']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'radio',
                                'name' => 'users',
                                'id' => 'users-1',
                                'value' => 1
                            ]],
                            'option 1',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'radio',
                                'name' => 'users',
                                'id' => 'users-2',
                                'value' => 2
                            ]],
                            'option 2',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRadioControlInline()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2'
            ],
            'inline' => true
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label d-block pt-0 col-sm-5']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'hidden',
                        'name' => 'users',
                        'value' => '',
                    ]],
                    ['div' => ['class' => 'form-check form-check-inline']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-1',
                            'value' => 1
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                            'option 1',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check form-check-inline']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-2',
                            'value' => 2
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                            'option 2',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRadioControlInlineNestedInput()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2'
            ],
            'inline' => true,
            'nestedInput' => true
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label d-block pt-0 col-sm-5']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'hidden',
                        'name' => 'users',
                        'value' => '',
                    ]],
                    ['div' => ['class' => 'form-check form-check-inline']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'radio',
                                'name' => 'users',
                                'id' => 'users-1',
                                'value' => 1
                            ]],
                            'option 1',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check form-check-inline']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'radio',
                                'name' => 'users',
                                'id' => 'users-2',
                                'value' => 2
                            ]],
                            'option 2',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRadioControlPerOptionConfiguration()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
                4 => [
                    'text' => 'option 3',
                    'value' => 12,
                    'class' => 'custominputclass',
                    'label' => [
                        'class' => 'customlabelclass'
                    ]
                ],
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label d-block pt-0 col-sm-5']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'hidden',
                        'name' => 'users',
                        'value' => '',
                    ]],
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-1',
                            'value' => 1
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                            'option 1',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-2',
                            'value' => 2
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                            'option 2',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'custominputclass',
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-12',
                            'value' => 12
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-12']],
                            'option 3',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRadioControlPerOptionConfigurationInline()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
                4 => [
                    'text' => 'option 3',
                    'value' => 12,
                    'class' => 'custominputclass',
                    'label' => [
                        'class' => 'customlabelclass'
                    ]
                ],
            ],
            'inline' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label d-block pt-0 col-sm-5']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'hidden',
                        'name' => 'users',
                        'value' => '',
                    ]],
                    ['div' => ['class' => 'form-check form-check-inline']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-1',
                            'value' => 1
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                            'option 1',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check form-check-inline']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-2',
                            'value' => 2
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                            'option 2',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check form-check-inline']],
                        ['input' => [
                            'class' => 'custominputclass',
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-12',
                            'value' => 12
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-12']],
                            'option 3',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRadioControlPerOptionConfigurationInlineNestedInput()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
                4 => [
                    'text' => 'option 3',
                    'value' => 12,
                    'class' => 'custominputclass',
                    'label' => [
                        'class' => 'customlabelclass'
                    ]
                ],
            ],
            'inline' => true,
            'nestedInput' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label d-block pt-0 col-sm-5']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'hidden',
                        'name' => 'users',
                        'value' => '',
                    ]],
                    ['div' => ['class' => 'form-check form-check-inline']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'radio',
                                'name' => 'users',
                                'id' => 'users-1',
                                'value' => 1
                            ]],
                            'option 1',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check form-check-inline']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'radio',
                                'name' => 'users',
                                'id' => 'users-2',
                                'value' => 2
                            ]],
                            'option 2',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check form-check-inline']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-12']],
                            ['input' => [
                                'class' => 'custominputclass',
                                'type' => 'radio',
                                'name' => 'users',
                                'id' => 'users-12',
                                'value' => 12
                            ]],
                            'option 3',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignRadioControl()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline'
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2'
            ]
        ]);
        $expected = [
            ['div' => ['class' => 'form-group radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['span' => ['id' => 'users-group-label', 'class' => 'sr-only']],
                    'Users',
                '/span',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-1',
                        'value' => 1
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'value' => 2
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignRadioControlWithPerOptionConfiguration()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline'
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
                4 => [
                    'text' => 'option 3',
                    'value' => 12,
                    'class' => 'custominputclass',
                    'label' => [
                        'class' => 'customlabelclass'
                    ]
                ],
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'form-group radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['span' => ['id' => 'users-group-label', 'class' => 'sr-only']],
                    'Users',
                '/span',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-1',
                        'value' => 1
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'value' => 2
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'custominputclass',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-12',
                        'value' => 12
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-12']],
                        'option 3',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignRadioControlNestedInput()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline'
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2'
            ],
            'nestedInput' => true
        ]);
        $expected = [
            ['div' => ['class' => 'form-group radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['span' => ['id' => 'users-group-label', 'class' => 'sr-only']],
                    'Users',
                '/span',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-1',
                            'value' => 1
                        ]],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-2',
                            'value' => 2
                        ]],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignRadioControlWithPerOptionConfigurationNestedInput()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline'
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
                4 => [
                    'text' => 'option 3',
                    'value' => 12,
                    'class' => 'custominputclass',
                    'label' => [
                        'class' => 'customlabelclass'
                    ]
                ],
            ],
            'nestedInput' => true
        ]);
        $expected = [
            ['div' => ['class' => 'form-group radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['span' => ['id' => 'users-group-label', 'class' => 'sr-only']],
                    'Users',
                '/span',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-1',
                            'value' => 1
                        ]],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-2',
                            'value' => 2
                        ]],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-12']],
                        ['input' => [
                            'class' => 'custominputclass',
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-12',
                            'value' => 12
                        ]],
                        'option 3',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControl()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2'
            ]
        ]);
        $expected = [
            ['div' => ['class' => 'form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'value' => 1
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'value' => 2
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlNestedInput()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2'
            ],
            'nestedInput' => true
        ]);
        $expected = [
            ['div' => ['class' => 'form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-1',
                            'value' => 1
                        ]],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-2',
                            'value' => 2
                        ]],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlInline()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2'
            ],
            'inline' => true
        ]);
        $expected = [
            ['div' => ['class' => 'form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'value' => 1
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'value' => 2
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlInlineNestedInput()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2'
            ],
            'inline' => true,
            'nestedInput' => true
        ]);
        $expected = [
            ['div' => ['class' => 'form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-1',
                            'value' => 1
                        ]],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-2',
                            'value' => 2
                        ]],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlOptionGroups()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                'group 1' => [
                    1 => 'option 1',
                    2 => 'option 2'
                ],
                'group 2' => [
                    3 => 'option 3',
                    4 => 'option 4'
                ],
            ]
        ]);
        $expected = [
            ['div' => ['class' => 'form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['fieldset' => ['class' => 'form-group']],
                    ['legend' => ['class' => 'col-form-label pt-0']],
                        'group 1',
                    '/legend',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-1',
                            'value' => 1
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                            'option 1',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-2',
                            'value' => 2
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                            'option 2',
                        '/label',
                    '/div',
                 '/fieldset',
                ['fieldset' => ['class' => 'form-group']],
                    ['legend' => ['class' => 'col-form-label pt-0']],
                        'group 2',
                    '/legend',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-3',
                            'value' => 3
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-3']],
                            'option 3',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-4',
                            'value' => 4
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-4']],
                            'option 4',
                        '/label',
                    '/div',
                 '/fieldset',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlOptionGroupsNestedInput()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                'group 1' => [
                    1 => 'option 1',
                    2 => 'option 2'
                ],
                'group 2' => [
                    3 => 'option 3',
                    4 => 'option 4'
                ],
            ],
            'nestedInput' => true
        ]);
        $expected = [
            ['div' => ['class' => 'form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['fieldset' => ['class' => 'form-group']],
                    ['legend' => ['class' => 'col-form-label pt-0']],
                        'group 1',
                    '/legend',
                    ['div' => ['class' => 'form-check']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-1',
                                'value' => 1
                            ]],
                            'option 1',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-2',
                                'value' => 2
                            ]],
                            'option 2',
                        '/label',
                    '/div',
                 '/fieldset',
                ['fieldset' => ['class' => 'form-group']],
                    ['legend' => ['class' => 'col-form-label pt-0']],
                        'group 2',
                    '/legend',
                    ['div' => ['class' => 'form-check']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-3']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-3',
                                'value' => 3
                            ]],
                            'option 3',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-4']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-4',
                                'value' => 4
                            ]],
                            'option 4',
                        '/label',
                    '/div',
                 '/fieldset',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlOptionGroupsInline()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                'group 1' => [
                    1 => 'option 1',
                    2 => 'option 2'
                ],
                'group 2' => [
                    3 => 'option 3',
                    4 => 'option 4'
                ],
            ],
            'inline' => true
        ]);
        $expected = [
            ['div' => ['class' => 'form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['fieldset' => ['class' => 'form-group']],
                    ['legend' => ['class' => 'col-form-label pt-0']],
                        'group 1',
                    '/legend',
                    ['div' => ['class' => 'form-check form-check-inline']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-1',
                            'value' => 1
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                            'option 1',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check form-check-inline']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-2',
                            'value' => 2
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                            'option 2',
                        '/label',
                    '/div',
                 '/fieldset',
                ['fieldset' => ['class' => 'form-group']],
                    ['legend' => ['class' => 'col-form-label pt-0']],
                        'group 2',
                    '/legend',
                    ['div' => ['class' => 'form-check form-check-inline']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-3',
                            'value' => 3
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-3']],
                            'option 3',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check form-check-inline']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-4',
                            'value' => 4
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-4']],
                            'option 4',
                        '/label',
                    '/div',
                 '/fieldset',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlOptionGroupsInlineNestedInput()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                'group 1' => [
                    1 => 'option 1',
                    2 => 'option 2'
                ],
                'group 2' => [
                    3 => 'option 3',
                    4 => 'option 4'
                ],
            ],
            'inline' => true,
            'nestedInput' => true
        ]);
        $expected = [
            ['div' => ['class' => 'form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['fieldset' => ['class' => 'form-group']],
                    ['legend' => ['class' => 'col-form-label pt-0']],
                        'group 1',
                    '/legend',
                    ['div' => ['class' => 'form-check form-check-inline']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-1',
                                'value' => 1
                            ]],
                            'option 1',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check form-check-inline']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-2',
                                'value' => 2
                            ]],
                            'option 2',
                        '/label',
                    '/div',
                 '/fieldset',
                ['fieldset' => ['class' => 'form-group']],
                    ['legend' => ['class' => 'col-form-label pt-0']],
                        'group 2',
                    '/legend',
                    ['div' => ['class' => 'form-check form-check-inline']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-3']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-3',
                                'value' => 3
                            ]],
                            'option 3',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check form-check-inline']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-4']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-4',
                                'value' => 4
                            ]],
                            'option 4',
                        '/label',
                    '/div',
                 '/fieldset',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlOptionsGroupsAndSingleEntries()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
                'group' => [
                    3 => 'option 3',
                    4 => 'option 4',
                ]
            ]
        ]);
        $expected = [
            ['div' => ['class' => 'form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'value' => 1
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'value' => 2
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['fieldset' => ['class' => 'form-group']],
                    ['legend' => ['class' => 'col-form-label pt-0']],
                        'group',
                    '/legend',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-3',
                            'value' => 3
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-3']],
                            'option 3',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-4',
                            'value' => 4
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-4']],
                            'option 4',
                        '/label',
                    '/div',
                 '/fieldset',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlOptionsGroupsAndSingleEntriesWithPerOptionConfiguration()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
                4 => [
                    'text' => 'option 3',
                    'value' => 12,
                    'class' => 'custominputclass',
                    'label' => [
                        'class' => 'customlabelclass'
                    ]
                ],
                'group' => [
                    10 => 'option 4',
                    20 => [
                        'text' => 'option 4',
                        'value' => 20,
                        'class' => 'custominputclass'
                    ],
                    30 => [
                        'text' => 'option 5 without label',
                        'value' => 30,
                        'label' => false
                    ],
                    40 => [
                        'text' => 'option 6',
                        'value' => 40,
                        'label' => [
                            'class' => 'customlabelclass'
                        ]
                    ],
                ]
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'value' => 1
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'value' => 2
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'custominputclass',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-12',
                        'value' => 12
                    ]],
                    ['label' => ['class' => 'customlabelclass', 'for' => 'users-12']],
                        'option 3',
                    '/label',
                '/div',
                ['fieldset' => ['class' => 'form-group']],
                    ['legend' => ['class' => 'col-form-label pt-0']],
                        'group',
                    '/legend',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-10',
                            'value' => 10
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-10']],
                            'option 4',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'custominputclass',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-20',
                            'value' => 20
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-20']],
                            'option 4',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-30',
                            'value' => 30
                        ]],
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-40',
                            'value' => 40
                        ]],
                        ['label' => ['class' => 'customlabelclass', 'for' => 'users-40']],
                            'option 6',
                        '/label',
                    '/div',
                 '/fieldset',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlOptionsGroupsAndSingleEntriesNestedInput()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
                'group' => [
                    3 => 'option 3',
                    4 => 'option 4',
                ]
            ],
            'nestedInput' => true
        ]);
        $expected = [
            ['div' => ['class' => 'form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-1',
                            'value' => 1
                        ]],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-2',
                            'value' => 2
                        ]],
                        'option 2',
                    '/label',
                '/div',
                ['fieldset' => ['class' => 'form-group']],
                    ['legend' => ['class' => 'col-form-label pt-0']],
                        'group',
                    '/legend',
                    ['div' => ['class' => 'form-check']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-3']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-3',
                                'value' => 3
                            ]],
                            'option 3',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-4']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-4',
                                'value' => 4
                            ]],
                            'option 4',
                        '/label',
                    '/div',
                 '/fieldset',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlOptionsGroupsAndSingleEntriesWithPerOptionConfigurationNestedInput()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
                4 => [
                    'text' => 'option 3',
                    'value' => 12,
                    'class' => 'custominputclass',
                    'label' => [
                        'class' => 'customlabelclass'
                    ]
                ],
                'group' => [
                    10 => 'option 4',
                    20 => [
                        'text' => 'option 4',
                        'value' => 20,
                        'class' => 'custominputclass'
                    ],
                    30 => [
                        'text' => 'option 5 without label',
                        'value' => 30,
                        'label' => false
                    ],
                    40 => [
                        'text' => 'option 6',
                        'value' => 40,
                        'label' => [
                            'class' => 'customlabelclass'
                        ]
                    ],
                ]
            ],
            'nestedInput' => true
        ]);
        $expected = [
            ['div' => ['class' => 'form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-1',
                            'value' => 1
                        ]],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-2',
                            'value' => 2
                        ]],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check']],
                    ['label' => ['class' => 'customlabelclass', 'for' => 'users-12']],
                        ['input' => [
                            'class' => 'custominputclass',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-12',
                            'value' => 12
                        ]],
                        'option 3',
                    '/label',
                '/div',
                ['fieldset' => ['class' => 'form-group']],
                    ['legend' => ['class' => 'col-form-label pt-0']],
                        'group',
                    '/legend',
                    ['div' => ['class' => 'form-check']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-10']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-10',
                                'value' => 10
                            ]],
                            'option 4',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-20']],
                            ['input' => [
                                'class' => 'custominputclass',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-20',
                                'value' => 20
                            ]],
                            'option 4',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-30',
                            'value' => 30
                        ]],
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['label' => ['class' => 'customlabelclass', 'for' => 'users-40']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-40',
                                'value' => 40
                            ]],
                            'option 6',
                        '/label',
                    '/div',
                 '/fieldset',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignMultipleCheckboxControl()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2'
            ]
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label d-block pt-0 col-sm-5']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'hidden',
                        'name' => 'users',
                        'value' => '',
                    ]],
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-1',
                            'value' => 1
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                            'option 1',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-2',
                            'value' => 2
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                            'option 2',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignMultipleCheckboxControlNestedInput()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2'
            ],
            'nestedInput' => true
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label d-block pt-0 col-sm-5']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'hidden',
                        'name' => 'users',
                        'value' => '',
                    ]],
                    ['div' => ['class' => 'form-check']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-1',
                                'value' => 1
                            ]],
                            'option 1',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-2',
                                'value' => 2
                            ]],
                            'option 2',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignMultipleCheckboxControlInline()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2'
            ],
            'inline' => true
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label d-block pt-0 col-sm-5']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'hidden',
                        'name' => 'users',
                        'value' => '',
                    ]],
                    ['div' => ['class' => 'form-check form-check-inline']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-1',
                            'value' => 1
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                            'option 1',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check form-check-inline']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-2',
                            'value' => 2
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                            'option 2',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignMultipleCheckboxControlInlineNestedInput()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2'
            ],
            'inline' => true,
            'nestedInput' => true
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label d-block pt-0 col-sm-5']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'hidden',
                        'name' => 'users',
                        'value' => '',
                    ]],
                    ['div' => ['class' => 'form-check form-check-inline']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-1',
                                'value' => 1
                            ]],
                            'option 1',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check form-check-inline']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-2',
                                'value' => 2
                            ]],
                            'option 2',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignMultipleCheckboxControlOptionGroups()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                'group 1' => [
                    1 => 'option 1',
                    2 => 'option 2'
                ],
                'group 2' => [
                    3 => 'option 3',
                    4 => 'option 4'
                ],
            ]
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label d-block pt-0 col-sm-5']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'hidden',
                        'name' => 'users',
                        'value' => '',
                    ]],
                    ['fieldset' => ['class' => 'form-group']],
                        ['legend' => ['class' => 'col-form-label pt-0']],
                            'group 1',
                        '/legend',
                        ['div' => ['class' => 'form-check']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-1',
                                'value' => 1
                            ]],
                            ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                                'option 1',
                            '/label',
                        '/div',
                        ['div' => ['class' => 'form-check']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-2',
                                'value' => 2
                            ]],
                            ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                                'option 2',
                            '/label',
                        '/div',
                     '/fieldset',
                    ['fieldset' => ['class' => 'form-group']],
                        ['legend' => ['class' => 'col-form-label pt-0']],
                            'group 2',
                        '/legend',
                        ['div' => ['class' => 'form-check']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-3',
                                'value' => 3
                            ]],
                            ['label' => ['class' => 'form-check-label', 'for' => 'users-3']],
                                'option 3',
                            '/label',
                        '/div',
                        ['div' => ['class' => 'form-check']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-4',
                                'value' => 4
                            ]],
                            ['label' => ['class' => 'form-check-label', 'for' => 'users-4']],
                                'option 4',
                            '/label',
                        '/div',
                     '/fieldset',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignMultipleCheckboxControlOptionGroupsNestedInput()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                'group 1' => [
                    1 => 'option 1',
                    2 => 'option 2'
                ],
                'group 2' => [
                    3 => 'option 3',
                    4 => 'option 4'
                ],
            ],
            'nestedInput' => true
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label d-block pt-0 col-sm-5']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'hidden',
                        'name' => 'users',
                        'value' => '',
                    ]],
                    ['fieldset' => ['class' => 'form-group']],
                        ['legend' => ['class' => 'col-form-label pt-0']],
                            'group 1',
                        '/legend',
                        ['div' => ['class' => 'form-check']],
                            ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                                ['input' => [
                                    'class' => 'form-check-input',
                                    'type' => 'checkbox',
                                    'name' => 'users[]',
                                    'id' => 'users-1',
                                    'value' => 1
                                ]],
                                'option 1',
                            '/label',
                        '/div',
                        ['div' => ['class' => 'form-check']],
                            ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                                ['input' => [
                                    'class' => 'form-check-input',
                                    'type' => 'checkbox',
                                    'name' => 'users[]',
                                    'id' => 'users-2',
                                    'value' => 2
                                ]],
                                'option 2',
                            '/label',
                        '/div',
                     '/fieldset',
                    ['fieldset' => ['class' => 'form-group']],
                        ['legend' => ['class' => 'col-form-label pt-0']],
                            'group 2',
                        '/legend',
                        ['div' => ['class' => 'form-check']],
                            ['label' => ['class' => 'form-check-label', 'for' => 'users-3']],
                                ['input' => [
                                    'class' => 'form-check-input',
                                    'type' => 'checkbox',
                                    'name' => 'users[]',
                                    'id' => 'users-3',
                                    'value' => 3
                                ]],
                                'option 3',
                            '/label',
                        '/div',
                        ['div' => ['class' => 'form-check']],
                            ['label' => ['class' => 'form-check-label', 'for' => 'users-4']],
                                ['input' => [
                                    'class' => 'form-check-input',
                                    'type' => 'checkbox',
                                    'name' => 'users[]',
                                    'id' => 'users-4',
                                    'value' => 4
                                ]],
                                'option 4',
                            '/label',
                        '/div',
                     '/fieldset',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignMultipleCheckboxControlOptionGroupsInline()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                'group 1' => [
                    1 => 'option 1',
                    2 => 'option 2'
                ],
                'group 2' => [
                    3 => 'option 3',
                    4 => 'option 4'
                ],
            ],
            'inline' => true
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label d-block pt-0 col-sm-5']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'hidden',
                        'name' => 'users',
                        'value' => '',
                    ]],
                    ['fieldset' => ['class' => 'form-group']],
                        ['legend' => ['class' => 'col-form-label pt-0']],
                            'group 1',
                        '/legend',
                        ['div' => ['class' => 'form-check form-check-inline']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-1',
                                'value' => 1
                            ]],
                            ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                                'option 1',
                            '/label',
                        '/div',
                        ['div' => ['class' => 'form-check form-check-inline']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-2',
                                'value' => 2
                            ]],
                            ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                                'option 2',
                            '/label',
                        '/div',
                     '/fieldset',
                    ['fieldset' => ['class' => 'form-group']],
                        ['legend' => ['class' => 'col-form-label pt-0']],
                            'group 2',
                        '/legend',
                        ['div' => ['class' => 'form-check form-check-inline']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-3',
                                'value' => 3
                            ]],
                            ['label' => ['class' => 'form-check-label', 'for' => 'users-3']],
                                'option 3',
                            '/label',
                        '/div',
                        ['div' => ['class' => 'form-check form-check-inline']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-4',
                                'value' => 4
                            ]],
                            ['label' => ['class' => 'form-check-label', 'for' => 'users-4']],
                                'option 4',
                            '/label',
                        '/div',
                     '/fieldset',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignMultipleCheckboxControlOptionGroupsInlineNestedInput()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                'group 1' => [
                    1 => 'option 1',
                    2 => 'option 2'
                ],
                'group 2' => [
                    3 => 'option 3',
                    4 => 'option 4'
                ],
            ],
            'inline' => true,
            'nestedInput' => true
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label d-block pt-0 col-sm-5']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'hidden',
                        'name' => 'users',
                        'value' => '',
                    ]],
                    ['fieldset' => ['class' => 'form-group']],
                        ['legend' => ['class' => 'col-form-label pt-0']],
                            'group 1',
                        '/legend',
                        ['div' => ['class' => 'form-check form-check-inline']],
                            ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                                ['input' => [
                                    'class' => 'form-check-input',
                                    'type' => 'checkbox',
                                    'name' => 'users[]',
                                    'id' => 'users-1',
                                    'value' => 1
                                ]],
                                'option 1',
                            '/label',
                        '/div',
                        ['div' => ['class' => 'form-check form-check-inline']],
                            ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                                ['input' => [
                                    'class' => 'form-check-input',
                                    'type' => 'checkbox',
                                    'name' => 'users[]',
                                    'id' => 'users-2',
                                    'value' => 2
                                ]],
                                'option 2',
                            '/label',
                        '/div',
                     '/fieldset',
                    ['fieldset' => ['class' => 'form-group']],
                        ['legend' => ['class' => 'col-form-label pt-0']],
                            'group 2',
                        '/legend',
                        ['div' => ['class' => 'form-check form-check-inline']],
                            ['label' => ['class' => 'form-check-label', 'for' => 'users-3']],
                                ['input' => [
                                    'class' => 'form-check-input',
                                    'type' => 'checkbox',
                                    'name' => 'users[]',
                                    'id' => 'users-3',
                                    'value' => 3
                                ]],
                                'option 3',
                            '/label',
                        '/div',
                        ['div' => ['class' => 'form-check form-check-inline']],
                            ['label' => ['class' => 'form-check-label', 'for' => 'users-4']],
                                ['input' => [
                                    'class' => 'form-check-input',
                                    'type' => 'checkbox',
                                    'name' => 'users[]',
                                    'id' => 'users-4',
                                    'value' => 4
                                ]],
                                'option 4',
                            '/label',
                        '/div',
                     '/fieldset',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignMultipleCheckboxControlOptionsGroupsAndSingleEntries()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
                'group' => [
                    3 => 'option 3',
                    4 => 'option 4',
                ]
            ]
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label d-block pt-0 col-sm-5']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'hidden',
                        'name' => 'users',
                        'value' => '',
                    ]],
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-1',
                            'value' => 1
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                            'option 1',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-2',
                            'value' => 2
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                            'option 2',
                        '/label',
                    '/div',
                    ['fieldset' => ['class' => 'form-group']],
                        ['legend' => ['class' => 'col-form-label pt-0']],
                            'group',
                        '/legend',
                        ['div' => ['class' => 'form-check']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-3',
                                'value' => 3
                            ]],
                            ['label' => ['class' => 'form-check-label', 'for' => 'users-3']],
                                'option 3',
                            '/label',
                        '/div',
                        ['div' => ['class' => 'form-check']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-4',
                                'value' => 4
                            ]],
                            ['label' => ['class' => 'form-check-label', 'for' => 'users-4']],
                                'option 4',
                            '/label',
                        '/div',
                     '/fieldset',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignMultipleCheckboxControlOptionsGroupsAndSingleEntriesWithPerOptionConfiguration()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
                4 => [
                    'text' => 'option 3',
                    'value' => 12,
                    'class' => 'custominputclass',
                    'label' => [
                        'class' => 'customlabelclass'
                    ]
                ],
                'group' => [
                    10 => 'option 4',
                    20 => [
                        'text' => 'option 4',
                        'value' => 20,
                        'class' => 'custominputclass'
                    ],
                    30 => [
                        'text' => 'option 5 without label',
                        'value' => 30,
                        'label' => false
                    ],
                    40 => [
                        'text' => 'option 6',
                        'value' => 40,
                        'label' => [
                            'class' => 'customlabelclass'
                        ]
                    ],
                ]
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label d-block pt-0 col-sm-5']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'hidden',
                        'name' => 'users',
                        'value' => '',
                    ]],
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-1',
                            'value' => 1
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                            'option 1',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-2',
                            'value' => 2
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                            'option 2',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'custominputclass',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-12',
                            'value' => 12
                        ]],
                        ['label' => ['class' => 'customlabelclass', 'for' => 'users-12']],
                            'option 3',
                        '/label',
                    '/div',
                    ['fieldset' => ['class' => 'form-group']],
                        ['legend' => ['class' => 'col-form-label pt-0']],
                            'group',
                        '/legend',
                        ['div' => ['class' => 'form-check']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-10',
                                'value' => 10
                            ]],
                            ['label' => ['class' => 'form-check-label', 'for' => 'users-10']],
                                'option 4',
                            '/label',
                        '/div',
                        ['div' => ['class' => 'form-check']],
                            ['input' => [
                                'class' => 'custominputclass',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-20',
                                'value' => 20
                            ]],
                            ['label' => ['class' => 'form-check-label', 'for' => 'users-20']],
                                'option 4',
                            '/label',
                        '/div',
                        ['div' => ['class' => 'form-check']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-30',
                                'value' => 30
                            ]],
                        '/div',
                        ['div' => ['class' => 'form-check']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-40',
                                'value' => 40
                            ]],
                            ['label' => ['class' => 'customlabelclass', 'for' => 'users-40']],
                                'option 6',
                            '/label',
                        '/div',
                     '/fieldset',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignMultipleCheckboxControlOptionsGroupsAndSingleEntriesNestedInput()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
                'group' => [
                    3 => 'option 3',
                    4 => 'option 4',
                ]
            ],
            'nestedInput' => true
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label d-block pt-0 col-sm-5']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'hidden',
                        'name' => 'users',
                        'value' => '',
                    ]],
                    ['div' => ['class' => 'form-check']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-1',
                                'value' => 1
                            ]],
                            'option 1',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-2',
                                'value' => 2
                            ]],
                            'option 2',
                        '/label',
                    '/div',
                    ['fieldset' => ['class' => 'form-group']],
                        ['legend' => ['class' => 'col-form-label pt-0']],
                            'group',
                        '/legend',
                        ['div' => ['class' => 'form-check']],
                            ['label' => ['class' => 'form-check-label', 'for' => 'users-3']],
                                ['input' => [
                                    'class' => 'form-check-input',
                                    'type' => 'checkbox',
                                    'name' => 'users[]',
                                    'id' => 'users-3',
                                    'value' => 3
                                ]],
                                'option 3',
                            '/label',
                        '/div',
                        ['div' => ['class' => 'form-check']],
                            ['label' => ['class' => 'form-check-label', 'for' => 'users-4']],
                                ['input' => [
                                    'class' => 'form-check-input',
                                    'type' => 'checkbox',
                                    'name' => 'users[]',
                                    'id' => 'users-4',
                                    'value' => 4
                                ]],
                                'option 4',
                            '/label',
                        '/div',
                     '/fieldset',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignMultipleCheckboxControlOptionsGroupsAndSingleEntriesWithPerOptionConfigurationNestedInput()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
                4 => [
                    'text' => 'option 3',
                    'value' => 12,
                    'class' => 'custominputclass',
                    'label' => [
                        'class' => 'customlabelclass'
                    ]
                ],
                'group' => [
                    10 => 'option 4',
                    20 => [
                        'text' => 'option 4',
                        'value' => 20,
                        'class' => 'custominputclass'
                    ],
                    30 => [
                        'text' => 'option 5 without label',
                        'value' => 30,
                        'label' => false
                    ],
                    40 => [
                        'text' => 'option 6',
                        'value' => 40,
                        'label' => [
                            'class' => 'customlabelclass'
                        ]
                    ],
                ]
            ],
            'nestedInput' => true
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label d-block pt-0 col-sm-5']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'hidden',
                        'name' => 'users',
                        'value' => '',
                    ]],
                    ['div' => ['class' => 'form-check']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-1',
                                'value' => 1
                            ]],
                            'option 1',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-2',
                                'value' => 2
                            ]],
                            'option 2',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['label' => ['class' => 'customlabelclass', 'for' => 'users-12']],
                            ['input' => [
                                'class' => 'custominputclass',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-12',
                                'value' => 12
                            ]],
                            'option 3',
                        '/label',
                    '/div',
                    ['fieldset' => ['class' => 'form-group']],
                        ['legend' => ['class' => 'col-form-label pt-0']],
                            'group',
                        '/legend',
                        ['div' => ['class' => 'form-check']],
                            ['label' => ['class' => 'form-check-label', 'for' => 'users-10']],
                                ['input' => [
                                    'class' => 'form-check-input',
                                    'type' => 'checkbox',
                                    'name' => 'users[]',
                                    'id' => 'users-10',
                                    'value' => 10
                                ]],
                                'option 4',
                            '/label',
                        '/div',
                        ['div' => ['class' => 'form-check']],
                            ['label' => ['class' => 'form-check-label', 'for' => 'users-20']],
                                ['input' => [
                                    'class' => 'custominputclass',
                                    'type' => 'checkbox',
                                    'name' => 'users[]',
                                    'id' => 'users-20',
                                    'value' => 20
                                ]],
                                'option 4',
                            '/label',
                        '/div',
                        ['div' => ['class' => 'form-check']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-30',
                                'value' => 30
                            ]],
                        '/div',
                        ['div' => ['class' => 'form-check']],
                            ['label' => ['class' => 'customlabelclass', 'for' => 'users-40']],
                                ['input' => [
                                    'class' => 'form-check-input',
                                    'type' => 'checkbox',
                                    'name' => 'users[]',
                                    'id' => 'users-40',
                                    'value' => 40
                                ]],
                                'option 6',
                            '/label',
                        '/div',
                     '/fieldset',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignMultipleCheckboxControl()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline'
            ]);
        });

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2'
            ]
        ]);
        $expected = [
            ['div' => ['class' => 'form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['span' => ['id' => 'users-group-label', 'class' => 'sr-only']],
                    'Users',
                '/span',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'value' => 1
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'value' => 2
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignMultipleCheckboxControlWithPerOptionConfiguration()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline'
            ]);
        });

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
                4 => [
                    'text' => 'option 3',
                    'value' => 12,
                    'class' => 'custominputclass',
                    'label' => [
                        'class' => 'customlabelclass'
                    ]
                ],
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['span' => ['id' => 'users-group-label', 'class' => 'sr-only']],
                    'Users',
                '/span',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'value' => 1
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'value' => 2
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'custominputclass',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-12',
                        'value' => 12
                    ]],
                    ['label' => ['class' => 'customlabelclass', 'for' => 'users-12']],
                        'option 3',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignMultipleCheckboxControlNestedInput()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline'
            ]);
        });

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2'
            ],
            'nestedInput' => true
        ]);
        $expected = [
            ['div' => ['class' => 'form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['span' => ['id' => 'users-group-label', 'class' => 'sr-only']],
                    'Users',
                '/span',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-1',
                            'value' => 1
                        ]],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-2',
                            'value' => 2
                        ]],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignMultipleCheckboxControlWithPerOptionConfigurationNestedInput()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline'
            ]);
        });

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
                4 => [
                    'text' => 'option 3',
                    'value' => 12,
                    'class' => 'custominputclass',
                    'label' => [
                        'class' => 'customlabelclass'
                    ]
                ],
            ],
            'nestedInput' => true
        ]);
        $expected = [
            ['div' => ['class' => 'form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['span' => ['id' => 'users-group-label', 'class' => 'sr-only']],
                    'Users',
                '/span',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-1',
                            'value' => 1
                        ]],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-2',
                            'value' => 2
                        ]],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['label' => ['class' => 'customlabelclass', 'for' => 'users-12']],
                        ['input' => [
                            'class' => 'custominputclass',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-12',
                            'value' => 12
                        ]],
                        'option 3',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignSubmit()
    {
        $this->Form->create($this->article);

        $result = $this->Form->submit('Submit');
        $expected = [
            'div' => ['class' => 'submit'],
                'input' => [
                    'type' => 'submit',
                    'value' => 'Submit',
                    'class' => 'btn-primary btn',
                ],
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignSubmit()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->submit('Submit');
        $expected = [
            'div' => ['class' => 'form-group row'],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    'input' => [
                        'type' => 'submit',
                        'value' => 'Submit',
                        'class' => 'btn-primary btn',
                    ],
                '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignSubmit()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline'
            ]);
        });

        $result = $this->Form->submit('Submit');
        $expected = [
            'div' => ['class' => 'submit'],
                'input' => [
                    'type' => 'submit',
                    'value' => 'Submit',
                    'class' => 'btn-primary btn',
                ],
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomCheckboxControl()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'custom' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group custom-control custom-checkbox checkbox']],
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => 0,
                ]],
                ['input' => [
                    'type' => 'checkbox',
                    'name' => 'users',
                    'value' => '1',
                    'id' => 'users',
                    'class' => 'custom-control-input',
                ]],
                ['label' => ['class' => 'custom-control-label', 'for' => 'users']],
                    'Users',
                '/label',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomCheckboxControlInline()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'custom' => true,
            'inline' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group custom-control custom-checkbox custom-control-inline checkbox']],
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => 0,
                ]],
                ['input' => [
                    'type' => 'checkbox',
                    'name' => 'users',
                    'value' => '1',
                    'id' => 'users',
                    'class' => 'custom-control-input',
                ]],
                ['label' => ['class' => 'custom-control-label', 'for' => 'users']],
                    'Users',
                '/label',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCustomCheckboxControl()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'custom' => true,
        ]);
        $expected = [
            'div' => ['class' => 'form-group row checkbox'],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'custom-control custom-checkbox']],
                        ['input' => [
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['input' => [
                            'type' => 'checkbox',
                            'name' => 'users',
                            'value' => '1',
                            'id' => 'users',
                            'class' => 'custom-control-input',
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users']],
                            'Users',
                        '/label',
                    '/div',
                '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCustomCheckboxControlInline()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'custom' => true,
            'inline' => true,
        ]);
        $expected = [
            'div' => ['class' => 'form-group row checkbox'],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'custom-control custom-checkbox']],
                        ['input' => [
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['input' => [
                            'type' => 'checkbox',
                            'name' => 'users',
                            'value' => '1',
                            'id' => 'users',
                            'class' => 'custom-control-input',
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users']],
                            'Users',
                        '/label',
                    '/div',
                '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomCheckboxControl()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline'
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'custom' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group custom-control custom-checkbox custom-control-inline checkbox']],
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => 0,
                ]],
                ['input' => [
                    'type' => 'checkbox',
                    'name' => 'users',
                    'value' => '1',
                    'id' => 'users',
                    'class' => 'custom-control-input',
                ]],
                ['label' => ['class' => 'custom-control-label', 'for' => 'users']],
                    'Users',
                '/label',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomCheckboxControlInline()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline'
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'custom' => true,
            'inline' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group custom-control custom-checkbox custom-control-inline checkbox']],
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => 0,
                ]],
                ['input' => [
                    'type' => 'checkbox',
                    'name' => 'users',
                    'value' => '1',
                    'id' => 'users',
                    'class' => 'custom-control-input',
                ]],
                ['label' => ['class' => 'custom-control-label', 'for' => 'users']],
                    'Users',
                '/label',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomRadioControl()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2'
            ],
            'custom' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'custom-control custom-radio']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-1',
                        'value' => 1
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'custom-control custom-radio']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'value' => 2
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomRadioControlInline()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2'
            ],
            'custom' => true,
            'inline' => true
        ]);
        $expected = [
            ['div' => ['class' => 'form-group radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'custom-control custom-radio custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-1',
                        'value' => 1
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'custom-control custom-radio custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'value' => 2
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomRadioControlPerOptionConfiguration()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
                4 => [
                    'text' => 'option 3',
                    'value' => 12,
                    'class' => 'custominputclass',
                    'label' => [
                        'class' => 'customlabelclass'
                    ]
                ],
            ],
            'custom' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'custom-control custom-radio']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-1',
                        'value' => 1
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'custom-control custom-radio']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'value' => 2
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['class' => 'custom-control custom-radio']],
                    ['input' => [
                        'class' => 'custominputclass',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-12',
                        'value' => 12
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-12']],
                        'option 3',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomRadioControlPerOptionConfigurationInline()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
                4 => [
                    'text' => 'option 3',
                    'value' => 12,
                    'class' => 'custominputclass',
                    'label' => [
                        'class' => 'customlabelclass'
                    ]
                ],
            ],
            'custom' => true,
            'inline' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'custom-control custom-radio custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-1',
                        'value' => 1
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'custom-control custom-radio custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'value' => 2
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['class' => 'custom-control custom-radio custom-control-inline']],
                    ['input' => [
                        'class' => 'custominputclass',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-12',
                        'value' => 12
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-12']],
                        'option 3',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCustomRadioControl()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2'
            ],
            'custom' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label d-block pt-0 col-sm-5']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'hidden',
                        'name' => 'users',
                        'value' => '',
                    ]],
                    ['div' => ['class' => 'custom-control custom-radio']],
                        ['input' => [
                            'class' => 'custom-control-input',
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-1',
                            'value' => 1
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                            'option 1',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'custom-control custom-radio']],
                        ['input' => [
                            'class' => 'custom-control-input',
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-2',
                            'value' => 2
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                            'option 2',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCustomRadioControlInline()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2'
            ],
            'custom' => true,
            'inline' => true
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label d-block pt-0 col-sm-5']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'hidden',
                        'name' => 'users',
                        'value' => '',
                    ]],
                    ['div' => ['class' => 'custom-control custom-radio custom-control-inline']],
                        ['input' => [
                            'class' => 'custom-control-input',
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-1',
                            'value' => 1
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                            'option 1',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'custom-control custom-radio custom-control-inline']],
                        ['input' => [
                            'class' => 'custom-control-input',
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-2',
                            'value' => 2
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                            'option 2',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCustomRadioControlPerOptionConfiguration()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
                4 => [
                    'text' => 'option 3',
                    'value' => 12,
                    'class' => 'custominputclass',
                    'label' => [
                        'class' => 'customlabelclass'
                    ]
                ],
            ],
            'custom' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label d-block pt-0 col-sm-5']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'hidden',
                        'name' => 'users',
                        'value' => '',
                    ]],
                    ['div' => ['class' => 'custom-control custom-radio']],
                        ['input' => [
                            'class' => 'custom-control-input',
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-1',
                            'value' => 1
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                            'option 1',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'custom-control custom-radio']],
                        ['input' => [
                            'class' => 'custom-control-input',
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-2',
                            'value' => 2
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                            'option 2',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'custom-control custom-radio']],
                        ['input' => [
                            'class' => 'custominputclass',
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-12',
                            'value' => 12
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users-12']],
                            'option 3',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCustomRadioControlPerOptionConfigurationInline()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
                4 => [
                    'text' => 'option 3',
                    'value' => 12,
                    'class' => 'custominputclass',
                    'label' => [
                        'class' => 'customlabelclass'
                    ]
                ],
            ],
            'custom' => true,
            'inline' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label d-block pt-0 col-sm-5']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'hidden',
                        'name' => 'users',
                        'value' => '',
                    ]],
                    ['div' => ['class' => 'custom-control custom-radio custom-control-inline']],
                        ['input' => [
                            'class' => 'custom-control-input',
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-1',
                            'value' => 1
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                            'option 1',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'custom-control custom-radio custom-control-inline']],
                        ['input' => [
                            'class' => 'custom-control-input',
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-2',
                            'value' => 2
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                            'option 2',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'custom-control custom-radio custom-control-inline']],
                        ['input' => [
                            'class' => 'custominputclass',
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-12',
                            'value' => 12
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users-12']],
                            'option 3',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomRadioControl()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline'
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2'
            ],
            'custom' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['span' => ['id' => 'users-group-label', 'class' => 'sr-only']],
                    'Users',
                '/span',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'custom-control custom-radio custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-1',
                        'value' => 1
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'custom-control custom-radio custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'value' => 2
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomRadioControlWithPerOptionConfiguration()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline'
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
                4 => [
                    'text' => 'option 3',
                    'value' => 12,
                    'class' => 'custominputclass',
                    'label' => [
                        'class' => 'customlabelclass'
                    ]
                ],
            ],
            'custom' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['span' => ['id' => 'users-group-label', 'class' => 'sr-only']],
                    'Users',
                '/span',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'custom-control custom-radio custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-1',
                        'value' => 1
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'custom-control custom-radio custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'value' => 2
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['class' => 'custom-control custom-radio custom-control-inline']],
                    ['input' => [
                        'class' => 'custominputclass',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-12',
                        'value' => 12
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-12']],
                        'option 3',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomMultipleCheckboxControl()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2'
            ],
            'custom' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'custom-control custom-checkbox']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'value' => 1
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'custom-control custom-checkbox']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'value' => 2
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomMultipleCheckboxControlInline()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2'
            ],
            'custom' => true,
            'inline' => true
        ]);
        $expected = [
            ['div' => ['class' => 'form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'custom-control custom-checkbox custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'value' => 1
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'custom-control custom-checkbox custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'value' => 2
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomMultipleCheckboxControlOptionGroups()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                'group 1' => [
                    1 => 'option 1',
                    2 => 'option 2'
                ],
                'group 2' => [
                    3 => 'option 3',
                    4 => 'option 4'
                ],
            ],
            'custom' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['fieldset' => ['class' => 'form-group']],
                    ['legend' => ['class' => 'col-form-label pt-0']],
                        'group 1',
                    '/legend',
                    ['div' => ['class' => 'custom-control custom-checkbox']],
                        ['input' => [
                            'class' => 'custom-control-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-1',
                            'value' => 1
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                            'option 1',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'custom-control custom-checkbox']],
                        ['input' => [
                            'class' => 'custom-control-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-2',
                            'value' => 2
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                            'option 2',
                        '/label',
                    '/div',
                 '/fieldset',
                ['fieldset' => ['class' => 'form-group']],
                    ['legend' => ['class' => 'col-form-label pt-0']],
                        'group 2',
                    '/legend',
                    ['div' => ['class' => 'custom-control custom-checkbox']],
                        ['input' => [
                            'class' => 'custom-control-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-3',
                            'value' => 3
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users-3']],
                            'option 3',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'custom-control custom-checkbox']],
                        ['input' => [
                            'class' => 'custom-control-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-4',
                            'value' => 4
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users-4']],
                            'option 4',
                        '/label',
                    '/div',
                 '/fieldset',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomMultipleCheckboxControlOptionGroupsInline()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                'group 1' => [
                    1 => 'option 1',
                    2 => 'option 2'
                ],
                'group 2' => [
                    3 => 'option 3',
                    4 => 'option 4'
                ],
            ],
            'custom' => true,
            'inline' => true
        ]);
        $expected = [
            ['div' => ['class' => 'form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['fieldset' => ['class' => 'form-group']],
                    ['legend' => ['class' => 'col-form-label pt-0']],
                        'group 1',
                    '/legend',
                    ['div' => ['class' => 'custom-control custom-checkbox custom-control-inline']],
                        ['input' => [
                            'class' => 'custom-control-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-1',
                            'value' => 1
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                            'option 1',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'custom-control custom-checkbox custom-control-inline']],
                        ['input' => [
                            'class' => 'custom-control-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-2',
                            'value' => 2
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                            'option 2',
                        '/label',
                    '/div',
                 '/fieldset',
                ['fieldset' => ['class' => 'form-group']],
                    ['legend' => ['class' => 'col-form-label pt-0']],
                        'group 2',
                    '/legend',
                    ['div' => ['class' => 'custom-control custom-checkbox custom-control-inline']],
                        ['input' => [
                            'class' => 'custom-control-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-3',
                            'value' => 3
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users-3']],
                            'option 3',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'custom-control custom-checkbox custom-control-inline']],
                        ['input' => [
                            'class' => 'custom-control-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-4',
                            'value' => 4
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users-4']],
                            'option 4',
                        '/label',
                    '/div',
                 '/fieldset',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomMultipleCheckboxControlOptionsGroupsAndSingleEntries()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
                'group' => [
                    3 => 'option 3',
                    4 => 'option 4',
                ]
            ],
            'custom' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'custom-control custom-checkbox']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'value' => 1
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'custom-control custom-checkbox']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'value' => 2
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['fieldset' => ['class' => 'form-group']],
                    ['legend' => ['class' => 'col-form-label pt-0']],
                        'group',
                    '/legend',
                    ['div' => ['class' => 'custom-control custom-checkbox']],
                        ['input' => [
                            'class' => 'custom-control-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-3',
                            'value' => 3
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users-3']],
                            'option 3',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'custom-control custom-checkbox']],
                        ['input' => [
                            'class' => 'custom-control-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-4',
                            'value' => 4
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users-4']],
                            'option 4',
                        '/label',
                    '/div',
                 '/fieldset',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomMultipleCheckboxControlOptionsGroupsAndSingleEntriesWithPerOptionConfiguration()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
                4 => [
                    'text' => 'option 3',
                    'value' => 12,
                    'class' => 'custominputclass',
                    'label' => [
                        'class' => 'customlabelclass'
                    ]
                ],
                'group' => [
                    10 => 'option 4',
                    20 => [
                        'text' => 'option 4',
                        'value' => 20,
                        'class' => 'custominputclass'
                    ],
                    40 => [
                        'text' => 'option 6',
                        'value' => 40,
                        'label' => [
                            'class' => 'customlabelclass'
                        ]
                    ],
                ]
            ],
            'custom' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'custom-control custom-checkbox']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'value' => 1
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'custom-control custom-checkbox']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'value' => 2
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['class' => 'custom-control custom-checkbox']],
                    ['input' => [
                        'class' => 'custominputclass',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-12',
                        'value' => 12
                    ]],
                    ['label' => ['class' => 'customlabelclass', 'for' => 'users-12']],
                        'option 3',
                    '/label',
                '/div',
                ['fieldset' => ['class' => 'form-group']],
                    ['legend' => ['class' => 'col-form-label pt-0']],
                        'group',
                    '/legend',
                    ['div' => ['class' => 'custom-control custom-checkbox']],
                        ['input' => [
                            'class' => 'custom-control-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-10',
                            'value' => 10
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users-10']],
                            'option 4',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'custom-control custom-checkbox']],
                        ['input' => [
                            'class' => 'custominputclass',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-20',
                            'value' => 20
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users-20']],
                            'option 4',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'custom-control custom-checkbox']],
                        ['input' => [
                            'class' => 'custom-control-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-40',
                            'value' => 40
                        ]],
                        ['label' => ['class' => 'customlabelclass', 'for' => 'users-40']],
                            'option 6',
                        '/label',
                    '/div',
                 '/fieldset',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCustomMultipleCheckboxControl()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2'
            ],
            'custom' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label d-block pt-0 col-sm-5']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'hidden',
                        'name' => 'users',
                        'value' => '',
                    ]],
                    ['div' => ['class' => 'custom-control custom-checkbox']],
                        ['input' => [
                            'class' => 'custom-control-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-1',
                            'value' => 1
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                            'option 1',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'custom-control custom-checkbox']],
                        ['input' => [
                            'class' => 'custom-control-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-2',
                            'value' => 2
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                            'option 2',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCustomMultipleCheckboxControlInline()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2'
            ],
            'custom' => true,
            'inline' => true
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label d-block pt-0 col-sm-5']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'hidden',
                        'name' => 'users',
                        'value' => '',
                    ]],
                    ['div' => ['class' => 'custom-control custom-checkbox custom-control-inline']],
                        ['input' => [
                            'class' => 'custom-control-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-1',
                            'value' => 1
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                            'option 1',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'custom-control custom-checkbox custom-control-inline']],
                        ['input' => [
                            'class' => 'custom-control-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-2',
                            'value' => 2
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                            'option 2',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCustomMultipleCheckboxControlOptionGroups()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                'group 1' => [
                    1 => 'option 1',
                    2 => 'option 2'
                ],
                'group 2' => [
                    3 => 'option 3',
                    4 => 'option 4'
                ],
            ],
            'custom' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label d-block pt-0 col-sm-5']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'hidden',
                        'name' => 'users',
                        'value' => '',
                    ]],
                    ['fieldset' => ['class' => 'form-group']],
                        ['legend' => ['class' => 'col-form-label pt-0']],
                            'group 1',
                        '/legend',
                        ['div' => ['class' => 'custom-control custom-checkbox']],
                            ['input' => [
                                'class' => 'custom-control-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-1',
                                'value' => 1
                            ]],
                            ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                                'option 1',
                            '/label',
                        '/div',
                        ['div' => ['class' => 'custom-control custom-checkbox']],
                            ['input' => [
                                'class' => 'custom-control-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-2',
                                'value' => 2
                            ]],
                            ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                                'option 2',
                            '/label',
                        '/div',
                     '/fieldset',
                    ['fieldset' => ['class' => 'form-group']],
                        ['legend' => ['class' => 'col-form-label pt-0']],
                            'group 2',
                        '/legend',
                        ['div' => ['class' => 'custom-control custom-checkbox']],
                            ['input' => [
                                'class' => 'custom-control-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-3',
                                'value' => 3
                            ]],
                            ['label' => ['class' => 'custom-control-label', 'for' => 'users-3']],
                                'option 3',
                            '/label',
                        '/div',
                        ['div' => ['class' => 'custom-control custom-checkbox']],
                            ['input' => [
                                'class' => 'custom-control-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-4',
                                'value' => 4
                            ]],
                            ['label' => ['class' => 'custom-control-label', 'for' => 'users-4']],
                                'option 4',
                            '/label',
                        '/div',
                     '/fieldset',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCustomMultipleCheckboxControlOptionGroupsInline()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                'group 1' => [
                    1 => 'option 1',
                    2 => 'option 2'
                ],
                'group 2' => [
                    3 => 'option 3',
                    4 => 'option 4'
                ],
            ],
            'custom' => true,
            'inline' => true
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label d-block pt-0 col-sm-5']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'hidden',
                        'name' => 'users',
                        'value' => '',
                    ]],
                    ['fieldset' => ['class' => 'form-group']],
                        ['legend' => ['class' => 'col-form-label pt-0']],
                            'group 1',
                        '/legend',
                        ['div' => ['class' => 'custom-control custom-checkbox custom-control-inline']],
                            ['input' => [
                                'class' => 'custom-control-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-1',
                                'value' => 1
                            ]],
                            ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                                'option 1',
                            '/label',
                        '/div',
                        ['div' => ['class' => 'custom-control custom-checkbox custom-control-inline']],
                            ['input' => [
                                'class' => 'custom-control-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-2',
                                'value' => 2
                            ]],
                            ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                                'option 2',
                            '/label',
                        '/div',
                     '/fieldset',
                    ['fieldset' => ['class' => 'form-group']],
                        ['legend' => ['class' => 'col-form-label pt-0']],
                            'group 2',
                        '/legend',
                        ['div' => ['class' => 'custom-control custom-checkbox custom-control-inline']],
                            ['input' => [
                                'class' => 'custom-control-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-3',
                                'value' => 3
                            ]],
                            ['label' => ['class' => 'custom-control-label', 'for' => 'users-3']],
                                'option 3',
                            '/label',
                        '/div',
                        ['div' => ['class' => 'custom-control custom-checkbox custom-control-inline']],
                            ['input' => [
                                'class' => 'custom-control-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-4',
                                'value' => 4
                            ]],
                            ['label' => ['class' => 'custom-control-label', 'for' => 'users-4']],
                                'option 4',
                            '/label',
                        '/div',
                     '/fieldset',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCustomMultipleCheckboxControlOptionsGroupsAndSingleEntries()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
                'group' => [
                    3 => 'option 3',
                    4 => 'option 4',
                ]
            ],
            'custom' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label d-block pt-0 col-sm-5']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'hidden',
                        'name' => 'users',
                        'value' => '',
                    ]],
                    ['div' => ['class' => 'custom-control custom-checkbox']],
                        ['input' => [
                            'class' => 'custom-control-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-1',
                            'value' => 1
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                            'option 1',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'custom-control custom-checkbox']],
                        ['input' => [
                            'class' => 'custom-control-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-2',
                            'value' => 2
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                            'option 2',
                        '/label',
                    '/div',
                    ['fieldset' => ['class' => 'form-group']],
                        ['legend' => ['class' => 'col-form-label pt-0']],
                            'group',
                        '/legend',
                        ['div' => ['class' => 'custom-control custom-checkbox']],
                            ['input' => [
                                'class' => 'custom-control-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-3',
                                'value' => 3
                            ]],
                            ['label' => ['class' => 'custom-control-label', 'for' => 'users-3']],
                                'option 3',
                            '/label',
                        '/div',
                        ['div' => ['class' => 'custom-control custom-checkbox']],
                            ['input' => [
                                'class' => 'custom-control-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-4',
                                'value' => 4
                            ]],
                            ['label' => ['class' => 'custom-control-label', 'for' => 'users-4']],
                                'option 4',
                            '/label',
                        '/div',
                     '/fieldset',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCustomMultipleCheckboxControlOptionsGroupsAndSingleEntriesWithPerOptionConfiguration()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
                4 => [
                    'text' => 'option 3',
                    'value' => 12,
                    'class' => 'custominputclass',
                    'label' => [
                        'class' => 'customlabelclass'
                    ]
                ],
                'group' => [
                    10 => 'option 4',
                    20 => [
                        'text' => 'option 4',
                        'value' => 20,
                        'class' => 'custominputclass'
                    ],
                    40 => [
                        'text' => 'option 6',
                        'value' => 40,
                        'label' => [
                            'class' => 'customlabelclass'
                        ]
                    ],
                ]
            ],
            'custom' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label d-block pt-0 col-sm-5']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'hidden',
                        'name' => 'users',
                        'value' => '',
                    ]],
                    ['div' => ['class' => 'custom-control custom-checkbox']],
                        ['input' => [
                            'class' => 'custom-control-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-1',
                            'value' => 1
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                            'option 1',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'custom-control custom-checkbox']],
                        ['input' => [
                            'class' => 'custom-control-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-2',
                            'value' => 2
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                            'option 2',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'custom-control custom-checkbox']],
                        ['input' => [
                            'class' => 'custominputclass',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-12',
                            'value' => 12
                        ]],
                        ['label' => ['class' => 'customlabelclass', 'for' => 'users-12']],
                            'option 3',
                        '/label',
                    '/div',
                    ['fieldset' => ['class' => 'form-group']],
                        ['legend' => ['class' => 'col-form-label pt-0']],
                            'group',
                        '/legend',
                        ['div' => ['class' => 'custom-control custom-checkbox']],
                            ['input' => [
                                'class' => 'custom-control-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-10',
                                'value' => 10
                            ]],
                            ['label' => ['class' => 'custom-control-label', 'for' => 'users-10']],
                                'option 4',
                            '/label',
                        '/div',
                        ['div' => ['class' => 'custom-control custom-checkbox']],
                            ['input' => [
                                'class' => 'custominputclass',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-20',
                                'value' => 20
                            ]],
                            ['label' => ['class' => 'custom-control-label', 'for' => 'users-20']],
                                'option 4',
                            '/label',
                        '/div',
                        ['div' => ['class' => 'custom-control custom-checkbox']],
                            ['input' => [
                                'class' => 'custom-control-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-40',
                                'value' => 40
                            ]],
                            ['label' => ['class' => 'customlabelclass', 'for' => 'users-40']],
                                'option 6',
                            '/label',
                        '/div',
                     '/fieldset',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomMultipleCheckboxControl()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline'
            ]);
        });

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2'
            ],
            'custom' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['span' => ['id' => 'users-group-label', 'class' => 'sr-only']],
                    'Users',
                '/span',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'custom-control custom-checkbox custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'value' => 1
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'custom-control custom-checkbox custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'value' => 2
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomMultipleCheckboxControlWithPerOptionConfiguration()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline'
            ]);
        });

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
                4 => [
                    'text' => 'option 3',
                    'value' => 12,
                    'class' => 'custominputclass',
                    'label' => [
                        'class' => 'customlabelclass'
                    ]
                ],
            ],
            'custom' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['span' => ['id' => 'users-group-label', 'class' => 'sr-only']],
                    'Users',
                '/span',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'custom-control custom-checkbox custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'value' => 1
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'custom-control custom-checkbox custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'value' => 2
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['class' => 'custom-control custom-checkbox custom-control-inline']],
                    ['input' => [
                        'class' => 'custominputclass',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-12',
                        'value' => 12
                    ]],
                    ['label' => ['class' => 'customlabelclass', 'for' => 'users-12']],
                        'option 3',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomSelectControl()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'select',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'custom' => true
        ]);
        $expected = [
            ['div' => ['class' => 'form-group select']],
                ['label' => ['for' => 'users']],
                    'Users',
                '/label',
                ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'custom-select']],
                    ['option' => ['value' => '1']],
                        'option 1',
                    '/option',
                    ['option' => ['value' => '2']],
                        'option 2',
                    '/option',
                '/select',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomSelectControlInputGroupAppend()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'select',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'custom' => true,
            'append' => 'append',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group select']],
                ['label' => ['for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['class' => 'input-group']],
                    ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'custom-select']],
                        ['option' => ['value' => '1']],
                            'option 1',
                        '/option',
                        ['option' => ['value' => '2']],
                            'option 2',
                        '/option',
                    '/select',
                    ['div' => ['class' => 'input-group-append']],
                        ['span' => ['class' => 'input-group-text']],
                            'append',
                        '/span',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomSelectControlInputGroupPrepend()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'select',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'custom' => true,
            'prepend' => 'prepend',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group select']],
                ['label' => ['for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['class' => 'input-group']],
                    ['div' => ['class' => 'input-group-prepend']],
                        ['span' => ['class' => 'input-group-text']],
                            'prepend',
                        '/span',
                    '/div',
                    ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'custom-select']],
                        ['option' => ['value' => '1']],
                            'option 1',
                        '/option',
                        ['option' => ['value' => '2']],
                            'option 2',
                        '/option',
                    '/select',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCustomSelectControl()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'type' => 'select',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'custom' => true
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row select']],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'custom-select']],
                        ['option' => ['value' => '1']],
                            'option 1',
                        '/option',
                        ['option' => ['value' => '2']],
                            'option 2',
                        '/option',
                    '/select',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCustomSelectControlInputGroupAppend()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'type' => 'select',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'custom' => true,
            'append' => 'append',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row select']],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['div' => ['class' => 'input-group']],
                        ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'custom-select']],
                            ['option' => ['value' => '1']],
                                'option 1',
                            '/option',
                            ['option' => ['value' => '2']],
                                'option 2',
                            '/option',
                        '/select',
                        ['div' => ['class' => 'input-group-append']],
                            ['span' => ['class' => 'input-group-text']],
                                'append',
                            '/span',
                        '/div',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCustomSelectControlInputGroupPrepend()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('users', [
            'type' => 'select',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'custom' => true,
            'prepend' => 'prepend',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row select']],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['div' => ['class' => 'input-group']],
                        ['div' => ['class' => 'input-group-prepend']],
                            ['span' => ['class' => 'input-group-text']],
                                'prepend',
                            '/span',
                        '/div',
                        ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'custom-select']],
                            ['option' => ['value' => '1']],
                                'option 1',
                            '/option',
                            ['option' => ['value' => '2']],
                                'option 2',
                            '/option',
                        '/select',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomSelectControl()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline'
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'select',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'custom' => true
        ]);
        $expected = [
            ['div' => ['class' => 'form-group select']],
                ['label' => ['class' => 'sr-only', 'for' => 'users']],
                    'Users',
                '/label',
                ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'custom-select']],
                    ['option' => ['value' => '1']],
                        'option 1',
                    '/option',
                    ['option' => ['value' => '2']],
                        'option 2',
                    '/option',
                '/select',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomSelectControlInputGroupAppend()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline'
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'select',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'custom' => true,
            'append' => 'append',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group select']],
                ['label' => ['class' => 'sr-only', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['class' => 'input-group']],
                    ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'custom-select']],
                        ['option' => ['value' => '1']],
                            'option 1',
                        '/option',
                        ['option' => ['value' => '2']],
                            'option 2',
                        '/option',
                    '/select',
                    ['div' => ['class' => 'input-group-append']],
                        ['span' => ['class' => 'input-group-text']],
                            'append',
                        '/span',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomSelectControlInputGroupPrepend()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline'
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'select',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'custom' => true,
            'prepend' => 'prepend',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group select']],
                ['label' => ['class' => 'sr-only', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['class' => 'input-group']],
                    ['div' => ['class' => 'input-group-prepend']],
                        ['span' => ['class' => 'input-group-text']],
                            'prepend',
                        '/span',
                    '/div',
                    ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'custom-select']],
                        ['option' => ['value' => '1']],
                            'option 1',
                        '/option',
                        ['option' => ['value' => '2']],
                            'option 2',
                        '/option',
                    '/select',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomFileControl()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'custom' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group file']],
                ['div' => ['class' => 'custom-file']],
                    ['input' => [
                        'type' => 'file',
                        'name' => 'file',
                        'id' => 'file',
                        'class' => 'custom-file-input',
                    ]],
                    ['label' => ['class' => 'custom-file-label', 'for' => 'file']],
                        'File',
                    '/label',
                 '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomFileControlInputGroupAppend()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'custom' => true,
            'append' => 'append',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group file']],
                ['div' => ['class' => 'input-group']],
                    ['div' => ['class' => 'custom-file']],
                        ['input' => [
                            'type' => 'file',
                            'name' => 'file',
                            'id' => 'file',
                            'class' => 'custom-file-input',
                        ]],
                        ['label' => ['class' => 'custom-file-label', 'for' => 'file']],
                            'File',
                        '/label',
                     '/div',
                    ['div' => ['class' => 'input-group-append']],
                        ['span' => ['class' => 'input-group-text']],
                            'append',
                        '/span',
                    '/div',
                '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomFileControlInputGroupPrepend()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'custom' => true,
            'prepend' => 'prepend',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group file']],
                ['div' => ['class' => 'input-group']],
                    ['div' => ['class' => 'input-group-prepend']],
                        ['span' => ['class' => 'input-group-text']],
                            'prepend',
                        '/span',
                    '/div',
                    ['div' => ['class' => 'custom-file']],
                        ['input' => [
                            'type' => 'file',
                            'name' => 'file',
                            'id' => 'file',
                            'class' => 'custom-file-input',
                        ]],
                        ['label' => ['class' => 'custom-file-label', 'for' => 'file']],
                            'File',
                        '/label',
                     '/div',
                '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCustomFileControl()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'custom' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row file']],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'custom-file']],
                        ['input' => [
                            'type' => 'file',
                            'name' => 'file',
                            'id' => 'file',
                            'class' => 'custom-file-input',
                        ]],
                        ['label' => ['class' => 'custom-file-label', 'for' => 'file']],
                            'File',
                        '/label',
                    '/div',
                '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCustomFileControlInputGroupAppend()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'custom' => true,
            'append' => 'append',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row file']],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'input-group']],
                        ['div' => ['class' => 'custom-file']],
                            ['input' => [
                                'type' => 'file',
                                'name' => 'file',
                                'id' => 'file',
                                'class' => 'custom-file-input',
                            ]],
                            ['label' => ['class' => 'custom-file-label', 'for' => 'file']],
                                'File',
                            '/label',
                         '/div',
                        ['div' => ['class' => 'input-group-append']],
                            ['span' => ['class' => 'input-group-text']],
                                'append',
                            '/span',
                        '/div',
                    '/div',
                '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCustomFileControlInputGroupPrepend()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'custom' => true,
            'prepend' => 'prepend',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row file']],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'input-group']],
                        ['div' => ['class' => 'input-group-prepend']],
                            ['span' => ['class' => 'input-group-text']],
                                'prepend',
                            '/span',
                        '/div',
                        ['div' => ['class' => 'custom-file']],
                            ['input' => [
                                'type' => 'file',
                                'name' => 'file',
                                'id' => 'file',
                                'class' => 'custom-file-input',
                            ]],
                            ['label' => ['class' => 'custom-file-label', 'for' => 'file']],
                                'File',
                            '/label',
                         '/div',
                    '/div',
                '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomFileControl()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline'
            ]);
        });

        $result = $this->Form->control('file', [
            'type' => 'file',
            'custom' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group file']],
                ['div' => ['class' => 'custom-file']],
                    ['input' => [
                        'type' => 'file',
                        'name' => 'file',
                        'id' => 'file',
                        'class' => 'custom-file-input',
                    ]],
                    ['label' => ['class' => 'custom-file-label', 'for' => 'file']],
                        'File',
                    '/label',
                 '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomFileControlInputGroupAppend()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline'
            ]);
        });

        $result = $this->Form->control('file', [
            'type' => 'file',
            'custom' => true,
            'append' => 'append',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group file']],
                ['div' => ['class' => 'input-group']],
                    ['div' => ['class' => 'custom-file']],
                        ['input' => [
                            'type' => 'file',
                            'name' => 'file',
                            'id' => 'file',
                            'class' => 'custom-file-input',
                        ]],
                        ['label' => ['class' => 'custom-file-label', 'for' => 'file']],
                            'File',
                        '/label',
                     '/div',
                    ['div' => ['class' => 'input-group-append']],
                        ['span' => ['class' => 'input-group-text']],
                            'append',
                        '/span',
                    '/div',
                '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomFileControlInputGroupPrepend()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline'
            ]);
        });

        $result = $this->Form->control('file', [
            'type' => 'file',
            'custom' => true,
            'prepend' => 'prepend',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group file']],
                ['div' => ['class' => 'input-group']],
                    ['div' => ['class' => 'input-group-prepend']],
                        ['span' => ['class' => 'input-group-text']],
                            'prepend',
                        '/span',
                    '/div',
                    ['div' => ['class' => 'custom-file']],
                        ['input' => [
                            'type' => 'file',
                            'name' => 'file',
                            'id' => 'file',
                            'class' => 'custom-file-input',
                        ]],
                        ['label' => ['class' => 'custom-file-label', 'for' => 'file']],
                            'File',
                        '/label',
                     '/div',
                '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testCustomFileControlInputGroupInferLabelFromField()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'custom' => true,
            'append' => 'append',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group file']],
                ['div' => ['class' => 'input-group']],
                    ['div' => ['class' => 'custom-file']],
                        ['input' => [
                            'type' => 'file',
                            'name' => 'file',
                            'id' => 'file',
                            'class' => 'custom-file-input',
                        ]],
                        ['label' => ['class' => 'custom-file-label', 'for' => 'file']],
                            'File',
                        '/label',
                     '/div',
                    ['div' => ['class' => 'input-group-append']],
                        ['span' => ['class' => 'input-group-text']],
                            'append',
                        '/span',
                    '/div',
                '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testCustomFileControlInputGroupInferLabelFromAssociatedField()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('associated.0.file', [
            'type' => 'file',
            'custom' => true,
            'append' => 'append',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group file']],
                ['div' => ['class' => 'input-group']],
                    ['div' => ['class' => 'custom-file']],
                        ['input' => [
                            'type' => 'file',
                            'name' => 'associated[0][file]',
                            'id' => 'associated-0-file',
                            'class' => 'custom-file-input',
                        ]],
                        ['label' => ['class' => 'custom-file-label', 'for' => 'associated-0-file']],
                            'File',
                        '/label',
                     '/div',
                    ['div' => ['class' => 'input-group-append']],
                        ['span' => ['class' => 'input-group-text']],
                            'append',
                        '/span',
                    '/div',
                '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testCustomFileControlInputGroupLabelTextFromOptions()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'label' => [
                'text' => 'text'
            ],
            'custom' => true,
            'append' => 'append',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group file']],
                ['div' => ['class' => 'input-group']],
                    ['div' => ['class' => 'custom-file']],
                        ['input' => [
                            'type' => 'file',
                            'name' => 'file',
                            'id' => 'file',
                            'class' => 'custom-file-input',
                        ]],
                        ['label' => ['class' => 'custom-file-label', 'for' => 'file']],
                            'text',
                        '/label',
                     '/div',
                    ['div' => ['class' => 'input-group-append']],
                        ['span' => ['class' => 'input-group-text']],
                            'append',
                        '/span',
                    '/div',
                '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testCustomFileControlInputGroupLabelAttributes()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'label' => [
                'foo' => 'bar'
            ],
            'custom' => true,
            'append' => 'append',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group file']],
                ['div' => ['class' => 'input-group']],
                    ['div' => ['class' => 'custom-file']],
                        ['input' => [
                            'type' => 'file',
                            'name' => 'file',
                            'id' => 'file',
                            'class' => 'custom-file-input',
                        ]],
                        ['label' => ['class' => 'custom-file-label', 'foo' => 'bar', 'for' => 'file']],
                            'File',
                        '/label',
                     '/div',
                    ['div' => ['class' => 'input-group-append']],
                        ['span' => ['class' => 'input-group-text']],
                            'append',
                        '/span',
                    '/div',
                '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testCustomFileControlInputGroupLabelEscaping()
    {
        $result = $this->Form->control('file', [
            'type' => 'file',
            'label' => [
                'text' => '<b>text</b>',
            ],
            'custom' => true,
            'append' => 'append',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group file']],
                ['div' => ['class' => 'input-group']],
                    ['div' => ['class' => 'custom-file']],
                        ['input' => [
                            'type' => 'file',
                            'name' => 'file',
                            'id' => 'file',
                            'class' => 'custom-file-input',
                        ]],
                        ['label' => ['class' => 'custom-file-label', 'for' => 'file']],
                            '&lt;b&gt;text&lt;/b&gt;',
                        '/label',
                     '/div',
                    ['div' => ['class' => 'input-group-append']],
                        ['span' => ['class' => 'input-group-text']],
                            'append',
                        '/span',
                    '/div',
                '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'label' => [
                'text' => '<b>text</b>',
                'escape' => false
            ],
            'custom' => true,
            'append' => 'append',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group file']],
                ['div' => ['class' => 'input-group']],
                    ['div' => ['class' => 'custom-file']],
                        ['input' => [
                            'type' => 'file',
                            'name' => 'file',
                            'id' => 'file',
                            'class' => 'custom-file-input',
                        ]],
                        ['label' => ['class' => 'custom-file-label', 'for' => 'file']],
                            ['b' => true], 'text', '/b',
                        '/label',
                     '/div',
                    ['div' => ['class' => 'input-group-append']],
                        ['span' => ['class' => 'input-group-text']],
                            'append',
                        '/span',
                    '/div',
                '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }
}
