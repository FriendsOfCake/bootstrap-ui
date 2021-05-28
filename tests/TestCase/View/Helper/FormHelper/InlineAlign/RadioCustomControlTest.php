<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\InlineAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class RadioCustomControlTest extends AbstractFormHelperTest
{
    public function testInlineAlignCustomRadioControl()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'custom' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group position-relative radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['span' => ['id' => 'users-group-label', 'class' => 'visually-hidden']],
                    'Users',
                '/span',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'custom-control custom-radio custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-1',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'custom-control custom-radio custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomRadioControlWithDisabledLabel()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'custom' => true,
            'label' => false,
        ]);
        $expected = [
            ['div' => [
                'class' => 'form-group position-relative radio',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'custom-control custom-radio custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-1',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'custom-control custom-radio custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomRadioControlWithCustomLabel()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'custom' => true,
            'label' => 'Custom Label',
        ]);
        $expected = [
            ['div' => [
                'class' => 'form-group position-relative radio',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['span' => ['id' => 'users-group-label', 'class' => 'visually-hidden']],
                    'Custom Label',
                '/span',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'custom-control custom-radio custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-1',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'custom-control custom-radio custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomRadioControlWithCustomLabelOptions()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('users', [
            'type' => 'radio',
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
            ['div' => [
                'class' => 'form-group position-relative radio',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['span' => ['id' => 'users-group-label', 'class' => 'custom-label-class visually-hidden', 'foo' => 'bar']],
                    'Custom Label',
                '/span',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'custom-control custom-radio custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-1',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'custom-control custom-radio custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomRadioControlWithCustomLabelTemplateIsBackwardsCompatible()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'custom' => true,
            'templates' => [
                'radioLabel' =>
                    '<span id="{{groupId}}" class="visually-hidden" back="compat">{{text}}{{tooltip}}</span>',
            ],
        ]);
        $expected = [
            ['div' => [
                'class' => 'form-group position-relative radio',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['span' => ['id' => 'users-group-label', 'class' => 'visually-hidden', 'back' => 'compat']],
                    'Users',
                '/span',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'custom-control custom-radio custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-1',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'custom-control custom-radio custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomRadioControlWithHelp()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'custom' => true,
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => [
                'class' => 'form-group position-relative radio',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['span' => ['id' => 'users-group-label', 'class' => 'visually-hidden']],
                    'Users',
                '/span',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'custom-control custom-radio custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-1',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'custom-control custom-radio custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['small' => ['class' => 'visually-hidden form-text text-muted']],
                    'Help text',
                '/small',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomRadioControlWithHelpOptions()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [],
            'custom' => true,
            'help' => [
                'foo' => 'bar',
                'content' => 'Help text',
            ],
        ]);
        $expected = [
            ['div' => [
                'class' => 'form-group position-relative radio',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['span' => ['id' => 'users-group-label', 'class' => 'visually-hidden']],
                    'Users',
                '/span',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['small' => ['foo' => 'bar', 'class' => 'visually-hidden form-text text-muted']],
                    'Help text',
                '/small',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomRadioControlWithTooltip()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('published', [
            'type' => 'radio',
            'custom' => true,
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => [
                'class' => 'form-group position-relative radio',
                'role' => 'group',
                'aria-labelledby' => 'published-group-label',
            ]],
                ['span' => ['id' => 'published-group-label', 'class' => 'visually-hidden']],
                    'Published ',
                    'span' => [
                        'data-toggle' => 'tooltip',
                        'title' => 'Tooltip text',
                        'class' => 'fas fa-info-circle',
                    ],
                    '/span',
                '/span',
                'input' => [
                    'type' => 'hidden',
                    'name' => 'published',
                    'value' => '',
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomRadioControlWithError()
    {
        $this->withErrorReporting(0, function () {
            $this->article['errors'] = [
                'users' => ['error message'],
            ];
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('users', [
            'type' => 'radio',
            'options' => [
                1 => 'option 1',
                2 => 'option 2',
            ],
            'custom' => true,
        ]);
        $expected = [
            ['div' => [
                'class' => 'form-group position-relative radio is-invalid',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['span' => ['id' => 'users-group-label', 'class' => 'visually-hidden']],
                    'Users',
                '/span',
                ['input' => [
                    'class' => 'is-invalid',
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'custom-control custom-radio custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input is-invalid',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-1',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'custom-control custom-radio custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input is-invalid',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['class' => 'invalid-tooltip']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomRadioControlContainerOptions()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('users', [
            'type' => 'radio',
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
                'class' => 'container-class form-group position-relative radio',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['span' => ['id' => 'users-group-label', 'class' => 'visually-hidden']],
                    'Users',
                '/span',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'custom-control custom-radio custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-1',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'custom-control custom-radio custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomRadioControlContainerOptionsWithError()
    {
        $this->article['errors'] = [
            'users' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('users', [
            'type' => 'radio',
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
                'class' => 'container-class form-group position-relative radio is-invalid',
                'role' => 'group',
                'aria-labelledby' => 'users-group-label',
            ]],
                ['span' => ['id' => 'users-group-label', 'class' => 'visually-hidden']],
                    'Users',
                '/span',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                    'class' => 'is-invalid',
                ]],
                ['div' => ['class' => 'custom-control custom-radio custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input is-invalid',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-1',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'custom-control custom-radio custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input is-invalid',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['class' => 'invalid-tooltip']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomRadioControlWithPerOptionConfiguration()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

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
            'custom' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group position-relative radio', 'role' => 'group', 'aria-labelledby' => 'users-group-label']],
                ['span' => ['id' => 'users-group-label', 'class' => 'visually-hidden']],
                    'Users',
                '/span',
                ['input' => [
                    'type' => 'hidden',
                    'name' => 'users',
                    'value' => '',
                ]],
                ['div' => ['class' => 'custom-control custom-radio custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-1',
                        'value' => 1,
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-1']],
                        'option 1',
                    '/label',
                '/div',
                ['div' => ['class' => 'custom-control custom-radio custom-control-inline']],
                    ['input' => [
                        'class' => 'custom-control-input',
                        'type' => 'radio',
                        'name' => 'users',
                        'id' => 'users-2',
                        'value' => 2,
                    ]],
                    ['label' => ['class' => 'custom-control-label', 'for' => 'users-2']],
                        'option 2',
                    '/label',
                '/div',
                ['div' => ['class' => 'custom-control custom-radio custom-control-inline']],
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
        ];
        $this->assertHtml($expected, $result);
    }
}
