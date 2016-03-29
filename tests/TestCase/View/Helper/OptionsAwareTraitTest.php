<?php

namespace BootstrapUI\Test\TestCase\View\Helper;

use BootstrapUI\View\Helper\OptionsAwareTrait;
use Cake\TestSuite\TestCase;

/**
 * TestOptionsAware
 */
class TestOptionsAware
{

    use OptionsAwareTrait;
}

/**
 * OptionsAwareTraitTest
 */
class OptionsAwareTraitTest extends TestCase
{
    /**
     * @var OptionsAwareTrait
     */
    public $object;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->object = new TestOptionsAware();
    }

    public function testApplyButtonStyles()
    {
        $this->assertEquals(['class' => 'btn btn-default'], $this->object->applyButtonClasses([]));
        foreach (['default', 'success', 'warning', 'danger', 'info', 'primary'] as $style) {
            $this->assertEquals(['class' => "btn-{$style} btn"], $this->object->applyButtonClasses(['class' => $style]));
            $this->assertEquals(['class' => "btn-{$style} btn"], $this->object->applyButtonClasses(['class' => "btn-$style"]));
        }
    }

    public function testRenameClasses()
    {
        $this->assertEquals(['class' => ''], $this->object->renameClasses(['a' => 'b'], []));
        $this->assertEquals(['class' => 'b'], $this->object->renameClasses(['a' => 'b'], ['class' => 'a']));
        $this->assertEquals(['class' => 'b'], $this->object->renameClasses(['a' => 'b', 'c' => 'd'], ['class' => 'a']));
    }

    public function testHasAnyClass()
    {
        $this->assertFalse($this->object->hasAnyClass('a', []));
        $this->assertFalse($this->object->hasAnyClass('a', ['class' => 'x y z']));

        $this->assertTrue($this->object->hasAnyClass('a', ['class' => 'a b c']));
        $this->assertTrue($this->object->hasAnyClass('a w', ['class' => 'x y z a b c']));
    }

    public function testInjectClasses()
    {
        $this->assertEquals(['class' => 'a'], $this->object->injectClasses('a', []));
        $this->assertEquals(['class' => 'a b c'], $this->object->injectClasses('a b c', []));
        $this->assertEquals(['class' => 'x y z a'], $this->object->injectClasses('a', ['class' => 'x y z']));
        $this->assertEquals(['class' => 'x y z a'], $this->object->injectClasses('a', ['class' => ['x', 'y', 'z']]));
        $this->assertEquals(['class' => 'x y z a b c'], $this->object->injectClasses('a b c', ['class' => 'x y z']));
    }

    public function testOverlappingInjectClasses()
    {
        $this->assertEquals(['class' => 'a b c x y z'], $this->object->injectClasses('a b c', ['class' => 'a b c x y z']));
        $this->assertEquals(['class' => 'a b c x y z'], $this->object->injectClasses('a', ['class' => 'a b c x y z']));
        $this->assertEquals(['class' => 'a c x y z b'], $this->object->injectClasses('a b c', ['class' => 'a c x y z']));
    }

    public function testSkippingInjectClasses()
    {
        $this->assertEquals(['class' => 'x y z a c'], $this->object->injectClasses('a b c', ['class' => 'x y z', 'skip' => 'b']));
        $this->assertEquals(['class' => 'x y z a b c'], $this->object->injectClasses('a b c', ['class' => 'x y z', 'skip' => 'm']));
    }

    public function testCheckClasses()
    {
        foreach (['a', 'a b c', ['a'], ['a', 'b', 'c']] as $class) {
            $this->assertFalse($this->object->checkClasses($class, []));
            $this->assertFalse($this->object->checkClasses($class, ['class' => 'x y z']));
            $this->assertFalse($this->object->checkClasses($class, ['class' => ['x', 'y', 'z']]));
        }

        $this->assertTrue($this->object->checkClasses('a', ['class' => 'a']));
        $this->assertTrue($this->object->checkClasses('a b c', ['class' => 'c b a']));
        $this->assertTrue($this->object->checkClasses('a b c', ['class' => ['c', 'b', 'a']]));
    }
}
