<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\HorizontalAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class CheckboxCustomControlTest extends AbstractFormHelperTest
{
    public function testHorizontalAlignCustomCheckboxControl()
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
            'type' => 'checkbox',
            'custom' => true,
        ]);
        $expected = [
            'div' => ['class' => 'form-group row checkbox'],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'custom-control custom-checkbox']],
                        ['input' => [
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['input' => [
                            'type' => 'checkbox',
                            'name' => 'users',
                            'value' => '1',
                            'id' => 'users',
                            'class' => 'custom-control-input',
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users']],
                            'Users',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCustomCheckboxControlWithDisabledLabel()
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
            'type' => 'checkbox',
            'custom' => true,
            'label' => false,
        ]);
        $expected = [
            'div' => ['class' => 'form-group row checkbox'],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'custom-control custom-checkbox']],
                        ['input' => [
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['input' => [
                            'type' => 'checkbox',
                            'name' => 'users',
                            'value' => '1',
                            'id' => 'users',
                            'class' => 'custom-control-input',
                        ]],
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCustomCheckboxControlWithCustomLabel()
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
            'type' => 'checkbox',
            'custom' => true,
            'label' => 'Custom Label',
        ]);
        $expected = [
            'div' => ['class' => 'form-group row checkbox'],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'custom-control custom-checkbox']],
                        ['input' => [
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['input' => [
                            'type' => 'checkbox',
                            'name' => 'users',
                            'value' => '1',
                            'id' => 'users',
                            'class' => 'custom-control-input',
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users']],
                            'Custom Label',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCustomCheckboxControlContainerOptions()
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
            'type' => 'checkbox',
            'custom' => true,
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            'div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class form-group row checkbox',
            ],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'custom-control custom-checkbox']],
                        ['input' => [
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['input' => [
                            'type' => 'checkbox',
                            'name' => 'users',
                            'value' => '1',
                            'id' => 'users',
                            'class' => 'custom-control-input',
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users']],
                            'Users',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCustomCheckboxControlContainerOptionsWithError()
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
            'type' => 'checkbox',
            'custom' => true,
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            'div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class form-group row checkbox is-invalid',
            ],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'custom-control custom-checkbox']],
                        ['input' => [
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                            'class' => 'is-invalid',
                        ]],
                        ['input' => [
                            'type' => 'checkbox',
                            'name' => 'users',
                            'value' => '1',
                            'id' => 'users',
                            'class' => 'custom-control-input is-invalid',
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users']],
                            'Users',
                        '/label',
                        ['div' => ['class' => 'invalid-feedback']],
                            'error message',
                        '/div',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCustomCheckboxControlInline()
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
            'type' => 'checkbox',
            'custom' => true,
            'inline' => true,
        ]);
        $expected = [
            'div' => ['class' => 'form-group row checkbox'],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'custom-control custom-checkbox']],
                        ['input' => [
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['input' => [
                            'type' => 'checkbox',
                            'name' => 'users',
                            'value' => '1',
                            'id' => 'users',
                            'class' => 'custom-control-input',
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users']],
                            'Users',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCustomCheckboxControlInlineWithDisabledLabel()
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
            'type' => 'checkbox',
            'custom' => true,
            'inline' => true,
            'label' => false,
        ]);
        $expected = [
            'div' => ['class' => 'form-group row checkbox'],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'custom-control custom-checkbox']],
                        ['input' => [
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['input' => [
                            'type' => 'checkbox',
                            'name' => 'users',
                            'value' => '1',
                            'id' => 'users',
                            'class' => 'custom-control-input',
                        ]],
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCustomCheckboxControlInlineWithCustomLabel()
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
            'type' => 'checkbox',
            'custom' => true,
            'inline' => true,
            'label' => 'Custom Label',
        ]);
        $expected = [
            'div' => ['class' => 'form-group row checkbox'],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'custom-control custom-checkbox']],
                        ['input' => [
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['input' => [
                            'type' => 'checkbox',
                            'name' => 'users',
                            'value' => '1',
                            'id' => 'users',
                            'class' => 'custom-control-input',
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users']],
                            'Custom Label',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCustomCheckboxControlInlineContainerOptions()
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
            'type' => 'checkbox',
            'custom' => true,
            'inline' => true,
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            'div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class form-group row checkbox',
            ],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'custom-control custom-checkbox']],
                        ['input' => [
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['input' => [
                            'type' => 'checkbox',
                            'name' => 'users',
                            'value' => '1',
                            'id' => 'users',
                            'class' => 'custom-control-input',
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users']],
                            'Users',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCustomCheckboxControlInlineContainerOptionsWithError()
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
            'type' => 'checkbox',
            'custom' => true,
            'inline' => true,
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            'div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class form-group row checkbox is-invalid',
            ],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'custom-control custom-checkbox']],
                        ['input' => [
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                            'class' => 'is-invalid',
                        ]],
                        ['input' => [
                            'type' => 'checkbox',
                            'name' => 'users',
                            'value' => '1',
                            'id' => 'users',
                            'class' => 'custom-control-input is-invalid',
                        ]],
                        ['label' => ['class' => 'custom-control-label', 'for' => 'users']],
                            'Users',
                        '/label',
                        ['div' => ['class' => 'invalid-feedback']],
                            'error message',
                        '/div',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
