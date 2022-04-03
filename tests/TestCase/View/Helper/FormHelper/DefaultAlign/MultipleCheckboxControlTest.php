<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\DefaultAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class MultipleCheckboxControlTest extends AbstractFormHelperTest
{
    public function testDefaultAlignMultipleCheckboxControl()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlWithDisabledLabel()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'label' => false,
        ]);
        $expected = [
            ['div' => [
                'class' => 'mb-3 form-group multicheckbox',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlWithCustomLabel()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'label' => 'Custom Label',
        ]);
        $expected = [
            ['div' => [
                'class' => 'mb-3 form-group multicheckbox',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Custom Label',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlWithCustomLabelOptions()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'label' => [
                'class' => 'custom-label-class',
                'foo' => 'bar',
                'text' => 'Custom Label',
            ],
        ]);
        $expected = [
            ['div' => [
                'class' => 'mb-3 form-group multicheckbox',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'custom-label-class form-label d-block', 'foo' => 'bar']],
                    'Custom Label',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlWithHelp()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'aria-describedby' => 'users-help',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'aria-describedby' => 'users-help',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['small' => ['id' => 'users-help', 'class' => 'd-block form-text text-muted']],
                    'Help text',
                '/small',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlWithHelpOptions()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'help' => [
                'id' => 'custom-help',
                'foo' => 'bar',
                'class' => 'help-class',
                'content' => 'Help text',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'aria-describedby' => 'custom-help',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'aria-describedby' => 'custom-help',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['small' => [
                    'id' => 'custom-help',
                    'foo' => 'bar',
                    'class' => 'help-class d-block form-text text-muted',
                ]],
                    'Help text',
                '/small',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlWithTooltip()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [],
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users ',
                    'span' => [
                        'data-bs-toggle' => 'tooltip',
                        'title' => 'Tooltip text',
                        'class' => 'bi bi-info-circle-fill',
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

    public function testDefaultAlignMultipleCheckboxControlWithCustomSpacing()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [],
            'spacing' => 'custom-spacing',
        ]);
        $expected = [
            ['div' => [
                'class' => 'custom-spacing form-group multicheckbox',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
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

    public function testDefaultAlignMultipleCheckboxControlWithError()
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
        ]);
        $expected = [
            ['div' => [
                'class' => 'mb-3 form-group multicheckbox is-invalid',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'class' => 'is-invalid',
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input is-invalid',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'users-error',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input is-invalid',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'users-error',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['id' => 'users-error', 'class' => 'ms-0 invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlWithErrorAndHelp()
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
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => [
                'class' => 'mb-3 form-group multicheckbox is-invalid',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'class' => 'is-invalid',
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input is-invalid',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'users-error users-help',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input is-invalid',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'users-error users-help',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['id' => 'users-error', 'class' => 'ms-0 invalid-feedback']],
                    'error message',
                '/div',
                ['small' => ['id' => 'users-help', 'class' => 'd-block form-text text-muted']],
                    'Help text',
                '/small',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlWithErrorAndHelpOptions()
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
            'help' => [
                'id' => 'custom-help',
                'foo' => 'bar',
                'class' => 'help-class',
                'content' => 'Help text',
            ],
        ]);
        $expected = [
            ['div' => [
                'class' => 'mb-3 form-group multicheckbox is-invalid',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'class' => 'is-invalid',
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input is-invalid',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'users-error custom-help',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input is-invalid',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'users-error custom-help',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['id' => 'users-error', 'class' => 'ms-0 invalid-feedback']],
                    'error message',
                '/div',
                ['small' => [
                    'id' => 'custom-help',
                    'foo' => 'bar',
                    'class' => 'help-class d-block form-text text-muted',
                ]],
                    'Help text',
                '/small',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlCustomAriaDescribedByWithErrorAndHelp()
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
            'help' => 'Help text',
            'aria-describedby' => 'custom',
        ]);
        $expected = [
            ['div' => [
                'class' => 'mb-3 form-group multicheckbox is-invalid',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'class' => 'is-invalid',
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input is-invalid',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'custom',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input is-invalid',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'custom',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['id' => 'users-error', 'class' => 'ms-0 invalid-feedback']],
                    'error message',
                '/div',
                ['small' => ['id' => 'users-help', 'class' => 'd-block form-text text-muted']],
                    'Help text',
                '/small',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlContainerOptions()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            ['div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class mb-3 form-group multicheckbox',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlContainerOptionsWithError()
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
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            ['div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class mb-3 form-group multicheckbox is-invalid',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'class' => 'is-invalid',
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input is-invalid',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'users-error',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input is-invalid',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'users-error',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['id' => 'users-error', 'class' => 'ms-0 invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlNestedInput()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'nestedInput' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-1',
                            'value' => 1,
                        ]],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-2',
                            'value' => 2,
                        ]],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlNestedInputWithError()
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
            'nestedInput' => true,
        ]);
        $expected = [
            ['div' => [
                'class' => 'mb-3 form-group multicheckbox is-invalid',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'class' => 'is-invalid',
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        ['input' => [
                            'class' => 'form-check-input is-invalid',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-1',
                            'aria-invalid' => 'true',
                            'aria-describedby' => 'users-error',
                            'value' => 1,
                        ]],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        ['input' => [
                            'class' => 'form-check-input is-invalid',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-2',
                            'aria-invalid' => 'true',
                            'aria-describedby' => 'users-error',
                            'value' => 2,
                        ]],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['id' => 'users-error', 'class' => 'ms-0 invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlInline()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'inline' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlInlineWithDisabledLabel()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'inline' => true,
            'label' => false,
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlInlineWithCustomLabel()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'inline' => true,
            'label' => 'Custom Label',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Custom Label',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlInlineWithCustomLabelOptions()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'inline' => true,
            'label' => [
                'class' => 'custom-label-class',
                'foo' => 'bar',
                'text' => 'Custom Label',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'custom-label-class form-label d-block', 'foo' => 'bar']],
                    'Custom Label',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlInlineWithHelp()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'inline' => true,
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => [
                'class' => 'mb-3 form-group multicheckbox',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'aria-describedby' => 'users-help',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'aria-describedby' => 'users-help',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['small' => ['id' => 'users-help', 'class' => 'd-block form-text text-muted']],
                    'Help text',
                '/small',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlInlineWithHelpOptions()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'inline' => true,
            'help' => [
                'id' => 'custom-help',
                'foo' => 'bar',
                'class' => 'help-class',
                'content' => 'Help text',
            ],
        ]);
        $expected = [
            ['div' => [
                'class' => 'mb-3 form-group multicheckbox',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'aria-describedby' => 'custom-help',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'aria-describedby' => 'custom-help',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['small' => [
                    'id' => 'custom-help',
                    'foo' => 'bar',
                    'class' => 'help-class d-block form-text text-muted',
                ]],
                    'Help text',
                '/small',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlInlineWithTooltip()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [],
            'inline' => true,
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => [
                'class' => 'mb-3 form-group multicheckbox',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users ',
                    'span' => [
                        'data-bs-toggle' => 'tooltip',
                        'title' => 'Tooltip text',
                        'class' => 'bi bi-info-circle-fill',
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

    public function testDefaultAlignMultipleCheckboxControlInlineWithError()
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
            'inline' => true,
        ]);
        $expected = [
            ['div' => [
                'class' => 'mb-3 form-group multicheckbox is-invalid',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'class' => 'is-invalid',
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input is-invalid',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'users-error',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input is-invalid',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'users-error',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['id' => 'users-error', 'class' => 'ms-0 invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlInlineContainerOptions()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'inline' => true,
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            ['div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class mb-3 form-group multicheckbox',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlInlineContainerOptionsWithError()
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
            'inline' => true,
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            ['div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class mb-3 form-group multicheckbox is-invalid',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'class' => 'is-invalid',
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input is-invalid',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'users-error',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input is-invalid',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'users-error',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['id' => 'users-error', 'class' => 'ms-0 invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlInlineNestedInput()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'inline' => true,
            'nestedInput' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-1',
                            'value' => 1,
                        ]],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-2',
                            'value' => 2,
                        ]],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlOptionGroups()
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
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['fieldset' => ['class' => 'mb-3 form-group']],
                    ['legend' => ['class' => 'col-form-label pt-0']],
                        'group 1',
                    '/legend',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-1',
                            'value' => 1,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                            'option 1',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-2',
                            'value' => 2,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                            'option 2',
                        '/label',
                    '/div',
                 '/fieldset',
                ['fieldset' => ['class' => 'mb-3 form-group']],
                    ['legend' => ['class' => 'col-form-label pt-0']],
                        'group 2',
                    '/legend',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-3',
                            'value' => 3,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-3']],
                            'option 3',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-4',
                            'value' => 4,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-4']],
                            'option 4',
                        '/label',
                    '/div',
                 '/fieldset',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlOptionGroupsWithCustomSpacing()
    {
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
            'spacing' => 'custom-spacing',
        ]);
        $expected = [
            ['div' => [
                'class' => 'custom-spacing form-group multicheckbox',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['fieldset' => ['class' => 'custom-spacing form-group']],
                    ['legend' => ['class' => 'col-form-label pt-0']],
                        'group 1',
                    '/legend',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-1',
                            'value' => 1,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                            'option 1',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-2',
                            'value' => 2,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                            'option 2',
                        '/label',
                    '/div',
                 '/fieldset',
                ['fieldset' => ['class' => 'custom-spacing form-group']],
                    ['legend' => ['class' => 'col-form-label pt-0']],
                        'group 2',
                    '/legend',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-3',
                            'value' => 3,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-3']],
                            'option 3',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-4',
                            'value' => 4,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-4']],
                            'option 4',
                        '/label',
                    '/div',
                 '/fieldset',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlOptionGroupsWithError()
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
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
        ]);
        $expected = [
            ['div' => [
                'class' => 'mb-3 form-group multicheckbox is-invalid',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'class' => 'is-invalid',
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['fieldset' => ['class' => 'mb-3 form-group']],
                    ['legend' => ['class' => 'col-form-label pt-0']],
                        'group 1',
                    '/legend',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input is-invalid',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-1',
                            'aria-invalid' => 'true',
                            'aria-describedby' => 'users-error',
                            'value' => 1,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                            'option 1',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input is-invalid',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-2',
                            'aria-invalid' => 'true',
                            'aria-describedby' => 'users-error',
                            'value' => 2,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                            'option 2',
                        '/label',
                    '/div',
                 '/fieldset',
                ['fieldset' => ['class' => 'mb-3 form-group']],
                    ['legend' => ['class' => 'col-form-label pt-0']],
                        'group 2',
                    '/legend',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input is-invalid',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-3',
                            'aria-invalid' => 'true',
                            'aria-describedby' => 'users-error',
                            'value' => 3,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-3']],
                            'option 3',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input is-invalid',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-4',
                            'aria-invalid' => 'true',
                            'aria-describedby' => 'users-error',
                            'value' => 4,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-4']],
                            'option 4',
                        '/label',
                    '/div',
                 '/fieldset',
                ['div' => ['id' => 'users-error', 'class' => 'ms-0 invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlOptionGroupsNestedInput()
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
            'nestedInput' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['fieldset' => ['class' => 'mb-3 form-group']],
                    ['legend' => ['class' => 'col-form-label pt-0']],
                        'group 1',
                    '/legend',
                    ['div' => ['class' => 'form-check']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-1',
                                'value' => 1,
                            ]],
                            'option 1',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-2',
                                'value' => 2,
                            ]],
                            'option 2',
                        '/label',
                    '/div',
                 '/fieldset',
                ['fieldset' => ['class' => 'mb-3 form-group']],
                    ['legend' => ['class' => 'col-form-label pt-0']],
                        'group 2',
                    '/legend',
                    ['div' => ['class' => 'form-check']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-3']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-3',
                                'value' => 3,
                            ]],
                            'option 3',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-4']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-4',
                                'value' => 4,
                            ]],
                            'option 4',
                        '/label',
                    '/div',
                 '/fieldset',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlOptionGroupsInline()
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
            'inline' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['fieldset' => ['class' => 'mb-3 form-group']],
                    ['legend' => ['class' => 'col-form-label pt-0']],
                        'group 1',
                    '/legend',
                    ['div' => ['class' => 'form-check form-check-inline']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-1',
                            'value' => 1,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                            'option 1',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check form-check-inline']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-2',
                            'value' => 2,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                            'option 2',
                        '/label',
                    '/div',
                 '/fieldset',
                ['fieldset' => ['class' => 'mb-3 form-group']],
                    ['legend' => ['class' => 'col-form-label pt-0']],
                        'group 2',
                    '/legend',
                    ['div' => ['class' => 'form-check form-check-inline']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-3',
                            'value' => 3,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-3']],
                            'option 3',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check form-check-inline']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-4',
                            'value' => 4,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-4']],
                            'option 4',
                        '/label',
                    '/div',
                 '/fieldset',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlOptionGroupsInlineNestedInput()
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
            'inline' => true,
            'nestedInput' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['fieldset' => ['class' => 'mb-3 form-group']],
                    ['legend' => ['class' => 'col-form-label pt-0']],
                        'group 1',
                    '/legend',
                    ['div' => ['class' => 'form-check form-check-inline']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-1',
                                'value' => 1,
                            ]],
                            'option 1',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check form-check-inline']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-2',
                                'value' => 2,
                            ]],
                            'option 2',
                        '/label',
                    '/div',
                 '/fieldset',
                ['fieldset' => ['class' => 'mb-3 form-group']],
                    ['legend' => ['class' => 'col-form-label pt-0']],
                        'group 2',
                    '/legend',
                    ['div' => ['class' => 'form-check form-check-inline']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-3']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-3',
                                'value' => 3,
                            ]],
                            'option 3',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check form-check-inline']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-4']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-4',
                                'value' => 4,
                            ]],
                            'option 4',
                        '/label',
                    '/div',
                 '/fieldset',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlOptionsGroupsAndSingleEntries()
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
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['fieldset' => ['class' => 'mb-3 form-group']],
                    ['legend' => ['class' => 'col-form-label pt-0']],
                        'group',
                    '/legend',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-3',
                            'value' => 3,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-3']],
                            'option 3',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-4',
                            'value' => 4,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-4']],
                            'option 4',
                        '/label',
                    '/div',
                 '/fieldset',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlOptionsGroupsAndSingleEntriesWithPerOptionConfiguration()
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
                    30 => [
                        'text' => 'option 5 without label',
                        'value' => 30,
                        'label' => false,
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
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check']],
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
                ['fieldset' => ['class' => 'mb-3 form-group']],
                    ['legend' => ['class' => 'col-form-label pt-0']],
                        'group',
                    '/legend',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-10',
                            'value' => 10,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-10']],
                            'option 4',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'custominputclass',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-20',
                            'value' => 20,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-20']],
                            'option 4',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-30',
                            'value' => 30,
                        ]],
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input',
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

    public function testDefaultAlignMultipleCheckboxControlOptionsGroupsAndSingleEntriesNestedInput()
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
            'nestedInput' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-1',
                            'value' => 1,
                        ]],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-2',
                            'value' => 2,
                        ]],
                        'option 2',
                    '/label',
                '/div',
                ['fieldset' => ['class' => 'mb-3 form-group']],
                    ['legend' => ['class' => 'col-form-label pt-0']],
                        'group',
                    '/legend',
                    ['div' => ['class' => 'form-check']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-3']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-3',
                                'value' => 3,
                            ]],
                            'option 3',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-4']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-4',
                                'value' => 4,
                            ]],
                            'option 4',
                        '/label',
                    '/div',
                 '/fieldset',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlOptionsGroupsAndSingleEntriesWithPerOptionConfigurationNestedInput()
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
                    30 => [
                        'text' => 'option 5 without label',
                        'value' => 30,
                        'label' => false,
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
            'nestedInput' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-1',
                            'value' => 1,
                        ]],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-2',
                            'value' => 2,
                        ]],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check']],
                    ['label' => ['class' => 'customlabelclass', 'for' => 'users-12']],
                        ['input' => [
                            'class' => 'custominputclass',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-12',
                            'value' => 12,
                        ]],
                        'option 3',
                    '/label',
                '/div',
                ['fieldset' => ['class' => 'mb-3 form-group']],
                    ['legend' => ['class' => 'col-form-label pt-0']],
                        'group',
                    '/legend',
                    ['div' => ['class' => 'form-check']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-10']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-10',
                                'value' => 10,
                            ]],
                            'option 4',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-20']],
                            ['input' => [
                                'class' => 'custominputclass',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-20',
                                'value' => 20,
                            ]],
                            'option 4',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users[]',
                            'id' => 'users-30',
                            'value' => 30,
                        ]],
                    '/div',
                    ['div' => ['class' => 'form-check']],
                        ['label' => ['class' => 'customlabelclass', 'for' => 'users-40']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users[]',
                                'id' => 'users-40',
                                'value' => 40,
                            ]],
                            'option 6',
                        '/label',
                    '/div',
                 '/fieldset',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignMultipleCheckboxControlSwitch()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'switch' => true,
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group multicheckbox', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-switch']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-1',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check form-switch']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'name' => 'users[]',
                        'id' => 'users-2',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
