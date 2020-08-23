<?php
namespace BootstrapUI\TestSuite;

/**
 * Test case class.
 */
class TestCase extends \Cake\TestSuite\TestCase
{
    /**
     * Helper method for check deprecation methods
     *
     * @param callable $callable callable function that will receive asserts
     * @return void
     */
    public function deprecated($callable)
    {
        $errorLevel = error_reporting();
        error_reporting(E_ALL ^ E_USER_DEPRECATED);
        try {
            $callable();
        } finally {
            error_reporting($errorLevel);
        }
    }
}
