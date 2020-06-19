<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\Command;

use Cake\TestSuite\ConsoleIntegrationTestTrait;
use Cake\TestSuite\TestCase;

class BootstrapCommandTest extends TestCase
{
    use ConsoleIntegrationTestTrait;

    public function setUp(): void
    {
        parent::setUp();

        $this->useCommandRunner();
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }

    public function testEntry()
    {
        $this->exec('bootstrap');

        $this->assertOutputEmpty();
        $this->assertEquals(
            ['<warning>No command provided. Run `bootstrap --help` to get a list of commands.</warning>'],
            $this->_err->messages()
        );
    }

    public function testHelp()
    {
        $this->exec('bootstrap --help');

        $this->assertEquals(
            [
                'The BootstrapUI console provides commands for installing dependencies
and samples, and for modifying your application to use BootstrapUI.',
                '',
                '<info>Available Commands:</info>',
                '',
                '- bootstrap install',
                '- bootstrap modify_view',
                '- bootstrap copy_layouts',
                '',
                'To run a command, type <info>`bootstrap command_name [args|options]`</info>',
                'To get help on a specific command, type <info>`bootstrap command_name --help`</info>',
                '',
            ],
            $this->_out->messages()
        );
        $this->assertErrorEmpty();
    }
}
