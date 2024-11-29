<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\DefaultAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class SelectControlTest extends AbstractFormHelperTest
{
    public function testDefaultAlignSelectControl()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'select',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 select'],
                ['label' => ['class' => 'form-label', 'for' => 'users']],
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
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignSelectControlWithFloatingLabel()
    {
        $this->Form->create($this->article);

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
            'div' => ['class' => 'mb-3 form-floating select'],
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
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignSelectControlWithDisabledLabel()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'select',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'label' => false,
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 select'],
                ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'form-select']],
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

    public function testDefaultAlignSelectControlWithCustomLabel()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'select',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'label' => 'Custom Label',
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 select'],
                ['label' => ['class' => 'form-label', 'for' => 'users']],
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
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignSelectControlWithCustomLabelOptions()
    {
        $this->Form->create($this->article);

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
            'div' => ['class' => 'mb-3 select'],
                'label' => ['for' => 'users', 'class' => 'custom-label-class form-label', 'foo' => 'bar'],
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
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignSelectControlWithHelp()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'select',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'help' => 'Help text',
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 select'],
                ['label' => ['class' => 'form-label', 'for' => 'users']],
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
                ['div' => ['id' => 'users-help', 'class' => 'form-text']],
                    'Help text',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignSelectControlWithHelpOptions()
    {
        $this->Form->create($this->article);

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
            'div' => ['class' => 'mb-3 select'],
                ['label' => ['class' => 'form-label', 'for' => 'users']],
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
                    'class' => 'help-class form-text',
                ]],
                    'Help text',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignSelectControlWithTooltip()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'select',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 select'],
                ['label' => ['class' => 'form-label', 'for' => 'users']],
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
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignSelectControlWithCustomSpacing()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'select',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'spacing' => 'custom-spacing',
        ]);
        $expected = [
            'div' => ['class' => 'custom-spacing select'],
                ['label' => ['class' => 'form-label', 'for' => 'users']],
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
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignSelectControlWithError()
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'select',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 select is-invalid'],
                ['label' => ['class' => 'form-label', 'for' => 'users']],
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
                ['div' => ['id' => 'users-error', 'class' => 'ms-0 invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignSelectControlWithErrorAndHelp()
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'select',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'help' => 'Help text',
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 select is-invalid'],
                ['label' => ['class' => 'form-label', 'for' => 'users']],
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
                ['div' => ['id' => 'users-error', 'class' => 'ms-0 invalid-feedback']],
                    'error message',
                '/div',
                ['div' => ['id' => 'users-help', 'class' => 'form-text']],
                    'Help text',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignSelectControlWithErrorAndHelpOptions()
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article);

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
            'div' => ['class' => 'mb-3 select is-invalid'],
                ['label' => ['class' => 'form-label', 'for' => 'users']],
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
                ['div' => ['id' => 'users-error', 'class' => 'ms-0 invalid-feedback']],
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

    public function testDefaultAlignSelectControlContainerOptions()
    {
        $this->Form->create($this->article);

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
                'class' => 'container-class mb-3 select',
            ],
                ['label' => ['class' => 'form-label', 'for' => 'users']],
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
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignSelectControlContainerOptionsWithError()
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article);

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
                'class' => 'container-class mb-3 select is-invalid',
            ],
                ['label' => ['class' => 'form-label', 'for' => 'users']],
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
                ['div' => ['id' => 'users-error', 'class' => 'ms-0 invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignSelectControlInputGroupAppend()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'select',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'append' => 'append',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 select']],
                ['label' => ['class' => 'form-label', 'for' => 'users']],
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
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignSelectControlInputGroupPrepend()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('users', [
            'type' => 'select',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'prepend' => 'prepend',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 select']],
                ['label' => ['class' => 'form-label', 'for' => 'users']],
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
        ];
        $this->assertHtml($expected, $result);
    }
}
