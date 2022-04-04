<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\HorizontalAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;
use BootstrapUI\View\Helper\FormHelper;

class ColorControlTest extends AbstractFormHelperTest
{
    public function testHorizontalAlignColorControl()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('color', [
            'type' => 'color',
            'value' => '#ffffff',
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 form-group row color'],
                'label' => ['class' => 'col-form-label col-sm-5', 'for' => 'color'],
                    'Color',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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

    public function testHorizontalAlignColorControlWithDisabledLabel()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('color', [
            'type' => 'color',
            'value' => '#ffffff',
            'label' => false,
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 form-group row color'],
                ['div' => ['class' => 'col-sm-7']],
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

    public function testHorizontalAlignColorControlWithCustomLabel()
    {
        unset($this->article['required']['color']);
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('color', [
            'type' => 'color',
            'value' => '#ffffff',
            'label' => 'Custom Label',
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 form-group row color'],
                'label' => ['class' => 'col-form-label col-sm-5', 'for' => 'color'],
                    'Custom Label',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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

    public function testHorizontalAlignColorControlWithCustomLabelOptions()
    {
        unset($this->article['required']['color']);
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
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
            'div' => ['class' => 'mb-3 form-group row color'],
                'label' => [
                    'for' => 'color',
                    'class' => 'custom-label-class col-form-label col-sm-5',
                    'foo' => 'bar',
                ],
                    'Custom Label',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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

    public function testHorizontalAlignColorControlWithHelp()
    {
        unset($this->article['required']['color']);
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('color', [
            'type' => 'color',
            'value' => '#ffffff',
            'help' => 'Help text',
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 form-group row color'],
                'label' => ['class' => 'col-form-label col-sm-5', 'for' => 'color'],
                    'Color',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    'input' => [
                        'type' => 'color',
                        'name' => 'color',
                        'id' => 'color',
                        'class' => 'form-control form-control-color',
                        'aria-describedby' => 'color-help',
                        'value' => '#ffffff',
                    ],
                    ['small' => ['id' => 'color-help', 'class' => 'd-block form-text text-muted']],
                        'Help text',
                    '/small',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignColorControlWithHelpOptions()
    {
        unset($this->article['required']['color']);
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
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
            'div' => ['class' => 'mb-3 form-group row color'],
                'label' => ['class' => 'col-form-label col-sm-5', 'for' => 'color'],
                    'Color',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    'input' => [
                        'type' => 'color',
                        'name' => 'color',
                        'id' => 'color',
                        'class' => 'form-control form-control-color',
                        'aria-describedby' => 'custom-help',
                        'value' => '#ffffff',
                    ],
                    ['small' => [
                        'id' => 'custom-help',
                        'foo' => 'bar',
                        'class' => 'help-class d-block form-text text-muted',
                    ]],
                        'Help text',
                    '/small',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignColorControlWithTooltip()
    {
        unset($this->article['required']['color']);
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('color', [
            'type' => 'color',
            'value' => '#ffffff',
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 form-group row color'],
                'label' => ['class' => 'col-form-label col-sm-5', 'for' => 'color'],
                    'Color',
                    'span' => [
                        'data-bs-toggle' => 'tooltip',
                        'title' => 'Tooltip text',
                        'class' => 'bi bi-info-circle-fill',
                    ],
                    '/span',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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

    public function testHorizontalAlignColorControlWithCustomSpacing()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('color', [
            'type' => 'color',
            'value' => '#ffffff',
            'spacing' => 'custom-spacing',
        ]);
        $expected = [
            'div' => ['class' => 'custom-spacing form-group row color'],
                'label' => ['class' => 'col-form-label col-sm-5', 'for' => 'color'],
                    'Color',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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

    public function testHorizontalAlignColorControlWithError()
    {
        $this->article['errors'] = [
            'color' => ['error message'],
        ];
        unset($this->article['required']['color']);
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('color', [
            'type' => 'color',
            'value' => '#ffffff',
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 form-group row color is-invalid'],
                'label' => ['class' => 'col-form-label col-sm-5', 'for' => 'color'],
                    'Color',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    'input' => [
                        'type' => 'color',
                        'name' => 'color',
                        'id' => 'color',
                        'class' => 'form-control form-control-color is-invalid',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'color-error',
                        'value' => '#ffffff',
                    ],
                    ['div' => ['id' => 'color-error', 'class' => 'ms-0 invalid-feedback']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignColorControlWithErrorAndHelp()
    {
        $this->article['errors'] = [
            'color' => ['error message'],
        ];
        unset($this->article['required']['color']);
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('color', [
            'type' => 'color',
            'value' => '#ffffff',
            'help' => 'Help text',
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 form-group row color is-invalid'],
                'label' => ['class' => 'col-form-label col-sm-5', 'for' => 'color'],
                    'Color',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    'input' => [
                        'type' => 'color',
                        'name' => 'color',
                        'id' => 'color',
                        'class' => 'form-control form-control-color is-invalid',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'color-error color-help',
                        'value' => '#ffffff',
                    ],
                    ['div' => ['id' => 'color-error', 'class' => 'ms-0 invalid-feedback']],
                        'error message',
                    '/div',
                    ['small' => ['id' => 'color-help', 'class' => 'd-block form-text text-muted']],
                        'Help text',
                    '/small',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignColorControlWithErrorAndHelpOptions()
    {
        $this->article['errors'] = [
            'color' => ['error message'],
        ];
        unset($this->article['required']['color']);
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
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
            'div' => ['class' => 'mb-3 form-group row color is-invalid'],
                'label' => ['class' => 'col-form-label col-sm-5', 'for' => 'color'],
                    'Color',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    'input' => [
                        'type' => 'color',
                        'name' => 'color',
                        'id' => 'color',
                        'class' => 'form-control form-control-color is-invalid',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'color-error custom-help',
                        'value' => '#ffffff',
                    ],
                    ['div' => ['id' => 'color-error', 'class' => 'ms-0 invalid-feedback']],
                        'error message',
                    '/div',
                    ['small' => [
                        'id' => 'custom-help',
                        'foo' => 'bar',
                        'class' => 'help-class d-block form-text text-muted',
                    ]],
                        'Help text',
                    '/small',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignColorControlContainerOptions()
    {
        unset($this->article['required']['color']);
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
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
            'div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class mb-3 form-group row color',
            ],
                'label' => ['class' => 'col-form-label col-sm-5', 'for' => 'color',],
                    'Color',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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

    public function testHorizontalAlignColorControlContainerOptionsWithError()
    {
        $this->article['errors'] = [
            'color' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
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
            'div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class mb-3 form-group row color is-invalid',
            ],
                'label' => ['class' => 'col-form-label col-sm-5', 'for' => 'color',],
                    'Color',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    'input' => [
                        'type' => 'color',
                        'name' => 'color',
                        'id' => 'color',
                        'class' => 'form-control form-control-color is-invalid',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'color-error',
                        'value' => '#ffffff',
                    ],
                    ['div' => ['id' => 'color-error', 'class' => 'ms-0 invalid-feedback']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
