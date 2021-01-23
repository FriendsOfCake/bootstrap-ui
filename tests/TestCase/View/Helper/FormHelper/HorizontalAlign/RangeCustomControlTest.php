<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\HorizontalAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class RangeCustomControlTest extends AbstractFormHelperTest
{
    public function testHorizontalAlignCustomRangeControl()
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
            'custom' => true,
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
                        'class' => 'custom-range',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCustomRangeControlWithDisabledLabel()
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
            'custom' => true,
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
                        'class' => 'custom-range',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCustomRangeControlWithCustomLabel()
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
            'custom' => true,
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
                        'class' => 'custom-range',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCustomRangeControlWithError()
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
            'custom' => true,
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
                        'class' => 'custom-range is-invalid',
                    ],
                    ['div' => ['class' => 'invalid-feedback']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCustomRangeControlContainerOptions()
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
            'custom' => true,
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
                        'class' => 'custom-range',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignCustomRangeControlContainerOptionsWithError()
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
            'custom' => true,
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
                        'class' => 'custom-range is-invalid',
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