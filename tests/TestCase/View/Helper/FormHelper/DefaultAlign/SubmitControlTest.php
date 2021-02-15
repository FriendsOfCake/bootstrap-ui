<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\DefaultAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class SubmitControlTest extends AbstractFormHelperTest
{
    public function testDefaultAlignSubmit()
    {
        $this->Form->create($this->article);

        $result = $this->Form->submit('Submit');
        $expected = [
            'div' => ['class' => 'submit'],
                'input' => [
                    'type' => 'submit',
                    'value' => 'Submit',
                    'class' => 'btn-primary btn',
                ],
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testDefaultAlignSubmitContainerOptions()
    {
        $this->Form->create($this->article);

        $result = $this->Form->submit('Submit', [
            'container' => [
                'class' => 'container-class',
                'attribute' => 'container-attribute',
            ],
        ]);
        $expected = [
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
        ];
        $this->assertHtml($expected, $result);
    }
}
