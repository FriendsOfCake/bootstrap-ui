<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\DefaultAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class RadioControlTest extends AbstractFormHelperTest
{
    public function testDefaultAlignRadioControl(): void
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'id' => 'users',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'radio',
                        'name' => 'users',
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
                        'type' => 'radio',
                        'name' => 'users',
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

    public function testDefaultAlignRadioControlWithDisabledLabel(): void
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'label' => false,
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['input' => [
                    'type' => 'hidden',
                    'id' => 'users',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'radio',
                        'name' => 'users',
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
                        'type' => 'radio',
                        'name' => 'users',
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

    public function testDefaultAlignRadioControlWithCustomLabel(): void
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'label' => 'Custom Label',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Custom Label',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'id' => 'users',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'radio',
                        'name' => 'users',
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
                        'type' => 'radio',
                        'name' => 'users',
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

    public function testDefaultAlignRadioControlWithCustomLabelOptions(): void
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
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
            ['div' => ['class' => 'mb-3 radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'custom-label-class form-label d-block', 'foo' => 'bar']],
                    'Custom Label',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'id' => 'users',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'radio',
                        'name' => 'users',
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
                        'type' => 'radio',
                        'name' => 'users',
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

    public function testDefaultAlignRadioControlWithHelp(): void
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'id' => 'users',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'radio',
                        'name' => 'users',
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
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'aria-describedby' => 'users-help',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['id' => 'users-help', 'class' => 'form-text']],
                    'Help text',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignRadioControlWithHelpOptions(): void
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
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
            ['div' => ['class' => 'mb-3 radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'id' => 'users',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'radio',
                        'name' => 'users',
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
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'aria-describedby' => 'custom-help',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
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

    public function testDefaultAlignRadioControlWithTooltip(): void
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users' ,
                    'span' => [
                        'data-bs-toggle' => 'tooltip',
                        'title' => 'Tooltip text',
                        'class' => 'bi bi-info-circle-fill',
                    ],
                    '/span',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'id' => 'users',
                    'name' => 'users',
                    'value' => '',
                ]],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignRadioControlWithCustomSpacing(): void
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [],
            'spacing' => 'custom-spacing',
        ]);
        $expected = [
            ['div' => [
                'class' => 'custom-spacing radio',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'id' => 'users',
                    'name' => 'users',
                    'value' => '',
                ]],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignRadioControlWithError(): void
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
        ]);
        $expected = [
            ['div' => [
                'class' => 'mb-3 radio is-invalid',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'class' => 'is-invalid',
                    'type' => 'hidden',
                    'id' => 'users',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'aria-invalid' => 'true',
                        'class' => 'form-check-input is-invalid',
                        'type' => 'radio',
                        'name' => 'users',
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
                        'aria-invalid' => 'true',
                        'class' => 'form-check-input is-invalid',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'users-error',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['id' => 'users-error', 'class' => 'invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignRadioControlWithErrorAndHelp(): void
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => [
                'class' => 'mb-3 radio is-invalid',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'class' => 'is-invalid',
                    'type' => 'hidden',
                    'id' => 'users',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input is-invalid',
                        'type' => 'radio',
                        'name' => 'users',
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
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'users-error users-help',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
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

    public function testDefaultAlignRadioControlWithErrorAndHelpOptions(): void
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
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
                'class' => 'mb-3 radio is-invalid',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'class' => 'is-invalid',
                    'type' => 'hidden',
                    'id' => 'users',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input is-invalid',
                        'type' => 'radio',
                        'name' => 'users',
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
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'users-error custom-help',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
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

    public function testDefaultAlignRadioControlContainerOptions(): void
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
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
                'class' => 'container-class mb-3 radio',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'id' => 'users',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'radio',
                        'name' => 'users',
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
                        'type' => 'radio',
                        'name' => 'users',
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

    public function testDefaultAlignRadioControlContainerOptionsWithError(): void
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
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
                'class' => 'container-class mb-3 radio is-invalid',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'class' => 'is-invalid',
                    'type' => 'hidden',
                    'id' => 'users',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'aria-invalid' => 'true',
                        'class' => 'form-check-input is-invalid',
                        'type' => 'radio',
                        'name' => 'users',
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
                        'aria-invalid' => 'true',
                        'class' => 'form-check-input is-invalid',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'users-error',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['id' => 'users-error', 'class' => 'invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignRadioControlNestedInput(): void
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'nestedInput' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'id' => 'users',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'radio',
                            'name' => 'users',
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
                            'type' => 'radio',
                            'name' => 'users',
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

    public function testDefaultAlignRadioControlInline(): void
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'inline' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'id' => 'users',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'radio',
                        'name' => 'users',
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
                        'type' => 'radio',
                        'name' => 'users',
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

    public function testDefaultAlignRadioControlInlineWithDisabledLabel(): void
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'inline' => true,
            'label' => false,
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['input' => [
                    'type' => 'hidden',
                    'id' => 'users',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'radio',
                        'name' => 'users',
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
                        'type' => 'radio',
                        'name' => 'users',
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

    public function testDefaultAlignRadioControlInlineWithCustomLabel(): void
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'inline' => true,
            'label' => 'Custom Label',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Custom Label',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'id' => 'users',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'radio',
                        'name' => 'users',
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
                        'type' => 'radio',
                        'name' => 'users',
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

    public function testDefaultAlignRadioControlInlineWithCustomLabelOptions(): void
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
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
            ['div' => ['class' => 'mb-3 radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => [
                    'id' => 'users-group-label',
                    'class' => 'custom-label-class form-label d-block',
                    'foo' => 'bar',
                ]],
                    'Custom Label',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'id' => 'users',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'radio',
                        'name' => 'users',
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
                        'type' => 'radio',
                        'name' => 'users',
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

    public function testDefaultAlignRadioControlInlineWithHelp(): void
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'inline' => true,
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'id' => 'users',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'radio',
                        'name' => 'users',
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
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'aria-describedby' => 'users-help',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['id' => 'users-help', 'class' => 'form-text']],
                    'Help text',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignRadioControlInlineWithHelpOptions(): void
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
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
            ['div' => ['class' => 'mb-3 radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'id' => 'users',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'radio',
                        'name' => 'users',
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
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'aria-describedby' => 'custom-help',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
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

    public function testDefaultAlignRadioControlInlineWithTooltip(): void
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'inline' => true,
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users' ,
                    'span' => [
                        'data-bs-toggle' => 'tooltip',
                        'title' => 'Tooltip text',
                        'class' => 'bi bi-info-circle-fill',
                    ],
                    '/span',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'id' => 'users',
                    'name' => 'users',
                    'value' => '',
                ]],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignRadioControlInlineWithError(): void
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'inline' => true,
        ]);
        $expected = [
            ['div' => [
                'class' => 'mb-3 radio is-invalid',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'class' => 'is-invalid',
                    'type' => 'hidden',
                    'id' => 'users',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'aria-invalid' => 'true',
                        'class' => 'form-check-input is-invalid',
                        'type' => 'radio',
                        'name' => 'users',
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
                        'aria-invalid' => 'true',
                        'class' => 'form-check-input is-invalid',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'users-error',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['id' => 'users-error', 'class' => 'invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignRadioControlInlineContainerOptions(): void
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
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
                'class' => 'container-class mb-3 radio',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'id' => 'users',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'radio',
                        'name' => 'users',
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
                        'type' => 'radio',
                        'name' => 'users',
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

    public function testDefaultAlignRadioControlInlineContainerOptionsWithError(): void
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
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
                'class' => 'container-class mb-3 radio is-invalid',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'class' => 'is-invalid',
                    'type' => 'hidden',
                    'id' => 'users',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'aria-invalid' => 'true',
                        'class' => 'form-check-input is-invalid',
                        'type' => 'radio',
                        'name' => 'users',
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
                        'aria-invalid' => 'true',
                        'class' => 'form-check-input is-invalid',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'users-error',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['id' => 'users-error', 'class' => 'invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignRadioControlInlineNestedInput(): void
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'inline' => true,
            'nestedInput' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'id' => 'users',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'radio',
                            'name' => 'users',
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
                            'type' => 'radio',
                            'name' => 'users',
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

    public function testDefaultAlignRadioControlInlineNestedInputWithError(): void
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'inline' => true,
            'nestedInput' => true,
        ]);
        $expected = [
            ['div' => [
                'class' => 'mb-3 radio is-invalid',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'class' => 'is-invalid',
                    'type' => 'hidden',
                    'id' => 'users',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        ['input' => [
                            'aria-invalid' => 'true',
                            'class' => 'form-check-input is-invalid',
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-1',
                            'aria-invalid' => 'true',
                            'aria-describedby' => 'users-error',
                            'value' => 1,
                        ]],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        ['input' => [
                            'aria-invalid' => 'true',
                            'class' => 'form-check-input is-invalid',
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-2',
                            'aria-invalid' => 'true',
                            'aria-describedby' => 'users-error',
                            'value' => 2,
                        ]],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['id' => 'users-error', 'class' => 'invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testPerOptionConfiguration(): void
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
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
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'id' => 'users',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'radio',
                        'name' => 'users',
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
                        'type' => 'radio',
                        'name' => 'users',
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
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-12',
                        'value' => 12,
                    ]],
                    ['label' => ['class' => 'customlabelclass', 'for' => 'users-12']],
                        'option 3',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testPerOptionConfigurationInline(): void
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
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
            ],
            'inline' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'id' => 'users',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input',
                        'type' => 'radio',
                        'name' => 'users',
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
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'custominputclass',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-12',
                        'value' => 12,
                    ]],
                    ['label' => ['class' => 'customlabelclass', 'for' => 'users-12']],
                        'option 3',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testPerOptionConfigurationInlineNestedInput(): void
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
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
            ],
            'inline' => true,
            'nestedInput' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'form-label d-block']],
                    'Users',
                '/label',
                ['input' => [
                    'type' => 'hidden',
                    'id' => 'users',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'radio',
                            'name' => 'users',
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
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-2',
                            'value' => 2,
                        ]],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['label' => ['class' => 'customlabelclass', 'for' => 'users-12']],
                        ['input' => [
                            'class' => 'custominputclass',
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-12',
                            'value' => 12,
                        ]],
                        'option 3',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
