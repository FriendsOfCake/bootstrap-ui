<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\InlineAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class ColorControlTest extends AbstractFormHelperTest
{
    public function testInlineAlignColorControl()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('color', [
            'type' => 'color',
            'value' => '#ffffff',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'color'],
                    'label' => ['class' => 'form-label visually-hidden', 'for' => 'color'],
                        'Color',
                    '/label',
                    'input' => [
                        'type' => 'color',
                        'name' => 'color',
                        'id' => 'color',
                        'class' => 'form-control form-control-color',
                        'value' => '#ffffff',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignColorControlWithDisabledLabel()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('color', [
            'type' => 'color',
            'value' => '#ffffff',
            'label' => false,
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'color'],
                    'input' => [
                        'type' => 'color',
                        'name' => 'color',
                        'id' => 'color',
                        'class' => 'form-control form-control-color',
                        'value' => '#ffffff',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignColorControlWithCustomLabel()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('color', [
            'type' => 'color',
            'value' => '#ffffff',
            'label' => 'Custom Label',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'color'],
                    'label' => ['class' => 'form-label visually-hidden', 'for' => 'color'],
                        'Custom Label',
                    '/label',
                    'input' => [
                        'type' => 'color',
                        'name' => 'color',
                        'id' => 'color',
                        'class' => 'form-control form-control-color',
                        'value' => '#ffffff',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignColorControlWithCustomLabelOptions()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('color', [
            'type' => 'color',
            'value' => '#ffffff',
            'label' => [
                'class' => 'custom-label-class',
                'foo' => 'bar',
                'text' => 'Custom Label',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'color'],
                    'label' => [
                        'class' => 'custom-label-class form-label visually-hidden',
                        'foo' => 'bar',
                        'for' => 'color',
                    ],
                        'Custom Label',
                    '/label',
                    'input' => [
                        'type' => 'color',
                        'name' => 'color',
                        'id' => 'color',
                        'class' => 'form-control form-control-color',
                        'value' => '#ffffff',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignColorControlWithHelp()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('color', [
            'type' => 'color',
            'value' => '#ffffff',
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'color'],
                    'label' => ['class' => 'form-label visually-hidden', 'for' => 'color'],
                        'Color',
                    '/label',
                    'input' => [
                        'type' => 'color',
                        'name' => 'color',
                        'id' => 'color',
                        'class' => 'form-control form-control-color',
                        'aria-describedby' => 'color-help',
                        'value' => '#ffffff',
                    ],
                    ['div' => ['id' => 'color-help', 'class' => 'form-text visually-hidden']],
                        'Help text',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignColorControlWithHelpOptions()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('color', [
            'type' => 'color',
            'value' => '#ffffff',
            'help' => [
                'id' => 'custom-help',
                'foo' => 'bar',
                'class' => 'help-class',
                'content' => 'Help text',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'color'],
                    'label' => ['class' => 'form-label visually-hidden', 'for' => 'color'],
                        'Color',
                    '/label',
                    'input' => [
                        'type' => 'color',
                        'name' => 'color',
                        'id' => 'color',
                        'class' => 'form-control form-control-color',
                        'aria-describedby' => 'custom-help',
                        'value' => '#ffffff',
                    ],
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

    public function testInlineAlignColorControlWithTooltip()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('color', [
            'type' => 'color',
            'value' => '#ffffff',
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'color'],
                    'label' => ['class' => 'form-label visually-hidden', 'for' => 'color'],
                        'Color',
                        'span' => [
                            'data-bs-toggle' => 'tooltip',
                            'title' => 'Tooltip text',
                            'class' => 'bi bi-info-circle-fill',
                        ],
                        '/span',
                    '/label',
                    'input' => [
                        'type' => 'color',
                        'name' => 'color',
                        'id' => 'color',
                        'class' => 'form-control form-control-color',
                        'value' => '#ffffff',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignColorControlWithError()
    {
        $this->article['errors'] = [
            'color' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('color', [
            'type' => 'color',
            'value' => '#ffffff',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'position-relative color is-invalid'],
                    'label' => ['class' => 'form-label visually-hidden', 'for' => 'color'],
                        'Color',
                    '/label',
                    'input' => [
                        'type' => 'color',
                        'name' => 'color',
                        'id' => 'color',
                        'class' => 'form-control form-control-color is-invalid',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'color-error',
                        'value' => '#ffffff',
                    ],
                    ['div' => ['id' => 'color-error', 'class' => 'invalid-tooltip']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignColorControlWithErrorAndHelp()
    {
        $this->article['errors'] = [
            'color' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('color', [
            'type' => 'color',
            'value' => '#ffffff',
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'position-relative color is-invalid'],
                    'label' => ['class' => 'form-label visually-hidden', 'for' => 'color'],
                        'Color',
                    '/label',
                    'input' => [
                        'type' => 'color',
                        'name' => 'color',
                        'id' => 'color',
                        'class' => 'form-control form-control-color is-invalid',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'color-error color-help',
                        'value' => '#ffffff',
                    ],
                    ['div' => ['id' => 'color-error', 'class' => 'invalid-tooltip']],
                        'error message',
                    '/div',
                    ['div' => ['id' => 'color-help', 'class' => 'form-text visually-hidden']],
                        'Help text',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignColorControlWithErrorAndHelpOptions()
    {
        $this->article['errors'] = [
            'color' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('color', [
            'type' => 'color',
            'value' => '#ffffff',
            'help' => [
                'id' => 'custom-help',
                'foo' => 'bar',
                'class' => 'help-class',
                'content' => 'Help text',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'position-relative color is-invalid'],
                    'label' => ['class' => 'form-label visually-hidden', 'for' => 'color'],
                        'Color',
                    '/label',
                    'input' => [
                        'type' => 'color',
                        'name' => 'color',
                        'id' => 'color',
                        'class' => 'form-control form-control-color is-invalid',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'color-error custom-help',
                        'value' => '#ffffff',
                    ],
                    ['div' => ['id' => 'color-error', 'class' => 'invalid-tooltip']],
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

    public function testInlineAlignColorControlContainerOptions()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('color', [
            'type' => 'color',
            'value' => '#ffffff',
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);

        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => [
                    'attribute' => 'container-attribute',
                    'class' => 'container-class color',
                ],
                    'label' => ['class' => 'form-label visually-hidden', 'for' => 'color'],
                        'Color',
                    '/label',
                    'input' => [
                        'type' => 'color',
                        'name' => 'color',
                        'id' => 'color',
                        'class' => 'form-control form-control-color',
                        'value' => '#ffffff',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignColorControlContainerOptionsWithError()
    {
        $this->article['errors'] = [
            'color' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('color', [
            'type' => 'color',
            'value' => '#ffffff',
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);

        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => [
                    'attribute' => 'container-attribute',
                    'class' => 'container-class position-relative color is-invalid',
                ],
                    'label' => ['class' => 'form-label visually-hidden', 'for' => 'color'],
                        'Color',
                    '/label',
                    'input' => [
                        'type' => 'color',
                        'name' => 'color',
                        'id' => 'color',
                        'class' => 'form-control form-control-color is-invalid',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'color-error',
                        'value' => '#ffffff',
                    ],
                    ['div' => ['id' => 'color-error', 'class' => 'invalid-tooltip']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
