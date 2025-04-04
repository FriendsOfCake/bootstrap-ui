<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\DefaultAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;
use DateTime;

class DateTimeControlTest extends AbstractFormHelperTest
{
    public function testDefaultAlignDateTimeControl()
    {
        $this->Form->create($this->article);

        $now = new DateTime('now');

        $result = $this->Form->control('created', [
            'type' => 'datetime-local',
            'value' => $now->format('Y-m-d H:i:s'),
        ]);

        $expected = [
            ['div' => ['class' => 'mb-3 datetime-local']],
                ['label' => ['class' => 'form-label', 'for' => 'created']],
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

    public function testDefaultAlignDateTimeControlWithDisabledLabel()
    {
        $this->Form->create($this->article);

        $now = new DateTime('now');

        $result = $this->Form->control('created', [
            'type' => 'datetime-local',
            'value' => $now->format('Y-m-d H:i:s'),
            'label' => false,
        ]);

        $expected = [
            ['div' => [
                'class' => 'mb-3 datetime-local',
            ]],
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

    public function testDefaultAlignDateTimeControlWithCustomLabel()
    {
        $this->Form->create($this->article);

        $now = new DateTime('now');

        $result = $this->Form->control('created', [
            'type' => 'datetime-local',
            'value' => $now->format('Y-m-d H:i:s'),
            'label' => 'Custom Label',
        ]);

        $expected = [
            ['div' => [
                'class' => 'mb-3 datetime-local',
            ]],
                ['label' => ['class' => 'form-label', 'for' => 'created']],
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

    public function testDefaultAlignDateTimeControlWithCustomLabelOptions()
    {
        $this->Form->create($this->article);

        $now = new DateTime('now');

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
            ['div' => [
                'class' => 'mb-3 datetime-local',
            ]],
                ['label' => [
                    'class' => 'custom-label-class form-label',
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

    public function testDefaultAlignDateTimeControlWithHelp()
    {
        $this->Form->create($this->article);

        $now = time();

        $result = $this->Form->control('created', [
            'type' => 'time',
            'value' => $now,
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 time']],
                ['label' => ['class' => 'form-label', 'for' => 'created']],
                    'Created',
                '/label',
                'input' => [
                    'type' => 'time',
                    'name' => 'created',
                    'id' => 'created',
                    'class' => 'form-control',
                    'aria-describedby' => 'created-help',
                    'step' => '1',
                    'value' => date('H:i:s', $now),
                ],
                ['div' => ['id' => 'created-help', 'class' => 'form-text']],
                    'Help text',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignDateTimeControlWithHelpOptions()
    {
        $this->Form->create($this->article);

        $now = time();

        $result = $this->Form->control('created', [
            'type' => 'time',
            'value' => $now,
            'help' => [
                'id' => 'custom-help',
                'foo' => 'bar',
                'class' => 'help-class',
                'content' => 'Help text',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 time']],
                ['label' => ['class' => 'form-label', 'for' => 'created']],
                    'Created',
                '/label',
                'input' => [
                    'type' => 'time',
                    'name' => 'created',
                    'id' => 'created',
                    'class' => 'form-control',
                    'aria-describedby' => 'custom-help',
                    'step' => '1',
                    'value' => date('H:i:s', $now),
                ],
                ['div' => [
                    'id' => 'custom-help',
                    'foo' => 'bar',
                    'class' => 'help-class form-text',
                ]],
                    'Help text',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignDateTimeControlWithTooltip()
    {
        $this->Form->create($this->article);

        $now = time();

        $result = $this->Form->control('created', [
            'type' => 'time',
            'value' => $now,
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 time']],
                ['label' => ['class' => 'form-label', 'for' => 'created']],
                    'Created ',
                    'span' => [
                        'data-bs-toggle' => 'tooltip',
                        'title' => 'Tooltip text',
                        'class' => 'bi bi-info-circle-fill',
                    ],
                    '/span',
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

    public function testDefaultAlignDateTimeControlWithCustomSpacing()
    {
        $this->Form->create($this->article);

        $now = new DateTime('now');

        $result = $this->Form->control('created', [
            'type' => 'datetime-local',
            'value' => $now->format('Y-m-d H:i:s'),
            'spacing' => 'custom-spacing',
        ]);

        $expected = [
            ['div' => ['class' => 'custom-spacing datetime-local']],
            ['label' => ['class' => 'form-label', 'for' => 'created']],
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

    public function testDefaultAlignDateTimeControlWithError()
    {
        $this->article['errors'] = [
            'created' => ['error message'],
        ];
        $this->Form->create($this->article);

        $now = new DateTime('now');

        $result = $this->Form->control('created', [
            'type' => 'datetime-local',
            'value' => $now->format('Y-m-d H:i:s'),
        ]);

        $expected = [
            ['div' => [
                'class' => 'mb-3 datetime-local is-invalid',
            ]],
                ['label' => ['class' => 'form-label', 'for' => 'created']],
                    'Created',
                '/label',
                'input' => [
                    'type' => 'datetime-local',
                    'name' => 'created',
                    'id' => 'created',
                    'aria-invalid' => 'true',
                    'class' => 'is-invalid form-control',
                    'aria-invalid' => 'true',
                    'aria-describedby' => 'created-error',
                    'value' => $now->format('Y-m-d H:i:s'),
                ],
                ['div' => ['id' => 'created-error', 'class' => 'invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignDateTimeControlWithErrorAndHelp()
    {
        $this->article['errors'] = [
            'created' => ['error message'],
        ];
        $this->Form->create($this->article);

        $now = new DateTime('now');

        $result = $this->Form->control('created', [
            'type' => 'datetime-local',
            'value' => $now->format('Y-m-d H:i:s'),
            'help' => 'Help text',
        ]);

        $expected = [
            ['div' => [
                'class' => 'mb-3 datetime-local is-invalid',
            ]],
                ['label' => ['class' => 'form-label', 'for' => 'created']],
                    'Created',
                '/label',
                'input' => [
                    'type' => 'datetime-local',
                    'name' => 'created',
                    'id' => 'created',
                    'class' => 'is-invalid form-control',
                    'aria-invalid' => 'true',
                    'aria-describedby' => 'created-error created-help',
                    'value' => $now->format('Y-m-d H:i:s'),
                ],
                ['div' => ['id' => 'created-error', 'class' => 'invalid-feedback']],
                    'error message',
                '/div',
                ['div' => ['id' => 'created-help', 'class' => 'form-text']],
                    'Help text',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignDateTimeControlWithErrorAndHelpOptions()
    {
        $this->article['errors'] = [
            'created' => ['error message'],
        ];
        $this->Form->create($this->article);

        $now = new DateTime('now');

        $result = $this->Form->control('created', [
            'type' => 'datetime-local',
            'value' => $now->format('Y-m-d H:i:s'),
            'help' => [
                'id' => 'custom-help',
                'foo' => 'bar',
                'class' => 'help-class',
                'content' => 'Help text',
            ],
        ]);

        $expected = [
            ['div' => [
                'class' => 'mb-3 datetime-local is-invalid',
            ]],
                ['label' => ['class' => 'form-label', 'for' => 'created']],
                    'Created',
                '/label',
                'input' => [
                    'type' => 'datetime-local',
                    'name' => 'created',
                    'id' => 'created',
                    'class' => 'is-invalid form-control',
                    'aria-invalid' => 'true',
                    'aria-describedby' => 'created-error custom-help',
                    'value' => $now->format('Y-m-d H:i:s'),
                ],
                ['div' => ['id' => 'created-error', 'class' => 'invalid-feedback']],
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
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignDateTimeControlContainerOptions()
    {
        $this->Form->create($this->article);

        $now = new DateTime('now');

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
                'class' => 'container-class mb-3 datetime-local',
            ]],
                ['label' => ['class' => 'form-label', 'for' => 'created']],
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

    public function testDefaultAlignDateTimeControlContainerOptionsWithError()
    {
        $this->article['errors'] = [
            'created' => ['error message'],
        ];
        $this->Form->create($this->article);

        $now = new DateTime('now');

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
                'class' => 'container-class mb-3 datetime-local is-invalid',
            ]],
                ['label' => ['class' => 'form-label', 'for' => 'created']],
                    'Created',
                '/label',
                'input' => [
                    'type' => 'datetime-local',
                    'name' => 'created',
                    'id' => 'created',
                    'aria-invalid' => 'true',
                    'class' => 'is-invalid form-control',
                    'aria-invalid' => 'true',
                    'aria-describedby' => 'created-error',
                    'value' => $now->format('Y-m-d H:i:s'),
                ],
                ['div' => ['id' => 'created-error', 'class' => 'invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignDateTimeControlDate()
    {
        $this->Form->create($this->article);

        $now = time();

        $result = $this->Form->control('created', [
            'type' => 'date',
            'value' => $now,
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 date']],
                ['label' => ['class' => 'form-label', 'for' => 'created']],
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

    public function testDefaultAlignDateTimeControlTime()
    {
        $this->Form->create($this->article);

        $now = time();

        $result = $this->Form->control('created', [
            'type' => 'time',
            'value' => $now,
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 time']],
                ['label' => ['class' => 'form-label', 'for' => 'created']],
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

    public function testDefaultAlignDateTimeControlCustomContainerTemplateViaTemplater()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('created', [
            'type' => 'datetime',
        ]);
        $this->assertStringContainsString('<div class="mb-3 datetime">', $result);

        $result = $this->Form->control('created', [
            'type' => 'date',
        ]);
        $this->assertStringContainsString('<div class="mb-3 date">', $result);

        $result = $this->Form->control('created', [
            'type' => 'time',
        ]);
        $this->assertStringContainsString('<div class="mb-3 time">', $result);

        $this->Form->setTemplates([
            'datetimeContainer' => '<div class="custom datetimeContainer {{type}}{{required}}">{{content}}</div>',
            'dateContainer' => '<div class="custom dateContainer {{type}}{{required}}">{{content}}</div>',
            'timeContainer' => '<div class="custom timeContainer {{type}}{{required}}">{{content}}</div>',
        ]);
        $result = $this->Form->control('created', [
            'type' => 'datetime',
        ]);
        $this->assertStringContainsString('<div class="custom datetimeContainer datetime">', $result);

        $result = $this->Form->control('created', [
            'type' => 'date',
        ]);
        $this->assertStringContainsString('<div class="custom dateContainer date">', $result);

        $result = $this->Form->control('created', [
            'type' => 'time',
        ]);
        $this->assertStringContainsString('<div class="custom timeContainer time">', $result);
    }

    public function testDefaultAlignDateTimeControlCustomContainerErrorTemplateViaOptions()
    {
        $this->article['errors'] = [
            'created' => [
                'foo' => 'bar',
            ],
        ];
        $this->Form->create($this->article);

        $result = $this->Form->control('created', [
            'type' => 'datetime',
        ]);
        $this->assertStringContainsString('<div class="mb-3 datetime is-invalid">', $result);

        $result = $this->Form->control('created', [
            'type' => 'date',
        ]);
        $this->assertStringContainsString('<div class="mb-3 date is-invalid">', $result);

        $result = $this->Form->control('created', [
            'type' => 'time',
        ]);
        $this->assertStringContainsString('<div class="mb-3 time is-invalid">', $result);

        $result = $this->Form->control('created', [
            'type' => 'datetime',
            'templates' => [
                'datetimeContainerError' => '<div class="custom datetimeContainerError {{type}}{{required}}">{{content}}</div>',
            ],
        ]);
        $this->assertStringContainsString('<div class="custom datetimeContainerError datetime">', $result);

        $result = $this->Form->control('created', [
            'type' => 'date',
            'templates' => [
                'dateContainerError' => '<div class="custom dateContainerError {{type}}{{required}}">{{content}}</div>',
            ],
        ]);
        $this->assertStringContainsString('<div class="custom dateContainerError date">', $result);

        $result = $this->Form->control('created', [
            'type' => 'time',
            'templates' => [
                'timeContainerError' => '<div class="custom timeContainerError {{type}}{{required}}">{{content}}</div>',
            ],
        ]);
        $this->assertStringContainsString('<div class="custom timeContainerError time">', $result);
    }
}
