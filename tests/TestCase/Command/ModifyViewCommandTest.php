<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\Command;

use Cake\Core\Plugin;
use Cake\TestSuite\ConsoleIntegrationTestTrait;
use Cake\TestSuite\TestCase;

class ModifyViewCommandTest extends TestCase
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

        if (file_exists(APP . 'View' . DS . 'AppView.php.backup')) {
            rename(
                APP . 'View' . DS . 'AppView.php.backup',
                APP . 'View' . DS . 'AppView.php'
            );
        }

        if (file_exists(APP . 'View' . DS . 'CustomAppView.php')) {
            unlink(APP . 'View' . DS . 'CustomAppView.php');
        }
    }

    public function testModifyView()
    {
        $comparisonsPath =
            Plugin::path('BootstrapUI') . 'tests' . DS . 'comparisons' . DS . 'Command' . DS . 'ModifyView' . DS;

        $filePath = APP . 'View' . DS . 'AppView.php';

        copy(
            $filePath,
            APP . 'View' . DS . 'AppView.php.backup'
        );
        copy(
            $comparisonsPath . 'AppView.skeleton.php',
            $filePath
        );

        $this->assertFileNotEquals(
            $comparisonsPath . 'AppView.bootstrap.php',
            $filePath
        );

        $this->exec('bootstrap modify_view');

        $this->assertEquals(
            [
                '<info>Modifying view...</info>',
                "<success>Modified `$filePath`.</success>",
            ],
            $this->_out->messages()
        );
        $this->assertErrorEmpty();

        $this->assertFileEquals(
            $comparisonsPath . 'AppView.bootstrap.php',
            $filePath
        );
    }

    public function testCustomFilePath()
    {
        $comparisonsPath =
            Plugin::path('BootstrapUI') . 'tests' . DS . 'comparisons' . DS . 'Command' . DS . 'ModifyView' . DS;

        $filePath = APP . 'View' . DS . 'CustomAppView.php';

        copy(
            $comparisonsPath . 'AppView.skeleton.php',
            $filePath
        );

        $this->assertFileNotEquals(
            $comparisonsPath . 'AppView.bootstrap.php',
            $filePath
        );

        $this->exec('bootstrap modify_view ' . escapeshellarg($filePath));

        $this->assertEquals(
            [
                '<info>Modifying view...</info>',
                "<success>Modified `$filePath`.</success>",
            ],
            $this->_out->messages()
        );
        $this->assertErrorEmpty();

        $this->assertFileEquals(
            $comparisonsPath . 'AppView.bootstrap.php',
            $filePath
        );
    }

    public function testHelp()
    {
        $filePath = APP . 'View' . DS . 'AppView.php';

        $this->exec('bootstrap modify_view --help');

        $this->assertEquals(
            ["Modifies `AppView.php` to extend this plugin's `UIView` class.

<info>Usage:</info>
cake bootstrap modify_view [-h] [-q] [-v] [<file>]

<info>Options:</info>

--help, -h     Display this help.
--quiet, -q    Enable quiet output.
--verbose, -v  Enable verbose output.

<info>Arguments:</info>

file  The path of the `AppView.php` file. Defaults to
      `$filePath`.
      <comment>(optional)</comment>

<warning>Don't run this command if you have a already modified the
`AppView` class!</warning>
"],
            $this->_out->messages()
        );
        $this->assertErrorEmpty();
    }
}
