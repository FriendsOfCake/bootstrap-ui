<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\InlineAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class FileControlTest extends AbstractFormHelperTest
{
    public function testInlineAlignFileControl()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('file', [
            'type' => 'file',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => ['class' => 'form-group file']],
                    ['label' => ['class' => 'form-label visually-hidden', 'for' => 'file']],
                        'File',
                    '/label',
                    ['input' => [
                        'type' => 'file',
                        'name' => 'file',
                        'id' => 'file',
                        'class' => 'form-control',
                    ]],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignFileControlWithDisabledLabel()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('file', [
            'type' => 'file',
            'label' => false,
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => ['class' => 'form-group file']],
                    ['input' => [
                        'type' => 'file',
                        'name' => 'file',
                        'id' => 'file',
                        'class' => 'form-control',
                    ]],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignFileControlWithCustomLabel()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('file', [
            'type' => 'file',
            'label' => 'Custom Label',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => ['class' => 'form-group file']],
                    ['label' => ['class' => 'form-label visually-hidden', 'for' => 'file']],
                        'Custom Label',
                    '/label',
                    ['input' => [
                        'type' => 'file',
                        'name' => 'file',
                        'id' => 'file',
                        'class' => 'form-control',
                    ]],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignFileControlWithCustomLabelOptions()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('file', [
            'type' => 'file',
            'label' => [
                'class' => 'custom-label-class',
                'foo' => 'bar',
                'text' => 'Custom Label',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => ['class' => 'form-group file']],
                    ['label' => [
                        'class' => 'custom-label-class form-label visually-hidden',
                        'foo' => 'bar',
                        'for' => 'file',
                    ]],
                        'Custom Label',
                    '/label',
                    ['input' => [
                        'type' => 'file',
                        'name' => 'file',
                        'id' => 'file',
                        'class' => 'form-control',
                    ]],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignFileControlWithHelp()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('file', [
            'type' => 'file',
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => ['class' => 'form-group file']],
                    ['label' => ['class' => 'form-label visually-hidden', 'for' => 'file']],
                        'File',
                    '/label',
                    ['input' => [
                        'type' => 'file',
                        'name' => 'file',
                        'id' => 'file',
                        'class' => 'form-control',
                    ]],
                    ['small' => ['class' => 'visually-hidden form-text text-muted']],
                        'Help text',
                    '/small',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignFileControlWithHelpOptions()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('file', [
            'type' => 'file',
            'help' => [
                'foo' => 'bar',
                'content' => 'Help text',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => ['class' => 'form-group file']],
                    ['label' => ['class' => 'form-label visually-hidden', 'for' => 'file']],
                        'File',
                    '/label',
                    ['input' => [
                        'type' => 'file',
                        'name' => 'file',
                        'id' => 'file',
                        'class' => 'form-control',
                    ]],
                    ['small' => ['foo' => 'bar', 'class' => 'visually-hidden form-text text-muted']],
                        'Help text',
                    '/small',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignFileControlWithTooltip()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('file', [
            'type' => 'file',
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => ['class' => 'form-group file']],
                    ['label' => ['class' => 'form-label visually-hidden', 'for' => 'file']],
                        'File ',
                        'span' => [
                            'data-bs-toggle' => 'tooltip',
                            'title' => 'Tooltip text',
                            'class' => 'bi bi-info-circle-fill',
                        ],
                        '/span',
                    '/label',
                    ['input' => [
                        'type' => 'file',
                        'name' => 'file',
                        'id' => 'file',
                        'class' => 'form-control',
                    ]],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignFileControlWithError()
    {
        $this->withErrorReporting(0, function () {
            $this->article['errors'] = [
                'file' => ['error message'],
            ];
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('file', [
            'type' => 'file',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => ['class' => 'form-group position-relative file is-invalid']],
                    ['label' => ['class' => 'form-label visually-hidden', 'for' => 'file']],
                        'File',
                    '/label',
                    ['input' => [
                        'type' => 'file',
                        'name' => 'file',
                        'id' => 'file',
                        'class' => 'is-invalid form-control',
                    ]],
                    ['div' => ['class' => 'invalid-tooltip']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignFileControlContainerOptions()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('file', [
            'type' => 'file',
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => [
                    'attribute' => 'container-attribute',
                    'class' => 'container-class form-group file',
                ]],
                    ['label' => ['class' => 'form-label visually-hidden', 'for' => 'file']],
                        'File',
                    '/label',
                    ['input' => [
                        'type' => 'file',
                        'name' => 'file',
                        'id' => 'file',
                        'class' => 'form-control',
                    ]],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignFileControlContainerOptionsWithError()
    {
        $this->withErrorReporting(0, function () {
            $this->article['errors'] = [
                'file' => ['error message'],
            ];
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('file', [
            'type' => 'file',
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => [
                    'attribute' => 'container-attribute',
                    'class' => 'container-class form-group position-relative file is-invalid',
                ]],
                    ['label' => ['class' => 'form-label visually-hidden', 'for' => 'file']],
                        'File',
                    '/label',
                    ['input' => [
                        'type' => 'file',
                        'name' => 'file',
                        'id' => 'file',
                        'class' => 'is-invalid form-control',
                    ]],
                    ['div' => ['class' => 'invalid-tooltip']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignFileControlInputGroupAppend()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'append' => 'append',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => ['class' => 'form-group file']],
                    ['label' => ['class' => 'form-label visually-hidden', 'for' => 'file']],
                        'File',
                    '/label',
                    ['div' => ['class' => 'input-group']],
                        ['input' => [
                            'type' => 'file',
                            'name' => 'file',
                            'id' => 'file',
                            'class' => 'form-control',
                        ]],
                        ['span' => ['class' => 'input-group-text']],
                            'append',
                        '/span',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignFileControlInputGroupPrepend()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'prepend' => 'prepend',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => ['class' => 'form-group file']],
                    ['label' => ['class' => 'form-label visually-hidden', 'for' => 'file']],
                        'File',
                    '/label',
                    ['div' => ['class' => 'input-group']],
                        ['span' => ['class' => 'input-group-text']],
                            'prepend',
                        '/span',
                        ['input' => [
                            'type' => 'file',
                            'name' => 'file',
                            'id' => 'file',
                            'class' => 'form-control',
                        ]],
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignFileControlInputGroupWithError()
    {
        $this->article['errors'] = [
            'file' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'append' => 'append',
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                ['div' => ['class' => 'form-group position-relative file is-invalid']],
                    ['label' => ['class' => 'form-label visually-hidden', 'for' => 'file']],
                        'File',
                    '/label',
                    ['div' => ['class' => 'input-group is-invalid']],
                        ['input' => [
                            'type' => 'file',
                            'name' => 'file',
                            'id' => 'file',
                            'class' => 'is-invalid form-control',
                        ]],
                        ['span' => ['class' => 'input-group-text']],
                            'append',
                        '/span',
                    '/div',
                    ['div' => ['class' => 'invalid-tooltip']],
                        'error message',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
