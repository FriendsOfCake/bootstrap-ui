<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper\DefaultAlign;

use BootstrapUI\Test\TestCase\View\Helper\FormHelper\AbstractFormHelperTest;

class SelectControlTest extends AbstractFormHelperTest
{
    /**
     * testSelectControl method
     *
     * @return void
     */
    public function testSelectControl()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('foreign_key', [
            'type' => 'select',
            'class' => 'my-class',
        ]);
        $expected = [
            'div' => ['class' => 'form-group select'],
            'label' => ['for' => 'foreign-key'],
            'Foreign Key',
            '/label',
            'select' => [
                'name' => 'foreign_key',
                'id' => 'foreign-key',
                'class' => 'my-class form-control',
            ],
            '/select',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testSelectControlWithDisabledLabel()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('foreign_key', [
            'type' => 'select',
            'class' => 'my-class',
            'label' => false,
        ]);
        $expected = [
            'div' => ['class' => 'form-group select'],
                'select' => [
                    'name' => 'foreign_key',
                    'id' => 'foreign-key',
                    'class' => 'my-class form-control',
                ],
                '/select',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testSelectControlWithCustomLabel()
    {
        $this->Form->create($this->article);

        $result = $this->Form->control('foreign_key', [
            'type' => 'select',
            'class' => 'my-class',
            'label' => 'Custom Label',
        ]);
        $expected = [
            'div' => ['class' => 'form-group select'],
                'label' => ['for' => 'foreign-key'],
                    'Custom Label',
                '/label',
                'select' => [
                    'name' => 'foreign_key',
                    'id' => 'foreign-key',
                    'class' => 'my-class form-control',
                ],
                '/select',
            '/div',
        ];
        $this->assertHtml($expected, $result);
    }
}
