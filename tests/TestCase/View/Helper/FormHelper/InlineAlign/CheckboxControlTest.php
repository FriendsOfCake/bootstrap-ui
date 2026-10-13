<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\InlineAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class CheckboxControlTest extends AbstractFormHelperTest
{
    public function testInlineAlignCheckboxControl(): void
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => ['class' => 'form-check checkbox']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCheckboxControlWithDisabledLabel(): void
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'label' => false,
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => ['class' => 'form-check checkbox']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCheckboxControlWithCustomLabel(): void
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'label' => 'Custom Label',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => ['class' => 'form-check checkbox']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCheckboxControlWithCustomLabelOptions(): void
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'label' => [
                'class' => 'custom-label-class',
                'foo' => 'bar',
                'text' => 'Custom Label',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => ['class' => 'form-check checkbox']],
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
                    ['label' => ['class' => 'custom-label-class form-check-label', 'foo' => 'bar', 'for' => 'users']],
                        'Custom Label',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCheckboxControlWithHelp(): void
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => ['class' => 'form-check checkbox']],
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
                    ['div' => ['id' => 'users-help', 'class' => 'form-text visually-hidden']],
                        'Help text',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCheckboxControlWithHelpOptions(): void
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

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
            ['div' => ['class' => 'col-auto']],
                ['div' => ['class' => 'form-check checkbox']],
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
                        'class' => 'help-class form-text visually-hidden',
                    ]],
                        'Help text',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCheckboxControlWithTooltip(): void
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => ['class' => 'form-check checkbox']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCheckboxControlWithError(): void
    {
        $this->withErrorReporting(0, function () {
            $this->article['errors'] = [
                'users' => ['error message'],
            ];
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => ['class' => 'form-check position-relative checkbox is-invalid']],
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
                        'aria-describedby' => 'users-error',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                        'Users',
                    '/label',
                    ['div' => ['id' => 'users-error', 'class' => 'invalid-tooltip']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCheckboxControlWithErrorAndHelp(): void
    {
        $this->withErrorReporting(0, function () {
            $this->article['errors'] = [
                'users' => ['error message'],
            ];
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => ['class' => 'form-check position-relative checkbox is-invalid']],
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
                    ['div' => ['id' => 'users-error', 'class' => 'invalid-tooltip']],
                        'error message',
                    '/div',
                    ['div' => ['id' => 'users-help', 'class' => 'form-text visually-hidden']],
                        'Help text',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCheckboxControlWithErrorAndHelpOptions(): void
    {
        $this->withErrorReporting(0, function () {
            $this->article['errors'] = [
                'users' => ['error message'],
            ];
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

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
            ['div' => ['class' => 'col-auto']],
                ['div' => ['class' => 'form-check position-relative checkbox is-invalid']],
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
                    ['div' => ['id' => 'users-error', 'class' => 'invalid-tooltip']],
                        'error message',
                    '/div',
                    ['div' => [
                        'id' => 'custom-help',
                        'foo' => 'bar',
                        'class' => 'help-class form-text visually-hidden',
                    ]],
                        'Help text',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCheckboxControlContainerOptions(): void
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => [
                    'attribute' => 'container-attribute',
                    'class' => 'container-class form-check checkbox',
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCheckboxControlContainerOptionsWithError(): void
    {
        $this->withErrorReporting(0, function () {
            $this->article['errors'] = [
                'users' => ['error message'],
            ];
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => [
                    'attribute' => 'container-attribute',
                    'class' => 'container-class form-check position-relative checkbox is-invalid',
                ]],
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
                        'aria-describedby' => 'users-error',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                        'Users',
                    '/label',
                    ['div' => ['id' => 'users-error', 'class' => 'invalid-tooltip']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCheckboxControlNestedInput(): void
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'nestedInput' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => ['class' => 'form-check checkbox']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCheckboxControlNestedInputWithTooltip(): void
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'nestedInput' => true,
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => ['class' => 'form-check checkbox']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCheckboxControlInline(): void
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'inline' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => ['class' => 'form-check checkbox']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCheckboxControlInlineWithHelp(): void
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'inline' => true,
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => ['class' => 'form-check checkbox']],
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
                    ['div' => ['id' => 'users-help', 'class' => 'form-text visually-hidden']],
                        'Help text',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCheckboxControlInlineWithHelpOptions(): void
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

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
            ['div' => ['class' => 'col-auto']],
                ['div' => ['class' => 'form-check checkbox']],
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
                        'class' => 'help-class form-text visually-hidden',
                    ]],
                        'Help text',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCheckboxControlInlineWithTooltip(): void
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'inline' => true,
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => ['class' => 'form-check checkbox']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCheckboxControlInlineWithError(): void
    {
        $this->withErrorReporting(0, function () {
            $this->article['errors'] = [
                'users' => ['error message'],
            ];
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'inline' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => ['class' => 'form-check position-relative checkbox is-invalid']],
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
                        'aria-describedby' => 'users-error',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                        'Users',
                    '/label',
                    ['div' => ['id' => 'users-error', 'class' => 'invalid-tooltip']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCheckboxControlInlineNestedInput(): void
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'inline' => true,
            'nestedInput' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => ['class' => 'form-check checkbox']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCheckboxControlInlineNestedInputWithTooltip(): void
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'inline' => true,
            'nestedInput' => true,
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => ['class' => 'form-check checkbox']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCheckboxControlSwitch(): void
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'switch' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => ['class' => 'form-check form-switch checkbox']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
