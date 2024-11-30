<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\InlineAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class SelectControlTest extends AbstractFormHelperTest
{
    public function testInlineAlignSelectControl()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('users', [
            'type' => 'select',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'form-group select'],
                    ['label' => ['class' => 'form-label visually-hidden', 'for' => 'users']],
                        'Users',
                    '/label',
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

    public function testInlineAlignSelectControlWithFloatingLabel()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
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
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'form-floating form-group select'],
                    ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'form-select']],
                        ['option' => ['value' => '1']],
                            'option 1',
                        '/option',
                        ['option' => ['value' => '2']],
                            'option 2',
                        '/option',
                    '/select',
                    ['label' => ['for' => 'users']],
                        'Users',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignSelectControlWithDisabledLabel()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
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
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'form-group select'],
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

    public function testInlineAlignSelectControlWithCustomLabel()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
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
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'form-group select'],
                    ['label' => ['class' => 'form-label visually-hidden', 'for' => 'users']],
                        'Custom Label',
                    '/label',
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

    public function testInlineAlignSelectControlWithCustomLabelOptions()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
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
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'form-group select'],
                    'label' => [
                        'for' => 'users',
                        'class' => 'custom-label-class form-label visually-hidden',
                        'foo' => 'bar',
                    ],
                        'Custom Label',
                    '/label',
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

    public function testInlineAlignSelectControlWithHelp()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
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
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'form-group select'],
                    ['label' => ['class' => 'form-label visually-hidden', 'for' => 'users']],
                        'Users',
                    '/label',
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
                    ['div' => ['id' => 'users-help', 'class' => 'form-text visually-hidden']],
                        'Help text',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignSelectControlWithHelpOptions()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
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
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'form-group select'],
                    ['label' => ['class' => 'form-label visually-hidden', 'for' => 'users']],
                        'Users',
                    '/label',
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
                    ['div' => [
                        'id' => 'custom-help',
                        'foo' => 'bar',
                        'class' => 'help-class form-text visually-hidden',
                    ]],
                        'Help text',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignSelectControlWithTooltip()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
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
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'form-group select'],
                    ['label' => ['class' => 'form-label visually-hidden', 'for' => 'users']],
                        'Users',
                        'span' => [
                            'data-bs-toggle' => 'tooltip',
                            'title' => 'Tooltip text',
                            'class' => 'bi bi-info-circle-fill',
                        ],
                        '/span',
                    '/label',
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

    public function testInlineAlignSelectControlWithError()
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('users', [
            'type' => 'select',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'form-group position-relative select is-invalid'],
                    ['label' => ['class' => 'form-label visually-hidden', 'for' => 'users']],
                        'Users',
                    '/label',
                    ['select' => [
                        'name' => 'users',
                        'id' => 'users',
                        'class' => 'form-select is-invalid',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'users-error',
                    ]],
                        ['option' => ['value' => '1']],
                            'option 1',
                        '/option',
                        ['option' => ['value' => '2']],
                            'option 2',
                        '/option',
                    '/select',
                    ['div' => ['id' => 'users-error', 'class' => 'invalid-tooltip']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignSelectControlWithErrorAndHelp()
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => 'inline',
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
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'form-group position-relative select is-invalid'],
                    ['label' => ['class' => 'form-label visually-hidden', 'for' => 'users']],
                        'Users',
                    '/label',
                    ['select' => [
                        'name' => 'users',
                        'id' => 'users',
                        'class' => 'form-select is-invalid',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'users-error users-help',
                    ]],
                        ['option' => ['value' => '1']],
                            'option 1',
                        '/option',
                        ['option' => ['value' => '2']],
                            'option 2',
                        '/option',
                    '/select',
                    ['div' => ['id' => 'users-error', 'class' => 'invalid-tooltip']],
                        'error message',
                    '/div',
                    ['div' => ['id' => 'users-help', 'class' => 'form-text visually-hidden']],
                        'Help text',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignSelectControlWithErrorAndHelpOptions()
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => 'inline',
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
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'form-group position-relative select is-invalid'],
                    ['label' => ['class' => 'form-label visually-hidden', 'for' => 'users']],
                        'Users',
                    '/label',
                    ['select' => [
                        'name' => 'users',
                        'id' => 'users',
                        'class' => 'form-select is-invalid',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'users-error custom-help',
                    ]],
                        ['option' => ['value' => '1']],
                            'option 1',
                        '/option',
                        ['option' => ['value' => '2']],
                            'option 2',
                        '/option',
                    '/select',
                    ['div' => ['id' => 'users-error', 'class' => 'invalid-tooltip']],
                        'error message',
                    '/div',
                    ['div' => [
                        'id' => 'custom-help',
                        'foo' => 'bar',
                        'class' => 'help-class form-text visually-hidden',
                    ]],
                        'Help text',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignSelectControlContainerOptions()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
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
            ['div' => ['class' => 'col-auto']],
                'div' => [
                    'attribute' => 'container-attribute',
                    'class' => 'container-class form-group select',
                ],
                    ['label' => ['class' => 'form-label visually-hidden', 'for' => 'users']],
                        'Users',
                    '/label',
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

    public function testInlineAlignSelectControlContainerOptionsWithError()
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => 'inline',
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
            ['div' => ['class' => 'col-auto']],
                'div' => [
                    'attribute' => 'container-attribute',
                    'class' => 'container-class form-group position-relative select is-invalid',
                ],
                    ['label' => ['class' => 'form-label visually-hidden', 'for' => 'users']],
                        'Users',
                    '/label',
                    ['select' => [
                        'name' => 'users',
                        'id' => 'users',
                        'class' => 'form-select is-invalid',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'users-error',
                    ]],
                        ['option' => ['value' => '1']],
                            'option 1',
                        '/option',
                        ['option' => ['value' => '2']],
                            'option 2',
                        '/option',
                    '/select',
                    ['div' => ['id' => 'users-error', 'class' => 'invalid-tooltip']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignSelectControlInputGroupAppend()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
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
            ['div' => ['class' => 'col-auto']],
                ['div' => ['class' => 'form-group select']],
                    ['label' => ['class' => 'form-label visually-hidden', 'for' => 'users']],
                        'Users',
                    '/label',
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

    public function testInlineAlignSelectControlInputGroupPrepend()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
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
            ['div' => ['class' => 'col-auto']],
                ['div' => ['class' => 'form-group select']],
                    ['label' => ['class' => 'form-label visually-hidden', 'for' => 'users']],
                        'Users',
                    '/label',
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
