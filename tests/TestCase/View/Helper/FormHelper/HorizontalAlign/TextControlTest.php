<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\HorizontalAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;
use BootstrapUI\View\Helper\FormHelper;

class TextControlTest extends AbstractFormHelperTest
{
    public function testHorizontalAlignTextControl()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('title');
        $expected = [
            'div' => ['class' => 'mb-3 form-group row text'],
                'label' => ['class' => 'col-form-label col-sm-5', 'for' => 'title'],
                    'Title',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'id' => 'title',
                        'class' => 'form-control',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignTextControlWithFloatingLabel()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('title', [
            'label' => [
                'floating' => true,
            ],
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 form-group row text'],
                ['div' => ['class' => 'offset-sm-5 col-sm-7 form-floating']],
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'id' => 'title',
                        'placeholder' => 'Title',
                        'class' => 'form-control',
                    ],
                    'label' => ['class' => 'ps-4', 'for' => 'title'],
                        'Title',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignTextControlWithFloatingLabelAndCustomLabelText()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('title', [
            'label' => [
                'floating' => true,
                'text' => 'Custom Label',
            ],
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 form-group row text'],
                ['div' => ['class' => 'offset-sm-5 col-sm-7 form-floating']],
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'id' => 'title',
                        'placeholder' => 'Custom Label',
                        'class' => 'form-control',
                    ],
                    'label' => ['class' => 'ps-4', 'for' => 'title'],
                        'Custom Label',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignTextControlWithFloatingLabelAndCustomPlaceholder()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('title', [
            'label' => [
                'floating' => true,
            ],
            'placeholder' => 'Custom Placeholder',
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 form-group row text'],
                ['div' => ['class' => 'offset-sm-5 col-sm-7 form-floating']],
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'id' => 'title',
                        'placeholder' => 'Custom Placeholder',
                        'class' => 'form-control',
                    ],
                    'label' => ['class' => 'ps-4', 'for' => 'title'],
                        'Title',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignTextControlWithFloatingLabelAndDisabledPlaceholder()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('title', [
            'label' => [
                'floating' => true,
            ],
            'placeholder' => false,
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 form-group row text'],
                ['div' => ['class' => 'offset-sm-5 col-sm-7 form-floating']],
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'id' => 'title',
                        'class' => 'form-control',
                    ],
                    'label' => ['class' => 'ps-4', 'for' => 'title'],
                        'Title',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignTextControlWithDisabledLabel()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('title', ['label' => false]);
        $expected = [
            'div' => ['class' => 'mb-3 form-group row text'],
                ['div' => ['class' => 'col-sm-7']],
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'id' => 'title',
                        'class' => 'form-control',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignTextControlWithCustomLabel()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('title', ['label' => 'Custom Label']);
        $expected = [
            'div' => ['class' => 'mb-3 form-group row text'],
                'label' => ['class' => 'col-form-label col-sm-5', 'for' => 'title'],
                    'Custom Label',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'id' => 'title',
                        'class' => 'form-control',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignTextControlWithCustomLabelOptions()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('title', [
            'label' => [
                'class' => 'custom-label-class',
                'foo' => 'bar',
                'text' => 'Custom Label',
            ],
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 form-group row text'],
                'label' => [
                    'for' => 'title',
                    'class' => 'custom-label-class col-form-label col-sm-5',
                    'foo' => 'bar',
                ],
                    'Custom Label',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'id' => 'title',
                        'class' => 'form-control',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignTextControlWithHelp()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('title', [
            'help' => 'Help text',
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 form-group row text'],
                'label' => ['class' => 'col-form-label col-sm-5', 'for' => 'title'],
                    'Title',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'id' => 'title',
                        'class' => 'form-control',
                        'aria-describedby' => 'title-help',
                    ],
                    ['small' => ['id' => 'title-help', 'class' => 'd-block form-text text-muted']],
                        'Help text',
                    '/small',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignTextControlWithHelpOptions()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('title', [
            'help' => [
                'id' => 'custom-help',
                'foo' => 'bar',
                'class' => 'help-class',
                'content' => 'Help text',
            ],
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 form-group row text'],
                'label' => ['class' => 'col-form-label col-sm-5', 'for' => 'title'],
                    'Title',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'id' => 'title',
                        'class' => 'form-control',
                        'aria-describedby' => 'custom-help',
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

    public function testHorizontalAlignTextControlWithTooltip()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('title', [
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 form-group row text'],
                'label' => ['class' => 'col-form-label col-sm-5', 'for' => 'title'],
                    'Title',
                    'span' => [
                        'data-bs-toggle' => 'tooltip',
                        'title' => 'Tooltip text',
                        'class' => 'bi bi-info-circle-fill',
                    ],
                    '/span',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'id' => 'title',
                        'class' => 'form-control',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignTextControlWithError()
    {
        $this->article['errors'] = [
            'title' => ['error message'],
        ];
        unset($this->article['required']['title']);
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('title');
        $expected = [
            'div' => ['class' => 'mb-3 form-group row text is-invalid'],
                'label' => ['class' => 'col-form-label col-sm-5', 'for' => 'title'],
                    'Title',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'id' => 'title',
                        'aria-invalid' => 'true',
                        'class' => 'is-invalid form-control',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'title-error',
                    ],
                    ['div' => ['id' => 'title-error', 'class' => 'ms-0 invalid-feedback']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignTextControlWithErrorAndHelp()
    {
        $this->article['errors'] = [
            'title' => ['error message'],
        ];
        unset($this->article['required']['title']);
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('title', [
            'help' => 'Help text',
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 form-group row text is-invalid'],
                'label' => ['class' => 'col-form-label col-sm-5', 'for' => 'title'],
                    'Title',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'id' => 'title',
                        'class' => 'is-invalid form-control',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'title-error title-help',
                    ],
                    ['div' => ['id' => 'title-error', 'class' => 'ms-0 invalid-feedback']],
                        'error message',
                    '/div',
                    ['small' => ['id' => 'title-help', 'class' => 'd-block form-text text-muted']],
                        'Help text',
                    '/small',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignTextControlWithErrorAndHelpOptions()
    {
        $this->article['errors'] = [
            'title' => ['error message'],
        ];
        unset($this->article['required']['title']);
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('title', [
            'help' => [
                'id' => 'custom-help',
                'foo' => 'bar',
                'class' => 'help-class',
                'content' => 'Help text',
            ],
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 form-group row text is-invalid'],
                'label' => ['class' => 'col-form-label col-sm-5', 'for' => 'title'],
                    'Title',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'id' => 'title',
                        'class' => 'is-invalid form-control',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'title-error custom-help',
                    ],
                    ['div' => ['id' => 'title-error', 'class' => 'ms-0 invalid-feedback']],
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

    public function testHorizontalAlignTextControlContainerOptions()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('title', [
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);

        $expected = [
            'div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class mb-3 form-group row text',
            ],
                'label' => ['class' => 'col-form-label col-sm-5', 'for' => 'title',],
                    'Title',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'id' => 'title',
                        'class' => 'form-control',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignTextControlContainerOptionsWithError()
    {
        unset($this->article['required']['title']);
        $this->article['errors'] = [
            'title' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('title', [
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);

        $expected = [
            'div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class mb-3 form-group row text is-invalid',
            ],
                'label' => ['class' => 'col-form-label col-sm-5', 'for' => 'title',],
                    'Title',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'id' => 'title',
                        'aria-invalid' => 'true',
                        'class' => 'is-invalid form-control',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'title-error',
                    ],
                    ['div' => ['id' => 'title-error', 'class' => 'ms-0 invalid-feedback']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
