<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\DefaultAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class RangeCustomControlTest extends AbstractFormHelperTest
{
    public function testDefaultAlignCustomRangeControl()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('height', [
            'type' => 'range',
            'min' => 0,
            'max' => 10,
            'step' => 1,
            'custom' => true,
        ]);
        $expected = [
            'div' => ['class' => 'form-group range'],
                ['label' => ['for' => 'height']],
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

    public function testDefaultAlignCustomRangeControlWithDisabledLabel()
    {
        $this->Form->create($this->article);

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

    public function testDefaultAlignCustomRangeControlWithCustomLabel()
    {
        $this->Form->create($this->article);

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
                ['label' => ['for' => 'height']],
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

    public function testDefaultAlignCustomRangeControlWithCustomLabelOptions()
    {
        $this->Form->create($this->article);

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
                ['label' => ['class' => 'custom-label-class', 'foo' => 'bar', 'for' => 'height']],
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

    public function testDefaultAlignCustomRangeControlWithHelp()
    {
        $this->Form->create($this->article);

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
                ['label' => ['for' => 'height']],
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
                ['small' => ['class' => 'form-text text-muted']],
                    'Help text',
                '/small',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomRangeControlWithHelpOptions()
    {
        $this->Form->create($this->article);

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
                ['label' => ['for' => 'height']],
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
                ['small' => ['foo' => 'bar', 'class' => 'form-text text-muted']],
                    'Help text',
                '/small',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomRangeControlWithTooltip()
    {
        $this->Form->create($this->article);

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
                ['label' => ['for' => 'height']],
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

    public function testDefaultAlignCustomRangeControlWithError()
    {
        $this->article['errors'] = [
            'height' => ['error message'],
        ];
        $this->Form->create($this->article);

        $result = $this->Form->control('height', [
            'type' => 'range',
            'min' => 0,
            'max' => 10,
            'step' => 1,
            'custom' => true,
        ]);
        $expected = [
            'div' => ['class' => 'form-group range is-invalid'],
                ['label' => ['for' => 'height']],
                    'Height',
                '/label',
                'input' => [
                    'type' => 'range',
                    'name' => 'height',
                    'min' => 0,
                    'max' => 10,
                    'step' => 1,
                    'id' => 'height',
                    'aria-invalid' => 'true',
                    'class' => 'custom-range is-invalid',
                ],
                ['div' => ['class' => 'invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomRangeControlContainerOptions()
    {
        $this->Form->create($this->article);

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
                ['label' => ['for' => 'height']],
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

    public function testDefaultAlignCustomRangeControlContainerOptionsWithError()
    {
        $this->article['errors'] = [
            'height' => ['error message'],
        ];
        $this->Form->create($this->article);

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
                'class' => 'container-class form-group range is-invalid',
            ],
                ['label' => ['for' => 'height']],
                    'Height',
                '/label',
                'input' => [
                    'type' => 'range',
                    'name' => 'height',
                    'min' => 0,
                    'max' => 10,
                    'step' => 1,
                    'id' => 'height',
                    'aria-invalid' => 'true',
                    'class' => 'custom-range is-invalid',
                ],
                ['div' => ['class' => 'invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
