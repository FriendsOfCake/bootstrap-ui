<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\InlineAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class CheckboxCustomControlTest extends AbstractFormHelperTest
{
    public function testInlineAlignCustomCheckboxControl()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomCheckboxControlWithDisabledLabel()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'custom' => true,
            'label' => false,
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomCheckboxControlWithCustomLabel()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'custom' => true,
            'label' => 'Custom Label',
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
                    'Custom Label',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomCheckboxControlWithCustomLabelOptions()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'custom' => true,
            'label' => [
                'class' => 'custom-label-class',
                'foo' => 'bar',
                'text' => 'Custom Label',
            ],
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
                ['label' => ['class' => 'custom-label-class custom-control-label', 'foo' => 'bar', 'for' => 'users']],
                    'Custom Label',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomCheckboxControlWithHelp()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'custom' => true,
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group custom-control custom-checkbox custom-control-inline checkbox']],
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => 0,
                ]],
                ['input' => [
                    'class' => 'custom-control-input',
                    'type' => 'checkbox',
                    'name' => 'users',
                    'id' => 'users',
                    'value' => 1,
                ]],
                ['label' => ['class' => 'custom-control-label', 'for' => 'users']],
                    'Users',
                '/label',
                ['small' => ['class' => 'visually-hidden form-text text-muted']],
                    'Help text',
                '/small',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomCheckboxControlWithHelpOptions()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'custom' => true,
            'help' => [
                'foo' => 'bar',
                'content' => 'Help text',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'form-group custom-control custom-checkbox custom-control-inline checkbox']],
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => 0,
                ]],
                ['input' => [
                    'class' => 'custom-control-input',
                    'type' => 'checkbox',
                    'name' => 'users',
                    'id' => 'users',
                    'value' => 1,
                ]],
                ['label' => ['class' => 'custom-control-label', 'for' => 'users']],
                    'Users',
                '/label',
                ['small' => ['foo' => 'bar', 'class' => 'visually-hidden form-text text-muted']],
                    'Help text',
                '/small',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomCheckboxControlWithTooltip()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'custom' => true,
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group custom-control custom-checkbox custom-control-inline checkbox']],
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => 0,
                ]],
                ['input' => [
                    'class' => 'custom-control-input',
                    'type' => 'checkbox',
                    'name' => 'users',
                    'id' => 'users',
                    'value' => 1,
                ]],
                ['label' => ['class' => 'custom-control-label', 'for' => 'users']],
                    'Users ',
                    'span' => [
                        'data-bs-toggle' => 'tooltip',
                        'title' => 'Tooltip text',
                        'class' => 'fas fa-info-circle',
                    ],
                    '/span',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomCheckboxControlWithError()
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
            'custom' => true,
        ]);
        $expected = [
            ['div' => [
                'class' => 'form-group custom-control custom-checkbox custom-control-inline position-relative checkbox is-invalid',
            ]],
                ['input' => [
                    'class' => 'is-invalid',
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => 0,
                ]],
                ['input' => [
                    'class' => 'custom-control-input is-invalid',
                    'type' => 'checkbox',
                    'name' => 'users',
                    'id' => 'users',
                    'value' => 1,
                ]],
                ['label' => ['class' => 'custom-control-label', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['class' => 'invalid-tooltip']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomCheckboxControlContainerOptions()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'custom' => true,
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            ['div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class form-group custom-control custom-checkbox custom-control-inline checkbox',
            ]],
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
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomCheckboxControlContainerOptionsWithError()
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];

        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'custom' => true,
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            ['div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class form-group custom-control custom-checkbox custom-control-inline position-relative checkbox is-invalid',
            ]],
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => 0,
                    'class' => 'is-invalid',
                ]],
                ['input' => [
                    'type' => 'checkbox',
                    'name' => 'users',
                    'value' => '1',
                    'id' => 'users',
                    'class' => 'custom-control-input is-invalid',
                ]],
                ['label' => ['class' => 'custom-control-label', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['class' => 'invalid-tooltip']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomCheckboxControlInline()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomCheckboxControlInlineWithDisabledLabel()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'custom' => true,
            'inline' => true,
            'label' => false,
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomCheckboxControlInlineWithCustomLabel()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'custom' => true,
            'inline' => true,
            'label' => 'Custom Label',
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
                    'Custom Label',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomCheckboxControlInlineWithHelp()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'custom' => true,
            'inline' => true,
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group custom-control custom-checkbox custom-control-inline checkbox']],
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => 0,
                ]],
                ['input' => [
                    'class' => 'custom-control-input',
                    'type' => 'checkbox',
                    'name' => 'users',
                    'id' => 'users',
                    'value' => 1,
                ]],
                ['label' => ['class' => 'custom-control-label', 'for' => 'users']],
                    'Users',
                '/label',
                ['small' => ['class' => 'visually-hidden form-text text-muted']],
                    'Help text',
                '/small',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomCheckboxControlInlineWithHelpOptions()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'custom' => true,
            'inline' => true,
            'help' => [
                'foo' => 'bar',
                'content' => 'Help text',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'form-group custom-control custom-checkbox custom-control-inline checkbox']],
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => 0,
                ]],
                ['input' => [
                    'class' => 'custom-control-input',
                    'type' => 'checkbox',
                    'name' => 'users',
                    'id' => 'users',
                    'value' => 1,
                ]],
                ['label' => ['class' => 'custom-control-label', 'for' => 'users']],
                    'Users',
                '/label',
                ['small' => ['foo' => 'bar', 'class' => 'visually-hidden form-text text-muted']],
                    'Help text',
                '/small',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomCheckboxControlInlineWithTooltip()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'custom' => true,
            'inline' => true,
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group custom-control custom-checkbox custom-control-inline checkbox']],
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => 0,
                ]],
                ['input' => [
                    'class' => 'custom-control-input',
                    'type' => 'checkbox',
                    'name' => 'users',
                    'id' => 'users',
                    'value' => 1,
                ]],
                ['label' => ['class' => 'custom-control-label', 'for' => 'users']],
                    'Users ',
                    'span' => [
                        'data-bs-toggle' => 'tooltip',
                        'title' => 'Tooltip text',
                        'class' => 'fas fa-info-circle',
                    ],
                    '/span',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomCheckboxControlInlineWithError()
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
            'custom' => true,
            'inline' => true,
        ]);
        $expected = [
            ['div' => [
                'class' => 'form-group custom-control custom-checkbox custom-control-inline position-relative checkbox is-invalid',
            ]],
                ['input' => [
                    'class' => 'is-invalid',
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => 0,
                ]],
                ['input' => [
                    'class' => 'custom-control-input is-invalid',
                    'type' => 'checkbox',
                    'name' => 'users',
                    'id' => 'users',
                    'value' => 1,
                ]],
                ['label' => ['class' => 'custom-control-label', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['class' => 'invalid-tooltip']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomCheckboxControlInlineContainerOptions()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'custom' => true,
            'inline' => true,
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            ['div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class form-group custom-control custom-checkbox custom-control-inline checkbox',
            ]],
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
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomCheckboxControlInlineContainerOptionsWithError()
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];

        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'custom' => true,
            'inline' => true,
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            ['div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class form-group custom-control custom-checkbox custom-control-inline position-relative checkbox is-invalid',
            ]],
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => 0,
                    'class' => 'is-invalid',
                ]],
                ['input' => [
                    'type' => 'checkbox',
                    'name' => 'users',
                    'value' => '1',
                    'id' => 'users',
                    'class' => 'custom-control-input is-invalid',
                ]],
                ['label' => ['class' => 'custom-control-label', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['class' => 'invalid-tooltip']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
