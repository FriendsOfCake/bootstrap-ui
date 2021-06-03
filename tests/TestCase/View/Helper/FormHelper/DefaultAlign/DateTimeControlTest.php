<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\DefaultAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class DateTimeControlTest extends AbstractFormHelperTest
{
    public function testDefaultAlignDateTimeControl()
    {
        $this->Form->create($this->article);

        $now = new \DateTime('now');

        $result = $this->Form->control('created', [
            'type' => 'datetime-local',
            'value' => $now->format('Y-m-d H:i:s'),
        ]);

        $expected = [
            ['div' => ['class' => 'mb-3 form-group datetime-local']],
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

        $now = new \DateTime('now');

        $result = $this->Form->control('created', [
            'type' => 'datetime-local',
            'value' => $now->format('Y-m-d H:i:s'),
            'label' => false,
        ]);

        $expected = [
            ['div' => [
                'class' => 'mb-3 form-group datetime-local',
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

        $now = new \DateTime('now');

        $result = $this->Form->control('created', [
            'type' => 'datetime-local',
            'value' => $now->format('Y-m-d H:i:s'),
            'label' => 'Custom Label',
        ]);

        $expected = [
            ['div' => [
                'class' => 'mb-3 form-group datetime-local',
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
            ['div' => [
                'class' => 'mb-3 form-group datetime-local',
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

    public function testDefaultAlignDateTimeControlWithCustomLabelTemplateIsBackwardsCompatible()
    {
        $this->Form->create($this->article);

        $now = new \DateTime('now');

        $result = $this->Form->control('created', [
            'type' => 'datetime-local',
            'value' => $now->format('Y-m-d H:i:s'),
            'templates' => [
                'datetimeContainer' =>
                    '<div{{containerAttrs}} class="{{containerClass}}form-group {{type}}{{required}}" role="group" ' .
                        'aria-labelledby="{{groupId}}">{{content}}{{help}}</div>',
                'datetimeLabel' => '<label id="{{groupId}}" back="compat">{{text}}{{tooltip}}</label>',
            ],
        ]);

        $expected = [
            ['div' => [
                'class' => 'mb-3 form-group datetime-local',
                'role' => 'group',
                'aria-labelledby' => 'created-group-label',
            ]],
                ['label' => [
                    'id' => 'created-group-label',
                    'back' => 'compat',
                ]],
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
        $this->assertHtml($expected, $result, true);
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
            ['div' => ['class' => 'mb-3 form-group time']],
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
                ['small' => ['class' => 'd-block form-text text-muted']],
                    'Help text',
                '/small',
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
                'foo' => 'bar',
                'content' => 'Help text',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'mb-3 form-group time']],
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
                ['small' => ['foo' => 'bar', 'class' => 'd-block form-text text-muted']],
                    'Help text',
                '/small',
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
            ['div' => ['class' => 'mb-3 form-group time']],
                ['label' => ['class' => 'form-label', 'for' => 'created']],
                    'Created ',
                    'span' => [
                        'data-bs-toggle' => 'tooltip',
                        'title' => 'Tooltip text',
                        'class' => 'fas fa-info-circle',
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

    public function testDefaultAlignDateTimeControlWithError()
    {
        $this->article['errors'] = [
            'created' => ['error message'],
        ];
        $this->Form->create($this->article);

        $now = new \DateTime('now');

        $result = $this->Form->control('created', [
            'type' => 'datetime-local',
            'value' => $now->format('Y-m-d H:i:s'),
        ]);

        $expected = [
            ['div' => [
                'class' => 'mb-3 form-group datetime-local is-invalid',
            ]],
                ['label' => ['class' => 'form-label', 'for' => 'created']],
                    'Created',
                '/label',
                'input' => [
                    'type' => 'datetime-local',
                    'name' => 'created',
                    'id' => 'created',
                    'class' => 'is-invalid form-control',
                    'value' => $now->format('Y-m-d H:i:s'),
                ],
                ['div' => ['class' => 'invalid-feedback']],
                    'error message',
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignDateTimeControlContainerOptions()
    {
        $this->Form->create($this->article);

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
                'class' => 'container-class mb-3 form-group datetime-local',
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
                'class' => 'container-class mb-3 form-group datetime-local is-invalid',
            ]],
                ['label' => ['class' => 'form-label', 'for' => 'created']],
                    'Created',
                '/label',
                'input' => [
                    'type' => 'datetime-local',
                    'name' => 'created',
                    'id' => 'created',
                    'class' => 'is-invalid form-control',
                    'value' => $now->format('Y-m-d H:i:s'),
                ],
                ['div' => ['class' => 'invalid-feedback']],
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
            ['div' => ['class' => 'mb-3 form-group date']],
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
            ['div' => ['class' => 'mb-3 form-group time']],
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
        $this->assertStringContainsString('<div class="mb-3 form-group datetime">', $result);

        $result = $this->Form->control('created', [
            'type' => 'date',
        ]);
        $this->assertStringContainsString('<div class="mb-3 form-group date">', $result);

        $result = $this->Form->control('created', [
            'type' => 'time',
        ]);
        $this->assertStringContainsString('<div class="mb-3 form-group time">', $result);

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
        $this->assertStringContainsString('<div class="mb-3 form-group datetime is-invalid">', $result);

        $result = $this->Form->control('created', [
            'type' => 'date',
        ]);
        $this->assertStringContainsString('<div class="mb-3 form-group date is-invalid">', $result);

        $result = $this->Form->control('created', [
            'type' => 'time',
        ]);
        $this->assertStringContainsString('<div class="mb-3 form-group time is-invalid">', $result);

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
