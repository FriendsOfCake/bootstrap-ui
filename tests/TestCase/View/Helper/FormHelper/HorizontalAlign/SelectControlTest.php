<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\HorizontalAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;
use BootstrapUI\View\Helper\FormHelper;

class SelectControlTest extends AbstractFormHelperTest
{
    public function testHorizontalAlignSelectControl()
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
            'type' => 'select',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group row select']],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'form-select']],
                        ['option' => ['value' => '1']],
                            'option 1',
                        '/option',
                        ['option' => ['value' => '2']],
                            'option 2',
                        '/option',
                    '/select',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignSelectControlWithFloatingLabel()
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
            'type' => 'select',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'label' => [
                'floating' => true,
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group row select']],
                ['div' => ['class' => 'offset-sm-5 col-sm-7 form-floating']],
                    ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'form-select']],
                        ['option' => ['value' => '1']],
                            'option 1',
                        '/option',
                        ['option' => ['value' => '2']],
                            'option 2',
                        '/option',
                    '/select',
                    ['label' => ['class' => 'ps-4', 'for' => 'users']],
                        'Users',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignSelectControlWithDisabledLabel()
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
            'type' => 'select',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'label' => false,
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group row select']],
                ['div' => ['class' => 'col-sm-7']],
                    ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'form-select']],
                        ['option' => ['value' => '1']],
                            'option 1',
                        '/option',
                        ['option' => ['value' => '2']],
                            'option 2',
                        '/option',
                    '/select',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignSelectControlWithCustomLabel()
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
            'type' => 'select',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'label' => 'Custom Label',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group row select']],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'users']],
                    'Custom Label',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'form-select']],
                        ['option' => ['value' => '1']],
                            'option 1',
                        '/option',
                        ['option' => ['value' => '2']],
                            'option 2',
                        '/option',
                    '/select',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignSelectControlWithCustomLabelOptions()
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
            'type' => 'select',
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
            ['div' => ['class' => 'mb-3 form-group row select']],
                ['label' => [
                    'class' => 'custom-label-class col-form-label col-sm-5',
                    'foo' => 'bar',
                    'for' => 'users',
                ]],
                    'Custom Label',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'form-select']],
                        ['option' => ['value' => '1']],
                            'option 1',
                        '/option',
                        ['option' => ['value' => '2']],
                            'option 2',
                        '/option',
                    '/select',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignSelectControlWithHelp()
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
            'type' => 'select',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group row select']],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['select' => [
                        'name' => 'users',
                        'id' => 'users',
                        'class' => 'form-select',
                        'aria-describedby' => 'users-help',
                    ]],
                        ['option' => ['value' => '1']],
                            'option 1',
                        '/option',
                        ['option' => ['value' => '2']],
                            'option 2',
                        '/option',
                    '/select',
                    ['small' => ['id' => 'users-help', 'class' => 'd-block form-text text-muted']],
                        'Help text',
                    '/small',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignSelectControlWithHelpOptions()
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
            'type' => 'select',
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
            ['div' => ['class' => 'mb-3 form-group row select']],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['select' => [
                        'name' => 'users',
                        'id' => 'users',
                        'class' => 'form-select',
                        'aria-describedby' => 'custom-help',
                    ]],
                        ['option' => ['value' => '1']],
                            'option 1',
                        '/option',
                        ['option' => ['value' => '2']],
                            'option 2',
                        '/option',
                    '/select',
                    ['small' => [
                        'id' => 'custom-help',
                        'foo' => 'bar',
                        'class' => 'help-class d-block form-text text-muted',
                    ]],
                        'Help text',
                    '/small',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignSelectControlWithTooltip()
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
            'type' => 'select',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group row select']],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'users']],
                    'Users',
                    'span' => [
                        'data-bs-toggle' => 'tooltip',
                        'title' => 'Tooltip text',
                        'class' => 'bi bi-info-circle-fill',
                    ],
                    '/span',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'form-select']],
                        ['option' => ['value' => '1']],
                            'option 1',
                        '/option',
                        ['option' => ['value' => '2']],
                            'option 2',
                        '/option',
                    '/select',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignSelectControlWithError()
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
            'type' => 'select',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group row select is-invalid']],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'form-select is-invalid']],
                        ['option' => ['value' => '1']],
                            'option 1',
                        '/option',
                        ['option' => ['value' => '2']],
                            'option 2',
                        '/option',
                    '/select',
                    ['div' => ['class' => 'ms-0 invalid-feedback']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignSelectControlContainerOptions()
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
            'type' => 'select',
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
                'class' => 'container-class mb-3 form-group row select',
            ]],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'form-select']],
                        ['option' => ['value' => '1']],
                            'option 1',
                        '/option',
                        ['option' => ['value' => '2']],
                            'option 2',
                        '/option',
                    '/select',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignSelectControlContainerOptionsWithError()
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
            'type' => 'select',
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
                'class' => 'container-class mb-3 form-group row select is-invalid',
            ]],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'form-select is-invalid']],
                        ['option' => ['value' => '1']],
                            'option 1',
                        '/option',
                        ['option' => ['value' => '2']],
                            'option 2',
                        '/option',
                    '/select',
                    ['div' => ['class' => 'ms-0 invalid-feedback']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignSelectControlInputGroupAppend()
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
            'type' => 'select',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'append' => 'append',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group row select']],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['div' => ['class' => 'input-group']],
                        ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'form-select']],
                            ['option' => ['value' => '1']],
                                'option 1',
                            '/option',
                            ['option' => ['value' => '2']],
                                'option 2',
                            '/option',
                        '/select',
                        ['span' => ['class' => 'input-group-text']],
                            'append',
                        '/span',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignSelectControlInputGroupPrepend()
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
            'type' => 'select',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'prepend' => 'prepend',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group row select']],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['div' => ['class' => 'input-group']],
                        ['span' => ['class' => 'input-group-text']],
                            'prepend',
                        '/span',
                        ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'form-select']],
                            ['option' => ['value' => '1']],
                                'option 1',
                            '/option',
                            ['option' => ['value' => '2']],
                                'option 2',
                            '/option',
                        '/select',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
