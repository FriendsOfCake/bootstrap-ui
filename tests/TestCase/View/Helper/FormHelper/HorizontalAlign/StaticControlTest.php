<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\HorizontalAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;
use BootstrapUI\View\Helper\FormHelper;

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
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('title', ['type' => 'staticControl']);
        $expected = [
            'div' => ['class' => 'mb-3 row staticControl'],
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
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('title', [
            'type' => 'staticControl',
            'hiddenField' => false,
            'escape' => false,
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 row staticControl'],
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
    }

    public function testHorizontalAlignStaticControlWithDisabledLabel()
    {
        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'title';
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('title', [
            'type' => 'staticControl',
            'label' => false,
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 row staticControl'],
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
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('title', [
            'type' => 'staticControl',
            'label' => 'Custom Label',
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 row staticControl'],
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
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
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
            'div' => ['class' => 'mb-3 row staticControl'],
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

    public function testHorizontalAlignStaticControlWithHelp()
    {
        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'title';
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('title', [
            'type' => 'staticControl',
            'help' => 'Help text',
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 row staticControl'],
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
                        'aria-describedby' => 'title-help',
                        'value' => 'title',
                    ],
                    ['div' => ['id' => 'title-help', 'class' => 'form-text']],
                        'Help text',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignStaticControlWithHelpOptions()
    {
        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'title';
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
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
            'div' => ['class' => 'mb-3 row staticControl'],
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
                        'aria-describedby' => 'custom-help',
                        'value' => 'title',
                    ],
                    ['div' => [
                        'id' => 'custom-help',
                        'foo' => 'bar',
                        'class' => 'help-class form-text',
                    ]],
                        'Help text',
                    '/div',
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
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('title', [
            'type' => 'staticControl',
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 row staticControl'],
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

    public function testHorizontalAlignStaticControlWithCustomSpacing()
    {
        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'foo <u>bar</u>';
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('title', [
            'type' => 'staticControl',
            'spacing' => 'custom-spacing',
        ]);
        $expected = [
            'div' => ['class' => 'custom-spacing row staticControl'],
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
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('title', [
            'type' => 'staticControl',
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 row staticControl is-invalid'],
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
                        'aria-invalid' => 'true',
                        'class' => 'is-invalid',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'title-error',
                        'value' => 'title',
                    ],
                    ['div' => ['id' => 'title-error', 'class' => 'ms-0 invalid-feedback']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignStaticControlWithErrorAndHelp()
    {
        $this->article['errors'] = [
            'title' => ['error message'],
        ];
        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'title';
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('title', [
            'type' => 'staticControl',
            'help' => 'Help text',
        ]);
        $expected = [
            'div' => ['class' => 'mb-3 row staticControl is-invalid'],
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
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'title-error title-help',
                        'value' => 'title',
                    ],
                    ['div' => ['id' => 'title-error', 'class' => 'ms-0 invalid-feedback']],
                        'error message',
                    '/div',
                    ['div' => ['id' => 'title-help', 'class' => 'form-text']],
                        'Help text',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignStaticControlWithErrorAndHelpOptions()
    {
        $this->article['errors'] = [
            'title' => ['error message'],
        ];
        unset($this->article['required']['title']);
        $this->article['defaults']['title'] = 'title';
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
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
            'div' => ['class' => 'mb-3 row staticControl is-invalid'],
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
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'title-error custom-help',
                        'value' => 'title',
                    ],
                    ['div' => ['id' => 'title-error', 'class' => 'ms-0 invalid-feedback']],
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
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
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
                'class' => 'container-class mb-3 row staticControl',
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
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
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
                'class' => 'container-class mb-3 row staticControl is-invalid',
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
                        'aria-invalid' => 'true',
                        'class' => 'is-invalid',
                        'aria-invalid' => 'true',
                        'aria-describedby' => 'title-error',
                        'value' => 'title',
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
