<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\DefaultAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class RangeControlTest extends AbstractFormHelperTest
{
    public function testDefaultAlignRangeControl()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('height', [
            'type' => 'range',
            'min' => 0,
            'max' => 10,
            'step' => 1,
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
                    'class' => 'form-control',
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignRangeControlWithDisabledLabel()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('height', [
            'type' => 'range',
            'min' => 0,
            'max' => 10,
            'step' => 1,
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
                    'class' => 'form-control',
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignRangeControlWithCustomLabel()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('height', [
            'type' => 'range',
            'min' => 0,
            'max' => 10,
            'step' => 1,
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
                    'class' => 'form-control',
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignRangeControlWithCustomLabelOptions()
    {
        $this->Form->create($this->article);

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
                    'class' => 'form-control',
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignRangeControlWithHelp()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('height', [
            'type' => 'range',
            'min' => 0,
            'max' => 10,
            'step' => 1,
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
                    'class' => 'form-control',
                ],
                ['small' => ['class' => 'form-text text-muted']],
                    'Help text',
                '/small',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignRangeControlWithHelpOptions()
    {
        $this->Form->create($this->article);

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
                    'class' => 'form-control',
                ],
                ['small' => ['foo' => 'bar', 'class' => 'form-text text-muted']],
                    'Help text',
                '/small',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignRangeControlWithTooltip()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('height', [
            'type' => 'range',
            'min' => 0,
            'max' => 10,
            'step' => 1,
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            'div' => ['class' => 'form-group range'],
                ['label' => ['for' => 'height']],
                    'Height ',
                    'span' => [
                        'data-bs-toggle' => 'tooltip',
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
                    'class' => 'form-control',
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignRangeControlWithError()
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
                    'class' => 'is-invalid form-control',
                ],
                ['div' => ['class' => 'invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignRangeControlContainerOptions()
    {
        $this->Form->create($this->article);

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
                    'class' => 'form-control',
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignRangeControlContainerOptionsWithError()
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
                    'class' => 'is-invalid form-control',
                ],
                ['div' => ['class' => 'invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
