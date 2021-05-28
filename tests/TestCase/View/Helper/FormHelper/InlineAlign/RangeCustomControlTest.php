<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\InlineAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class RangeCustomControlTest extends AbstractFormHelperTest
{
    public function testInlineAlignCustomRangeControl()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('height', [
            'type' => 'range',
            'min' => 0,
            'max' => 10,
            'step' => 1,
            'custom' => true,
        ]);
        $expected = [
            'div' => ['class' => 'form-group range'],
                ['label' => ['class' => 'visually-hidden', 'for' => 'height']],
                    'Height',
                '/label',
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
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomRangeControlWithDisabledLabel()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
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
            'div' => ['class' => 'form-group range'],
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
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomRangeControlWithCustomLabel()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
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
            'div' => ['class' => 'form-group range'],
                ['label' => ['class' => 'visually-hidden', 'for' => 'height']],
                    'Custom Label',
                '/label',
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
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomRangeControlWithCustomLabelOptions()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('height', [
            'type' => 'range',
            'min' => 0,
            'max' => 10,
            'step' => 1,
            'custom' => true,
            'label' => [
                'class' => 'custom-label-class',
                'foo' => 'bar',
                'text' => 'Custom Label',
            ],
        ]);
        $expected = [
            'div' => ['class' => 'form-group range'],
                ['label' => ['class' => 'custom-label-class visually-hidden', 'foo' => 'bar', 'for' => 'height']],
                    'Custom Label',
                '/label',
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
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomRangeControlWithHelp()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('height', [
            'type' => 'range',
            'min' => 0,
            'max' => 10,
            'step' => 1,
            'custom' => true,
            'help' => 'Help text',
        ]);
        $expected = [
            'div' => ['class' => 'form-group range'],
                ['label' => ['class' => 'visually-hidden', 'for' => 'height']],
                    'Height',
                '/label',
                'input' => [
                    'type' => 'range',
                    'name' => 'height',
                    'min' => 0,
                    'max' => 10,
                    'step' => 1,
                    'id' => 'height',
                    'class' => 'custom-range',
                ],
                ['small' => ['class' => 'visually-hidden form-text text-muted']],
                    'Help text',
                '/small',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomRangeControlWithHelpOptions()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('height', [
            'type' => 'range',
            'min' => 0,
            'max' => 10,
            'step' => 1,
            'custom' => true,
            'help' => [
                'foo' => 'bar',
                'content' => 'Help text',
            ],
        ]);
        $expected = [
            'div' => ['class' => 'form-group range'],
                ['label' => ['class' => 'visually-hidden', 'for' => 'height']],
                    'Height',
                '/label',
                'input' => [
                    'type' => 'range',
                    'name' => 'height',
                    'min' => 0,
                    'max' => 10,
                    'step' => 1,
                    'id' => 'height',
                    'class' => 'custom-range',
                ],
                ['small' => ['foo' => 'bar', 'class' => 'visually-hidden form-text text-muted']],
                    'Help text',
                '/small',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomRangeControlWithTooltip()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('height', [
            'type' => 'range',
            'min' => 0,
            'max' => 10,
            'step' => 1,
            'custom' => true,
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            'div' => ['class' => 'form-group range'],
                ['label' => ['class' => 'visually-hidden', 'for' => 'height']],
                    'Height ',
                    'span' => [
                        'data-toggle' => 'tooltip',
                        'title' => 'Tooltip text',
                        'class' => 'fas fa-info-circle',
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
                    'class' => 'custom-range',
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomRangeControlWithError()
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
            'custom' => true,
        ]);
        $expected = [
            'div' => ['class' => 'form-group position-relative range is-invalid'],
                ['label' => ['class' => 'visually-hidden', 'for' => 'height']],
                    'Height',
                '/label',
                'input' => [
                    'type' => 'range',
                    'name' => 'height',
                    'min' => 0,
                    'max' => 10,
                    'step' => 1,
                    'id' => 'height',
                    'class' => 'custom-range is-invalid',
                ],
                ['div' => ['class' => 'invalid-tooltip']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomRangeControlContainerOptions()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
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
                'class' => 'container-class form-group range',
            ],
                ['label' => ['class' => 'visually-hidden', 'for' => 'height']],
                    'Height',
                '/label',
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
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomRangeControlContainerOptionsWithError()
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
            'custom' => true,
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            'div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class form-group position-relative range is-invalid',
            ],
                ['label' => ['class' => 'visually-hidden', 'for' => 'height']],
                    'Height',
                '/label',
                'input' => [
                    'type' => 'range',
                    'name' => 'height',
                    'min' => 0,
                    'max' => 10,
                    'step' => 1,
                    'id' => 'height',
                    'class' => 'custom-range is-invalid',
                ],
                ['div' => ['class' => 'invalid-tooltip']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
