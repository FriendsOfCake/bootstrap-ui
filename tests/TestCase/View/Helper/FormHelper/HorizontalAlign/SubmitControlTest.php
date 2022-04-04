<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\HorizontalAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;
use BootstrapUI\View\Helper\FormHelper;

class SubmitControlTest extends AbstractFormHelperTest
{
    public function testHorizontalAlignSubmit()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->submit('Submit');
        $expected = [
            'div' => ['class' => 'form-group row'],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
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

    public function testHorizontalAlignSubmitContainerOptions()
    {
        $this->Form->create($this->article, [
            'align' => [
                'sm' => [
                    FormHelper::GRID_COLUMN_ONE => 5,
                    FormHelper::GRID_COLUMN_TWO => 7,
                ],
            ],
        ]);

        $result = $this->Form->submit('Submit', [
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
            'div' => [
                'attribute' => 'container-attribute',
                'class' => 'container-class form-group row',
            ],
                ['div' => ['class' => 'offset-sm-5 col-sm-7']],
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
