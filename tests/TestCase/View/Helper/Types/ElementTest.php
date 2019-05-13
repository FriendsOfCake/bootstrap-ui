<?php

namespace BootstrapUI\Test\TestCase\View\Helper\Types;

use BootstrapUI\View\Helper\Types\Element;
use Cake\TestSuite\TestCase;

/**
 * ElementTest
 */
class ElementTest extends TestCase
{
    /**
     * Test get elements
     *
     * @return void
     *
     * @covers \BootstrapUI\View\Helper\Types\Element::values
     */
    public function testGetElements()
    {
        $elements = Element::values();
        $expected = [
            Element::ALERT,
            Element::BADGE,
            Element::BG,
            Element::BORDER,
            Element::BTN,
            Element::BTN_OUTLINE,
            Element::LIST_GROUP_ITEM,
            Element::INPUT_GROUP,
        ];
        $this->assertSame($expected, $elements);
    }
}
