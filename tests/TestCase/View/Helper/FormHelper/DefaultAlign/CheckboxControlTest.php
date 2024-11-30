<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\DefaultAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class CheckboxControlTest extends AbstractFormHelperTest
{
    public function testDefaultAlignCheckboxControl()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group form-check checkbox']],
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
                    'value' => 1,
                ]],
                ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                    'Users',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCheckboxControlWithDisabledLabel()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'label' => false,
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group form-check checkbox']],
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
                    'value' => 1,
                ]],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCheckboxControlWithCustomLabel()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'label' => 'Custom Label',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group form-check checkbox']],
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
                    'value' => 1,
                ]],
                ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                    'Custom Label',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCheckboxControlWithCustomLabelOptions()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'label' => [
                'class' => 'custom-label-class',
                'foo' => 'bar',
                'text' => 'Custom Label',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group form-check checkbox']],
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
                    'value' => 1,
                ]],
                ['label' => [
                    'class' => 'custom-label-class form-check-label',
                    'foo' => 'bar',
                    'for' => 'users',
                ]],
                    'Custom Label',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCheckboxControlWithHelp()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group form-check checkbox']],
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
                    'aria-describedby' => 'users-help',
                    'value' => 1,
                ]],
                ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['id' => 'users-help', 'class' => 'form-text']],
                    'Help text',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCheckboxControlWithHelpOptions()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'help' => [
                'id' => 'custom-help',
                'foo' => 'bar',
                'class' => 'help-class',
                'content' => 'Help text',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group form-check checkbox']],
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
                    'aria-describedby' => 'custom-help',
                    'value' => 1,
                ]],
                ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => [
                    'id' => 'custom-help',
                    'foo' => 'bar',
                    'class' => 'help-class form-text',
                ]],
                    'Help text',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCheckboxControlWithTooltip()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group form-check checkbox']],
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
                    'value' => 1,
                ]],
                ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                    'Users ',
                    'span' => [
                        'data-bs-toggle' => 'tooltip',
                        'title' => 'Tooltip text',
                        'class' => 'bi bi-info-circle-fill',
                    ],
                    '/span',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCheckboxControlWithCustomSpacing()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'spacing' => 'custom-spacing',
        ]);
        $expected = [
            ['div' => ['class' => 'custom-spacing form-group form-check checkbox']],
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
                    'value' => 1,
                ]],
                ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                    'Users',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCheckboxControlWithError()
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group form-check checkbox is-invalid']],
                ['input' => [
                    'class' => 'is-invalid',
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => 0,
                ]],
                ['input' => [
                    'aria-invalid' => 'true',
                    'class' => 'form-check-input is-invalid',
                    'type' => 'checkbox',
                    'name' => 'users',
                    'id' => 'users',
                    'aria-invalid' => 'true',
                    'aria-describedby' => 'users-error',
                    'value' => 1,
                ]],
                ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['id' => 'users-error', 'class' => 'invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCheckboxControlWithErrorAndHelp()
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group form-check checkbox is-invalid']],
                ['input' => [
                    'class' => 'is-invalid',
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => 0,
                ]],
                ['input' => [
                    'class' => 'form-check-input is-invalid',
                    'type' => 'checkbox',
                    'name' => 'users',
                    'id' => 'users',
                    'aria-invalid' => 'true',
                    'aria-describedby' => 'users-error users-help',
                    'value' => 1,
                ]],
                ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['id' => 'users-error', 'class' => 'invalid-feedback']],
                    'error message',
                '/div',
                ['div' => ['id' => 'users-help', 'class' => 'form-text']],
                    'Help text',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCheckboxControlWithErrorAndHelpAndOptions()
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'help' => [
                'id' => 'custom-help',
                'foo' => 'bar',
                'class' => 'help-class',
                'content' => 'Help text',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group form-check checkbox is-invalid']],
                ['input' => [
                    'class' => 'is-invalid',
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => 0,
                ]],
                ['input' => [
                    'class' => 'form-check-input is-invalid',
                    'type' => 'checkbox',
                    'name' => 'users',
                    'id' => 'users',
                    'aria-invalid' => 'true',
                    'aria-describedby' => 'users-error custom-help',
                    'value' => 1,
                ]],
                ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['id' => 'users-error', 'class' => 'invalid-feedback']],
                    'error message',
                '/div',
                ['div' => [
                    'id' => 'custom-help',
                    'foo' => 'bar',
                    'class' => 'help-class form-text',
                ]],
                    'Help text',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCheckboxControlContainerOptions()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            ['div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class mb-3 form-group form-check checkbox',
            ]],
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
                    'value' => 1,
                ]],
                ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                    'Users',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCheckboxControlContainerOptionsWithError()
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            ['div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class mb-3 form-group form-check checkbox is-invalid',
            ]],
                ['input' => [
                    'class' => 'is-invalid',
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => 0,
                ]],
                ['input' => [
                    'aria-invalid' => 'true',
                    'class' => 'form-check-input is-invalid',
                    'type' => 'checkbox',
                    'name' => 'users',
                    'id' => 'users',
                    'aria-invalid' => 'true',
                    'aria-describedby' => 'users-error',
                    'value' => 1,
                ]],
                ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['id' => 'users-error', 'class' => 'invalid-feedback']],
                    'error message',
                '/div',
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
            ['div' => ['class' => 'mb-3 form-group form-check checkbox']],
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
                        'value' => 1,
                    ]],
                    'Users',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCheckboxControlNestedInputWithTooltip()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'nestedInput' => true,
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group form-check checkbox']],
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
                        'value' => 1,
                    ]],
                    'Users ',
                    'span' => [
                        'data-bs-toggle' => 'tooltip',
                        'title' => 'Tooltip text',
                        'class' => 'bi bi-info-circle-fill',
                    ],
                    '/span',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCheckboxControlNestedInputWithError()
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'nestedInput' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group form-check checkbox is-invalid']],
                ['input' => [
                    'class' => 'is-invalid',
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => 0,
                ]],
                ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                    ['input' => [
                        'aria-invalid' => 'true',
                        'class' => 'form-check-input is-invalid',
                        'type' => 'checkbox',
                        'name' => 'users',
                        'id' => 'users',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'users-error',
                        'value' => 1,
                    ]],
                    'Users',
                '/label',
                ['div' => ['id' => 'users-error', 'class' => 'invalid-feedback']],
                    'error message',
                '/div',
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
            ['div' => ['class' => 'mb-3 form-check form-check-inline align-top checkbox']],
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
                    'value' => 1,
                ]],
                ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                    'Users',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCheckboxControlInlineWithDisabledLabel()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'inline' => true,
            'label' => false,
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-check form-check-inline align-top checkbox']],
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
                    'value' => 1,
                ]],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCheckboxControlInlineWithCustomLabel()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'inline' => true,
            'label' => 'Custom Label',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-check form-check-inline align-top checkbox']],
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
                    'value' => 1,
                ]],
                ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                    'Custom Label',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCheckboxControlInlineWithCustomLabelOptions()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'inline' => true,
            'label' => [
                'class' => 'custom-label-class',
                'foo' => 'bar',
                'text' => 'Custom Label',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-check form-check-inline align-top checkbox']],
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
                    'value' => 1,
                ]],
                ['label' => [
                    'class' => 'custom-label-class form-check-label',
                    'foo' => 'bar',
                    'for' => 'users',
                ]],
                    'Custom Label',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCheckboxControlInlineWithHelp()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'inline' => true,
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-check form-check-inline align-top checkbox']],
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
                    'aria-describedby' => 'users-help',
                    'value' => 1,
                ]],
                ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['id' => 'users-help','class' => 'form-text']],
                    'Help text',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCheckboxControlInlineWithHelpOptions()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'inline' => true,
            'help' => [
                'id' => 'custom-help',
                'foo' => 'bar',
                'class' => 'help-class',
                'content' => 'Help text',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-check form-check-inline align-top checkbox']],
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
                    'aria-describedby' => 'custom-help',
                    'value' => 1,
                ]],
                ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => [
                    'id' => 'custom-help',
                    'foo' => 'bar',
                    'class' => 'help-class form-text',
                ]],
                    'Help text',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCheckboxControlInlineWithTooltip()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'inline' => true,
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-check form-check-inline align-top checkbox']],
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
                    'value' => 1,
                ]],
                ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                    'Users ',
                    'span' => [
                        'data-bs-toggle' => 'tooltip',
                        'title' => 'Tooltip text',
                        'class' => 'bi bi-info-circle-fill',
                    ],
                    '/span',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCheckboxControlInlineWithError()
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'inline' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-check form-check-inline align-top checkbox is-invalid']],
                ['input' => [
                    'class' => 'is-invalid',
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => 0,
                ]],
                ['input' => [
                    'aria-invalid' => 'true',
                    'class' => 'form-check-input is-invalid',
                    'type' => 'checkbox',
                    'name' => 'users',
                    'id' => 'users',
                    'aria-invalid' => 'true',
                    'aria-describedby' => 'users-error',
                    'value' => 1,
                ]],
                ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['id' => 'users-error', 'class' => 'invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCheckboxControlInlineContainerOptions()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'inline' => true,
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            ['div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class mb-3 form-check form-check-inline align-top checkbox',
            ]],
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
                    'value' => 1,
                ]],
                ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                    'Users',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCheckboxControlInlineContainerOptionsWithError()
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'inline' => true,
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            ['div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class mb-3 form-check form-check-inline align-top checkbox is-invalid',
            ]],
                ['input' => [
                    'class' => 'is-invalid',
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => 0,
                ]],
                ['input' => [
                    'aria-invalid' => 'true',
                    'class' => 'form-check-input is-invalid',
                    'type' => 'checkbox',
                    'name' => 'users',
                    'id' => 'users',
                    'aria-invalid' => 'true',
                    'aria-describedby' => 'users-error',
                    'value' => 1,
                ]],
                ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['id' => 'users-error', 'class' => 'invalid-feedback']],
                    'error message',
                '/div',
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
            ['div' => ['class' => 'mb-3 form-check form-check-inline align-top checkbox']],
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
                        'value' => 1,
                    ]],
                    'Users',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCheckboxControlInlineNestedInputWithTooltip()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'inline' => true,
            'nestedInput' => true,
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-check form-check-inline align-top checkbox']],
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
                        'value' => 1,
                    ]],
                    'Users ',
                    'span' => [
                        'data-bs-toggle' => 'tooltip',
                        'title' => 'Tooltip text',
                        'class' => 'bi bi-info-circle-fill',
                    ],
                    '/span',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCheckboxControlSwitch()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'switch' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group form-check form-switch checkbox']],
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
                    'value' => 1,
                ]],
                ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                    'Users',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
