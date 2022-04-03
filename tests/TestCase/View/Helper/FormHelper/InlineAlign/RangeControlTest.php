<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\InlineAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class RangeControlTest extends AbstractFormHelperTest
{
    public function testInlineAlignRangeControl()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('height', [
            'type' => 'range',
            'min' => 0,
            'max' => 10,
            'step' => 1,
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'form-group range'],
                    ['label' => ['class' => 'form-label visually-hidden', 'for' => 'height']],
                        'Height',
                    '/label',
                    'input' => [
                        'type' => 'range',
                        'name' => 'height',
                        'min' => 0,
                        'max' => 10,
                        'step' => 1,
                        'id' => 'height',
                        'class' => 'form-range',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignRangeControlWithDisabledLabel()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('height', [
            'type' => 'range',
            'min' => 0,
            'max' => 10,
            'step' => 1,
            'label' => false,
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'form-group range'],
                    'input' => [
                        'type' => 'range',
                        'name' => 'height',
                        'min' => 0,
                        'max' => 10,
                        'step' => 1,
                        'id' => 'height',
                        'class' => 'form-range',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignRangeControlWithCustomLabel()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('height', [
            'type' => 'range',
            'min' => 0,
            'max' => 10,
            'step' => 1,
            'label' => 'Custom Label',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'form-group range'],
                    ['label' => ['class' => 'form-label visually-hidden', 'for' => 'height']],
                        'Custom Label',
                    '/label',
                    'input' => [
                        'type' => 'range',
                        'name' => 'height',
                        'min' => 0,
                        'max' => 10,
                        'step' => 1,
                        'id' => 'height',
                        'class' => 'form-range',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignRangeControlWithCustomLabelOptions()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('height', [
            'type' => 'range',
            'min' => 0,
            'max' => 10,
            'step' => 1,
            'label' => [
                'class' => 'custom-label-class',
                'foo' => 'bar',
                'text' => 'Custom Label',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'form-group range'],
                    ['label' => [
                        'class' => 'custom-label-class form-label visually-hidden',
                        'foo' => 'bar',
                        'for' => 'height',
                    ]],
                        'Custom Label',
                    '/label',
                    'input' => [
                        'type' => 'range',
                        'name' => 'height',
                        'min' => 0,
                        'max' => 10,
                        'step' => 1,
                        'id' => 'height',
                        'class' => 'form-range',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignRangeControlWithHelp()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('height', [
            'type' => 'range',
            'min' => 0,
            'max' => 10,
            'step' => 1,
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'form-group range'],
                    ['label' => ['class' => 'form-label visually-hidden', 'for' => 'height']],
                        'Height',
                    '/label',
                    'input' => [
                        'type' => 'range',
                        'name' => 'height',
                        'min' => 0,
                        'max' => 10,
                        'step' => 1,
                        'id' => 'height',
                        'class' => 'form-range',
                        'aria-describedby' => 'height-help',
                    ],
                    ['small' => ['id' => 'height-help', 'class' => 'visually-hidden form-text']],
                        'Help text',
                    '/small',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignRangeControlWithHelpOptions()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('height', [
            'type' => 'range',
            'min' => 0,
            'max' => 10,
            'step' => 1,
            'help' => [
                'id' => 'custom-help',
                'foo' => 'bar',
                'class' => 'help-class',
                'content' => 'Help text',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'form-group range'],
                    ['label' => ['class' => 'form-label visually-hidden', 'for' => 'height']],
                        'Height',
                    '/label',
                    'input' => [
                        'type' => 'range',
                        'name' => 'height',
                        'min' => 0,
                        'max' => 10,
                        'step' => 1,
                        'id' => 'height',
                        'class' => 'form-range',
                        'aria-describedby' => 'custom-help',
                    ],
                    ['small' => [
                        'id' => 'custom-help',
                        'foo' => 'bar',
                        'class' => 'help-class visually-hidden form-text',
                    ]],
                        'Help text',
                    '/small',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignRangeControlWithTooltip()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('height', [
            'type' => 'range',
            'min' => 0,
            'max' => 10,
            'step' => 1,
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'form-group range'],
                    ['label' => ['class' => 'form-label visually-hidden', 'for' => 'height']],
                        'Height ',
                        'span' => [
                            'data-bs-toggle' => 'tooltip',
                            'title' => 'Tooltip text',
                            'class' => 'bi bi-info-circle-fill',
                        ],
                        '/span',
                    '/label',
                    'input' => [
                        'type' => 'range',
                        'name' => 'height',
                        'min' => 0,
                        'max' => 10,
                        'step' => 1,
                        'id' => 'height',
                        'class' => 'form-range',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignRangeControlWithError()
    {
        $this->article['errors'] = [
            'height' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('height', [
            'type' => 'range',
            'min' => 0,
            'max' => 10,
            'step' => 1,
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'form-group position-relative range is-invalid'],
                    ['label' => ['class' => 'form-label visually-hidden', 'for' => 'height']],
                        'Height',
                    '/label',
                    'input' => [
                        'type' => 'range',
                        'name' => 'height',
                        'min' => 0,
                        'max' => 10,
                        'step' => 1,
                        'id' => 'height',
                        'class' => 'form-range is-invalid',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'height-error',
                    ],
                    ['div' => ['id' => 'height-error', 'class' => 'invalid-tooltip']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignRangeControlWithErrorAndHelp()
    {
        $this->article['errors'] = [
            'height' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('height', [
            'type' => 'range',
            'min' => 0,
            'max' => 10,
            'step' => 1,
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'form-group position-relative range is-invalid'],
                    ['label' => ['class' => 'form-label visually-hidden', 'for' => 'height']],
                        'Height',
                    '/label',
                    'input' => [
                        'type' => 'range',
                        'name' => 'height',
                        'min' => 0,
                        'max' => 10,
                        'step' => 1,
                        'id' => 'height',
                        'class' => 'form-range is-invalid',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'height-error height-help',
                    ],
                    ['div' => ['id' => 'height-error', 'class' => 'invalid-tooltip']],
                        'error message',
                    '/div',
                    ['small' => ['id' => 'height-help', 'class' => 'visually-hidden form-text']],
                        'Help text',
                    '/small',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignRangeControlWithErrorAndHelpOptions()
    {
        $this->article['errors'] = [
            'height' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('height', [
            'type' => 'range',
            'min' => 0,
            'max' => 10,
            'step' => 1,
            'help' => [
                'id' => 'custom-help',
                'foo' => 'bar',
                'class' => 'help-class',
                'content' => 'Help text',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'form-group position-relative range is-invalid'],
                    ['label' => ['class' => 'form-label visually-hidden', 'for' => 'height']],
                        'Height',
                    '/label',
                    'input' => [
                        'type' => 'range',
                        'name' => 'height',
                        'min' => 0,
                        'max' => 10,
                        'step' => 1,
                        'id' => 'height',
                        'class' => 'form-range is-invalid',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'height-error custom-help',
                    ],
                    ['div' => ['id' => 'height-error', 'class' => 'invalid-tooltip']],
                        'error message',
                    '/div',
                    ['small' => [
                        'id' => 'custom-help',
                        'foo' => 'bar',
                        'class' => 'help-class visually-hidden form-text',
                    ]],
                        'Help text',
                    '/small',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignRangeControlContainerOptions()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('height', [
            'type' => 'range',
            'min' => 0,
            'max' => 10,
            'step' => 1,
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => [
                    'attribute' => 'container-attribute',
                    'class' => 'container-class form-group range',
                ],
                    ['label' => ['class' => 'form-label visually-hidden', 'for' => 'height']],
                        'Height',
                    '/label',
                    'input' => [
                        'type' => 'range',
                        'name' => 'height',
                        'min' => 0,
                        'max' => 10,
                        'step' => 1,
                        'id' => 'height',
                        'class' => 'form-range',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignRangeControlContainerOptionsWithError()
    {
        $this->article['errors'] = [
            'height' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('height', [
            'type' => 'range',
            'min' => 0,
            'max' => 10,
            'step' => 1,
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => [
                    'attribute' => 'container-attribute',
                    'class' => 'container-class form-group position-relative range is-invalid',
                ],
                    ['label' => ['class' => 'form-label visually-hidden', 'for' => 'height']],
                        'Height',
                    '/label',
                    'input' => [
                        'type' => 'range',
                        'name' => 'height',
                        'min' => 0,
                        'max' => 10,
                        'step' => 1,
                        'id' => 'height',
                        'class' => 'form-range is-invalid',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'height-error',
                    ],
                    ['div' => ['id' => 'height-error', 'class' => 'invalid-tooltip']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
