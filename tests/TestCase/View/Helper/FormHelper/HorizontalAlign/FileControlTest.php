<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\HorizontalAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class FileControlTest extends AbstractFormHelperTest
{
    public function testHorizontalAlignFileControl()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('file', [
            'type' => 'file',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row file']],
                ['label' => ['class' => 'col-form-label pt-1 col-sm-5', 'for' => 'file']],
                    'File',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'file',
                        'name' => 'file',
                        'id' => 'file',
                        'class' => 'form-control-file',
                    ]],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignFileControlWithDisabledLabel()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'label' => false,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row file']],
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'file',
                        'name' => 'file',
                        'id' => 'file',
                        'class' => 'form-control-file',
                    ]],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignFileControlWithCustomLabel()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'label' => 'Custom Label',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row file']],
                ['label' => ['class' => 'col-form-label pt-1 col-sm-5', 'for' => 'file']],
                    'Custom Label',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'file',
                        'name' => 'file',
                        'id' => 'file',
                        'class' => 'form-control-file',
                    ]],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignFileControlWithCustomLabelOptions()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'label' => [
                'class' => 'custom-label-class',
                'foo' => 'bar',
                'text' => 'Custom Label',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row file']],
                ['label' => ['class' => 'custom-label-class col-form-label pt-1 col-sm-5', 'foo' => 'bar', 'for' => 'file']],
                    'Custom Label',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'file',
                        'name' => 'file',
                        'id' => 'file',
                        'class' => 'form-control-file',
                    ]],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * Horizontal file control label templates are not backwards compatible,
     * they will produce a duplicate `class` attribute.
     */
    public function testHorizontalAlignFileControlWithCustomLabelTemplateIsBackwardsCompatible()
    {
        $this->markTestIncomplete('Horizontal file control label templates are not backwards compatible');

        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'templates' => [
                'fileLabel' =>
                    '<label class="col-form-label pt-1 %s"{{attrs}} back="compat">{{text}}{{tooltip}}</label>',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row file']],
                ['label' => ['class' => 'col-form-label pt-1 %s', 'for' => 'file', 'back' => 'compat']],
                    'File',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'file',
                        'name' => 'file',
                        'id' => 'file',
                        'class' => 'form-control-file',
                    ]],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignFileControlWithHelp()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row file']],
                ['label' => ['class' => 'col-form-label pt-1 col-sm-5', 'for' => 'file']],
                    'File',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'file',
                        'name' => 'file',
                        'id' => 'file',
                        'class' => 'form-control-file',
                    ]],
                    ['small' => ['class' => 'form-text text-muted']],
                        'Help text',
                    '/small',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignFileControlWithHelpOptions()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'help' => [
                'foo' => 'bar',
                'content' => 'Help text',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row file']],
                ['label' => ['class' => 'col-form-label pt-1 col-sm-5', 'for' => 'file']],
                    'File',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'file',
                        'name' => 'file',
                        'id' => 'file',
                        'class' => 'form-control-file',
                    ]],
                    ['small' => ['foo' => 'bar', 'class' => 'form-text text-muted']],
                        'Help text',
                    '/small',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignFileControlWithTooltip()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row file']],
                ['label' => ['class' => 'col-form-label pt-1 col-sm-5', 'for' => 'file']],
                    'File ',
                    'span' => [
                        'data-toggle' => 'tooltip',
                        'title' => 'Tooltip text',
                        'class' => 'fas fa-info-circle',
                    ],
                    '/span',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'file',
                        'name' => 'file',
                        'id' => 'file',
                        'class' => 'form-control-file',
                    ]],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignFileControlWithError()
    {
        $this->article['errors'] = [
            'file' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('file', [
            'type' => 'file',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group row file is-invalid']],
                ['label' => ['class' => 'col-form-label pt-1 col-sm-5', 'for' => 'file']],
                    'File',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'file',
                        'name' => 'file',
                        'id' => 'file',
                        'aria-invalid' => 'true',
                        'class' => 'is-invalid form-control-file',
                    ]],
                    ['div' => ['class' => 'invalid-feedback']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignFileControlContainerOptions()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            ['div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class form-group row file',
            ]],
                ['label' => ['class' => 'col-form-label pt-1 col-sm-5', 'for' => 'file']],
                    'File',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'file',
                        'name' => 'file',
                        'id' => 'file',
                        'class' => 'form-control-file',
                    ]],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignFileControlContainerOptionsWithError()
    {
        $this->article['errors'] = [
            'file' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    'left' => 5,
                    'middle' => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            ['div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class form-group row file is-invalid',
            ]],
                ['label' => ['class' => 'col-form-label pt-1 col-sm-5', 'for' => 'file']],
                    'File',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    ['input' => [
                        'type' => 'file',
                        'name' => 'file',
                        'id' => 'file',
                        'aria-invalid' => 'true',
                        'class' => 'is-invalid form-control-file',
                    ]],
                    ['div' => ['class' => 'invalid-feedback']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
