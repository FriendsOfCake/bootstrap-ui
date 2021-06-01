<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\InlineAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class CheckboxControlTest extends AbstractFormHelperTest
{
    public function testInlineAlignCheckboxControl()
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

    public function testInlineAlignCheckboxControlWithDisabledLabel()
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

    public function testInlineAlignCheckboxControlWithCustomLabel()
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

    public function testInlineAlignCheckboxControlWithCustomLabelOptions()
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

    public function testInlineAlignCheckboxControlWithHelp()
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
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                        'Users',
                    '/label',
                    ['small' => ['class' => 'visually-hidden form-text text-muted']],
                        'Help text',
                    '/small',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCheckboxControlWithHelpOptions()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'help' => [
                'foo' => 'bar',
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
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                        'Users',
                    '/label',
                    ['small' => ['foo' => 'bar', 'class' => 'visually-hidden form-text text-muted']],
                        'Help text',
                    '/small',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCheckboxControlWithTooltip()
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
                            'class' => 'fas fa-info-circle',
                        ],
                        '/span',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCheckboxControlWithError()
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
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                        'Users',
                    '/label',
                    ['div' => ['class' => 'invalid-tooltip']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCheckboxControlContainerOptions()
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

    public function testInlineAlignCheckboxControlContainerOptionsWithError()
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
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                        'Users',
                    '/label',
                    ['div' => ['class' => 'invalid-tooltip']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCheckboxControlNestedInput()
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

    public function testInlineAlignCheckboxControlNestedInputWithTooltip()
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
                            'class' => 'fas fa-info-circle',
                        ],
                        '/span',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCheckboxControlInline()
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

    public function testInlineAlignCheckboxControlInlineWithHelp()
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
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                        'Users',
                    '/label',
                    ['small' => ['class' => 'visually-hidden form-text text-muted']],
                        'Help text',
                    '/small',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCheckboxControlInlineWithHelpOptions()
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
                'foo' => 'bar',
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
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                        'Users',
                    '/label',
                    ['small' => ['foo' => 'bar', 'class' => 'visually-hidden form-text text-muted']],
                        'Help text',
                    '/small',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCheckboxControlInlineWithTooltip()
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
                            'class' => 'fas fa-info-circle',
                        ],
                        '/span',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCheckboxControlInlineWithError()
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
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                        'Users',
                    '/label',
                    ['div' => ['class' => 'invalid-tooltip']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCheckboxControlInlineNestedInput()
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

    public function testInlineAlignCheckboxControlInlineNestedInputWithTooltip()
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
                            'class' => 'fas fa-info-circle',
                        ],
                        '/span',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
