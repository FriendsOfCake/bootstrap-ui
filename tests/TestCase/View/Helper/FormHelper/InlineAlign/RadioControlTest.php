<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\InlineAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class RadioControlTest extends AbstractFormHelperTest
{
    public function testInlineAlignRadioControl()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => [
                    'class' => 'form-group position-relative radio',
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignRadioControlWithDisabledLabel()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'label' => false,
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => [
                    'class' => 'form-group position-relative radio',
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignRadioControlWithCustomLabel()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'label' => 'Custom Label',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => [
                    'class' => 'form-group position-relative radio',
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignRadioControlWithCustomLabelOptions()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

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
            ['div' => ['class' => 'col-auto']],
                ['div' => [
                    'class' => 'form-group position-relative radio',
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignRadioControlWithHelp()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => [
                    'class' => 'form-group position-relative radio',
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
                    ['small' => ['id' => 'users-help', 'class' => 'visually-hidden form-text']],
                        'Help text',
                    '/small',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignRadioControlWithHelpOptions()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

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
            ['div' => ['class' => 'col-auto']],
                ['div' => [
                    'class' => 'form-group position-relative radio',
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
                    ['small' => [
                        'id' => 'custom-help',
                        'foo' => 'bar',
                        'class' => 'help-class visually-hidden form-text',
                    ]],
                        'Help text',
                    '/small',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignRadioControlWithTooltip()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('published', [
            'type' => 'radio',
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => [
                    'class' => 'form-group position-relative radio',
                    'role' => 'group',
                    'aria-labelledby' => 'published-group-label',
                ]],
                    ['span' => ['id' => 'published-group-label', 'class' => 'form-label visually-hidden']],
                        'Published ',
                        'span' => [
                            'data-bs-toggle' => 'tooltip',
                            'title' => 'Tooltip text',
                            'class' => 'bi bi-info-circle-fill',
                        ],
                        '/span',
                    '/span',
                    'input' => [
                        'type' => 'hidden',
                        'name' => 'published',
                        'value' => '',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignRadioControlWithError()
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
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => [
                    'class' => 'form-group position-relative radio is-invalid',
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
                    ['div' => ['id' => 'users-error', 'class' => 'invalid-tooltip']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignRadioControlWithErrorAndHelp()
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
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => [
                    'class' => 'form-group position-relative radio is-invalid',
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
                    ['div' => ['class' => 'form-check form-check-inline']],
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
                    ['div' => ['id' => 'users-error', 'class' => 'invalid-tooltip']],
                        'error message',
                    '/div',
                    ['small' => ['id' => 'users-help', 'class' => 'visually-hidden form-text']],
                        'Help text',
                    '/small',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignRadioControlWithErrorAndHelpOptions()
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
            ['div' => ['class' => 'col-auto']],
                ['div' => [
                    'class' => 'form-group position-relative radio is-invalid',
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
                    ['div' => ['class' => 'form-check form-check-inline']],
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
                    ['div' => ['id' => 'users-error', 'class' => 'invalid-tooltip']],
                        'error message',
                    '/div',
                    ['small' => [
                        'id' => 'custom-help',
                        'foo' => 'bar',
                        'class' => 'help-class visually-hidden form-text',
                    ]],
                        'Help text',
                    '/small',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignRadioControlContainerOptions()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

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
            ['div' => ['class' => 'col-auto']],
                ['div' => [
                    'attribute' => 'container-attribute',
                    'class' => 'container-class form-group position-relative radio',
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignRadioControlContainerOptionsWithError()
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
            ['div' => ['class' => 'col-auto']],
                ['div' => [
                    'attribute' => 'container-attribute',
                    'class' => 'container-class form-group position-relative radio is-invalid',
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
                    ['div' => ['id' => 'users-error', 'class' => 'invalid-tooltip']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignRadioControlWithPerOptionConfiguration()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

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
            ['div' => ['class' => 'col-auto']],
                ['div' => [
                    'class' => 'form-group position-relative radio',
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignRadioControlNestedInput()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'nestedInput' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => [
                    'class' => 'form-group position-relative radio',
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignRadioControlWithPerOptionConfigurationNestedInput()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

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
            'nestedInput' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => [
                    'class' => 'form-group position-relative radio',
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
