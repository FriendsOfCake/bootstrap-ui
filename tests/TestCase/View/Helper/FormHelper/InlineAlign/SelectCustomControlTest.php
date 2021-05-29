<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\InlineAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class SelectCustomControlTest extends AbstractFormHelperTest
{
    public function testInlineAlignCustomSelectControl()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'select',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'custom' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group select']],
                ['label' => ['class' => 'visually-hidden', 'for' => 'users']],
                    'Users',
                '/label',
                ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'custom-select']],
                    ['option' => ['value' => '1']],
                        'option 1',
                    '/option',
                    ['option' => ['value' => '2']],
                        'option 2',
                    '/option',
                '/select',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomSelectControlWithDisabledLabel()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'select',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'custom' => true,
            'label' => false,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group select']],
                ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'custom-select']],
                    ['option' => ['value' => '1']],
                        'option 1',
                    '/option',
                    ['option' => ['value' => '2']],
                        'option 2',
                    '/option',
                '/select',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomSelectControlWithCustomLabel()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'select',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'custom' => true,
            'label' => 'Custom Label',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group select']],
                ['label' => ['class' => 'visually-hidden', 'for' => 'users']],
                    'Custom Label',
                '/label',
                ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'custom-select']],
                    ['option' => ['value' => '1']],
                        'option 1',
                    '/option',
                    ['option' => ['value' => '2']],
                        'option 2',
                    '/option',
                '/select',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomSelectControlWithCustomLabelOptions()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'select',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'custom' => true,
            'label' => [
                'class' => 'custom-label-class',
                'foo' => 'bar',
                'text' => 'Custom Label',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'form-group select']],
                ['label' => ['class' => 'custom-label-class visually-hidden', 'foo' => 'bar', 'for' => 'users']],
                    'Custom Label',
                '/label',
                ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'custom-select']],
                    ['option' => ['value' => '1']],
                        'option 1',
                    '/option',
                    ['option' => ['value' => '2']],
                        'option 2',
                    '/option',
                '/select',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomSelectControlWithHelp()
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
            'custom' => true,
            'help' => 'Help text',
        ]);
        $expected = [
            'div' => ['class' => 'form-group select'],
                ['label' => ['class' => 'visually-hidden', 'for' => 'users']],
                    'Users',
                '/label',
                ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'custom-select']],
                    ['option' => ['value' => '1']],
                        'option 1',
                    '/option',
                    ['option' => ['value' => '2']],
                        'option 2',
                    '/option',
                '/select',
                ['small' => ['class' => 'visually-hidden form-text text-muted']],
                    'Help text',
                '/small',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomSelectControlWithHelpOptions()
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
            'custom' => true,
            'help' => [
                'foo' => 'bar',
                'content' => 'Help text',
            ],
        ]);
        $expected = [
            'div' => ['class' => 'form-group select'],
                ['label' => ['class' => 'visually-hidden', 'for' => 'users']],
                    'Users',
                '/label',
                ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'custom-select']],
                    ['option' => ['value' => '1']],
                        'option 1',
                    '/option',
                    ['option' => ['value' => '2']],
                        'option 2',
                    '/option',
                '/select',
                ['small' => ['foo' => 'bar', 'class' => 'visually-hidden form-text text-muted']],
                    'Help text',
                '/small',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomSelectControlWithTooltip()
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
            'custom' => true,
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            'div' => ['class' => 'form-group select'],
                ['label' => ['class' => 'visually-hidden', 'for' => 'users']],
                    'Users',
                    'span' => [
                        'data-bs-toggle' => 'tooltip',
                        'title' => 'Tooltip text',
                        'class' => 'fas fa-info-circle',
                    ],
                    '/span',
                '/label',
                ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'custom-select']],
                    ['option' => ['value' => '1']],
                        'option 1',
                    '/option',
                    ['option' => ['value' => '2']],
                        'option 2',
                    '/option',
                '/select',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomSelectControlWithError()
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
            'custom' => true,
        ]);
        $expected = [
            'div' => ['class' => 'form-group position-relative select is-invalid'],
                ['label' => ['class' => 'visually-hidden', 'for' => 'users']],
                    'Users',
                '/label',
                ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'custom-select is-invalid']],
                    ['option' => ['value' => '1']],
                        'option 1',
                    '/option',
                    ['option' => ['value' => '2']],
                        'option 2',
                    '/option',
                '/select',
                ['div' => ['class' => 'invalid-tooltip']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomSelectControlContainerOptions()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'select',
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
                'class' => 'container-class form-group select',
            ]],
                ['label' => ['class' => 'visually-hidden', 'for' => 'users']],
                    'Users',
                '/label',
                ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'custom-select']],
                    ['option' => ['value' => '1']],
                        'option 1',
                    '/option',
                    ['option' => ['value' => '2']],
                        'option 2',
                    '/option',
                '/select',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomSelectControlContainerOptionsWithError()
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];

        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'select',
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
                'class' => 'container-class form-group position-relative select is-invalid',
            ]],
                ['label' => ['class' => 'visually-hidden', 'for' => 'users']],
                    'Users',
                '/label',
                ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'custom-select is-invalid']],
                    ['option' => ['value' => '1']],
                        'option 1',
                    '/option',
                    ['option' => ['value' => '2']],
                        'option 2',
                    '/option',
                '/select',
                ['div' => ['class' => 'invalid-tooltip']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomSelectControlInputGroupAppend()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'select',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'custom' => true,
            'append' => 'append',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group select']],
                ['label' => ['class' => 'visually-hidden', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['class' => 'input-group']],
                    ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'custom-select']],
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
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomSelectControlInputGroupPrepend()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'select',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'custom' => true,
            'prepend' => 'prepend',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group select']],
                ['label' => ['class' => 'visually-hidden', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['class' => 'input-group']],
                    ['span' => ['class' => 'input-group-text']],
                        'prepend',
                    '/span',
                    ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'custom-select']],
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
}
