<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\HorizontalAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;
use BootstrapUI\View\Helper\FormHelper;
use DateTime;

class DateTimeControlTest extends AbstractFormHelperTest
{
    public function testHorizontalAlignDateTimeControl()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $now = new DateTime('now');

        $result = $this->Form->control('created', [
            'type' => 'datetime-local',
            'value' => $now->format('Y-m-d H:i:s'),
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 row datetime-local']],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'created']],
                    'Created',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    'input' => [
                        'type' => 'datetime-local',
                        'name' => 'created',
                        'id' => 'created',
                        'class' => 'form-control',
                        'value' => $now->format('Y-m-d H:i:s'),
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignDateTimeControlWithDisabledLabel()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $now = new DateTime('now');

        $result = $this->Form->control('created', [
            'type' => 'datetime-local',
            'value' => $now->format('Y-m-d H:i:s'),
            'label' => false,
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 row datetime-local']],
                ['div' => ['class' => 'col-sm-7']],
                    'input' => [
                        'type' => 'datetime-local',
                        'name' => 'created',
                        'id' => 'created',
                        'class' => 'form-control',
                        'value' => $now->format('Y-m-d H:i:s'),
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignDateTimeControlWithCustomLabel()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $now = new DateTime('now');

        $result = $this->Form->control('created', [
            'type' => 'datetime-local',
            'value' => $now->format('Y-m-d H:i:s'),
            'label' => 'Custom Label',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 row datetime-local']],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'created']],
                    'Custom Label',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    'input' => [
                        'type' => 'datetime-local',
                        'name' => 'created',
                        'id' => 'created',
                        'class' => 'form-control',
                        'value' => $now->format('Y-m-d H:i:s'),
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignDateTimeControlWithCustomLabelOptions()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

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
            ['div' => ['class' => 'mb-3 row datetime-local']],
                ['label' => ['class' => 'custom-label-class col-form-label col-sm-5', 'foo' => 'bar', 'for' => 'created']],
                    'Custom Label',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    'input' => [
                        'type' => 'datetime-local',
                        'name' => 'created',
                        'id' => 'created',
                        'class' => 'form-control',
                        'value' => $now->format('Y-m-d H:i:s'),
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignDateTimeControlWithHelp()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $now = time();

        $result = $this->Form->control('created', [
            'type' => 'time',
            'value' => $now,
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 row time']],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'created']],
                    'Created',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignDateTimeControlWithHelpOptions()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

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
            ['div' => ['class' => 'mb-3 row time']],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'created']],
                    'Created',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignDateTimeControlWithTooltip()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $now = time();

        $result = $this->Form->control('created', [
            'type' => 'time',
            'value' => $now,
            'tooltip' => 'Tooltip text',
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 row time']],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'created']],
                    'Created ',
                    'span' => [
                        'data-bs-toggle' => 'tooltip',
                        'title' => 'Tooltip text',
                        'class' => 'bi bi-info-circle-fill',
                    ],
                    '/span',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                'input' => [
                    'type' => 'time',
                    'name' => 'created',
                    'id' => 'created',
                    'class' => 'form-control',
                    'step' => '1',
                    'value' => date('H:i:s', $now),
                ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignDateTimeControlWithCustomSpacing()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $now = new DateTime('now');

        $result = $this->Form->control('created', [
            'type' => 'datetime-local',
            'value' => $now->format('Y-m-d H:i:s'),
            'spacing' => 'custom-spacing',
        ]);
        $expected = [
            ['div' => ['class' => 'custom-spacing row datetime-local']],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'created']],
                    'Created',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    'input' => [
                        'type' => 'datetime-local',
                        'name' => 'created',
                        'id' => 'created',
                        'class' => 'form-control',
                        'value' => $now->format('Y-m-d H:i:s'),
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignDateTimeControlWithError()
    {
        $this->article['errors'] = [
            'created' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $now = new DateTime('now');

        $result = $this->Form->control('created', [
            'type' => 'datetime-local',
            'value' => $now->format('Y-m-d H:i:s'),
        ]);
        $expected = [
            ['div' => [
                'class' => 'mb-3 row datetime-local is-invalid',
            ]],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'created']],
                    'Created',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignDateTimeControlWithErrorAndHelp()
    {
        $this->article['errors'] = [
            'created' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $now = new DateTime('now');

        $result = $this->Form->control('created', [
            'type' => 'datetime-local',
            'value' => $now->format('Y-m-d H:i:s'),
            'help' => 'Help text',
        ]);
        $expected = [
            ['div' => [
                'class' => 'mb-3 row datetime-local is-invalid',
            ]],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'created']],
                    'Created',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignDateTimeControlWithErrorAndHelpOptions()
    {
        $this->article['errors'] = [
            'created' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

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
                'class' => 'mb-3 row datetime-local is-invalid',
            ]],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'created']],
                    'Created',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignDateTimeControlContainerOptions()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

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
                'class' => 'container-class mb-3 row datetime-local',
            ]],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'created']],
                    'Created',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                    'input' => [
                        'type' => 'datetime-local',
                        'name' => 'created',
                        'id' => 'created',
                        'class' => 'form-control',
                        'value' => $now->format('Y-m-d H:i:s'),
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignDateTimeControlContainerOptionsWithError()
    {
        $this->article['errors'] = [
            'created' => ['error message'],
        ];
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

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
                'class' => 'container-class mb-3 row datetime-local is-invalid',
            ]],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'created']],
                    'Created',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
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
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignDateTimeControlDate()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $now = time();

        $result = $this->Form->control('created', [
            'type' => 'date',
            'value' => $now,
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 row date']],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'created']],
                    'Created',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                'input' => [
                    'type' => 'date',
                    'name' => 'created',
                    'id' => 'created',
                    'class' => 'form-control',
                    'value' => date('Y-m-d', $now),
                ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignDateTimeControlTime()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $now = time();

        $result = $this->Form->control('created', [
            'type' => 'time',
            'value' => $now,
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 row time']],
                ['label' => ['class' => 'col-form-label col-sm-5', 'for' => 'created']],
                    'Created',
                '/label',
                ['div' => ['class' => 'col-sm-7']],
                'input' => [
                    'type' => 'time',
                    'name' => 'created',
                    'id' => 'created',
                    'class' => 'form-control',
                    'step' => '1',
                    'value' => date('H:i:s', $now),
                ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testHorizontalAlignDateTimeControlCustomContainerTemplateViaTemplater()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('created', [
            'type' => 'datetime',
        ]);
        $this->assertStringContainsString('<div class="mb-3 row datetime">', $result);

        $result = $this->Form->control('created', [
            'type' => 'date',
        ]);
        $this->assertStringContainsString('<div class="mb-3 row date">', $result);

        $result = $this->Form->control('created', [
            'type' => 'time',
        ]);
        $this->assertStringContainsString('<div class="mb-3 row time">', $result);

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

    public function testHorizontalAlignDateTimeControlCustomContainerErrorTemplateViaOptions()
    {
        $this->article['errors'] = [
            'created' => [
                'foo' => 'bar',
            ],
        ];
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->control('created', [
            'type' => 'datetime',
        ]);
        $this->assertStringContainsString('<div class="mb-3 row datetime is-invalid">', $result);

        $result = $this->Form->control('created', [
            'type' => 'date',
        ]);
        $this->assertStringContainsString('<div class="mb-3 row date is-invalid">', $result);

        $result = $this->Form->control('created', [
            'type' => 'time',
        ]);
        $this->assertStringContainsString('<div class="mb-3 row time is-invalid">', $result);

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
