<?php
declare(strict_types=1);

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
     */
    public function testGetElements()
    {
        $elements = Element::values();
        $expected = [
            Element::ALERT,
            Element::BADGE,
            Element::BG,
            Element::TEXT_BG,
            Element::BORDER,
            Element::BTN,
            Element::BTN_OUTLINE,
            Element::LIST_GROUP_ITEM,
            Element::INPUT_GROUP,
        ];
        $this->assertSame($expected, $elements);
    }
}
