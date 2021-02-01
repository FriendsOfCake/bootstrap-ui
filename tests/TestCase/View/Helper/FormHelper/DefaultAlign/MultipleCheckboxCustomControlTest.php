<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\DefaultAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class MultipleCheckboxCustomControlTest extends AbstractFormHelperTest
{
    public function testDefaultAlignCustomMultipleCheckboxControl()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
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
                        'value' => 1,
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
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomMultipleCheckboxControlWithDisabledLabel()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'custom' => true,
            'label' => false,
        ]);
        $expected = [
            ['div' => [
                'class' => 'form-group multicheckbox',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
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
                        'value' => 1,
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
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomMultipleCheckboxControlWithCustomLabel()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'custom' => true,
            'label' => 'Custom Label',
        ]);
        $expected = [
            ['div' => [
                'class' => 'form-group multicheckbox',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Custom Label',
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
                        'value' => 1,
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
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomMultipleCheckboxControlWithTooltip()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [],
            'custom' => true,
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => [
                'class' => 'form-group multicheckbox',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users ',
                    'span' => [
                        'data-toggle' => 'tooltip',
                        'title' => 'Tooltip text',
                        'class' => 'fas fa-info-circle',
                    ],
                    '/span',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomMultipleCheckboxControlWithError()
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'custom' => true,
        ]);
        $expected = [
            ['div' => [
                'class' => 'form-group multicheckbox is-invalid',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users',
                '/label',
                ['input' => [
                    'class' => 'is-invalid',
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'custom-control custom-checkbox']],
                    ['input' => [
                        'class' => 'custom-control-input is-invalid',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'custom-control custom-checkbox']],
                    ['input' => [
                        'class' => 'custom-control-input is-invalid',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['class' => 'invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomMultipleCheckboxControlContainerOptions()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'custom' => true,
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            ['div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class form-group multicheckbox',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
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
                        'value' => 1,
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
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomMultipleCheckboxControlContainerOptionsWithError()
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'custom' => true,
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            ['div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class form-group multicheckbox is-invalid',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                    'class' => 'is-invalid',
                ]],
                ['div' => ['class' => 'custom-control custom-checkbox']],
                    ['input' => [
                        'class' => 'custom-control-input is-invalid',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'custom-control custom-checkbox']],
                    ['input' => [
                        'class' => 'custom-control-input is-invalid',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['class' => 'invalid-feedback']],
                    'error message',
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
                2 => 'option 2',
            ],
            'custom' => true,
            'inline' => true,
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
                        'value' => 1,
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
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomMultipleCheckboxControlInlineWithDisabledLabel()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'custom' => true,
            'inline' => true,
            'label' => false,
        ]);
        $expected = [
            ['div' => [
                'class' => 'form-group multicheckbox',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
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
                        'value' => 1,
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
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomMultipleCheckboxControlInlineWithCustomLabel()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'custom' => true,
            'inline' => true,
            'label' => 'Custom Label',
        ]);
        $expected = [
            ['div' => [
                'class' => 'form-group multicheckbox',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Custom Label',
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
                        'value' => 1,
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
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomMultipleCheckboxControlInlineWithTooltip()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [],
            'custom' => true,
            'inline' => true,
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => [
                'class' => 'form-group multicheckbox',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users ',
                    'span' => [
                        'data-toggle' => 'tooltip',
                        'title' => 'Tooltip text',
                        'class' => 'fas fa-info-circle',
                    ],
                    '/span',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomMultipleCheckboxControlInlineWithError()
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'custom' => true,
            'inline' => true,
        ]);
        $expected = [
            ['div' => [
                'class' => 'form-group multicheckbox is-invalid',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users',
                '/label',
                ['input' => [
                    'class' => 'is-invalid',
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'custom-control custom-checkbox custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input is-invalid',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'custom-control custom-checkbox custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input is-invalid',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['class' => 'invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomMultipleCheckboxControlInlineContainerOptions()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
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
                'class' => 'container-class form-group multicheckbox',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
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
                        'value' => 1,
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
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomMultipleCheckboxControlInlineContainerOptionsWithError()
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
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
                'class' => 'container-class form-group multicheckbox is-invalid',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                    'class' => 'is-invalid',
                ]],
                ['div' => ['class' => 'custom-control custom-checkbox custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input is-invalid',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'custom-control custom-checkbox custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input is-invalid',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['class' => 'invalid-feedback']],
                    'error message',
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
                    2 => 'option 2',
                ],
                'group 2' => [
                    3 => 'option 3',
                    4 => 'option 4',
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
                            'value' => 1,
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
                            'value' => 2,
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
                            'value' => 3,
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
                            'value' => 4,
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
                    2 => 'option 2',
                ],
                'group 2' => [
                    3 => 'option 3',
                    4 => 'option 4',
                ],
            ],
            'custom' => true,
            'inline' => true,
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
                            'value' => 1,
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
                            'value' => 2,
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
                            'value' => 3,
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
                            'value' => 4,
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
                ['div' => ['class' => 'custom-control custom-checkbox']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'value' => 1,
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
                        'value' => 2,
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
                            'value' => 3,
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
                            'value' => 4,
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
                        'class' => 'customlabelclass',
                    ],
                ],
                'group' => [
                    10 => 'option 4',
                    20 => [
                        'text' => 'option 4',
                        'value' => 20,
                        'class' => 'custominputclass',
                    ],
                    40 => [
                        'text' => 'option 6',
                        'value' => 40,
                        'label' => [
                            'class' => 'customlabelclass',
                        ],
                    ],
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
                ['div' => ['class' => 'custom-control custom-checkbox']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'value' => 1,
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
                        'value' => 2,
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
                        'value' => 12,
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
                            'value' => 10,
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
                            'value' => 20,
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
                            'value' => 40,
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
}
