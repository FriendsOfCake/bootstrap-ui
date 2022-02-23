<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\DefaultAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class CheckboxCustomControlTest extends AbstractFormHelperTest
{
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomCheckboxControlWithDisabledLabel()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'custom' => true,
            'label' => false,
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomCheckboxControlWithCustomLabel()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'custom' => true,
            'label' => 'Custom Label',
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
                    'Custom Label',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomCheckboxControlWithCustomLabelOptions()
    {
        $this->Form->create($this->article);

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
                ['label' => [
                    'class' => 'custom-label-class custom-control-label',
                    'foo' => 'bar',
                    'for' => 'users',
                ]],
                    'Custom Label',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomCheckboxControlWithHelp()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'custom' => true,
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group custom-control custom-checkbox checkbox']],
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
                ['small' => ['class' => 'form-text text-muted']],
                    'Help text',
                '/small',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomCheckboxControlWithHelpOptions()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'custom' => true,
            'help' => [
                'foo' => 'bar',
                'content' => 'Help text',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'form-group custom-control custom-checkbox checkbox']],
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
                ['small' => ['foo' => 'bar','class' => 'form-text text-muted']],
                    'Help text',
                '/small',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomCheckboxControlWithTooltip()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'custom' => true,
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group custom-control custom-checkbox checkbox']],
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
                        'data-toggle' => 'tooltip',
                        'title' => 'Tooltip text',
                        'class' => 'fas fa-info-circle',
                    ],
                    '/span',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomCheckboxControlWithError()
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'custom' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group custom-control custom-checkbox checkbox is-invalid']],
                ['input' => [
                    'class' => 'is-invalid',
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => 0,
                ]],
                ['input' => [
                    'aria-invalid' => 'true',
                    'class' => 'custom-control-input is-invalid',
                    'type' => 'checkbox',
                    'name' => 'users',
                    'id' => 'users',
                    'value' => 1,
                ]],
                ['label' => ['class' => 'custom-control-label', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['class' => 'invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomCheckboxControlContainerOptions()
    {
        $this->Form->create($this->article);

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
                'class' => 'container-class form-group custom-control custom-checkbox checkbox',
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

    public function testDefaultAlignCustomCheckboxControlContainerOptionsWithError()
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article);

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
                'class' => 'container-class form-group custom-control custom-checkbox checkbox is-invalid',
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
                    'aria-invalid' => 'true',
                    'class' => 'custom-control-input is-invalid',
                ]],
                ['label' => ['class' => 'custom-control-label', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['class' => 'invalid-feedback']],
                    'error message',
                '/div',
            '/div',
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomCheckboxControlInlineWithDisabledLabel()
    {
        $this->Form->create($this->article);

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

    public function testDefaultAlignCustomCheckboxControlInlineWithCustomLabel()
    {
        $this->Form->create($this->article);

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

    public function testDefaultAlignCustomCheckboxControlInlineWithCustomLabelOptions()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'custom' => true,
            'inline' => true,
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
                ['label' => [
                    'class' => 'custom-label-class custom-control-label',
                    'foo' => 'bar',
                    'for' => 'users',
                ]],
                    'Custom Label',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * Inline checkboxes currently do not render help text.
     */
    public function testDefaultAlignCustomCheckboxControlInlineWithHelp()
    {
        $this->Form->create($this->article);

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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * Inline checkboxes currently do not render help text.
     */
    public function testDefaultAlignCustomCheckboxControlInlineWithHelpOptions()
    {
        $this->Form->create($this->article);

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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomCheckboxControlInlineWithTooltip()
    {
        $this->Form->create($this->article);

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
                        'data-toggle' => 'tooltip',
                        'title' => 'Tooltip text',
                        'class' => 'fas fa-info-circle',
                    ],
                    '/span',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * Inline checkbox controls currently do not render error messages.
     */
    public function testDefaultAlignCustomCheckboxControlInlineWithError()
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'custom' => true,
            'inline' => true,
        ]);
        $expected = [
            ['div' => [
                'class' => 'form-group custom-control custom-checkbox custom-control-inline checkbox is-invalid',
            ]],
                ['input' => [
                    'class' => 'is-invalid',
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => 0,
                ]],
                ['input' => [
                    'aria-invalid' => 'true',
                    'class' => 'custom-control-input is-invalid',
                    'type' => 'checkbox',
                    'name' => 'users',
                    'id' => 'users',
                    'value' => 1,
                ]],
                ['label' => ['class' => 'custom-control-label', 'for' => 'users']],
                    'Users',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomCheckboxControlInlineContainerOptions()
    {
        $this->Form->create($this->article);

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

    /**
     * Inline checkbox controls currently do not render error messages.
     */
    public function testDefaultAlignCustomCheckboxControlInlineContainerOptionsWithError()
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article);

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
                'class' => 'container-class form-group custom-control custom-checkbox custom-control-inline checkbox is-invalid',
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
                    'aria-invalid' => 'true',
                    'class' => 'custom-control-input is-invalid',
                ]],
                ['label' => ['class' => 'custom-control-label', 'for' => 'users']],
                    'Users',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
