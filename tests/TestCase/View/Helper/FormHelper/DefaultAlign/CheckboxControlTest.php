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
                    'value' => 1,
                ]],
                ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                    'Users',
                '/label',
                ['small' => ['class' => 'd-block form-text text-muted']],
                    'Help text',
                '/small',
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
                'foo' => 'bar',
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
                    'value' => 1,
                ]],
                ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                    'Users',
                '/label',
                ['small' => ['foo' => 'bar', 'class' => 'd-block form-text text-muted']],
                    'Help text',
                '/small',
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
                        'class' => 'fas fa-info-circle',
                    ],
                    '/span',
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
                    'class' => 'form-check-input is-invalid',
                    'type' => 'checkbox',
                    'name' => 'users',
                    'id' => 'users',
                    'value' => 1,
                ]],
                ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['class' => 'invalid-feedback']],
                    'error message',
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
                    'class' => 'form-check-input is-invalid',
                    'type' => 'checkbox',
                    'name' => 'users',
                    'id' => 'users',
                    'value' => 1,
                ]],
                ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['class' => 'invalid-feedback']],
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
                        'class' => 'fas fa-info-circle',
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
                        'class' => 'form-check-input is-invalid',
                        'type' => 'checkbox',
                        'name' => 'users',
                        'id' => 'users',
                        'value' => 1,
                    ]],
                    'Users',
                '/label',
                ['div' => ['class' => 'invalid-feedback']],
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
            ['div' => ['class' => 'mb-3 form-check form-check-inline checkbox']],
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
            ['div' => ['class' => 'mb-3 form-check form-check-inline checkbox']],
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
            ['div' => ['class' => 'mb-3 form-check form-check-inline checkbox']],
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
            ['div' => ['class' => 'mb-3 form-check form-check-inline checkbox']],
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

    /**
     * Inline checkbox controls currently do not render help text.
     */
    public function testDefaultAlignCheckboxControlInlineWithHelp()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'inline' => true,
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-check form-check-inline checkbox']],
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

    /**
     * Inline checkboxes currently do not render help text.
     */
    public function testDefaultAlignCheckboxControlInlineWithHelpOptions()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'inline' => true,
            'help' => [
                'foo' => 'bar',
                'content' => 'Help text',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-check form-check-inline checkbox']],
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

    public function testDefaultAlignCheckboxControlInlineWithTooltip()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'checkbox',
            'inline' => true,
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-check form-check-inline checkbox']],
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
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * Inline checkbox controls currently do not render error messages.
     */
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
            ['div' => ['class' => 'mb-3 form-check form-check-inline checkbox is-invalid']],
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
                'class' => 'container-class mb-3 form-check form-check-inline checkbox',
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

    /**
     * Inline checkbox controls currently do not render error messages.
     */
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
                'class' => 'container-class mb-3 form-check form-check-inline checkbox is-invalid',
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
            ['div' => ['class' => 'mb-3 form-check form-check-inline checkbox']],
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
            ['div' => ['class' => 'mb-3 form-check form-check-inline checkbox']],
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
        ];
        $this->assertHtml($expected, $result);
    }
}
