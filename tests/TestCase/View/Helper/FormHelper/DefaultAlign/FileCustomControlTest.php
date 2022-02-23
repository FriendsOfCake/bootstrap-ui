<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\DefaultAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class FileCustomControlTest extends AbstractFormHelperTest
{
    public function testDefaultAlignCustomFileControl()
    {
        $this->Form->create($this->article);

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

    public function testDefaultAlignCustomFileControlWithDisabledLabel()
    {
        $this->Form->create($this->article);

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

    public function testDefaultAlignCustomFileControlWithCustomLabel()
    {
        $this->Form->create($this->article);

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

    public function testDefaultAlignCustomFileControlWithCustomLabelOptions()
    {
        $this->Form->create($this->article);

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
                    ['label' => [
                        'class' => 'custom-label-class custom-file-label',
                        'foo' => 'bar',
                        'for' => 'file',
                    ]],
                        'Custom Label',
                    '/label',
                 '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * Custom file control label templates are not backwards compatible,
     * they will produce a duplicate `class` attribute.
     */
    public function testDefaultAlignCustomFileControlWithCustomLabelTemplateIsBackwardsCompatible()
    {
        $this->markTestIncomplete('Custom file control label templates are not backwards compatible');

        $this->Form->create($this->article);

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
        $this->assertHtml($expected, $result, true);
    }

    public function testDefaultAlignCustomFileControlWithHelp()
    {
        $this->Form->create($this->article);

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
                ['small' => ['class' => 'form-text text-muted']],
                    'Help text',
                '/small',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomFileControlWithHelpOptions()
    {
        $this->Form->create($this->article);

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
                ['small' => ['foo' => 'bar', 'class' => 'form-text text-muted']],
                    'Help text',
                '/small',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * Custom file controls should not render tooltips, as the label renders as an "input box".
     */
    public function testDefaultAlignCustomFileControlWithTooltip()
    {
        $this->Form->create($this->article);

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

    public function testDefaultAlignCustomFileControlWithError()
    {
        $this->article['errors'] = [
            'file' => ['error message'],
        ];
        $this->Form->create($this->article);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'custom' => true,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group file is-invalid']],
                ['div' => ['class' => 'custom-file is-invalid']],
                    ['input' => [
                        'type' => 'file',
                        'name' => 'file',
                        'id' => 'file',
                        'aria-invalid' => 'true',
                        'class' => 'is-invalid custom-file-input',
                    ]],
                    ['label' => ['class' => 'custom-file-label', 'for' => 'file']],
                        'File',
                    '/label',
                '/div',
                ['div' => ['class' => 'invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomFileControlContainerOptions()
    {
        $this->Form->create($this->article);

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

    public function testDefaultAlignCustomFileControlContainerOptionsWithError()
    {
        $this->article['errors'] = [
            'file' => ['error message'],
        ];
        $this->Form->create($this->article);

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
                'class' => 'container-class form-group file is-invalid',
            ]],
                ['div' => ['class' => 'custom-file is-invalid']],
                    ['input' => [
                        'type' => 'file',
                        'name' => 'file',
                        'id' => 'file',
                        'aria-invalid' => 'true',
                        'class' => 'is-invalid custom-file-input',
                    ]],
                    ['label' => ['class' => 'custom-file-label', 'for' => 'file']],
                        'File',
                    '/label',
                '/div',
                ['div' => ['class' => 'invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomFileControlInputGroupAppend()
    {
        $this->Form->create($this->article);

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
                    ['div' => ['class' => 'input-group-append']],
                        ['span' => ['class' => 'input-group-text']],
                            'append',
                        '/span',
                    '/div',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignCustomFileControlInputGroupPrepend()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'custom' => true,
            'prepend' => 'prepend',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group file']],
                ['div' => ['class' => 'input-group']],
                    ['div' => ['class' => 'input-group-prepend']],
                        ['span' => ['class' => 'input-group-text']],
                            'prepend',
                        '/span',
                    '/div',
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

    public function testDefaultAlignCustomFileControlInputGroupWithError()
    {
        $this->article['errors'] = [
            'file' => ['error message'],
        ];
        $this->Form->create($this->article);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'custom' => true,
            'append' => 'append',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group file is-invalid']],
                ['div' => ['class' => 'input-group is-invalid']],
                    ['div' => ['class' => 'custom-file is-invalid']],
                        ['input' => [
                            'type' => 'file',
                            'name' => 'file',
                            'id' => 'file',
                            'aria-invalid' => 'true',
                            'class' => 'is-invalid custom-file-input',
                        ]],
                        ['label' => ['class' => 'custom-file-label', 'for' => 'file']],
                            'File',
                        '/label',
                     '/div',
                    ['div' => ['class' => 'input-group-append']],
                        ['span' => ['class' => 'input-group-text']],
                            'append',
                        '/span',
                    '/div',
                '/div',
                ['div' => ['class' => 'invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
