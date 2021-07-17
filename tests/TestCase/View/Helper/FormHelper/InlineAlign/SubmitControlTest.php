<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\InlineAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class SubmitControlTest extends AbstractFormHelperTest
{
    public function testInlineAlignSubmit()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->submit('Submit');
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => ['class' => 'submit'],
                    'input' => [
                        'type' => 'submit',
                        'value' => 'Submit',
                        'class' => 'btn-primary btn',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testInlineAlignSubmitContainerOptions()
    {
        $this->Form->create($this->article, [
            'align' => 'inline',
        ]);

        $result = $this->Form->submit('Submit', [
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            ['div' => ['class' => 'col-auto']],
                'div' => [
                    'attribute' => 'container-attribute',
                    'class' => 'container-class submit',
                ],
                    'input' => [
                        'type' => 'submit',
                        'value' => 'Submit',
                        'class' => 'btn-primary btn',
                    ],
                '/div',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
