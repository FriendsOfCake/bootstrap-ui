<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;
use BootstrapUI\View\Helper\FormHelper;
use InvalidArgumentException;

class FormHelperTest extends AbstractFormHelperTest
{
    public function testBasicPasswordControl()
    {
        $this->article['schema']['password'] = ['type' => 'string'];
        $this->Form->create($this->article);

        $result = $this->Form->control('password');
        $expected = [
            'div' => ['class' => 'mb-3 password'],
            'label' => ['class' => 'form-label', 'for' => 'password'],
            'Password',
            '/label',
            'input' => [
                'type' => 'password',
                'name' => 'password',
                'id' => 'password',
                'class' => 'form-control',
            ],
            '/div',
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
            'div' => ['class' => 'mb-3 text required'],
                'label' => ['class' => 'form-label', 'for' => 'title'],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'data-validity-message' => 'This field cannot be left empty',
                    'oninvalid' => 'this.setCustomValidity(&#039;&#039;); if (!this.value) this.setCustomValidity(this.dataset.validityMessage)',
                    'oninput' => 'this.setCustomValidity(&#039;&#039;)',
                    'id' => 'title',
                    'class' => 'form-control',
                    'required' => 'required',
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testAddOnPrependedText()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('title', ['prepend' => '@']);
        $expected = [
            'div' => ['class' => 'mb-3 text required'],
                'label' => ['class' => 'form-label', 'for' => 'title'],
                    'Title',
                '/label',
                ['div' => ['class' => 'input-group']],
                    'span' => ['class' => 'input-group-text'],
                        '@',
                    '/span',
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'required' => 'required',
                        'data-validity-message' => 'This field cannot be left empty',
                        'oninvalid' => 'this.setCustomValidity(&#039;&#039;); if (!this.value) this.setCustomValidity(this.dataset.validityMessage)',
                        'oninput' => 'this.setCustomValidity(&#039;&#039;)',
                        'id' => 'title',
                        'class' => 'form-control',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testAddOnPrependedTextMultiple()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('title', ['prepend' => ['$', '0.00']]);
        $expected = [
            'div' => ['class' => 'mb-3 text required'],
                'label' => ['class' => 'form-label', 'for' => 'title'],
                    'Title',
                '/label',
                ['div' => ['class' => 'input-group']],
                    ['span' => ['class' => 'input-group-text']],
                        '$',
                    '/span',
                    ['span' => ['class' => 'input-group-text']],
                        '0.00',
                    '/span',
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'required' => 'required',
                        'data-validity-message' => 'This field cannot be left empty',
                        'oninvalid' => 'this.setCustomValidity(&#039;&#039;); if (!this.value) this.setCustomValidity(this.dataset.validityMessage)',
                        'oninput' => 'this.setCustomValidity(&#039;&#039;)',
                        'id' => 'title',
                        'class' => 'form-control',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testAddOnAppendedText()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('title', ['append' => '@']);
        $expected = [
            'div' => ['class' => 'mb-3 text required'],
                'label' => ['class' => 'form-label', 'for' => 'title'],
                    'Title',
                '/label',
                ['div' => ['class' => 'input-group']],
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'required' => 'required',
                        'data-validity-message' => 'This field cannot be left empty',
                        'oninvalid' => 'this.setCustomValidity(&#039;&#039;); if (!this.value) this.setCustomValidity(this.dataset.validityMessage)',
                        'oninput' => 'this.setCustomValidity(&#039;&#039;)',
                        'id' => 'title',
                        'class' => 'form-control',
                    ],
                    'span' => ['class' => 'input-group-text'],
                        '@',
                    '/span',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testAddOnAppendedTextMultiple()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('title', ['append' => ['$', '0.00']]);
        $expected = [
            'div' => ['class' => 'mb-3 text required'],
                'label' => ['class' => 'form-label', 'for' => 'title'],
                    'Title',
                '/label',
                ['div' => ['class' => 'input-group']],
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'required' => 'required',
                        'data-validity-message' => 'This field cannot be left empty',
                        'oninvalid' => 'this.setCustomValidity(&#039;&#039;); if (!this.value) this.setCustomValidity(this.dataset.validityMessage)',
                        'oninput' => 'this.setCustomValidity(&#039;&#039;)',
                        'id' => 'title',
                        'class' => 'form-control',
                    ],
                    ['span' => ['class' => 'input-group-text']],
                        '$',
                    '/span',
                    ['span' => ['class' => 'input-group-text']],
                        '0.00',
                    '/span',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testAddOnPrependedButton()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('title', ['prepend' => $this->Form->button('GO')]);
        $expected = [
            'div' => ['class' => 'mb-3 text required'],
                'label' => ['class' => 'form-label', 'for' => 'title'],
                    'Title',
                '/label',
                ['div' => ['class' => 'input-group']],
                    'button' => ['type' => 'submit', 'class' => 'btn btn-secondary'],
                        'GO',
                    '/button',
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'required' => 'required',
                        'data-validity-message' => 'This field cannot be left empty',
                        'oninvalid' => 'this.setCustomValidity(&#039;&#039;); if (!this.value) this.setCustomValidity(this.dataset.validityMessage)',
                        'oninput' => 'this.setCustomValidity(&#039;&#039;)',
                        'id' => 'title',
                        'class' => 'form-control',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testAddOnPrependedButtonMultiple()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('title', [
            'prepend' => [
                $this->Form->button('NO'),
                $this->Form->button('GO'),
            ],
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 text required'],
                'label' => ['class' => 'form-label', 'for' => 'title'],
                    'Title',
                '/label',
                ['div' => ['class' => 'input-group']],
                    ['button' => ['type' => 'submit', 'class' => 'btn btn-secondary']],
                        'NO',
                    '/button',
                    ['button' => ['type' => 'submit', 'class' => 'btn btn-secondary']],
                        'GO',
                    '/button',
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'required' => 'required',
                        'data-validity-message' => 'This field cannot be left empty',
                        'oninvalid' => 'this.setCustomValidity(&#039;&#039;); if (!this.value) this.setCustomValidity(this.dataset.validityMessage)',
                        'oninput' => 'this.setCustomValidity(&#039;&#039;)',
                        'id' => 'title',
                        'class' => 'form-control',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testAddOnAppendedButton()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('title', ['append' => $this->Form->button('GO')]);
        $expected = [
            'div' => ['class' => 'mb-3 text required'],
                'label' => ['class' => 'form-label', 'for' => 'title'],
                    'Title',
                '/label',
                ['div' => ['class' => 'input-group']],
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'required' => 'required',
                        'data-validity-message' => 'This field cannot be left empty',
                        'oninvalid' => 'this.setCustomValidity(&#039;&#039;); if (!this.value) this.setCustomValidity(this.dataset.validityMessage)',
                        'oninput' => 'this.setCustomValidity(&#039;&#039;)',
                        'id' => 'title',
                        'class' => 'form-control',
                    ],
                    'button' => ['type' => 'submit', 'class' => 'btn btn-secondary'],
                        'GO',
                    '/button',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testAddOnAppendedButtonMultiple()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('title', [
            'append' => [
                $this->Form->button('NO'),
                $this->Form->button('GO'),
            ],
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 text required'],
                'label' => ['class' => 'form-label', 'for' => 'title'],
                    'Title',
                '/label',
                ['div' => ['class' => 'input-group']],
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'required' => 'required',
                        'data-validity-message' => 'This field cannot be left empty',
                        'oninvalid' => 'this.setCustomValidity(&#039;&#039;); if (!this.value) this.setCustomValidity(this.dataset.validityMessage)',
                        'oninput' => 'this.setCustomValidity(&#039;&#039;)',
                        'id' => 'title',
                        'class' => 'form-control',
                    ],
                    ['button' => ['type' => 'submit', 'class' => 'btn btn-secondary']],
                        'NO',
                    '/button',
                    ['button' => ['type' => 'submit', 'class' => 'btn btn-secondary']],
                        'GO',
                    '/button',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testAddOnOptions()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('title', ['prepend' => ['@', ['size' => 'lg']]]);
        $expected = [
            'div' => ['class' => 'mb-3 text required'],
                'label' => ['class' => 'form-label', 'for' => 'title'],
                    'Title',
                '/label',
                ['div' => ['class' => 'input-group input-group-lg']],
                    'span' => ['class' => 'input-group-text'],
                        '@',
                    '/span',
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'required' => 'required',
                        'data-validity-message' => 'This field cannot be left empty',
                        'oninvalid' => 'this.setCustomValidity(&#039;&#039;); if (!this.value) this.setCustomValidity(this.dataset.validityMessage)',
                        'oninput' => 'this.setCustomValidity(&#039;&#039;)',
                        'id' => 'title',
                        'class' => 'form-control',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Form->control('title', ['append' => ['@', ['size' => 'lg']]]);
        $expected = [
            'div' => ['class' => 'mb-3 text required'],
                'label' => ['class' => 'form-label', 'for' => 'title'],
                    'Title',
                '/label',
                ['div' => ['class' => 'input-group input-group-lg']],
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'required' => 'required',
                        'data-validity-message' => 'This field cannot be left empty',
                        'oninvalid' => 'this.setCustomValidity(&#039;&#039;); if (!this.value) this.setCustomValidity(this.dataset.validityMessage)',
                        'oninput' => 'this.setCustomValidity(&#039;&#039;)',
                        'id' => 'title',
                        'class' => 'form-control',
                    ],
                    'span' => ['class' => 'input-group-text'],
                        '@',
                    '/span',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testAddOnOptionsMultiple()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('title', [
            'prepend' => [
                '$', '0.00', ['size' => 'lg', 'class' => 'custom', 'custom' => 'attribute'],
            ],
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 text required'],
                'label' => ['class' => 'form-label', 'for' => 'title'],
                    'Title',
                '/label',
                ['div' => ['class' => 'input-group input-group-lg custom', 'custom' => 'attribute']],
                    ['span' => ['class' => 'input-group-text']],
                        '$',
                    '/span',
                    ['span' => ['class' => 'input-group-text']],
                        '0.00',
                    '/span',
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'required' => 'required',
                        'data-validity-message' => 'This field cannot be left empty',
                        'oninvalid' => 'this.setCustomValidity(&#039;&#039;); if (!this.value) this.setCustomValidity(this.dataset.validityMessage)',
                        'oninput' => 'this.setCustomValidity(&#039;&#039;)',
                        'id' => 'title',
                        'class' => 'form-control',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Form->control('title', [
            'append' => [
                '$', '0.00', ['size' => 'lg', 'class' => 'custom', 'custom' => 'attribute'],
            ],
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 text required'],
                'label' => ['class' => 'form-label', 'for' => 'title'],
                    'Title',
                '/label',
                ['div' => ['class' => 'input-group input-group-lg custom', 'custom' => 'attribute']],
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'required' => 'required',
                        'data-validity-message' => 'This field cannot be left empty',
                        'oninvalid' => 'this.setCustomValidity(&#039;&#039;); if (!this.value) this.setCustomValidity(this.dataset.validityMessage)',
                        'oninput' => 'this.setCustomValidity(&#039;&#039;)',
                        'id' => 'title',
                        'class' => 'form-control',
                    ],
                    ['span' => ['class' => 'input-group-text']],
                        '$',
                    '/span',
                    ['span' => ['class' => 'input-group-text']],
                        '0.00',
                    '/span',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testAddOnWithError()
    {
        $this->article['errors'] = [
            'title' => ['error message'],
        ];
        unset($this->article['required']['title']);
        $this->Form->create($this->article);

        $result = $this->Form->control('title', ['prepend' => '@']);
        $expected = [
            'div' => ['class' => 'mb-3 text is-invalid'],
                'label' => ['class' => 'form-label', 'for' => 'title'],
                    'Title',
                '/label',
                ['div' => ['class' => 'input-group is-invalid']],
                    'span' => ['class' => 'input-group-text'],
                        '@',
                    '/span',
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'id' => 'title',
                        'class' => 'is-invalid form-control',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'title-error',
                    ],
                '/div',
                ['div' => ['id' => 'title-error', 'class' => 'invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Form->control('title', ['append' => '@']);
        $expected = [
            'div' => ['class' => 'mb-3 text is-invalid'],
                'label' => ['class' => 'form-label', 'for' => 'title'],
                    'Title',
                '/label',
                ['div' => ['class' => 'input-group is-invalid']],
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'id' => 'title',
                        'class' => 'is-invalid form-control',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'title-error',
                    ],
                    'span' => ['class' => 'input-group-text'],
                        '@',
                    '/span',
                '/div',
                ['div' => ['id' => 'title-error', 'class' => 'invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testAddOnWithBasicInputs()
    {
        $this->article['required']['title'] = false;

        $this->Form->create($this->article);

        $result = $this->Form->text('title', ['prepend' => '@']);
        $expected = [
            ['div' => ['class' => 'input-group']],
                'span' => ['class' => 'input-group-text'],
                    '@',
                '/span',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'class' => 'form-control',
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Form->textArea('title', ['prepend' => '@']);
        $expected = [
            ['div' => ['class' => 'input-group']],
                'span' => ['class' => 'input-group-text'],
                    '@',
                '/span',
                'textarea' => [
                    'name' => 'title',
                    'class' => 'form-control',
                    'rows' => 5,
                ],
                '/textarea',
            '/div',
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Form->select('title', [], ['prepend' => '@']);
        $expected = [
            ['div' => ['class' => 'input-group']],
                'span' => ['class' => 'input-group-text'],
                    '@',
                '/span',
                ['select' => ['name' => 'title', 'class' => 'form-select']],
                    ['option' => ['value' => '']],
                    '/option',
                '/select',
            '/div',
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Form->file('title', ['prepend' => '@']);
        $expected = [
            ['div' => ['class' => 'input-group']],
                'span' => ['class' => 'input-group-text'],
                    '@',
                '/span',
                'input' => [
                    'type' => 'file',
                    'name' => 'title',
                    'class' => 'form-control',
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Form->dateTime('title', ['prepend' => '@']);
        $expected = [
            ['div' => ['class' => 'input-group']],
                'span' => ['class' => 'input-group-text'],
                    '@',
                '/span',
                'input' => [
                    'type' => 'datetime-local',
                    'name' => 'title',
                    'class' => 'form-control',
                    'step' => 1,
                    'value' => '',
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testFormCreate()
    {
        $result = $this->Form->create($this->article);
        $expected = [
            'form' => [
                'method' => 'post',
                'accept-charset' => 'utf-8',
                'action' => '/articles/add',
            ],
        ];
        $this->assertHtml($expected, $result);
    }

    public function testFormEnd()
    {
        $this->Form->create($this->article);
        $this->assertHtml(['/form'], $this->Form->end());
    }

    public function testFormCreateWithTemplatesFile()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article, ['templates' => 'custom_templates']);

        $result = $this->Form->control('title');
        $expected = [
            'div' => ['class' => 'custom-container mb-3'],
                'label' => ['class' => 'form-label', 'for' => 'title'],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'form-control',
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineFormCreate()
    {
        $result = $this->Form->create($this->article, ['align' => 'inline']);
        $expected = [
            'form' => [
                'method' => 'post',
                'accept-charset' => 'utf-8',
                'action' => '/articles/add',
                'class' => 'row g-3 align-items-center',
            ],
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineFormCreateWithCustomSpacing()
    {
        $result = $this->Form->create($this->article, [
            'align' => 'inline',
            'spacing' => 'custom-spacing',
        ]);
        $expected = [
            'form' => [
                'method' => 'post',
                'accept-charset' => 'utf-8',
                'action' => '/articles/add',
                'class' => 'row custom-spacing align-items-center',
            ],
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalFormCreate()
    {
        $result = $this->Form->create($this->article, ['align' => 'horizontal']);
        $expected = [
            'form' => [
                'method' => 'post',
                'accept-charset' => 'utf-8',
                'action' => '/articles/add',
            ],
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInvalidAlignmentFormCreate()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->Form->create($this->article, ['align' => 'foo']);
    }

    public function testCustomGridWithConstantsConfig()
    {
        $this->Form->create($this->article, [
            'align' => [
                FormHelper::GRID_COLUMN_ONE => 3,
                FormHelper::GRID_COLUMN_TWO => 5,
            ],
        ]);

        $result = $this->Form->control('title');
        $expected = [
            'div' => ['class' => 'mb-3 row text required'],
                'label' => [
                    'class' => 'col-form-label col-md-3',
                    'for' => 'title',
                ],
                    'Title',
                '/label',
                ['div' => ['class' => 'col-md-5']],
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'required' => 'required',
                        'data-validity-message' => 'This field cannot be left empty',
                        'oninvalid' => 'this.setCustomValidity(&#039;&#039;); if (!this.value) this.setCustomValidity(this.dataset.validityMessage)',
                        'oninput' => 'this.setCustomValidity(&#039;&#039;)',
                        'id' => 'title',
                        'class' => 'form-control',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testCustomGridWithBasicArrayConfig()
    {
        $this->Form->create($this->article, [
            'align' => [
                3,
                5,
            ],
        ]);

        $result = $this->Form->control('title');
        $expected = [
            'div' => ['class' => 'mb-3 row text required'],
                'label' => [
                    'class' => 'col-form-label col-md-3',
                    'for' => 'title',
                ],
                    'Title',
                '/label',
                ['div' => ['class' => 'col-md-5']],
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'required' => 'required',
                        'data-validity-message' => 'This field cannot be left empty',
                        'oninvalid' => 'this.setCustomValidity(&#039;&#039;); if (!this.value) this.setCustomValidity(this.dataset.validityMessage)',
                        'oninput' => 'this.setCustomValidity(&#039;&#039;)',
                        'id' => 'title',
                        'class' => 'form-control',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalFormCreateFromConfig()
    {
        $this->Form->setConfig([
            'align' => 'horizontal',
            'templateSet' => [
                'horizontal' => [
                    'checkboxFormGroup' => '<div class="%s"><div class="form-check my-checkbox">{{input}}{{label}}</div>{{error}}{{help}}</div>',
                ],
            ],
        ]);
        $result = $this->Form->create($this->article);
        $expected = [
            'form' => [
                'method' => 'post',
                'accept-charset' => 'utf-8',
                'action' => '/articles/add',
            ],
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Form->control('title');
        $expected = [
            'div' => ['class' => 'mb-3 row text required'],
                'label' => [
                    'class' => 'col-form-label col-md-2',
                    'for' => 'title',
                ],
                    'Title',
                '/label',
                ['div' => ['class' => 'col-md-10']],
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'required' => 'required',
                        'data-validity-message' => 'This field cannot be left empty',
                        'oninvalid' => 'this.setCustomValidity(&#039;&#039;); if (!this.value) this.setCustomValidity(this.dataset.validityMessage)',
                        'oninput' => 'this.setCustomValidity(&#039;&#039;)',
                        'id' => 'title',
                        'class' => 'form-control',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Form->control('published');
        $expected = [
            'div' => ['class' => 'mb-3 row checkbox'],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testBasicButton()
    {
        $result = $this->Form->button('Submit');
        $expected = [
            'button' => ['class' => 'btn btn-secondary', 'type' => 'submit'],
                'Submit',
            '/button',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testStyledButton()
    {
        $result = $this->Form->button('Submit', ['class' => 'success']);
        $expected = [
            'button' => ['class' => 'btn-success btn', 'type' => 'submit'],
                'Submit',
            '/button',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testPrimaryStyledButton()
    {
        $result = $this->Form->button('Submit', ['class' => 'primary']);
        $expected = [
            'button' => ['class' => 'btn-primary btn', 'type' => 'submit'],
                'Submit',
            '/button',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testStyledFormSubmit()
    {
        $result = $this->Form->submit('Submit', ['class' => 'btn btn-block']);
        $expected = [
            'div' => ['class' => 'submit'],
                'input' => [
                    'type' => 'submit',
                    'value' => 'Submit',
                    'class' => 'btn btn-block btn-secondary',
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Form->submit('Submit', ['class' => ['btn', 'btn-block']]);
        $expected = [
            'div' => ['class' => 'submit'],
                'input' => [
                    'type' => 'submit',
                    'value' => 'Submit',
                    'class' => 'btn btn-block btn-secondary',
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testTooltipWithDisabledLabel()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('title', [
            'tooltip' => 'Some important additional notes.',
            'label' => false,
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 text required'],
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'required' => 'required',
                    'data-validity-message' => 'This field cannot be left empty',
                    'oninvalid' => 'this.setCustomValidity(&#039;&#039;); if (!this.value) this.setCustomValidity(this.dataset.validityMessage)',
                    'oninput' => 'this.setCustomValidity(&#039;&#039;)',
                    'id' => 'title',
                    'class' => 'form-control',
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * Tests that the `control()` method can be used outside of an open form.
     *
     * This should result in controls being created with the default templates,
     * and without alignment/grid, and spacing related classes and structures.
     *
     * @return void
     */
    public function testFormControlWithoutOpenForm()
    {
        $Form = new FormHelper($this->View);

        $result = $Form->control('title');
        $expected = [
            ['div' => ['class' => 'text']],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'form-control',
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);

        $Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
            'spacing' => 'mb-1',
        ]);
        $Form->end();

        $result = $Form->control('title');
        $this->assertHtml($expected, $result);
    }

    /**
     * Test that "form-*" classes are added when using methods for specific input.
     *
     * @return void
     */
    public function testFormClassInjection()
    {
        $result = $this->Form->text('foo');
        $this->assertStringContainsString('class="form-control"', $result);

        $result = $this->Form->text('foo', ['class' => 'custom']);
        $this->assertStringContainsString('class="custom form-control"', $result);

        $result = $this->Form->select('foo');
        $this->assertStringNotContainsString('"form-control"', $result);
        $this->assertStringContainsString('class="form-select"', $result);

        $result = $this->Form->textarea('foo');
        $this->assertStringContainsString('class="form-control"', $result);

        $result = $this->Form->dateTime('foo');
        $this->assertStringContainsString('class="form-control"', $result);

        $result = $this->Form->file('foo');
        $this->assertStringContainsString('"form-control"', $result);

        $result = $this->Form->checkbox('foo');
        $this->assertStringNotContainsString('"form-control"', $result);
        $this->assertStringContainsString('class="form-check-input"', $result);

        $result = $this->Form->radio('foo', ['1' => 'Opt 1', '2' => 'Opt 2']);
        $this->assertStringNotContainsString('"form-control"', $result);
        $this->assertStringContainsString('class="form-check-input"', $result);

        $result = $this->Form->color('foo');
        $this->assertStringContainsString('class="form-control form-control-color"', $result);
    }

    public function testFeedbackStyleFromHelperConfig()
    {
        $this->article['errors'] = [
            'title' => ['error message'],
        ];
        $this->article['required']['title'] = false;

        $this->Form->setConfig('feedbackStyle', FormHelper::FEEDBACK_STYLE_TOOLTIP);
        $this->Form->create($this->article);

        $result = $this->Form->control('title');

        $expected = [
            ['div' => ['class' => 'mb-3 position-relative text is-invalid']],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'is-invalid form-control',
                    'aria-invalid' => 'true',
                    'aria-describedby' => 'title-error',
                ],
                ['div' => ['id' => 'title-error', 'class' => 'invalid-tooltip']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testOverrideFeedbackStyleFromHelperConfigViaControlConfig()
    {
        $this->article['errors'] = [
            'title' => ['error message'],
        ];
        $this->article['required']['title'] = false;

        $this->Form->setConfig('feedbackStyle', FormHelper::FEEDBACK_STYLE_TOOLTIP);
        $this->Form->create($this->article);

        $result = $this->Form->control('title', [
            'feedbackStyle' => FormHelper::FEEDBACK_STYLE_DEFAULT,
        ]);

        $expected = [
            ['div' => ['class' => 'mb-3 text is-invalid']],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'is-invalid form-control',
                    'aria-invalid' => 'true',
                    'aria-describedby' => 'title-error',
                ],
                ['div' => ['id' => 'title-error', 'class' => 'invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testFormGroupPositionFromHelperConfig()
    {
        $this->article['errors'] = [
            'title' => ['error message'],
        ];
        $this->article['required']['title'] = false;

        $this->Form->setConfig([
            'feedbackStyle' => FormHelper::FEEDBACK_STYLE_TOOLTIP,
            'formGroupPosition' => FormHelper::POSITION_ABSOLUTE,
        ]);
        $this->Form->create($this->article);

        $result = $this->Form->control('title');

        $expected = [
            ['div' => ['class' => 'mb-3 position-absolute text is-invalid']],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'is-invalid form-control',
                    'aria-invalid' => 'true',
                    'aria-describedby' => 'title-error',
                ],
                ['div' => ['id' => 'title-error', 'class' => 'invalid-tooltip']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testOverrideFormGroupPositionFromHelperConfigViaControlConfig()
    {
        $this->article['errors'] = [
            'title' => ['error message'],
        ];
        $this->article['required']['title'] = false;

        $this->Form->setConfig([
            'feedbackStyle' => FormHelper::FEEDBACK_STYLE_TOOLTIP,
            'formGroupPosition' => FormHelper::POSITION_ABSOLUTE,
        ]);
        $this->Form->create($this->article);

        $result = $this->Form->control('title', [
            'formGroupPosition' => FormHelper::POSITION_STATIC,
        ]);

        $expected = [
            ['div' => ['class' => 'mb-3 position-static text is-invalid']],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'is-invalid form-control',
                    'aria-invalid' => 'true',
                    'aria-describedby' => 'title-error',
                ],
                ['div' => ['id' => 'title-error', 'class' => 'invalid-tooltip']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignControlWithTooltipFeedbackStyle()
    {
        $this->article['errors'] = [
            'title' => ['error message'],
        ];
        $this->article['required']['title'] = false;

        $this->Form->create($this->article);

        $result = $this->Form->control('title', [
            'feedbackStyle' => FormHelper::FEEDBACK_STYLE_TOOLTIP,
        ]);

        $expected = [
            ['div' => ['class' => 'mb-3 position-relative text is-invalid']],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'is-invalid form-control',
                    'aria-invalid' => 'true',
                    'aria-describedby' => 'title-error',
                ],
                ['div' => ['id' => 'title-error', 'class' => 'invalid-tooltip']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignControlWithDefaultFeedbackStyle()
    {
        $this->article['errors'] = [
            'title' => ['error message'],
        ];
        $this->article['required']['title'] = false;

        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('title', [
            'feedbackStyle' => FormHelper::FEEDBACK_STYLE_DEFAULT,
        ]);

        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => ['class' => 'text is-invalid']],
                    ['label' => ['class' => 'form-label visually-hidden', 'for' => 'title']],
                        'Title',
                    '/label',
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'id' => 'title',
                        'class' => 'is-invalid form-control',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'title-error',
                    ],
                    ['div' => ['id' => 'title-error', 'class' => 'invalid-feedback']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignControlWithTooltipFeedbackStyle()
    {
        $this->article['errors'] = [
            'title' => ['error message'],
        ];
        $this->article['required']['title'] = false;

        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('title', [
            'feedbackStyle' => FormHelper::FEEDBACK_STYLE_TOOLTIP,
        ]);

        $expected = [
            ['div' => ['class' => 'mb-3 row position-relative text is-invalid']],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'title']],
                    'Title',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'id' => 'title',
                        'class' => 'is-invalid form-control',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'title-error',
                    ]],
                    ['div' => ['id' => 'title-error', 'class' => 'invalid-tooltip']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHiddenFieldsDoNotGenerateAriaAttributes()
    {
        $this->article['errors'] = [
            'title' => ['error message'],
        ];

        $this->Form->create($this->article);

        $result = $this->Form->control('title', [
            'type' => 'hidden',
            'help' => 'help text',
        ]);
        $expected = [
            'input' => [
                'type' => 'hidden',
                'name' => 'title',
                'id' => 'title',
                'class' => 'is-invalid',
            ],
        ];
        $this->assertHtml($expected, $result);
    }

    public function testOverrideAriaAttributes()
    {
        $this->article['errors'] = [
            'title' => ['error message'],
        ];

        $this->Form->create($this->article);

        $result = $this->Form->control('title', [
            'aria-required' => false,
            'aria-invalid' => false,
            'aria-describedby' => 'custom',
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 text required is-invalid'],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'data-validity-message' => 'This field cannot be left empty',
                    'oninvalid' => 'this.setCustomValidity(&#039;&#039;); if (!this.value) this.setCustomValidity(this.dataset.validityMessage)',
                    'oninput' => 'this.setCustomValidity(&#039;&#039;)',
                    'class' => 'is-invalid form-control',
                    'required' => 'required',
                    'aria-describedby' => 'custom',
                ],
                ['div' => ['id' => 'title-error', 'class' => 'invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testPartiallyOverrideAriaAttributes()
    {
        $this->article['errors'] = [
            'title' => ['error message'],
        ];

        $this->Form->create($this->article);

        $result = $this->Form->control('title', [
            'aria-invalid' => false,
            'aria-describedby' => 'custom',
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 text required is-invalid'],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'data-validity-message' => 'This field cannot be left empty',
                    'oninvalid' => 'this.setCustomValidity(&#039;&#039;); if (!this.value) this.setCustomValidity(this.dataset.validityMessage)',
                    'oninput' => 'this.setCustomValidity(&#039;&#039;)',
                    'class' => 'is-invalid form-control',
                    'required' => 'required',
                    'aria-describedby' => 'custom',
                ],
                ['div' => ['id' => 'title-error', 'class' => 'invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testSpacingViaCreateConfigIsBeingResetOnFormClose()
    {
        $this->article['required']['title'] = false;

        $this->Form->create($this->article, [
            'spacing' => 'custom-spacing-create',
        ]);
        $result = $this->Form->control('title');
        $this->Form->end();

        $expected = [
            ['div' => ['class' => 'custom-spacing-create text']],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'form-control',
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);

        $this->Form->create($this->article);
        $result = $this->Form->control('title');
        $this->Form->end();

        $expected = [
            ['div' => ['class' => 'mb-3 text']],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'form-control',
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testOverrideSpacingFromHelperConfigViaCreateConfig()
    {
        $this->article['required']['title'] = false;

        $this->Form->setConfig([
            'spacing' => 'custom-spacing-helper',
        ]);

        $this->Form->create($this->article);
        $result = $this->Form->control('title');
        $this->Form->end();

        $expected = [
            ['div' => ['class' => 'custom-spacing-helper text']],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'form-control',
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);

        $this->Form->create($this->article, [
            'spacing' => 'custom-spacing-create',
        ]);
        $result = $this->Form->control('title');
        $this->Form->end();

        $expected = [
            ['div' => ['class' => 'custom-spacing-create text']],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'form-control',
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testOverrideSpacingFromHelperConfigViaControlConfig()
    {
        $this->article['required']['title'] = false;

        $this->Form->setConfig([
            'spacing' => 'custom-spacing-helper',
        ]);

        $this->Form->create($this->article);
        $result = $this->Form->control('title');
        $this->Form->end();

        $expected = [
            ['div' => ['class' => 'custom-spacing-helper text']],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'form-control',
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);

        $this->Form->create($this->article);
        $result = $this->Form->control('title', [
            'spacing' => 'custom-spacing-control',
        ]);
        $this->Form->end();

        $expected = [
            ['div' => ['class' => 'custom-spacing-control text']],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'form-control',
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result, true);
    }

    public function testOverrideSpacingFromCreateConfigViaControlConfig()
    {
        $this->article['required']['title'] = false;

        $this->Form->create($this->article, [
            'spacing' => 'custom-spacing-create',
        ]);
        $result = $this->Form->control('title');

        $expected = [
            ['div' => ['class' => 'custom-spacing-create text']],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'form-control',
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Form->control('title', [
            'spacing' => 'custom-spacing-control',
        ]);
        $expected = [
            ['div' => ['class' => 'custom-spacing-control text']],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'form-control',
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result, true);

        $this->Form->end();
    }

    public function testDisableSpacingViaHelperConfig()
    {
        $this->article['required']['title'] = false;

        $this->Form->create($this->article);
        $result = $this->Form->control('title');
        $this->Form->end();

        $expected = [
            ['div' => ['class' => 'mb-3 text']],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'form-control',
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);

        $this->Form->setConfig([
            'spacing' => false,
        ]);

        $this->Form->create($this->article);
        $result = $this->Form->control('title');
        $this->Form->end();

        $expected = [
            ['div' => ['class' => 'text']],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'form-control',
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDisableSpacingFromHelperConfigViaCreateConfig()
    {
        $this->article['required']['title'] = false;

        $this->Form->setConfig([
            'spacing' => 'custom-spacing-helper',
        ]);

        $this->Form->create($this->article);
        $result = $this->Form->control('title');
        $this->Form->end();

        $expected = [
            ['div' => ['class' => 'custom-spacing-helper text']],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'form-control',
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);

        $this->Form->create($this->article, [
            'spacing' => false,
        ]);
        $result = $this->Form->control('title');
        $this->Form->end();

        $expected = [
            ['div' => ['class' => 'text']],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'form-control',
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDisableSpacingFromHelperConfigViaControlConfig()
    {
        $this->article['required']['title'] = false;

        $this->Form->setConfig([
            'spacing' => 'custom-spacing-helper',
        ]);

        $this->Form->create($this->article);
        $result = $this->Form->control('title');
        $this->Form->end();

        $expected = [
            ['div' => ['class' => 'custom-spacing-helper text']],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'form-control',
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);

        $this->Form->create($this->article);
        $result = $this->Form->control('title', [
            'spacing' => false,
        ]);
        $this->Form->end();

        $expected = [
            ['div' => ['class' => 'text']],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'form-control',
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result, true);
    }

    public function testDisableSpacingFromCreateConfigViaControlConfig()
    {
        $this->article['required']['title'] = false;

        $this->Form->create($this->article, [
            'spacing' => 'custom-spacing-create',
        ]);
        $result = $this->Form->control('title');

        $expected = [
            ['div' => ['class' => 'custom-spacing-create text']],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'form-control',
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Form->control('title', [
            'spacing' => false,
        ]);
        $expected = [
            ['div' => ['class' => 'text']],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'form-control',
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result, true);

        $this->Form->end();
    }

    public function testFloatingLabelPlaceholderGeneration()
    {
        $this->article['required']['title'] = false;
        $this->Form->create($this->article);

        $result = $this->Form->control('title', [
            'label' => [
                'floating' => true,
            ],
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 form-floating text'],
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'placeholder' => 'Title',
                    'class' => 'form-control',
                ],
                ['label' => ['for' => 'title']],
                    'Title',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testFloatingLabelPlaceholderGenerationForNestedField()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('author.name', [
            'label' => [
                'floating' => true,
            ],
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 form-floating text'],
                'input' => [
                    'type' => 'text',
                    'name' => 'author[name]',
                    'id' => 'author-name',
                    'placeholder' => 'Name',
                    'class' => 'form-control',
                ],
                ['label' => ['for' => 'author-name']],
                    'Name',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testFloatingLabelPlaceholderGenerationForIdField()
    {
        unset($this->article['required']['author_id']);
        $this->Form->create($this->article);

        $result = $this->Form->control('author_id', [
            'type' => 'text',
            'label' => [
                'floating' => true,
            ],
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 form-floating text'],
                'input' => [
                    'type' => 'text',
                    'name' => 'author_id',
                    'id' => 'author-id',
                    'placeholder' => 'Author',
                    'class' => 'form-control',
                ],
                ['label' => ['for' => 'author-id']],
                    'Author',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
