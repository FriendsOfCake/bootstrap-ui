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
            'div' => ['class' => 'form-group text required'],
                'label' => ['for' => 'title'],
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
            'div' => ['class' => 'form-group text required'],
                'label' => ['for' => 'title'],
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
                    ['div' => ['class' => 'input-group-append']],
                        'span' => ['class' => 'input-group-text'],
                            '@',
                        '/span',
                    '/div',
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
            'div' => ['class' => 'form-group text required'],
                'label' => ['for' => 'title'],
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
                    ['div' => ['class' => 'input-group-append']],
                        'button' => ['type' => 'submit', 'class' => 'btn btn-secondary'],
                            'GO',
                        '/button',
                    '/div',
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
            'div' => ['class' => 'form-group text required'],
                'label' => ['for' => 'title'],
                    'Title',
                '/label',
                ['div' => ['class' => 'input-group input-group-lg']],
                    ['div' => ['class' => 'input-group-prepend']],
                        'span' => ['class' => 'input-group-text'],
                            '@',
                        '/span',
                    '/div',
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
            'div' => ['class' => 'form-group text required'],
                'label' => ['for' => 'title'],
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
                    ['div' => ['class' => 'input-group-append']],
                        'span' => ['class' => 'input-group-text'],
                            '@',
                        '/span',
                    '/div',
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
            'div' => ['class' => 'form-group text is-invalid'],
                'label' => ['for' => 'title'],
                    'Title',
                '/label',
                ['div' => ['class' => 'input-group is-invalid']],
                    ['div' => ['class' => 'input-group-prepend']],
                        'span' => ['class' => 'input-group-text'],
                            '@',
                        '/span',
                    '/div',
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'id' => 'title',
                        'class' => 'is-invalid form-control',
                    ],
                '/div',
                ['div' => ['class' => 'invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Form->control('title', ['append' => '@']);
        $expected = [
            'div' => ['class' => 'form-group text is-invalid'],
                'label' => ['for' => 'title'],
                    'Title',
                '/label',
                ['div' => ['class' => 'input-group is-invalid']],
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'id' => 'title',
                        'class' => 'is-invalid form-control',
                    ],
                    ['div' => ['class' => 'input-group-append']],
                        'span' => ['class' => 'input-group-text'],
                            '@',
                        '/span',
                    '/div',
                '/div',
                ['div' => ['class' => 'invalid-feedback']],
                    'error message',
                '/div',
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
                'role' => 'form',
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
                'role' => 'form',
                'action' => '/articles/add',
                'class' => 'form-inline',
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
                'role' => 'form',
                'action' => '/articles/add',
                'class' => 'form-horizontal',
            ],
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInvalidAlignmentFormCreate()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->Form->create($this->article, ['align' => 'foo']);
    }

    public function testCustomGrid()
    {
        $this->Form->create($this->article, [
            'align' => [
                'left' => 3,
                'middle' => 5,
                'right' => 4,
            ],
        ]);

        $result = $this->Form->control('title');
        $expected = [
            'div' => ['class' => 'form-group row text required'],
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
                'role' => 'form',
                'action' => '/articles/add',
                'class' => 'form-horizontal',
            ],
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Form->control('title');
        $expected = [
            'div' => ['class' => 'form-group row text required'],
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
            'div' => ['class' => 'form-group text required'],
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
     * Test that "form-control" class is added when using methods for specific input.
     *
     * @return void
     */
    public function testFormControlClassInjection()
    {
        $result = $this->Form->text('foo');
        $this->assertStringContainsString('class="form-control"', $result);

        $result = $this->Form->text('foo', ['class' => 'custom']);
        $this->assertStringContainsString('class="custom form-control"', $result);

        $result = $this->Form->select('foo');
        $this->assertStringContainsString('class="form-control"', $result);

        $result = $this->Form->textarea('foo');
        $this->assertStringContainsString('class="form-control"', $result);

        $result = $this->Form->dateTime('foo');
        $this->assertStringContainsString('class="form-control"', $result);

        $result = $this->Form->file('foo');
        $this->assertStringNotContainsString('"form-control"', $result);

        $result = $this->Form->checkbox('foo');
        $this->assertStringNotContainsString('"form-control"', $result);

        $result = $this->Form->radio('foo', ['1' => 'Opt 1', '2' => 'Opt 2']);
        $this->assertStringNotContainsString('"form-control"', $result);
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
            ['div' => ['class' => 'form-group position-relative text is-invalid']],
                ['label' => ['for' => 'title']],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'is-invalid form-control',
                ],
                ['div' => ['class' => 'invalid-tooltip']],
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
            ['div' => ['class' => 'form-group text is-invalid']],
                ['label' => ['for' => 'title']],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'is-invalid form-control',
                ],
                ['div' => ['class' => 'invalid-feedback']],
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
            ['div' => ['class' => 'form-group position-absolute text is-invalid']],
                ['label' => ['for' => 'title']],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'is-invalid form-control',
                ],
                ['div' => ['class' => 'invalid-tooltip']],
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
            ['div' => ['class' => 'form-group position-static text is-invalid']],
                ['label' => ['for' => 'title']],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'is-invalid form-control',
                ],
                ['div' => ['class' => 'invalid-tooltip']],
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
            ['div' => ['class' => 'form-group position-relative text is-invalid']],
                ['label' => ['for' => 'title']],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'is-invalid form-control',
                ],
                ['div' => ['class' => 'invalid-tooltip']],
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
            ['div' => ['class' => 'form-group text is-invalid']],
                ['label' => ['class' => 'visually-hidden', 'for' => 'title']],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'is-invalid form-control',
                ],
                ['div' => ['class' => 'invalid-feedback']],
                    'error message',
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
                    'left' => 5,
                    'middle' => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('title', [
            'feedbackStyle' => FormHelper::FEEDBACK_STYLE_TOOLTIP,
        ]);

        $expected = [
            ['div' => ['class' => 'form-group row position-relative text is-invalid']],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'title']],
                    'Title',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'id' => 'title',
                        'class' => 'is-invalid form-control',
                    ]],
                    ['div' => ['class' => 'invalid-tooltip']],
                        'error message',
                    '/div',
                '/div',
            '/div',
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
                    ['div' => ['class' => 'custom-file ']],
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
                    ['div' => ['class' => 'custom-file ']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testCustomFileControlInputGroupLabelTextFromOptions()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'label' => [
                'text' => 'text',
            ],
            'custom' => true,
            'append' => 'append',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group file']],
                ['div' => ['class' => 'input-group']],
                    ['div' => ['class' => 'custom-file ']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testCustomFileControlInputGroupLabelAttributes()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'label' => [
                'foo' => 'bar',
            ],
            'custom' => true,
            'append' => 'append',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group file']],
                ['div' => ['class' => 'input-group']],
                    ['div' => ['class' => 'custom-file ']],
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
            '/div',
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
                    ['div' => ['class' => 'custom-file ']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'label' => [
                'text' => '<b>text</b>',
                'escape' => false,
            ],
            'custom' => true,
            'append' => 'append',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group file']],
                ['div' => ['class' => 'input-group']],
                    ['div' => ['class' => 'custom-file ']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
