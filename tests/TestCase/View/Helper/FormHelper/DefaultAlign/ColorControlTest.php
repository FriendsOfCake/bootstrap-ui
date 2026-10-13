<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\DefaultAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class ColorControlTest extends AbstractFormHelperTest
{
    public function testDefaultAlignColorControl(): void
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('color', [
            'type' => 'color',
            'value' => '#ffffff',
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 color'],
                ['label' => ['class' => 'form-label', 'for' => 'color']],
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
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignColorControlWithDisabledLabel(): void
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('color', [
            'type' => 'color',
            'value' => '#ffffff',
            'label' => false,
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 color'],
                'input' => [
                    'type' => 'color',
                    'name' => 'color',
                    'id' => 'color',
                    'class' => 'form-control form-control-color',
                    'value' => '#ffffff',
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignColorControlWithCustomLabel(): void
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('color', [
            'type' => 'color',
            'value' => '#ffffff',
            'label' => 'Custom Label',
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 color'],
                ['label' => ['class' => 'form-label', 'for' => 'color']],
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
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignColorControlWithCustomLabelOptions(): void
    {
        $this->Form->create($this->article);

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
            'div' => ['class' => 'mb-3 color'],
                'label' => ['for' => 'color', 'class' => 'custom-label-class form-label', 'foo' => 'bar'],
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
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignColorControlWithHelp(): void
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('color', [
            'type' => 'color',
            'value' => '#ffffff',
            'help' => 'Help text',
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 color'],
                ['label' => ['class' => 'form-label', 'for' => 'color']],
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
                ['div' => ['id' => 'color-help', 'class' => 'form-text']],
                    'Help text',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignColorControlWithHelpOptions(): void
    {
        $this->Form->create($this->article);

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
            'div' => ['class' => 'mb-3 color'],
                ['label' => ['class' => 'form-label', 'for' => 'color']],
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
                    'class' => 'help-class form-text',
                ]],
                    'Help text',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignColorControlWithTooltip(): void
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('color', [
            'type' => 'color',
            'value' => '#ffffff',
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 color'],
                ['label' => ['class' => 'form-label', 'for' => 'color']],
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
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignColorControlWithCustomSpacing(): void
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('color', [
            'type' => 'color',
            'value' => '#ffffff',
            'spacing' => 'custom-spacing',
        ]);
        $expected = [
            'div' => ['class' => 'custom-spacing color'],
                ['label' => ['class' => 'form-label', 'for' => 'color']],
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
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignColorControlWithError(): void
    {
        $this->article['errors'] = [
            'color' => ['error message'],
        ];
        $this->Form->create($this->article);

        $result = $this->Form->control('color', [
            'type' => 'color',
            'value' => '#ffffff',
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 color is-invalid'],
                ['label' => ['class' => 'form-label', 'for' => 'color']],
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
                ['div' => ['id' => 'color-error', 'class' => 'invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignColorControlWithErrorAndHelp(): void
    {
        $this->article['errors'] = [
            'color' => ['error message'],
        ];
        $this->Form->create($this->article);

        $result = $this->Form->control('color', [
            'type' => 'color',
            'value' => '#ffffff',
            'help' => 'Help text',
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 color is-invalid'],
                ['label' => ['class' => 'form-label', 'for' => 'color']],
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
                ['div' => ['id' => 'color-error', 'class' => 'invalid-feedback']],
                    'error message',
                '/div',
                ['div' => ['id' => 'color-help', 'class' => 'form-text']],
                    'Help text',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignColorControlWithErrorAndHelpOptions(): void
    {
        $this->article['errors'] = [
            'color' => ['error message'],
        ];
        $this->Form->create($this->article);

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
            'div' => ['class' => 'mb-3 color is-invalid'],
                ['label' => ['class' => 'form-label', 'for' => 'color']],
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
                ['div' => ['id' => 'color-error', 'class' => 'invalid-feedback']],
                    'error message',
                '/div',
                ['div' => [
                    'id' => 'custom-help',
                    'foo' => 'bar',
                    'class' => 'help-class form-text',
                ]],
                    'Help text',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignColorControlContainerOptions(): void
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('color', [
            'type' => 'color',
            'value' => '#ffffff',
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);

        $expected = [
            'div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class mb-3 color',
            ],
                ['label' => ['class' => 'form-label', 'for' => 'color']],
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
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignColorControlContainerOptionsWithError(): void
    {
        $this->article['errors'] = [
            'color' => ['error message'],
        ];
        $this->Form->create($this->article);

        $result = $this->Form->control('color', [
            'type' => 'color',
            'value' => '#ffffff',
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);

        $expected = [
            'div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class mb-3 color is-invalid',
            ],
                ['label' => ['class' => 'form-label', 'for' => 'color']],
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
                ['div' => ['id' => 'color-error', 'class' => 'invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
