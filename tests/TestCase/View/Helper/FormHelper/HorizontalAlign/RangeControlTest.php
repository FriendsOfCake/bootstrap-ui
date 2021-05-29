<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\HorizontalAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class RangeControlTest extends AbstractFormHelperTest
{
    public function testHorizontalAlignRangeControl()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('height', [
            'type' => 'range',
            'min' => 0,
            'max' => 10,
            'step' => 1,
        ]);
        $expected = [
            'div' => ['class' => 'form-group row range'],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'height']],
                    'Height',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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

    public function testHorizontalAlignRangeControlWithDisabledLabel()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('height', [
            'type' => 'range',
            'min' => 0,
            'max' => 10,
            'step' => 1,
            'label' => false,
        ]);
        $expected = [
            'div' => ['class' => 'form-group row range'],
                ['div' => ['class' => 'col-sm-7']],
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

    public function testHorizontalAlignRangeControlWithCustomLabel()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('height', [
            'type' => 'range',
            'min' => 0,
            'max' => 10,
            'step' => 1,
            'label' => 'Custom Label',
        ]);
        $expected = [
            'div' => ['class' => 'form-group row range'],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'height']],
                    'Custom Label',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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

    public function testHorizontalAlignRangeControlWithCustomLabelOptions()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
                ],
            ],
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
            'div' => ['class' => 'form-group row range'],
                ['label' => ['class' => 'custom-label-class col-form-label col-sm-5', 'foo' => 'bar', 'for' => 'height']],
                    'Custom Label',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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

    public function testHorizontalAlignRangeControlWithHelp()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('height', [
            'type' => 'range',
            'min' => 0,
            'max' => 10,
            'step' => 1,
            'help' => 'Help text',
        ]);
        $expected = [
            'div' => ['class' => 'form-group row range'],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'height']],
                    'Height',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    'input' => [
                        'type' => 'range',
                        'name' => 'height',
                        'min' => 0,
                        'max' => 10,
                        'step' => 1,
                        'id' => 'height',
                        'class' => 'form-range',
                    ],
                    ['small' => ['class' => 'form-text text-muted']],
                        'Help text',
                    '/small',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRangeControlWithHelpOptions()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('height', [
            'type' => 'range',
            'min' => 0,
            'max' => 10,
            'step' => 1,
            'help' => [
                'foo' => 'bar',
                'content' => 'Help text',
            ],
        ]);
        $expected = [
            'div' => ['class' => 'form-group row range'],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'height']],
                    'Height',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    'input' => [
                        'type' => 'range',
                        'name' => 'height',
                        'min' => 0,
                        'max' => 10,
                        'step' => 1,
                        'id' => 'height',
                        'class' => 'form-range',
                    ],
                    ['small' => ['foo' => 'bar', 'class' => 'form-text text-muted']],
                        'Help text',
                    '/small',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRangeControlWithTooltip()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('height', [
            'type' => 'range',
            'min' => 0,
            'max' => 10,
            'step' => 1,
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            'div' => ['class' => 'form-group row range'],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'height']],
                    'Height',
                    'span' => [
                        'data-bs-toggle' => 'tooltip',
                        'title' => 'Tooltip text',
                        'class' => 'fas fa-info-circle',
                    ],
                    '/span',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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

    public function testHorizontalAlignRangeControlWithError()
    {
        $this->article['errors'] = [
            'height' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('height', [
            'type' => 'range',
            'min' => 0,
            'max' => 10,
            'step' => 1,
        ]);
        $expected = [
            'div' => ['class' => 'form-group row range is-invalid'],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'height']],
                    'Height',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    'input' => [
                        'type' => 'range',
                        'name' => 'height',
                        'min' => 0,
                        'max' => 10,
                        'step' => 1,
                        'id' => 'height',
                        'class' => 'form-range is-invalid',
                    ],
                    ['div' => ['class' => 'invalid-feedback']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignRangeControlContainerOptions()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
                ],
            ],
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
            'div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class form-group row range',
            ],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'height']],
                    'Height',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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

    public function testHorizontalAlignRangeControlContainerOptionsWithError()
    {
        $this->article['errors'] = [
            'height' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
                ],
            ],
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
            'div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class form-group row range is-invalid',
            ],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'height']],
                    'Height',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    'input' => [
                        'type' => 'range',
                        'name' => 'height',
                        'min' => 0,
                        'max' => 10,
                        'step' => 1,
                        'id' => 'height',
                        'class' => 'form-range is-invalid',
                    ],
                    ['div' => ['class' => 'invalid-feedback']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
