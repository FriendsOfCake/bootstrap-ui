<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\DefaultAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class TextControlTest extends AbstractFormHelperTest
{
    public function testDefaultAlignTextControl()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article);

        $result = $this->Form->control('title');
        $expected = [
            'div' => ['class' => 'mb-3 form-group text'],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
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

    public function testDefaultAlignTextControlWithFloatingLabel()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article);

        $result = $this->Form->control('title', [
            'label' => [
                'floating' => true,
            ],
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 form-floating form-group text'],
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'form-control',
                ],
                ['label' => ['for' => 'title']],
                    'Title',
                '/label',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignTextControlWithDisabledLabel()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article);

        $result = $this->Form->control('title', ['label' => false]);
        $expected = [
            'div' => ['class' => 'mb-3 form-group text'],
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

    public function testDefaultAlignTextControlWithCustomLabel()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article);

        $result = $this->Form->control('title', ['label' => 'Custom Label']);
        $expected = [
            'div' => ['class' => 'mb-3 form-group text'],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
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

    public function testDefaultAlignTextControlWithCustomLabelOptions()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article);

        $result = $this->Form->control('title', [
            'label' => [
                'class' => 'custom-label-class',
                'foo' => 'bar',
                'text' => 'Custom Label',
            ],
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 form-group text'],
                'label' => ['for' => 'title', 'class' => 'custom-label-class form-label', 'foo' => 'bar'],
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

    public function testDefaultAlignTextControlWithHelp()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article);

        $result = $this->Form->control('title', [
            'help' => 'Help text',
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 form-group text'],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
                    'Title',
                '/label',
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
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignTextControlWithHelpOptions()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article);

        $result = $this->Form->control('title', [
            'help' => [
                'id' => 'custom-help',
                'foo' => 'bar',
                'class' => 'help-class',
                'content' => 'Help text',
            ],
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 form-group text'],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
                    'Title',
                '/label',
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
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignTextControlWithTooltip()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article);

        $result = $this->Form->control('title', [
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 form-group text'],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
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
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignTextControlWithError()
    {
        $this->article['errors'] = [
            'title' => ['error message'],
        ];
        unset($this->article['required']['title']);
        $this->Form->create($this->article);

        $result = $this->Form->control('title');
        $expected = [
            'div' => ['class' => 'mb-3 form-group text is-invalid'],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'is-invalid form-control',
                ],
                ['div' => ['class' => 'ms-0 invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignTextControlContainerOptions()
    {
        unset($this->article['required']['title']);
        $this->Form->create($this->article);

        $result = $this->Form->control('title', [
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);

        $expected = [
            'div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class mb-3 form-group text',
            ],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
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

    public function testDefaultAlignTextControlContainerOptionsWithError()
    {
        unset($this->article['required']['title']);
        $this->article['errors'] = [
            'title' => ['error message'],
        ];
        $this->Form->create($this->article);

        $result = $this->Form->control('title', [
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);

        $expected = [
            'div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class mb-3 form-group text is-invalid',
            ],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
                    'Title',
                '/label',
                'input' => [
                    'type' => 'text',
                    'name' => 'title',
                    'id' => 'title',
                    'class' => 'is-invalid form-control',
                ],
                ['div' => ['class' => 'ms-0 invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
