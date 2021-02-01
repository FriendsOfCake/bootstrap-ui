<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\DefaultAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class SelectCustomControlTest extends AbstractFormHelperTest
{
    public function testDefaultAlignCustomSelectControl()
    {
        $this->Form->create($this->article);

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
                ['label' => ['for' => 'users']],
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

    public function testDefaultAlignCustomSelectControlWithDisabledLabel()
    {
        $this->Form->create($this->article);

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

    public function testDefaultAlignCustomSelectControlWithCustomLabel()
    {
        $this->Form->create($this->article);

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
                ['label' => ['for' => 'users']],
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

    public function testDefaultAlignCustomSelectControlWithTooltip()
    {
        $this->Form->create($this->article);

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
                ['label' => ['for' => 'users']],
                    'Users',
                    'span' => [
                        'data-toggle' => 'tooltip',
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

    public function testDefaultAlignCustomSelectControlWithError()
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
            'custom' => true,
        ]);
        $expected = [
            'div' => ['class' => 'form-group select is-invalid'],
                ['label' => ['for' => 'users']],
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
                ['div' => ['class' => 'invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomSelectControlContainerOptions()
    {
        $this->Form->create($this->article);

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
                ['label' => ['for' => 'users']],
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

    public function testDefaultAlignCustomSelectControlContainerOptionsWithError()
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
            'custom' => true,
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            ['div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class form-group select is-invalid',
            ]],
                ['label' => ['for' => 'users']],
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
                ['div' => ['class' => 'invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomSelectControlInputGroupAppend()
    {
        $this->Form->create($this->article);

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
                ['label' => ['for' => 'users']],
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

    public function testDefaultAlignCustomSelectControlInputGroupPrepend()
    {
        $this->Form->create($this->article);

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
                ['label' => ['for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['class' => 'input-group']],
                    ['div' => ['class' => 'input-group-prepend']],
                        ['span' => ['class' => 'input-group-text']],
                            'prepend',
                        '/span',
                    '/div',
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
