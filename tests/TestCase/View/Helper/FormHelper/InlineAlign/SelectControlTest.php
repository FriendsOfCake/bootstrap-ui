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
            'div' => ['class' => 'form-group select'],
                ['label' => ['class' => 'sr-only', 'for' => 'users']],
                    'Users',
                '/label',
                ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'form-control']],
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
            'div' => ['class' => 'form-group select'],
                ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'form-control']],
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
            'div' => ['class' => 'form-group select'],
                ['label' => ['class' => 'sr-only', 'for' => 'users']],
                    'Custom Label',
                '/label',
                ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'form-control']],
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
            'div' => ['class' => 'form-group select'],
                'label' => ['for' => 'users', 'class' => 'custom-label-class sr-only', 'foo' => 'bar'],
                    'Custom Label',
                '/label',
                ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'form-control']],
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
            'div' => ['class' => 'form-group select'],
                ['label' => ['class' => 'sr-only', 'for' => 'users']],
                    'Users',
                '/label',
                ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'form-control']],
                    ['option' => ['value' => '1']],
                        'option 1',
                    '/option',
                    ['option' => ['value' => '2']],
                        'option 2',
                    '/option',
                '/select',
                ['small' => ['class' => 'sr-only form-text text-muted']],
                    'Help text',
                '/small',
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
                'foo' => 'bar',
                'content' => 'Help text',
            ],
        ]);
        $expected = [
            'div' => ['class' => 'form-group select'],
                ['label' => ['class' => 'sr-only', 'for' => 'users']],
                    'Users',
                '/label',
                ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'form-control']],
                    ['option' => ['value' => '1']],
                        'option 1',
                    '/option',
                    ['option' => ['value' => '2']],
                        'option 2',
                    '/option',
                '/select',
                ['small' => ['foo' => 'bar', 'class' => 'sr-only form-text text-muted']],
                    'Help text',
                '/small',
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
            'div' => ['class' => 'form-group select'],
                ['label' => ['class' => 'sr-only', 'for' => 'users']],
                    'Users',
                    'span' => [
                        'data-toggle' => 'tooltip',
                        'title' => 'Tooltip text',
                        'class' => 'fas fa-info-circle',
                    ],
                    '/span',
                '/label',
                ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'form-control']],
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
            'div' => ['class' => 'form-group position-relative select is-invalid'],
                ['label' => ['class' => 'sr-only', 'for' => 'users']],
                    'Users',
                '/label',
                ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'is-invalid form-control']],
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
            'div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class form-group select',
            ],
                ['label' => ['class' => 'sr-only', 'for' => 'users']],
                    'Users',
                '/label',
                ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'form-control']],
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
            'div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class form-group position-relative select is-invalid',
            ],
                ['label' => ['class' => 'sr-only', 'for' => 'users']],
                    'Users',
                '/label',
                ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'is-invalid form-control']],
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
            ['div' => ['class' => 'form-group select']],
                ['label' => ['class' => 'sr-only', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['class' => 'input-group']],
                    ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'form-control']],
                        ['option' => ['value' => '1']],
                            'option 1',
                        '/option',
                        ['option' => ['value' => '2']],
                            'option 2',
                        '/option',
                    '/select',
                    ['div' => ['class' => 'input-group-append']],
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
            ['div' => ['class' => 'form-group select']],
                ['label' => ['class' => 'sr-only', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['class' => 'input-group']],
                    ['div' => ['class' => 'input-group-prepend']],
                        ['span' => ['class' => 'input-group-text']],
                            'prepend',
                        '/span',
                    '/div',
                    ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'form-control']],
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
