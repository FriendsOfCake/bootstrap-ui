<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\HorizontalAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class SelectControlTest extends AbstractFormHelperTest
{
    public function testHorizontalAlignSelectControl()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
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
            ['div' => ['class' => 'form-group row select']],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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

    public function testHorizontalAlignSelectControlWithDisabledLabel()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
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
            ['div' => ['class' => 'form-group row select']],
                ['div' => ['class' => 'col-sm-7']],
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

    public function testHorizontalAlignSelectControlWithCustomLabel()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
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
            ['div' => ['class' => 'form-group row select']],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'users']],
                    'Custom Label',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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

    public function testHorizontalAlignSelectControlWithCustomLabelOptions()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
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
                'text' => 'Custom Label'
            ]
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row select']],
                ['label' => [
                    'class' => 'custom-label-class col-form-label col-sm-5',
                    'foo' => 'bar',
                    'for' => 'users',
                ]],
                    'Custom Label',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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

    public function testHorizontalAlignSelectControlWithTooltip()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
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
            ['div' => ['class' => 'form-group row select']],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'users']],
                    'Users',
                    'span' => [
                        'data-toggle' => 'tooltip',
                        'title' => 'Tooltip text',
                        'class' => 'fas fa-info-circle',
                    ],
                    '/span',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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

    public function testHorizontalAlignSelectControlWithError()
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
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
            ['div' => ['class' => 'form-group row select is-invalid']],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'is-invalid form-control']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignSelectControlContainerOptions()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
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
                'class' => 'container-class form-group row select',
            ]],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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

    public function testHorizontalAlignSelectControlContainerOptionsWithError()
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
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
                'class' => 'container-class form-group row select is-invalid',
            ]],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['select' => ['name' => 'users', 'id' => 'users', 'class' => 'is-invalid form-control']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignSelectControlInputGroupAppend()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
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
            ['div' => ['class' => 'form-group row select']],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignSelectControlInputGroupPrepend()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
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
            ['div' => ['class' => 'form-group row select']],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'users']],
                    'Users',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
