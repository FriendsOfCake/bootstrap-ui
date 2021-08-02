<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\DefaultAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class FileControlTest extends AbstractFormHelperTest
{
    public function testDefaultAlignFileControl()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('file', [
            'type' => 'file',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group file']],
                ['label' => ['class' => 'form-label', 'for' => 'file']],
                    'File',
                '/label',
                ['input' => [
                    'type' => 'file',
                    'name' => 'file',
                    'id' => 'file',
                    'class' => 'form-control',
                ]],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignFileControlWithDisabledLabel()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'label' => false,
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group file']],
                ['input' => [
                    'type' => 'file',
                    'name' => 'file',
                    'id' => 'file',
                    'class' => 'form-control',
                ]],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignFileControlWithCustomLabel()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'label' => 'Custom Label',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group file']],
                ['label' => ['class' => 'form-label', 'for' => 'file']],
                    'Custom Label',
                '/label',
                ['input' => [
                    'type' => 'file',
                    'name' => 'file',
                    'id' => 'file',
                    'class' => 'form-control',
                ]],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignFileControlWithCustomLabelOptions()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'label' => [
                'class' => 'custom-label-class',
                'foo' => 'bar',
                'text' => 'Custom Label',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group file']],
                ['label' => [
                    'class' => 'custom-label-class form-label',
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
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignFileControlWithHelp()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group file']],
                ['label' => ['class' => 'form-label', 'for' => 'file']],
                    'File',
                '/label',
                ['input' => [
                    'type' => 'file',
                    'name' => 'file',
                    'id' => 'file',
                    'class' => 'form-control',
                    'aria-describedby' => 'file-help',
                ]],
                ['small' => ['id' => 'file-help', 'class' => 'd-block form-text text-muted']],
                    'Help text',
                '/small',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignFileControlWithHelpOptions()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'help' => [
                'id' => 'custom-help',
                'foo' => 'bar',
                'class' => 'help-class',
                'content' => 'Help text',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group file']],
                ['label' => ['class' => 'form-label', 'for' => 'file']],
                    'File',
                '/label',
                ['input' => [
                    'type' => 'file',
                    'name' => 'file',
                    'id' => 'file',
                    'class' => 'form-control',
                    'aria-describedby' => 'custom-help',
                ]],
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

    public function testDefaultAlignFileControlWithTooltip()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group file']],
                ['label' => ['class' => 'form-label', 'for' => 'file']],
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
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignFileControlWithError()
    {
        $this->article['errors'] = [
            'file' => ['error message'],
        ];
        $this->Form->create($this->article);

        $result = $this->Form->control('file', [
            'type' => 'file',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group file is-invalid']],
                ['label' => ['class' => 'form-label', 'for' => 'file']],
                    'File',
                '/label',
                ['input' => [
                    'type' => 'file',
                    'name' => 'file',
                    'id' => 'file',
                    'class' => 'is-invalid form-control',
                ]],
                ['div' => ['class' => 'ms-0 invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignFileControlContainerOptions()
    {
        $this->Form->create($this->article);

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
                'class' => 'container-class mb-3 form-group file',
            ]],
                ['label' => ['class' => 'form-label', 'for' => 'file']],
                    'File',
                '/label',
                ['input' => [
                    'type' => 'file',
                    'name' => 'file',
                    'id' => 'file',
                    'class' => 'form-control',
                ]],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignFileControlContainerOptionsWithError()
    {
        $this->article['errors'] = [
            'file' => ['error message'],
        ];
        $this->Form->create($this->article);

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
                'class' => 'container-class mb-3 form-group file is-invalid',
            ]],
                ['label' => ['class' => 'form-label', 'for' => 'file']],
                    'File',
                '/label',
                ['input' => [
                    'type' => 'file',
                    'name' => 'file',
                    'id' => 'file',
                    'class' => 'is-invalid form-control',
                ]],
                ['div' => ['class' => 'ms-0 invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignFileControlInputGroupAppend()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'append' => 'append',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group file']],
                ['label' => ['class' => 'form-label', 'for' => 'file']],
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
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignFileControlInputGroupPrepend()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'prepend' => 'prepend',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group file']],
                ['label' => ['class' => 'form-label', 'for' => 'file']],
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
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignFileControlInputGroupWithError()
    {
        $this->article['errors'] = [
            'file' => ['error message'],
        ];
        $this->Form->create($this->article);

        $result = $this->Form->control('file', [
            'type' => 'file',
            'append' => 'append',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group file is-invalid']],
                ['label' => ['class' => 'form-label', 'for' => 'file']],
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
                ['div' => ['class' => 'ms-0 invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
