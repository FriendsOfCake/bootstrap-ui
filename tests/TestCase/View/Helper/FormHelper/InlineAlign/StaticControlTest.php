<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\InlineAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class StaticControlTest extends AbstractFormHelperTest
{
    public function testInlineAlignStaticControl()
    {
        $this->View->setRequest($this->View->getRequest()->withAttribute('formTokenData', []));

        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'foo <u>bar</u>';
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('title', ['type' => 'staticControl']);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'form-group staticControl'],
                    'label' => ['class' => 'form-label visually-hidden', 'for' => 'title'],
                        'Title',
                    '/label',
                    'p' => ['class' => 'form-control-plaintext'],
                        'foo &lt;u&gt;bar&lt;/u&gt;',
                    '/p',
                    'input' => [
                        'type' => 'hidden',
                        'name' => 'title',
                        'id' => 'title',
                        'value' => 'foo &lt;u&gt;bar&lt;/u&gt;',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
        $this->assertSame(
            ['title' => 'foo <u>bar</u>'],
            $this->Form->getFormProtector()->__debugInfo()['fields']
        );
    }

    public function testInlineAlignStaticControlWithoutHiddenField()
    {
        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'foo <u>bar</u>';
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('title', [
            'type' => 'staticControl',
            'hiddenField' => false,
            'escape' => false,
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'form-group staticControl'],
                    'label' => ['class' => 'form-label visually-hidden', 'for' => 'title'],
                        'Title',
                    '/label',
                    'p' => ['class' => 'form-control-plaintext'],
                        'foo',
                        'u' => [],
                            'bar',
                        '/u',
                    '/p',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignStaticControlWithDisabledLabel()
    {
        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'title';
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('title', [
            'type' => 'staticControl',
            'label' => false,
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'form-group staticControl'],
                    'p' => ['class' => 'form-control-plaintext'],
                        'title',
                    '/p',
                    'input' => [
                        'type' => 'hidden',
                        'name' => 'title',
                        'id' => 'title',
                        'value' => 'title',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignStaticControlWithCustomLabel()
    {
        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'title';
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('title', [
            'type' => 'staticControl',
            'label' => 'Custom Label',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'form-group staticControl'],
                    'label' => ['class' => 'form-label visually-hidden', 'for' => 'title'],
                        'Custom Label',
                    '/label',
                    'p' => ['class' => 'form-control-plaintext'],
                        'title',
                    '/p',
                    'input' => [
                        'type' => 'hidden',
                        'name' => 'title',
                        'id' => 'title',
                        'value' => 'title',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignStaticControlWithCustomLabelOptions()
    {
        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'title';
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('title', [
            'type' => 'staticControl',
            'label' => [
                'class' => 'custom-label-class',
                'foo' => 'bar',
                'text' => 'Custom Label',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'form-group staticControl'],
                    'label' => [
                        'class' => 'custom-label-class form-label visually-hidden',
                        'foo' => 'bar',
                        'for' => 'title',
                    ],
                        'Custom Label',
                    '/label',
                    'p' => ['class' => 'form-control-plaintext'],
                        'title',
                    '/p',
                    'input' => [
                        'type' => 'hidden',
                        'name' => 'title',
                        'id' => 'title',
                        'value' => 'title',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignStaticControlWithHelp()
    {
        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'title';
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('title', [
            'type' => 'staticControl',
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'form-group staticControl'],
                    'label' => ['class' => 'form-label visually-hidden', 'for' => 'title'],
                        'Title',
                    '/label',
                    'p' => ['class' => 'form-control-plaintext'],
                        'title',
                    '/p',
                    'input' => [
                        'type' => 'hidden',
                        'name' => 'title',
                        'id' => 'title',
                        'aria-describedby' => 'title-help',
                        'value' => 'title',
                    ],
                    ['small' => ['id' => 'title-help', 'class' => 'visually-hidden form-text']],
                        'Help text',
                    '/small',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignStaticControlWithHelpOptions()
    {
        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'title';
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('title', [
            'type' => 'staticControl',
            'help' => [
                'id' => 'custom-help',
                'foo' => 'bar',
                'class' => 'help-class',
                'content' => 'Help text',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'form-group staticControl'],
                    'label' => ['class' => 'form-label visually-hidden', 'for' => 'title'],
                        'Title',
                    '/label',
                    'p' => ['class' => 'form-control-plaintext'],
                        'title',
                    '/p',
                    'input' => [
                        'type' => 'hidden',
                        'name' => 'title',
                        'id' => 'title',
                        'aria-describedby' => 'custom-help',
                        'value' => 'title',
                    ],
                    ['small' => [
                        'id' => 'custom-help',
                        'foo' => 'bar',
                        'class' => 'help-class visually-hidden form-text',
                    ]],
                        'Help text',
                    '/small',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignStaticControlWithTooltip()
    {
        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'title';
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('title', [
            'type' => 'staticControl',
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'form-group staticControl'],
                    'label' => ['class' => 'form-label visually-hidden', 'for' => 'title'],
                        'Title',
                        'span' => [
                            'data-bs-toggle' => 'tooltip',
                            'title' => 'Tooltip text',
                            'class' => 'bi bi-info-circle-fill',
                        ],
                        '/span',
                    '/label',
                    'p' => ['class' => 'form-control-plaintext'],
                        'title',
                    '/p',
                    'input' => [
                        'type' => 'hidden',
                        'name' => 'title',
                        'id' => 'title',
                        'value' => 'title',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignStaticControlWithError()
    {
        $this->article['errors'] = [
            'title' => ['error message'],
        ];
        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'title';
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('title', [
            'type' => 'staticControl',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'form-group position-relative staticControl is-invalid'],
                    'label' => ['class' => 'form-label visually-hidden', 'for' => 'title'],
                        'Title',
                    '/label',
                    'p' => ['class' => 'form-control-plaintext'],
                        'title',
                    '/p',
                    'input' => [
                        'type' => 'hidden',
                        'name' => 'title',
                        'id' => 'title',
                        'class' => 'is-invalid',
                        'value' => 'title',
                    ],
                    ['div' => ['class' => 'invalid-tooltip']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignStaticControlContainerOptions()
    {
        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'title';
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('title', [
            'type' => 'staticControl',
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => [
                    'attribute' => 'container-attribute',
                    'class' => 'container-class form-group staticControl',
                ],
                    'label' => ['class' => 'form-label visually-hidden', 'for' => 'title'],
                        'Title',
                    '/label',
                    'p' => ['class' => 'form-control-plaintext'],
                        'title',
                    '/p',
                    'input' => [
                        'type' => 'hidden',
                        'name' => 'title',
                        'id' => 'title',
                        'value' => 'title',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignStaticControlContainerOptionsWithError()
    {
        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'title';
        $this->article['errors'] = [
            'title' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('title', [
            'type' => 'staticControl',
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => [
                    'attribute' => 'container-attribute',
                    'class' => 'container-class form-group position-relative staticControl is-invalid',
                ],
                    'label' => ['class' => 'form-label visually-hidden', 'for' => 'title'],
                        'Title',
                    '/label',
                    'p' => ['class' => 'form-control-plaintext'],
                        'title',
                    '/p',
                    'input' => [
                        'type' => 'hidden',
                        'name' => 'title',
                        'id' => 'title',
                        'class' => 'is-invalid',
                        'value' => 'title',
                    ],
                    ['div' => ['class' => 'invalid-tooltip']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
