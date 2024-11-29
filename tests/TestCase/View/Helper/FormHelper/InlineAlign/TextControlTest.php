<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\InlineAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class TextControlTest extends AbstractFormHelperTest
{
    public function testInlineAlignTextControl()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('title');
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'text'],
                    'label' => ['class' => 'form-label visually-hidden', 'for' => 'title'],
                        'Title',
                    '/label',
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

    public function testInlineAlignTextControlWithFloatingLabel()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('title', [
            'label' => [
                'floating' => true,
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'form-floating text'],
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'id' => 'title',
                        'placeholder' => 'Title',
                        'class' => 'form-control',
                    ],
                    'label' => ['for' => 'title'],
                        'Title',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignTextControlWithFloatingLabelAndCustomLabelText()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('title', [
            'label' => [
                'floating' => true,
                'text' => 'Custom Label',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'form-floating text'],
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'id' => 'title',
                        'placeholder' => 'Custom Label',
                        'class' => 'form-control',
                    ],
                    'label' => ['for' => 'title'],
                        'Custom Label',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignTextControlWithFloatingLabelAndCustomPlaceholder()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('title', [
            'label' => [
                'floating' => true,
            ],
            'placeholder' => 'Custom Placeholder',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'form-floating text'],
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'id' => 'title',
                        'placeholder' => 'Custom Placeholder',
                        'class' => 'form-control',
                    ],
                    'label' => ['for' => 'title'],
                        'Title',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignTextControlWithFloatingLabelAndDisabledPlaceholder()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('title', [
            'label' => [
                'floating' => true,
            ],
            'placeholder' => false,
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'form-floating text'],
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'id' => 'title',
                        'class' => 'form-control',
                    ],
                    'label' => ['for' => 'title'],
                        'Title',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignTextControlWithDisabledLabel()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('title', ['label' => false]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'text'],
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

    public function testInlineAlignTextControlWithCustomLabel()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('title', ['label' => 'Custom Label']);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'text'],
                    'label' => ['class' => 'form-label visually-hidden', 'for' => 'title'],
                        'Custom Label',
                    '/label',
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

    public function testInlineAlignTextControlWithCustomLabelOptions()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('title', [
            'label' => [
                'class' => 'custom-label-class',
                'foo' => 'bar',
                'text' => 'Custom Label',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'text'],
                    'label' => [
                        'class' => 'custom-label-class form-label visually-hidden',
                        'foo' => 'bar',
                        'for' => 'title',
                    ],
                        'Custom Label',
                    '/label',
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

    public function testInlineAlignTextControlWithHelp()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('title', [
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'text'],
                    'label' => ['class' => 'form-label visually-hidden', 'for' => 'title'],
                        'Title',
                    '/label',
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'id' => 'title',
                        'class' => 'form-control',
                        'aria-describedby' => 'title-help',
                    ],
                    ['div' => ['id' => 'title-help', 'class' => 'form-text visually-hidden']],
                        'Help text',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignTextControlWithHelpOptions()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article, [
            'align' => 'inline',
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
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'text'],
                    'label' => ['class' => 'form-label visually-hidden', 'for' => 'title'],
                        'Title',
                    '/label',
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'id' => 'title',
                        'class' => 'form-control',
                        'aria-describedby' => 'custom-help',
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

    public function testInlineAlignTextControlWithTooltip()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('title', [
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'text'],
                    'label' => ['class' => 'form-label visually-hidden', 'for' => 'title'],
                        'Title',
                        'span' => [
                            'data-bs-toggle' => 'tooltip',
                            'title' => 'Tooltip text',
                            'class' => 'bi bi-info-circle-fill',
                        ],
                        '/span',
                    '/label',
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

    public function testInlineAlignTextControlWithError()
    {
        $this->article['errors'] = [
            'title' => ['error message'],
        ];
        unset($this->article['required']['title']);
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('title');
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'position-relative text is-invalid'],
                    'label' => ['class' => 'form-label visually-hidden', 'for' => 'title'],
                        'Title',
                    '/label',
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'id' => 'title',
                        'class' => 'is-invalid form-control',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'title-error',
                    ],
                    ['div' => ['id' => 'title-error', 'class' => 'invalid-tooltip']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignTextControlWithErrorAndHelp()
    {
        $this->article['errors'] = [
            'title' => ['error message'],
        ];
        unset($this->article['required']['title']);
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('title', [
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'position-relative text is-invalid'],
                    'label' => ['class' => 'form-label visually-hidden', 'for' => 'title'],
                        'Title',
                    '/label',
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'id' => 'title',
                        'class' => 'is-invalid form-control',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'title-error title-help',
                    ],
                    ['div' => ['id' => 'title-error', 'class' => 'invalid-tooltip']],
                        'error message',
                    '/div',
                    ['div' => ['id' => 'title-help', 'class' => 'form-text visually-hidden']],
                        'Help text',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignTextControlWithErrorAndHelpOptions()
    {
        $this->article['errors'] = [
            'title' => ['error message'],
        ];
        unset($this->article['required']['title']);
        $this->Form->create($this->article, [
            'align' => 'inline',
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
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'position-relative text is-invalid'],
                    'label' => ['class' => 'form-label visually-hidden', 'for' => 'title'],
                        'Title',
                    '/label',
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'id' => 'title',
                        'class' => 'is-invalid form-control',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'title-error custom-help',
                    ],
                    ['div' => ['id' => 'title-error', 'class' => 'invalid-tooltip']],
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

    public function testInlineAlignTextControlContainerOptions()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('title', [
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);

        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => [
                    'attribute' => 'container-attribute',
                    'class' => 'container-class text',
                ],
                    'label' => ['class' => 'form-label visually-hidden', 'for' => 'title'],
                        'Title',
                    '/label',
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

    public function testInlineAlignTextControlContainerOptionsWithError()
    {
        unset($this->article['required']['title']);
        $this->article['errors'] = [
            'title' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('title', [
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);

        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => [
                    'attribute' => 'container-attribute',
                    'class' => 'container-class position-relative text is-invalid',
                ],
                    'label' => ['class' => 'form-label visually-hidden', 'for' => 'title'],
                        'Title',
                    '/label',
                    'input' => [
                        'type' => 'text',
                        'name' => 'title',
                        'id' => 'title',
                        'class' => 'is-invalid form-control',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'title-error',
                    ],
                    ['div' => ['id' => 'title-error', 'class' => 'invalid-tooltip']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
