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
            'div' => ['class' => 'form-group text'],
                'label' => ['class' => 'sr-only', 'for' => 'title'],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'form-control',
                ],
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
            'div' => ['class' => 'form-group text'],
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'form-control',
                ],
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
            'div' => ['class' => 'form-group text'],
                'label' => ['class' => 'sr-only', 'for' => 'title'],
                    'Custom Label',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'form-control',
                ],
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
            'div' => ['class' => 'form-group text'],
                'label' => ['class' => 'custom-label-class sr-only', 'foo' => 'bar', 'for' => 'title'],
                    'Custom Label',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'form-control',
                ],
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
            'div' => ['class' => 'form-group text'],
                'label' => ['class' => 'sr-only', 'for' => 'title'],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'form-control',
                ],
                ['small' => ['class' => 'sr-only form-text text-muted']],
                    'Help text',
                '/small',
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
                'foo' => 'bar',
                'content' => 'Help text',
            ],
        ]);
        $expected = [
            'div' => ['class' => 'form-group text'],
                'label' => ['class' => 'sr-only', 'for' => 'title'],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'form-control',
                ],
                ['small' => ['foo' => 'bar', 'class' => 'sr-only form-text text-muted']],
                    'Help text',
                '/small',
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
            'div' => ['class' => 'form-group text'],
                'label' => ['class' => 'sr-only', 'for' => 'title'],
                    'Title',
                    'span' => [
                        'data-toggle' => 'tooltip',
                        'title' => 'Tooltip text',
                        'class' => 'fas fa-info-circle',
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
            'div' => ['class' => 'form-group position-relative text is-invalid'],
                'label' => ['class' => 'sr-only', 'for' => 'title'],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'is-invalid form-control',
                ],
                ['div' => ['class' => 'invalid-tooltip']],
                    'error message',
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
            'div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class form-group text',
            ],
                'label' => ['class' => 'sr-only', 'for' => 'title',],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'form-control',
                ],
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
            'div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class form-group position-relative text is-invalid',
            ],
                'label' => ['class' => 'sr-only', 'for' => 'title',],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'is-invalid form-control',
                ],
                ['div' => ['class' => 'invalid-tooltip']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
