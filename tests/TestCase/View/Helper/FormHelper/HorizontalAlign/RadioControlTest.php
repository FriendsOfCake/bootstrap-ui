<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\HorizontalAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;
use BootstrapUI\View\Helper\FormHelper;

class RadioControlTest extends AbstractFormHelperTest
{
    public function testHorizontalAlignRadioControl(): void
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 row radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label col-sm-5 d-block pt-0']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRadioControlWithDisabledLabel(): void
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'label' => false,
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 row radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['div' => ['class' => 'col-sm-7']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRadioControlWithCustomLabel(): void
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'label' => 'Custom Label',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 row radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label col-sm-5 d-block pt-0']],
                    'Custom Label',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRadioControlWithCustomLabelOptions(): void
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

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
            ['div' => ['class' => 'mb-3 row radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'custom-label-class col-form-label col-sm-5 d-block pt-0', 'foo' => 'bar']],
                    'Custom Label',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRadioControlWithHelp(): void
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 row radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label col-sm-5 d-block pt-0']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRadioControlWithHelpOptions(): void
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

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
            ['div' => ['class' => 'mb-3 row radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label col-sm-5 d-block pt-0']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRadioControlWithTooltip(): void
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 row radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label col-sm-5 d-block pt-0']],
                    'Users ' ,
                    'span' => [
                        'data-bs-toggle' => 'tooltip',
                        'title' => 'Tooltip text',
                        'class' => 'bi bi-info-circle-fill',
                    ],
                    '/span',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'hidden',
                        'id' => 'users',
                        'name' => 'users',
                        'value' => '',
                    ]],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRadioControlWithCustomSpacing(): void
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [],
            'spacing' => 'custom-spacing',
        ]);
        $expected = [
            ['div' => [
                'class' => 'custom-spacing row radio',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label col-sm-5 d-block pt-0']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'hidden',
                        'id' => 'users',
                        'name' => 'users',
                        'value' => '',
                    ]],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRadioControlWithError(): void
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
        ]);
        $expected = [
            ['div' => [
                'class' => 'mb-3 row radio is-invalid',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label col-sm-5 d-block pt-0']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRadioControlWithErrorAndHelp(): void
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

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
                'class' => 'mb-3 row radio is-invalid',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label col-sm-5 d-block pt-0']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRadioControlWithErrorAndHelpOptions(): void
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

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
                'class' => 'mb-3 row radio is-invalid',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label col-sm-5 d-block pt-0']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRadioControlContainerOptions(): void
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

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
                'class' => 'container-class mb-3 row radio',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label col-sm-5 d-block pt-0']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRadioControlContainerOptionsWithError(): void
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

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
                'class' => 'container-class mb-3 row radio is-invalid',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label col-sm-5 d-block pt-0']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRadioControlNestedInput(): void
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'nestedInput' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 row radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                 ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label col-sm-5 d-block pt-0']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRadioControlNestedInputWithError(): void
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'nestedInput' => true,
        ]);
        $expected = [
            ['div' => [
                'class' => 'mb-3 row radio is-invalid',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                 ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label col-sm-5 d-block pt-0']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'class' => 'is-invalid',
                        'type' => 'hidden',
                        'id' => 'users',
                        'name' => 'users',
                        'value' => '',
                    ]],
                    ['div' => ['class' => 'form-check']],
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
                    ['div' => ['class' => 'form-check']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRadioControlInline(): void
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'inline' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 row radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label col-sm-5 d-block pt-0']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRadioControlInlineWithDisabledLabel(): void
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

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
            ['div' => ['class' => 'mb-3 row radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['div' => ['class' => 'col-sm-7']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRadioControlInlineWithCustomLabel(): void
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

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
            ['div' => ['class' => 'mb-3 row radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label col-sm-5 d-block pt-0']],
                    'Custom Label',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRadioControlInlineWithCustomLabelOptions(): void
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

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
            ['div' => ['class' => 'mb-3 row radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'custom-label-class col-form-label col-sm-5 d-block pt-0', 'foo' => 'bar']],
                    'Custom Label',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRadioControlInlineWithHelp(): void
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

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
            ['div' => ['class' => 'mb-3 row radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label col-sm-5 d-block pt-0']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRadioControlInlineWithHelpOptions(): void
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

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
            ['div' => ['class' => 'mb-3 row radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label col-sm-5 d-block pt-0']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRadioControlInlineWithTooltip(): void
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'inline' => true,
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 row radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label col-sm-5 d-block pt-0']],
                    'Users ' ,
                    'span' => [
                        'data-bs-toggle' => 'tooltip',
                        'title' => 'Tooltip text',
                        'class' => 'bi bi-info-circle-fill',
                    ],
                    '/span',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'hidden',
                        'id' => 'users',
                        'name' => 'users',
                        'value' => '',
                    ]],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRadioControlInlineWithError(): void
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

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
                'class' => 'mb-3 row radio is-invalid',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label col-sm-5 d-block pt-0']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRadioControlInlineContainerOptions(): void
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

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
                'class' => 'container-class mb-3 row radio',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label col-sm-5 d-block pt-0']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRadioControlInlineContainerOptionsWithError(): void
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

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
                'class' => 'container-class mb-3 row radio is-invalid',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label col-sm-5 d-block pt-0']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRadioControlInlineNestedInput(): void
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

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
            ['div' => ['class' => 'mb-3 row radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label col-sm-5 d-block pt-0']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRadioControlInlineNestedInputWithError(): void
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

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
                'class' => 'mb-3 row radio is-invalid',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label col-sm-5 d-block pt-0']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRadioControlPerOptionConfiguration(): void
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

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
            ['div' => ['class' => 'mb-3 row radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label col-sm-5 d-block pt-0']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRadioControlPerOptionConfigurationInline(): void
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

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
            ['div' => ['class' => 'mb-3 row radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label col-sm-5 d-block pt-0']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRadioControlPerOptionConfigurationInlineNestedInput(): void
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

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
            ['div' => ['class' => 'mb-3 row radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['label' => ['id' => 'users-group-label', 'class' => 'col-form-label col-sm-5 d-block pt-0']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
