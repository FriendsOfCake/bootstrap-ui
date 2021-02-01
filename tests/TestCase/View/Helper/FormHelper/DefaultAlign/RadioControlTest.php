<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\DefaultAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class RadioControlTest extends AbstractFormHelperTest
{
    public function testDefaultAlignRadioControl()
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
            ['div' => ['class' => 'form-group radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
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

    public function testDefaultAlignRadioControlWithDisabledLabel()
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
            ['div' => ['class' => 'form-group radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['input' => [
                    'type' => 'hidden',
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

    public function testDefaultAlignRadioControlWithCustomLabel()
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
            ['div' => ['class' => 'form-group radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
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

    public function testDefaultAlignRadioControlWithTooltip()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users' ,
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

    public function testDefaultAlignRadioControlWithError()
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
                'class' => 'form-group radio is-invalid',
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
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input is-invalid',
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
                        'class' => 'form-check-input is-invalid',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
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

    public function testDefaultAlignRadioControlContainerOptions()
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
                'class' => 'container-class form-group radio',
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

    public function testDefaultAlignRadioControlContainerOptionsWithError()
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
                'class' => 'container-class form-group radio is-invalid',
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
                ['div' => ['class' => 'form-check']],
                    ['input' => [
                        'class' => 'form-check-input is-invalid',
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
                        'class' => 'form-check-input is-invalid',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
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

    public function testDefaultAlignRadioControlNestedInput()
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
            ['div' => ['class' => 'form-group radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
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

    public function testDefaultAlignRadioControlInline()
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
            ['div' => ['class' => 'form-group radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
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

    public function testDefaultAlignRadioControlInlineWithDisabledLabel()
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
            ['div' => ['class' => 'form-group radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['input' => [
                    'type' => 'hidden',
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

    public function testDefaultAlignRadioControlInlineWithCustomLabel()
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
            ['div' => ['class' => 'form-group radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
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

    public function testDefaultAlignRadioControlInlineWithTooltip()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'inline' => true,
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
                    'Users' ,
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

    public function testDefaultAlignRadioControlInlineWithError()
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
                'class' => 'form-group radio is-invalid',
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
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input is-invalid',
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
                        'class' => 'form-check-input is-invalid',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
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

    public function testDefaultAlignRadioControlInlineContainerOptions()
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
                'class' => 'container-class form-group radio',
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

    public function testDefaultAlignRadioControlInlineContainerOptionsWithError()
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
                'class' => 'container-class form-group radio is-invalid',
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
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['input' => [
                        'class' => 'form-check-input is-invalid',
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
                        'class' => 'form-check-input is-invalid',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
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

    public function testDefaultAlignRadioControlInlineNestedInput()
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
            ['div' => ['class' => 'form-group radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
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

    public function testDefaultAlignRadioControlInlineNestedInputWithError()
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
                'class' => 'form-group radio is-invalid',
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
                ['div' => ['class' => 'form-check form-check-inline']],
                    ['label' => ['class' => 'form-check-label', 'for' => 'users-1']],
                        ['input' => [
                            'class' => 'form-check-input is-invalid',
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
                            'class' => 'form-check-input is-invalid',
                            'type' => 'radio',
                            'name' => 'users',
                            'id' => 'users-2',
                            'value' => 2,
                        ]],
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

    public function testPerOptionConfiguration()
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
            ['div' => ['class' => 'form-group radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
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

    public function testPerOptionConfigurationInline()
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
            ['div' => ['class' => 'form-group radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
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

    public function testPerOptionConfigurationInlineNestedInput()
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
            ['div' => ['class' => 'form-group radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'd-block']],
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
