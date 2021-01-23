<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\HorizontalAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class StaticControlTest extends AbstractFormHelperTest
{
    public function testHorizontalAlignStaticControl()
    {
        $this->View->setRequest($this->View->getRequest()->withAttribute('formTokenData', []));

        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'foo <u>bar</u>';
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('title', ['type' => 'staticControl']);
        $expected = [
            'div' => ['class' => 'form-group row staticControl'],
                'label' => ['class' => 'col-form-label col-sm-5', 'for' => 'title'],
                    'Title',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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

    public function testHorizontalAlignStaticControlWithoutHiddenField()
    {
        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'foo <u>bar</u>';
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('title', [
            'type' => 'staticControl',
            'hiddenField' => false,
            'escape' => false,
        ]);
        $expected = [
            'div' => ['class' => 'form-group row staticControl'],
                'label' => ['class' => 'col-form-label col-sm-5', 'for' => 'title'],
                    'Title',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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
        $this->assertEmpty($this->Form->fields);
    }

    public function testHorizontalAlignStaticControlWithDisabledLabel()
    {
        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'title';
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('title', [
            'type' => 'staticControl',
            'label' => false,
        ]);
        $expected = [
            'div' => ['class' => 'form-group row staticControl'],
                ['div' => ['class' => 'col-sm-7']],
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

    public function testHorizontalAlignStaticControlWithCustomLabel()
    {
        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'title';
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('title', [
            'type' => 'staticControl',
            'label' => 'Custom Label',
        ]);
        $expected = [
            'div' => ['class' => 'form-group row staticControl'],
                'label' => ['class' => 'col-form-label col-sm-5', 'for' => 'title'],
                    'Custom Label',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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

    public function testHorizontalAlignStaticControlWithCustomLabelOptions()
    {
        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'title';
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('title', [
            'type' => 'staticControl',
            'label' => [
                'class' => 'custom-label-class',
                'foo' => 'bar',
                'text' => 'Custom Label'
            ]
        ]);
        $expected = [
            'div' => ['class' => 'form-group row staticControl'],
                'label' => ['class' => 'custom-label-class col-form-label col-sm-5', 'foo' => 'bar', 'for' => 'title'],
                    'Custom Label',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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

    public function testHorizontalAlignStaticControlWithTooltip()
    {
        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'title';
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('title', [
            'type' => 'staticControl',
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            'div' => ['class' => 'form-group row staticControl'],
                'label' => ['class' => 'col-form-label col-sm-5', 'for' => 'title'],
                    'Title',
                    'span' => [
                        'data-toggle' => 'tooltip',
                        'title' => 'Tooltip text',
                        'class' => 'fas fa-info-circle',
                    ],
                    '/span',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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

    public function testHorizontalAlignStaticControlWithError()
    {
        $this->article['errors'] = [
            'title' => ['error message'],
        ];
        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'title';
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('title', [
            'type' => 'staticControl',
        ]);
        $expected = [
            'div' => ['class' => 'form-group row staticControl is-invalid'],
                'label' => ['class' => 'col-form-label col-sm-5', 'for' => 'title'],
                    'Title',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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
                    ['div' => ['class' => 'invalid-feedback']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignStaticControlContainerOptions()
    {
        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'title';
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
                ],
            ],
        ]);

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
                'class' => 'container-class form-group row staticControl',
            ],
                'label' => ['class' => 'col-form-label col-sm-5', 'for' => 'title'],
                    'Title',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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

    public function testHorizontalAlignStaticControlContainerOptionsWithError()
    {
        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'title';
        $this->article['errors'] = [
            'title' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
                ],
            ],
        ]);

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
                'class' => 'container-class form-group row staticControl is-invalid',
            ],
                'label' => ['class' => 'col-form-label col-sm-5', 'for' => 'title'],
                    'Title',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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
                    ['div' => ['class' => 'invalid-feedback']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
