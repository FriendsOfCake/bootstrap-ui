<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\InlineAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class MultipleCheckboxControlTest extends AbstractFormHelperTest
{
    public function testInlineAlignMultipleCheckboxControl()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => [
                    'class' => 'form-group d-flex position-relative multicheckbox',
                    'role' => 'group',
                    'aria-labelledby' => 'users-group-label',
                ]],
                    ['span' => ['id' => 'users-group-label', 'class' => 'form-label visually-hidden']],
                        'Users',
                    '/span',
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignMultipleCheckboxControlWithDisabledLabel()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'label' => false,
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => [
                    'class' => 'form-group d-flex position-relative multicheckbox',
                    'role' => 'group',
                    'aria-labelledby' => 'users-group-label',
                ]],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignMultipleCheckboxControlWithCustomLabel()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'label' => 'Custom Label',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => [
                    'class' => 'form-group d-flex position-relative multicheckbox',
                    'role' => 'group',
                    'aria-labelledby' => 'users-group-label',
                ]],
                    ['span' => ['id' => 'users-group-label', 'class' => 'form-label visually-hidden']],
                        'Custom Label',
                    '/span',
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignMultipleCheckboxControlWithCustomLabelOptions()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

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
            ['div' => ['class' => 'col-auto']],
                ['div' => [
                    'class' => 'form-group d-flex position-relative multicheckbox',
                    'role' => 'group',
                    'aria-labelledby' => 'users-group-label',
                ]],
                    ['span' => [
                        'id' => 'users-group-label',
                        'class' => 'custom-label-class form-label visually-hidden',
                        'foo' => 'bar',
                    ]],
                        'Custom Label',
                    '/span',
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignMultipleCheckboxControlWithHelp()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => [
                    'class' => 'form-group d-flex position-relative multicheckbox',
                    'role' => 'group',
                    'aria-labelledby' => 'users-group-label',
                ]],
                    ['span' => ['id' => 'users-group-label', 'class' => 'form-label visually-hidden']],
                        'Users',
                    '/span',
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
                    ['small' => ['class' => 'visually-hidden form-text text-muted']],
                        'Help text',
                    '/small',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignMultipleCheckboxControlWithHelpOptions()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [],
            'help' => [
                'foo' => 'bar',
                'content' => 'Help text',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => [
                    'class' => 'form-group d-flex position-relative multicheckbox',
                    'role' => 'group',
                    'aria-labelledby' => 'users-group-label',
                ]],
                    ['span' => ['id' => 'users-group-label', 'class' => 'form-label visually-hidden']],
                        'Users',
                    '/span',
                    ['input' => [
                        'type' => 'hidden',
                        'name' => 'users',
                        'value' => '',
                    ]],
                    ['small' => ['foo' => 'bar', 'class' => 'visually-hidden form-text text-muted']],
                        'Help text',
                    '/small',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignMultipleCheckboxControlWithTooltip()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [],
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => [
                    'class' => 'form-group d-flex position-relative multicheckbox',
                    'role' => 'group',
                    'aria-labelledby' => 'users-group-label',
                ]],
                    ['span' => ['id' => 'users-group-label', 'class' => 'form-label visually-hidden']],
                        'Users ',
                        'span' => [
                            'data-bs-toggle' => 'tooltip',
                            'title' => 'Tooltip text',
                            'class' => 'fas fa-info-circle',
                        ],
                        '/span',
                    '/span',
                    ['input' => [
                        'type' => 'hidden',
                        'name' => 'users',
                        'value' => '',
                    ]],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignMultipleCheckboxControlWithError()
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
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => [
                    'class' => 'form-group d-flex position-relative multicheckbox is-invalid',
                    'role' => 'group',
                    'aria-labelledby' => 'users-group-label',
                ]],
                    ['span' => ['id' => 'users-group-label', 'class' => 'form-label visually-hidden']],
                        'Users',
                    '/span',
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
                            'value' => 2,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                            'option 2',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'invalid-tooltip']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignMultipleCheckboxControlContainerOptions()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

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
            ['div' => ['class' => 'col-auto']],
                ['div' => [
                    'attribute' => 'container-attribute',
                    'class' => 'container-class form-group d-flex position-relative multicheckbox',
                    'role' => 'group',
                    'aria-labelledby' => 'users-group-label',
                ]],
                    ['span' => ['id' => 'users-group-label', 'class' => 'form-label visually-hidden']],
                        'Users',
                    '/span',
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignMultipleCheckboxControlContainerOptionsWithError()
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
            ['div' => ['class' => 'col-auto']],
                ['div' => [
                    'attribute' => 'container-attribute',
                    'class' => 'container-class form-group d-flex position-relative multicheckbox is-invalid',
                    'role' => 'group',
                    'aria-labelledby' => 'users-group-label',
                ]],
                    ['span' => ['id' => 'users-group-label', 'class' => 'form-label visually-hidden']],
                        'Users',
                    '/span',
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
                            'value' => 2,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users-2']],
                            'option 2',
                        '/label',
                    '/div',
                    ['div' => ['class' => 'invalid-tooltip']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignMultipleCheckboxControlWithPerOptionConfiguration()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

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
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => [
                    'class' => 'form-group d-flex position-relative multicheckbox',
                    'role' => 'group',
                    'aria-labelledby' => 'users-group-label',
                ]],
                    ['span' => ['id' => 'users-group-label', 'class' => 'form-label visually-hidden']],
                        'Users',
                    '/span',
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
                    ['div' => ['class' => 'form-check form-check-inline']],
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
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignMultipleCheckboxControlNestedInput()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'nestedInput' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => [
                    'class' => 'form-group d-flex position-relative multicheckbox',
                    'role' => 'group',
                    'aria-labelledby' => 'users-group-label',
                ]],
                    ['span' => ['id' => 'users-group-label', 'class' => 'form-label visually-hidden']],
                        'Users',
                    '/span',
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignMultipleCheckboxControlWithPerOptionConfigurationNestedInput()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

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
            ],
            'nestedInput' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => [
                    'class' => 'form-group d-flex position-relative multicheckbox',
                    'role' => 'group',
                    'aria-labelledby' => 'users-group-label',
                ]],
                    ['span' => ['id' => 'users-group-label', 'class' => 'form-label visually-hidden']],
                        'Users',
                    '/span',
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
                    ['div' => ['class' => 'form-check form-check-inline']],
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
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignMultipleCheckboxControlOptionGroups()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

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
            ['div' => ['class' => 'col-auto']],
                ['div' => [
                    'class' => 'form-group d-flex position-relative multicheckbox',
                    'role' => 'group',
                    'aria-labelledby' => 'users-group-label',
                ]],
                    ['span' => ['id' => 'users-group-label', 'class' => 'form-label visually-hidden']],
                        'Users',
                    '/span',
                    ['input' => [
                        'type' => 'hidden',
                        'name' => 'users',
                        'value' => '',
                    ]],
                    ['fieldset' => ['class' => 'form-group']],
                        ['legend' => ['class' => 'col-form-label float-none pt-0']],
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
                    ['fieldset' => ['class' => 'form-group']],
                        ['legend' => ['class' => 'col-form-label float-none pt-0']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignMultipleCheckboxControlOptionGroupsWithError()
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

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
            ['div' => ['class' => 'col-auto']],
                ['div' => [
                    'class' => 'form-group d-flex position-relative multicheckbox is-invalid',
                    'role' => 'group',
                    'aria-labelledby' => 'users-group-label',
                ]],
                    ['span' => ['id' => 'users-group-label', 'class' => 'form-label visually-hidden']],
                        'Users',
                    '/span',
                    ['input' => [
                        'class' => 'is-invalid',
                        'type' => 'hidden',
                        'name' => 'users',
                        'value' => '',
                    ]],
                    ['fieldset' => ['class' => 'form-group']],
                        ['legend' => ['class' => 'col-form-label float-none pt-0']],
                            'group 1',
                        '/legend',
                        ['div' => ['class' => 'form-check form-check-inline']],
                            ['input' => [
                                'class' => 'form-check-input is-invalid',
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
                                'class' => 'form-check-input is-invalid',
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
                    ['fieldset' => ['class' => 'form-group']],
                        ['legend' => ['class' => 'col-form-label float-none pt-0']],
                            'group 2',
                        '/legend',
                        ['div' => ['class' => 'form-check form-check-inline']],
                            ['input' => [
                                'class' => 'form-check-input is-invalid',
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
                                'class' => 'form-check-input is-invalid',
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
                    ['div' => ['class' => 'invalid-tooltip']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignMultipleCheckboxControlSwitch()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('users', [
            'multiple' => 'checkbox',
            'switch' => true,
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => [
                    'class' => 'form-group d-flex position-relative multicheckbox',
                    'role' => 'group',
                    'aria-labelledby' => 'users-group-label',
                ]],
                    ['span' => ['id' => 'users-group-label', 'class' => 'form-label visually-hidden']],
                        'Users',
                    '/span',
                    ['input' => [
                        'type' => 'hidden',
                        'name' => 'users',
                        'value' => '',
                    ]],
                    ['div' => ['class' => 'form-check form-switch form-check-inline']],
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
                    ['div' => ['class' => 'form-check form-switch form-check-inline']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
