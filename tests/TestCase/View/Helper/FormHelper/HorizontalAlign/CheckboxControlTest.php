<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\HorizontalAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class CheckboxControlTest extends AbstractFormHelperTest
{
    public function testHorizontalAlignCheckboxControl()
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
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row checkbox']],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users',
                            'id' => 'users',
                            'value' => 1,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                            'Users',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCheckboxControlWithDisabledLabel()
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
            'label' => false,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row checkbox']],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users',
                            'id' => 'users',
                            'value' => 1,
                        ]],
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCheckboxControlWithCustomLabel()
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
            'label' => 'Custom Label',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row checkbox']],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users',
                            'id' => 'users',
                            'value' => 1,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                            'Custom Label',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCheckboxControlWithCustomLabelOptions()
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
            'label' => [
                'class' => 'custom-label-class',
                'foo' => 'bar',
                'text' => 'Custom Label',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row checkbox']],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users',
                            'id' => 'users',
                            'value' => 1,
                        ]],
                        ['label' => ['class' => 'custom-label-class form-check-label', 'foo' => 'bar', 'for' => 'users']],
                            'Custom Label',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCheckboxControlWithHelp()
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
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row checkbox']],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users',
                            'id' => 'users',
                            'value' => 1,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                            'Users',
                        '/label',
                        ['small' => ['class' => 'form-text text-muted']],
                            'Help text',
                        '/small',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCheckboxControlWithHelpOptions()
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
            'help' => [
                'foo' => 'bar',
                'content' => 'Help text',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row checkbox']],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users',
                            'id' => 'users',
                            'value' => 1,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                            'Users',
                        '/label',
                        ['small' => ['foo' => 'bar', 'class' => 'form-text text-muted']],
                            'Help text',
                        '/small',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCheckboxControlWithTooltip()
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
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row checkbox']],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users',
                            'id' => 'users',
                            'value' => 1,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                            'Users ',
                            'span' => [
                                'data-bs-toggle' => 'tooltip',
                                'title' => 'Tooltip text',
                                'class' => 'fas fa-info-circle',
                            ],
                            '/span',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCheckboxControlWithError()
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
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row checkbox is-invalid']],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'is-invalid',
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['input' => [
                            'class' => 'form-check-input is-invalid',
                            'type' => 'checkbox',
                            'name' => 'users',
                            'id' => 'users',
                            'value' => 1,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users']],
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

    public function testHorizontalAlignCheckboxControlContainerOptions()
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
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            ['div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class form-group row checkbox',
            ]],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users',
                            'id' => 'users',
                            'value' => 1,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                            'Users',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCheckboxControlContainerOptionsWithError()
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
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            ['div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class form-group row checkbox is-invalid',
            ]],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'is-invalid',
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['input' => [
                            'class' => 'form-check-input is-invalid',
                            'type' => 'checkbox',
                            'name' => 'users',
                            'id' => 'users',
                            'value' => 1,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users']],
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

    public function testHorizontalAlignCheckboxControlNestedInput()
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
            'nestedInput' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row checkbox']],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users',
                                'id' => 'users',
                                'value' => 1,
                            ]],
                            'Users',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCheckboxControlNestedInputWithTooltip()
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
            'nestedInput' => true,
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row checkbox']],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users',
                                'id' => 'users',
                                'value' => 1,
                            ]],
                            'Users ',
                            'span' => [
                                'data-bs-toggle' => 'tooltip',
                                'title' => 'Tooltip text',
                                'class' => 'fas fa-info-circle',
                            ],
                            '/span',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCheckboxControlNestedInputWithError()
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
            'nestedInput' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row checkbox is-invalid']],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'is-invalid',
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                            ['input' => [
                                'class' => 'form-check-input is-invalid',
                                'type' => 'checkbox',
                                'name' => 'users',
                                'id' => 'users',
                                'value' => 1,
                            ]],
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

    public function testHorizontalAlignCheckboxControlInline()
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
            'inline' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row checkbox']],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users',
                            'id' => 'users',
                            'value' => 1,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                            'Users',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCheckboxControlInlineWithDisabledLabel()
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
            'inline' => true,
            'label' => false,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row checkbox']],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users',
                            'id' => 'users',
                            'value' => 1,
                        ]],
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCheckboxControlInlineWithCustomLabel()
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
            'inline' => true,
            'label' => 'Custom Label',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row checkbox']],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users',
                            'id' => 'users',
                            'value' => 1,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                            'Custom Label',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCheckboxControlInlineWithCustomLabelOptions()
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
            'inline' => true,
            'label' => [
                'class' => 'custom-label-class',
                'foo' => 'bar',
                'text' => 'Custom Label',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row checkbox']],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users',
                            'id' => 'users',
                            'value' => 1,
                        ]],
                        ['label' => ['class' => 'custom-label-class form-check-label', 'foo' => 'bar', 'for' => 'users']],
                            'Custom Label',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCheckboxControlInlineWithHelp()
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
            'inline' => true,
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row checkbox']],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users',
                            'id' => 'users',
                            'value' => 1,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                            'Users',
                        '/label',
                        ['small' => ['class' => 'form-text text-muted']],
                            'Help text',
                        '/small',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCheckboxControlInlineWithHelpOptions()
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
            'inline' => true,
            'help' => [
                'foo' => 'bar',
                'content' => 'Help text',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row checkbox']],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users',
                            'id' => 'users',
                            'value' => 1,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                            'Users',
                        '/label',
                        ['small' => ['foo' => 'bar', 'class' => 'form-text text-muted']],
                            'Help text',
                        '/small',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCheckboxControlInlineWithTooltip()
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
            'inline' => true,
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row checkbox']],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users',
                            'id' => 'users',
                            'value' => 1,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                            'Users ',
                            'span' => [
                                'data-bs-toggle' => 'tooltip',
                                'title' => 'Tooltip text',
                                'class' => 'fas fa-info-circle',
                            ],
                            '/span',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCheckboxControlInlineWithError()
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
            'inline' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row checkbox is-invalid']],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'is-invalid',
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['input' => [
                            'class' => 'form-check-input is-invalid',
                            'type' => 'checkbox',
                            'name' => 'users',
                            'id' => 'users',
                            'value' => 1,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users']],
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

    public function testHorizontalAlignCheckboxControlInlineContainerOptions()
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
            'inline' => true,
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            ['div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class form-group row checkbox',
            ]],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['input' => [
                            'class' => 'form-check-input',
                            'type' => 'checkbox',
                            'name' => 'users',
                            'id' => 'users',
                            'value' => 1,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                            'Users',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCheckboxControlInlineContainerOptionsWithError()
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
            'inline' => true,
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            ['div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class form-group row checkbox is-invalid',
            ]],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'class' => 'is-invalid',
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['input' => [
                            'class' => 'form-check-input is-invalid',
                            'type' => 'checkbox',
                            'name' => 'users',
                            'id' => 'users',
                            'value' => 1,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users']],
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

    public function testHorizontalAlignCheckboxControlInlineNestedInput()
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
            'inline' => true,
            'nestedInput' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row checkbox']],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users',
                                'id' => 'users',
                                'value' => 1,
                            ]],
                            'Users',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCheckboxControlInlineNestedInputWithTooltip()
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
            'inline' => true,
            'nestedInput' => true,
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row checkbox']],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
                    ['div' => ['class' => 'form-check']],
                        ['input' => [
                            'type' => 'hidden',
                            'name' => 'users',
                            'value' => 0,
                        ]],
                        ['label' => ['class' => 'form-check-label', 'for' => 'users']],
                            ['input' => [
                                'class' => 'form-check-input',
                                'type' => 'checkbox',
                                'name' => 'users',
                                'id' => 'users',
                                'value' => 1,
                            ]],
                            'Users ',
                            'span' => [
                                'data-bs-toggle' => 'tooltip',
                                'title' => 'Tooltip text',
                                'class' => 'fas fa-info-circle',
                            ],
                            '/span',
                        '/label',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
