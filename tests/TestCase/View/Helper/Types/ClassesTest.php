<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\Types;

use BootstrapUI\View\Helper\Types\Classes;
use Cake\TestSuite\TestCase;

/**
 * ClassesTest
 */
class ClassesTest extends TestCase
{
    /**
     * Test get elements
     *
     * @return void
     */
    public function testGetElements()
    {
        $elements = Classes::values();
        $expected = [
            Classes::PRIMARY,
            Classes::SECONDARY,
            Classes::SUCCESS,
            Classes::DANGER,
            Classes::WARNING,
            Classes::INFO,
            Classes::LIGHT,
            Classes::DARK,
            Classes::LINK,
            Classes::SM,
            Classes::LG,
        ];
        $this->assertSame($expected, $elements);
    }
}
