<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\InlineAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class FileCustomControlTest extends AbstractFormHelperTest
{
    public function testInlineAlignCustomFileControl()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('file', [
            'type' => 'file',
            'custom' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group file']],
                ['div' => ['class' => 'custom-file ']],
                    ['input' => [
                        'type' => 'file',
                        'name' => 'file',
                        'id' => 'file',
                        'class' => 'custom-file-input',
                    ]],
                    ['label' => ['class' => 'custom-file-label', 'for' => 'file']],
                        'File',
                    '/label',
                 '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomFileControlWithDisabledLabel()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('file', [
            'type' => 'file',
            'custom' => true,
            'label' => false,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group file']],
                ['div' => ['class' => 'custom-file ']],
                    ['input' => [
                        'type' => 'file',
                        'name' => 'file',
                        'id' => 'file',
                        'class' => 'custom-file-input',
                    ]],
                 '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomFileControlWithCustomLabel()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('file', [
            'type' => 'file',
            'custom' => true,
            'label' => 'Custom Label',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group file']],
                ['div' => ['class' => 'custom-file ']],
                    ['input' => [
                        'type' => 'file',
                        'name' => 'file',
                        'id' => 'file',
                        'class' => 'custom-file-input',
                    ]],
                    ['label' => ['class' => 'custom-file-label', 'for' => 'file']],
                        'Custom Label',
                    '/label',
                 '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomFileControlWithCustomLabelOptions()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('file', [
            'type' => 'file',
            'custom' => true,
            'label' => [
                'class' => 'custom-label-class',
                'foo' => 'bar',
                'text' => 'Custom Label',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'form-group file']],
                ['div' => ['class' => 'custom-file ']],
                    ['input' => [
                        'type' => 'file',
                        'name' => 'file',
                        'id' => 'file',
                        'class' => 'custom-file-input',
                    ]],
                    ['label' => ['class' => 'custom-label-class custom-file-label', 'foo' => 'bar', 'for' => 'file']],
                        'Custom Label',
                    '/label',
                 '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * Inline custom file control label templates are not backwards compatible,
     * they will produce a duplicate `class` attribute.
     */
    public function testInlineAlignCustomFileControlWithCustomLabelTemplateIsBackwardsCompatible()
    {
        $this->markTestIncomplete('Inline custom file control label templates are not backwards compatible');

        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('file', [
            'type' => 'file',
            'custom' => true,
            'templates' => [
                'customFileLabel' =>
                    '<label class="custom-file-label"{{attrs}} back="compat">{{text}}{{tooltip}}</label>',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'form-group file']],
                ['div' => ['class' => 'custom-file ']],
                    ['input' => [
                        'type' => 'file',
                        'name' => 'file',
                        'id' => 'file',
                        'class' => 'custom-file-input',
                    ]],
                    ['label' => ['class' => 'custom-file-label', 'for' => 'file', 'back' => 'compact']],
                        'File',
                    '/label',
                 '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomFileControlWithHelp()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('file', [
            'type' => 'file',
            'custom' => true,
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group file']],
                ['div' => ['class' => 'custom-file ']],
                    ['input' => [
                        'type' => 'file',
                        'name' => 'file',
                        'id' => 'file',
                        'class' => 'custom-file-input',
                    ]],
                    ['label' => ['class' => 'custom-file-label', 'for' => 'file']],
                        'File',
                    '/label',
                '/div',
                ['small' => ['class' => 'visually-hidden form-text text-muted']],
                    'Help text',
                '/small',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomFileControlWithHelpOptions()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('file', [
            'type' => 'file',
            'custom' => true,
            'help' => [
                'foo' => 'bar',
                'content' => 'Help text',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'form-group file']],
                ['div' => ['class' => 'custom-file ']],
                    ['input' => [
                        'type' => 'file',
                        'name' => 'file',
                        'id' => 'file',
                        'class' => 'custom-file-input',
                    ]],
                    ['label' => ['class' => 'custom-file-label', 'for' => 'file']],
                        'File',
                    '/label',
                '/div',
                ['small' => ['foo' => 'bar', 'class' => 'visually-hidden form-text text-muted']],
                    'Help text',
                '/small',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * Custom file controls should not render tooltips, as the label renders as an "input box".
     */
    public function testInlineAlignCustomFileControlWithTooltip()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('file', [
            'type' => 'file',
            'custom' => true,
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group file']],
                ['div' => ['class' => 'custom-file ']],
                    ['input' => [
                        'type' => 'file',
                        'name' => 'file',
                        'id' => 'file',
                        'class' => 'custom-file-input',
                    ]],
                    ['label' => ['class' => 'custom-file-label', 'for' => 'file']],
                        'File',
                    '/label',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomFileControlWithError()
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
            'custom' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group position-relative file is-invalid']],
                ['div' => ['class' => 'custom-file is-invalid']],
                    ['input' => [
                        'type' => 'file',
                        'name' => 'file',
                        'id' => 'file',
                        'class' => 'is-invalid custom-file-input',
                    ]],
                    ['label' => ['class' => 'custom-file-label', 'for' => 'file']],
                        'File',
                    '/label',
                '/div',
                ['div' => ['class' => 'invalid-tooltip']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomFileControlContainerOptions()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('file', [
            'type' => 'file',
            'custom' => true,
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            ['div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class form-group file',
            ]],
                ['div' => ['class' => 'custom-file ']],
                    ['input' => [
                        'type' => 'file',
                        'name' => 'file',
                        'id' => 'file',
                        'class' => 'custom-file-input',
                    ]],
                    ['label' => ['class' => 'custom-file-label', 'for' => 'file']],
                        'File',
                    '/label',
                 '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomFileControlContainerOptionsWithError()
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
            'custom' => true,
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            ['div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class form-group position-relative file is-invalid',
            ]],
                ['div' => ['class' => 'custom-file is-invalid']],
                    ['input' => [
                        'type' => 'file',
                        'name' => 'file',
                        'id' => 'file',
                        'class' => 'is-invalid custom-file-input',
                    ]],
                    ['label' => ['class' => 'custom-file-label', 'for' => 'file']],
                        'File',
                    '/label',
                '/div',
                ['div' => ['class' => 'invalid-tooltip']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomFileControlInputGroupAppend()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('file', [
            'type' => 'file',
            'custom' => true,
            'append' => 'append',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group file']],
                ['div' => ['class' => 'input-group']],
                    ['div' => ['class' => 'custom-file ']],
                        ['input' => [
                            'type' => 'file',
                            'name' => 'file',
                            'id' => 'file',
                            'class' => 'custom-file-input',
                        ]],
                        ['label' => ['class' => 'custom-file-label', 'for' => 'file']],
                            'File',
                        '/label',
                    '/div',
                    ['span' => ['class' => 'input-group-text']],
                        'append',
                    '/span',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomFileControlInputGroupPrepend()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('file', [
            'type' => 'file',
            'custom' => true,
            'prepend' => 'prepend',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group file']],
                ['div' => ['class' => 'input-group']],
                    ['span' => ['class' => 'input-group-text']],
                        'prepend',
                    '/span',
                    ['div' => ['class' => 'custom-file ']],
                        ['input' => [
                            'type' => 'file',
                            'name' => 'file',
                            'id' => 'file',
                            'class' => 'custom-file-input',
                        ]],
                        ['label' => ['class' => 'custom-file-label', 'for' => 'file']],
                            'File',
                        '/label',
                     '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignCustomFileControlInputGroupWithError()
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
            'custom' => true,
            'append' => 'append',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group position-relative file is-invalid']],
                ['div' => ['class' => 'input-group is-invalid']],
                    ['div' => ['class' => 'custom-file is-invalid']],
                        ['input' => [
                            'type' => 'file',
                            'name' => 'file',
                            'id' => 'file',
                            'class' => 'is-invalid custom-file-input',
                        ]],
                        ['label' => ['class' => 'custom-file-label', 'for' => 'file']],
                            'File',
                        '/label',
                    '/div',
                    ['span' => ['class' => 'input-group-text']],
                        'append',
                    '/span',
                '/div',
                ['div' => ['class' => 'invalid-tooltip']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
