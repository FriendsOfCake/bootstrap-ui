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
        $this->View = new View();

        $this->Form = new FormHelper($this->View);
        $request = new ServerRequest('articles/add');
        $request = $request
                ->withRequestTarget('/articles/add')
                ->withParam('controller', 'articles')
                ->withParam('action', 'add')
                ->withAttribute('webroot', '')
                ->withAttribute('base', '');
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
     * testErroredTextControl method
     *
     * @return void
     */
    public function testErroredTextControl()
    {
        $this->article['errors'] = [
            'title' => ['error message'],
            'published' => ['error message']
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
     * testBasicRadioControl method
     *
     * @return void
     */
    public function testBasicRadioControl()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('published', [
            'type' => 'radio',
            'options' => ['Yes', 'No']
        ]);
        $expected = [
            ['div' => ['class' => 'form-group radio']],
            ['label' => ['class' => 'form-check-label']],
            'Published',
            '/label',
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
            '/div'
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
     * testHorizontalRadioControl method
     *
     * @return void
     */
    public function testHorizontalRadiocontrol()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('published', [
            'type' => 'radio',
            'options' => ['Yes', 'No']
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row radio']],
            ['label' => ['class' => 'col-form-label col-sm-5']],
            'Published',
            '/label',
            ['div' => ['class' => 'col-sm-7']],
            'input' => [
                'type' => 'hidden',
                'name' => 'published',
                'value' => '',
            ],
            ['div' => ['class' => 'form-check']],
            ['input' => [
                'type' => 'radio',
                'name' => 'published',
                'value' => 0,
                'id' => 'published-0',
                'class' => 'form-check-input',
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
                'class' => 'form-check-input',
            ]],
            ['label' => ['for' => 'published-1', 'class' => 'form-check-label']],
            'No',
            '/label',
            '/div',
            '/div',
            '/div'
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * testInlineHorizontalRadioControl method
     *
     * @return void
     */
    public function testInlineHorizontalRadioControl()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7
                ]
            ]
        ]);

        $result = $this->Form->control('published', [
            'inline' => true,
            'type' => 'radio',
            'options' => ['Yes', 'No']
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row radio']],
            ['label' => ['class' => 'col-form-label col-sm-5']],
            'Published',
            '/label',
            ['div' => ['class' => 'col-sm-7']],
            'input' => [
                'type' => 'hidden',
                'name' => 'published',
                'value' => '',
            ],
            ['div' => ['class' => 'form-check form-check-inline']],
            ['input' => [
                'type' => 'radio',
                'name' => 'published',
                'value' => 0,
                'id' => 'published-0',
                'class' => 'form-check-input',
            ]],
            ['label' => [
                'for' => 'published-0',
                'class' => 'form-check-label',
            ]],
            'Yes',
            '/label',
            '/div',
            ['div' => ['class' => 'form-check form-check-inline']],
            ['input' => [
                'type' => 'radio',
                'name' => 'published',
                'value' => 1,
                'id' => 'published-1',
                'class' => 'form-check-input',
            ]],
            ['label' => [
                'class' => 'form-check-label',
                'for' => 'published-1'
            ]],
            'No',
            '/label',
            '/div',
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
     * testInlineCheckboxControl method
     *
     * @return void
     */
    public function testInlineCheckboxControl()
    {
        $this->markTestSkipped('Inline checkbox are currently broken');

        $this->Form->create($this->article);

        $result = $this->Form->control('published', ['inline' => true]);
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
                'value' => 1
            ]],
            'Published',
            '/label'
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
     * testBasicFormSubmit method
     *
     * @return void
     */
    public function testBasicFormSubmit()
    {
        $result = $this->Form->submit('Submit');
        $expected = [
            'div' => ['class' => 'submit'],
            'input' => [
                'type' => 'submit',
                'value' => 'Submit',
                'class' => 'btn-primary btn',
            ]
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
     * testHorizontalFormSubmit method
     *
     * @return void
     */
    public function testHorizontalFormSubmit()
    {
        $this->Form->create($this->article, ['align' => 'horizontal']);

        $result = $this->Form->submit('Submit');
        $expected = [
            'div' => ['class' => 'form-group'],
            ['div' => ['class' => 'offset-md-2 col-md-10']],
            'input' => [
                'type' => 'submit',
                'value' => 'Submit',
                'class' => 'btn-primary btn',
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
            ['div' => ['class' => 'checkbox']],
            ['label' => ['for' => 'field-value-1']],
            [
                'input' => [
                    'type' => 'checkbox',
                    'name' => 'field[]',
                    'id' => 'field-value-1',
                    'value' => 'Value 1',
                ]
            ],
            'Label 1',
            '/label',
            '/div',
            ['div' => ['class' => 'checkbox']],
            ['label' => ['for' => 'field-value-2']],
            [
                'input' => [
                    'type' => 'checkbox',
                    'name' => 'field[]',
                    'id' => 'field-value-2',
                    'value' => 'Value 2',
                ]
            ],
            'Label 2',
            '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * testMultipleCheckboxControl method
     *
     * @return void
     */
    public function testMultipleCheckboxControl()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'User 1',
                2 => 'User 2'
            ]
        ]);
        $expected = [
            ['div' => ['class' => 'form-group multicheckbox']],
            ['label' => []],
            'Users',
            '/label',
            'input' => [
                'type' => 'hidden',
                'name' => 'users',
                'value' => '',
            ],
            ['div' => ['class' => 'checkbox']],
            ['label' => ['for' => 'users-1']],
            [
                'input' => [
                    'type' => 'checkbox',
                    'name' => 'users[]',
                    'id' => 'users-1',
                    'value' => 1,
                ]
            ],
            'User 1',
            '/label',
            '/div',
            ['div' => ['class' => 'checkbox']],
            ['label' => ['for' => 'users-2']],
            [
                'input' => [
                    'type' => 'checkbox',
                    'name' => 'users[]',
                    'id' => 'users-2',
                    'value' => 2,
                ]
            ],
            'User 2',
            '/label',
            '/div',
            '/div'
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

/*    public function testConstruct()
    {
        $this->Form->create($this->article);
        $this->_defaultConfig['templateSet'] = ['test'];

        debug($this->Form);
    }*/
}
