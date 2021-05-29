<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\InlineAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class DateTimeControlTest extends AbstractFormHelperTest
{
    public function testInlineAlignDateTimeControl()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $now = new \DateTime('now');

        $result = $this->Form->control('created', [
            'type' => 'datetime-local',
            'value' => $now->format('Y-m-d H:i:s'),
        ]);
        $expected = [
            ['div' => ['class' => 'form-group position-relative datetime-local']],
                ['label' => ['class' => 'form-label visually-hidden', 'for' => 'created']],
                    'Created',
                '/label',
                'input' => [
                    'type' => 'datetime-local',
                    'name' => 'created',
                    'id' => 'created',
                    'class' => 'form-control',
                    'value' => $now->format('Y-m-d H:i:s'),
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignDateTimeControlWithDisabledLabel()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $now = new \DateTime('now');

        $result = $this->Form->control('created', [
            'type' => 'datetime-local',
            'value' => $now->format('Y-m-d H:i:s'),
            'label' => false,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group position-relative datetime-local']],
                'input' => [
                    'type' => 'datetime-local',
                    'name' => 'created',
                    'id' => 'created',
                    'class' => 'form-control',
                    'value' => $now->format('Y-m-d H:i:s'),
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignDateTimeControlWithCustomLabel()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $now = new \DateTime('now');

        $result = $this->Form->control('created', [
            'type' => 'datetime-local',
            'value' => $now->format('Y-m-d H:i:s'),
            'label' => 'Custom Label',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group position-relative datetime-local']],
                ['label' => ['class' => 'form-label visually-hidden', 'for' => 'created']],
                    'Custom Label',
                '/label',
                'input' => [
                    'type' => 'datetime-local',
                    'name' => 'created',
                    'id' => 'created',
                    'class' => 'form-control',
                    'value' => $now->format('Y-m-d H:i:s'),
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignDateTimeControlWithCustomLabelOptions()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $now = new \DateTime('now');

        $result = $this->Form->control('created', [
            'type' => 'datetime-local',
            'value' => $now->format('Y-m-d H:i:s'),
            'label' => [
                'class' => 'custom-label-class',
                'foo' => 'bar',
                'text' => 'Custom Label',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'form-group position-relative datetime-local']],
                ['label' => [
                    'class' => 'custom-label-class form-label visually-hidden',
                    'foo' => 'bar',
                    'for' => 'created',
                ]],
                    'Custom Label',
                '/label',
                'input' => [
                    'type' => 'datetime-local',
                    'name' => 'created',
                    'id' => 'created',
                    'class' => 'form-control',
                    'value' => $now->format('Y-m-d H:i:s'),
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignDateTimeControlWithCustomLabelTemplateIsBackwardsCompatible()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $now = new \DateTime('now');

        $result = $this->Form->control('created', [
            'type' => 'datetime-local',
            'value' => $now->format('Y-m-d H:i:s'),
            'templates' => [
                'datetimeContainer' =>
                    '<div{{containerAttrs}} ' .
                        'class="{{containerClass}}form-group {{formGroupPosition}}{{type}}{{required}}" ' .
                            'role="group" aria-labelledby="{{groupId}}">{{content}}{{help}}</div>',
                'datetimeLabel' => '<span id="{{groupId}}" class="visually-hidden" back="compat">{{text}}{{tooltip}}</span>',
            ],
        ]);
        $expected = [
            ['div' => [
                'class' => 'form-group position-relative datetime-local',
                'role' => 'group',
                'aria-labelledby' => 'created-group-label',
            ]],
                ['span' => [
                    'id' => 'created-group-label',
                    'class' => 'visually-hidden',
                    'back' => 'compat',
                ]],
                    'Created',
                '/span',
                'input' => [
                    'type' => 'datetime-local',
                    'name' => 'created',
                    'id' => 'created',
                    'class' => 'form-control',
                    'value' => $now->format('Y-m-d H:i:s'),
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignDateTimeControlWithHelp()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $now = new \DateTime('now');

        $result = $this->Form->control('created', [
            'type' => 'datetime-local',
            'value' => $now->format('Y-m-d H:i:s'),
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group position-relative datetime-local']],
                ['label' => ['class' => 'form-label visually-hidden', 'for' => 'created']],
                    'Created',
                '/label',
                'input' => [
                    'type' => 'datetime-local',
                    'name' => 'created',
                    'id' => 'created',
                    'class' => 'form-control',
                    'value' => $now->format('Y-m-d H:i:s'),
                ],
                ['small' => ['class' => 'visually-hidden form-text text-muted']],
                    'Help text',
                '/small',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignDateTimeControlWithHelpOptions()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $now = new \DateTime('now');

        $result = $this->Form->control('created', [
            'type' => 'datetime-local',
            'value' => $now->format('Y-m-d H:i:s'),
            'help' => [
                'foo' => 'bar',
                'content' => 'Help text',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'form-group position-relative datetime-local']],
                ['label' => ['class' => 'form-label visually-hidden', 'for' => 'created']],
                    'Created',
                '/label',
                'input' => [
                    'type' => 'datetime-local',
                    'name' => 'created',
                    'id' => 'created',
                    'class' => 'form-control',
                    'value' => $now->format('Y-m-d H:i:s'),
                ],
                ['small' => ['foo' => 'bar', 'class' => 'visually-hidden form-text text-muted']],
                    'Help text',
                '/small',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignDateTimeControlWithTooltip()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $now = new \DateTime('now');

        $result = $this->Form->control('created', [
            'type' => 'datetime-local',
            'value' => $now->format('Y-m-d H:i:s'),
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'form-group position-relative datetime-local']],
                ['label' => ['class' => 'form-label visually-hidden', 'for' => 'created']],
                    'Created ',
                    'span' => [
                        'data-bs-toggle' => 'tooltip',
                        'title' => 'Tooltip text',
                        'class' => 'fas fa-info-circle',
                    ],
                    '/span',
                '/label',
                'input' => [
                    'type' => 'datetime-local',
                    'name' => 'created',
                    'id' => 'created',
                    'class' => 'form-control',
                    'value' => $now->format('Y-m-d H:i:s'),
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * Inline datetime controls currently do not render error messages.
     */
    public function testInlineAlignDateTimeControlWithError()
    {
        $this->withErrorReporting(0, function () {
            $this->article['errors'] = [
                'created' => ['error message'],
            ];
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $now = new \DateTime('now');

        $result = $this->Form->control('created', [
            'type' => 'datetime-local',
            'value' => $now->format('Y-m-d H:i:s'),
        ]);
        $expected = [
            ['div' => [
                'class' => 'form-group position-relative datetime-local is-invalid',
            ]],
                ['label' => ['class' => 'form-label visually-hidden', 'for' => 'created']],
                    'Created',
                '/label',
                'input' => [
                    'type' => 'datetime-local',
                    'name' => 'created',
                    'id' => 'created',
                    'class' => 'is-invalid form-control',
                    'value' => $now->format('Y-m-d H:i:s'),
                ],
                ['div' => ['class' => 'invalid-tooltip']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignDateTimeControlContainerOptions()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $now = new \DateTime('now');

        $result = $this->Form->control('created', [
            'type' => 'datetime-local',
            'value' => $now->format('Y-m-d H:i:s'),
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            ['div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class form-group position-relative datetime-local',
            ]],
                ['label' => ['class' => 'form-label visually-hidden', 'for' => 'created']],
                    'Created',
                '/label',
                'input' => [
                    'type' => 'datetime-local',
                    'name' => 'created',
                    'id' => 'created',
                    'class' => 'form-control',
                    'value' => $now->format('Y-m-d H:i:s'),
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * Inline datetime controls currently do not render error messages.
     */
    public function testInlineAlignDateTimeControlContainerOptionsWithError()
    {
        $this->withErrorReporting(0, function () {
            $this->article['errors'] = [
                'created' => ['error message'],
            ];
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $now = new \DateTime('now');

        $result = $this->Form->control('created', [
            'type' => 'datetime-local',
            'value' => $now->format('Y-m-d H:i:s'),
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            ['div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class form-group position-relative datetime-local is-invalid',
            ]],
                ['label' => ['class' => 'form-label visually-hidden', 'for' => 'created']],
                    'Created',
                '/label',
                'input' => [
                    'type' => 'datetime-local',
                    'name' => 'created',
                    'id' => 'created',
                    'class' => 'is-invalid form-control',
                    'value' => $now->format('Y-m-d H:i:s'),
                ],
                ['div' => ['class' => 'invalid-tooltip']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignDateTimeControlDate()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $now = time();

        $result = $this->Form->control('created', [
            'type' => 'date',
            'value' => $now,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group position-relative date']],
                ['label' => ['class' => 'form-label visually-hidden', 'for' => 'created']],
                    'Created',
                '/label',
                'input' => [
                    'type' => 'date',
                    'name' => 'created',
                    'id' => 'created',
                    'class' => 'form-control',
                    'value' => date('Y-m-d', $now),
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignDateTimeControlTime()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $now = time();

        $result = $this->Form->control('created', [
            'type' => 'time',
            'value' => $now,
        ]);
        $expected = [
            ['div' => ['class' => 'form-group position-relative time']],
                ['label' => ['class' => 'form-label visually-hidden', 'for' => 'created']],
                    'Created',
                '/label',
                'input' => [
                    'type' => 'time',
                    'name' => 'created',
                    'id' => 'created',
                    'class' => 'form-control',
                    'step' => '1',
                    'value' => date('H:i:s', $now),
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignDateTimeControlCustomContainerTemplateViaTemplater()
    {
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('created', [
            'type' => 'datetime',
        ]);
        $this->assertStringContainsString('<div class="form-group position-relative datetime">', $result);

        $result = $this->Form->control('created', [
            'type' => 'date',
        ]);
        $this->assertStringContainsString('<div class="form-group position-relative date">', $result);

        $result = $this->Form->control('created', [
            'type' => 'time',
        ]);
        $this->assertStringContainsString('<div class="form-group position-relative time">', $result);

        $this->Form->setTemplates([
            'datetimeContainer' => '<div class="custom datetimeContainer {{type}}{{required}}" role="group" aria-labelledby="{{groupId}}">{{content}}</div>',
            'dateContainer' => '<div class="custom dateContainer {{type}}{{required}}" role="group" aria-labelledby="{{groupId}}">{{content}}</div>',
            'timeContainer' => '<div class="custom timeContainer {{type}}{{required}}" role="group" aria-labelledby="{{groupId}}">{{content}}</div>',
        ]);
        $result = $this->Form->control('created', [
            'type' => 'datetime',
        ]);
        $this->assertStringContainsString('<div class="custom datetimeContainer datetime" role="group" aria-labelledby="created-group-label">', $result);

        $result = $this->Form->control('created', [
            'type' => 'date',
        ]);
        $this->assertStringContainsString('<div class="custom dateContainer date" role="group" aria-labelledby="created-group-label">', $result);

        $result = $this->Form->control('created', [
            'type' => 'time',
        ]);
        $this->assertStringContainsString('<div class="custom timeContainer time" role="group" aria-labelledby="created-group-label">', $result);
    }

    public function testInlineAlignDateTimeControlCustomContainerErrorTemplateViaOptions()
    {
        $this->article['errors'] = [
            'created' => [
                'foo' => 'bar',
            ],
        ];
        $this->withErrorReporting(0, function () {
            $this->Form->create($this->article, [
                'align' => 'inline',
            ]);
        });

        $result = $this->Form->control('created', [
            'type' => 'datetime',
        ]);
        $this->assertStringContainsString('<div class="form-group position-relative datetime is-invalid">', $result);

        $result = $this->Form->control('created', [
            'type' => 'date',
        ]);
        $this->assertStringContainsString('<div class="form-group position-relative date is-invalid">', $result);

        $result = $this->Form->control('created', [
            'type' => 'time',
        ]);
        $this->assertStringContainsString('<div class="form-group position-relative time is-invalid">', $result);

        $result = $this->Form->control('created', [
            'type' => 'datetime',
            'templates' => [
                'datetimeContainerError' => '<div class="custom datetimeContainerError {{type}}{{required}}" role="group" aria-labelledby="{{groupId}}">{{content}}</div>',
            ],
        ]);
        $this->assertStringContainsString('<div class="custom datetimeContainerError datetime" role="group" aria-labelledby="created-group-label">', $result);

        $result = $this->Form->control('created', [
            'type' => 'date',
            'templates' => [
                'dateContainerError' => '<div class="custom dateContainerError {{type}}{{required}}" role="group" aria-labelledby="{{groupId}}">{{content}}</div>',
            ],
        ]);
        $this->assertStringContainsString('<div class="custom dateContainerError date" role="group" aria-labelledby="created-group-label">', $result);

        $result = $this->Form->control('created', [
            'type' => 'time',
            'templates' => [
                'timeContainerError' => '<div class="custom timeContainerError {{type}}{{required}}" role="group" aria-labelledby="{{groupId}}">{{content}}</div>',
            ],
        ]);
        $this->assertStringContainsString('<div class="custom timeContainerError time" role="group" aria-labelledby="created-group-label">', $result);
    }
}
