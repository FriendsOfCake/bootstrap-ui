<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\DefaultAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class StaticControlTest extends AbstractFormHelperTest
{
    public function testDefaultAlignStaticControl()
    {
        $this->View->setRequest($this->View->getRequest()->withAttribute('formTokenData', []));

        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'foo <u>bar</u>';
        $this->Form->create($this->article);

        $result = $this->Form->control('title', ['type' => 'staticControl']);
        $expected = [
            'div' => ['class' => 'mb-3 form-group staticControl'],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
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
        ];
        $this->assertHtml($expected, $result);
        $this->assertSame(
            ['title' => 'foo <u>bar</u>'],
            $this->Form->getFormProtector()->__debugInfo()['fields']
        );
    }

    public function testDefaultAlignStaticControlWithoutHiddenField()
    {
        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'foo <u>bar</u>';
        $this->Form->create($this->article);

        $result = $this->Form->control('title', [
            'type' => 'staticControl',
            'hiddenField' => false,
            'escape' => false,
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 form-group staticControl'],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
                    'Title',
                '/label',
                'p' => ['class' => 'form-control-plaintext'],
                    'foo',
                    'u' => [],
                        'bar',
                    '/u',
                '/p',
            '/div',
        ];
        $this->assertHtml($expected, $result);
        $this->assertEmpty($this->Form->fields);
    }

    public function testDefaultAlignStaticControlWithDisabledLabel()
    {
        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'title';
        $this->Form->create($this->article);

        $result = $this->Form->control('title', [
            'type' => 'staticControl',
            'label' => false,
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 form-group staticControl'],
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
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignStaticControlWithCustomLabel()
    {
        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'title';
        $this->Form->create($this->article);

        $result = $this->Form->control('title', [
            'type' => 'staticControl',
            'label' => 'Custom Label',
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 form-group staticControl'],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
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
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignStaticControlWithCustomLabelOptions()
    {
        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'title';
        $this->Form->create($this->article);

        $result = $this->Form->control('title', [
            'type' => 'staticControl',
            'label' => [
                'class' => 'custom-label-class',
                'foo' => 'bar',
                'text' => 'Custom Label',
            ],
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 form-group staticControl'],
                'label' => ['class' => 'custom-label-class form-label', 'foo' => 'bar', 'for' => 'title'],
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
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignStaticControlWithHelp()
    {
        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'title';
        $this->Form->create($this->article);

        $result = $this->Form->control('title', [
            'type' => 'staticControl',
            'help' => 'Help text',
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 form-group staticControl'],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
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
                ['small' => ['id' => 'title-help', 'class' => 'd-block form-text text-muted']],
                    'Help text',
                '/small',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignStaticControlWithHelpOptions()
    {
        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'title';
        $this->Form->create($this->article);

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
            'div' => ['class' => 'mb-3 form-group staticControl'],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
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
                    'class' => 'help-class d-block form-text text-muted',
                ]],
                    'Help text',
                '/small',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignStaticControlWithTooltip()
    {
        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'title';
        $this->Form->create($this->article);

        $result = $this->Form->control('title', [
            'type' => 'staticControl',
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 form-group staticControl'],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
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
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignStaticControlWithError()
    {
        $this->article['errors'] = [
            'title' => ['error message'],
        ];
        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'title';
        $this->Form->create($this->article);

        $result = $this->Form->control('title', [
            'type' => 'staticControl',
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 form-group staticControl is-invalid'],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
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
                ['div' => ['class' => 'ms-0 invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignStaticControlContainerOptions()
    {
        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'title';
        $this->Form->create($this->article);

        $result = $this->Form->control('title', [
            'type' => 'staticControl',
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            'div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class mb-3 form-group staticControl',
            ],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
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
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignStaticControlContainerOptionsWithError()
    {
        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'title';
        $this->article['errors'] = [
            'title' => ['error message'],
        ];
        $this->Form->create($this->article);

        $result = $this->Form->control('title', [
            'type' => 'staticControl',
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            'div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class mb-3 form-group staticControl is-invalid',
            ],
                ['label' => ['class' => 'form-label', 'for' => 'title']],
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
                ['div' => ['class' => 'ms-0 invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
