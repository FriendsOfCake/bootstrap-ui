<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\Command;

use BootstrapUI\Command\ModifyViewCommand;
use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\Exception\StopException;
use Cake\Core\Plugin;
use Cake\TestSuite\ConsoleIntegrationTestTrait;
use Cake\TestSuite\Stub\ConsoleOutput;
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

    public function testPathIsNotAFile()
    {
        /** @var \BootstrapUI\Command\ModifyViewCommand|\PHPUnit\Framework\MockObject\MockObject $command */
        $command = $this
            ->getMockBuilder(ModifyViewCommand::class)
            ->onlyMethods(['_isFile'])
            ->getMock();

        $command
            ->expects($this->once())
            ->method('_isFile')
            ->willReturn(false);

        $args = new Arguments([], [], []);

        $out = new ConsoleOutput();
        $err = new ConsoleOutput();
        $io = new ConsoleIo($out, $err);

        try {
            $result = $command->execute($args, $io);
        } catch (StopException $exception) {
            $result = $exception->getCode();
        }

        $filePath = APP . 'View' . DS . 'AppView.php';

        $this->assertEquals(Command::CODE_ERROR, $result);
        $this->assertEquals(
            ['<info>Modifying view...</info>'],
            $out->messages()
        );
        $this->assertEquals(
            ["<error>Could not modify `$filePath`.</error>"],
            $err->messages()
        );
    }

    public function testFileCannotBeRead()
    {
        /** @var \BootstrapUI\Command\ModifyViewCommand|\PHPUnit\Framework\MockObject\MockObject $command */
        $command = $this
            ->getMockBuilder(ModifyViewCommand::class)
            ->onlyMethods(['_readFile'])
            ->getMock();

        $command
            ->expects($this->once())
            ->method('_readFile')
            ->willReturn(false);

        $args = new Arguments([], [], []);

        $out = new ConsoleOutput();
        $err = new ConsoleOutput();
        $io = new ConsoleIo($out, $err);

        try {
            $result = $command->execute($args, $io);
        } catch (StopException $exception) {
            $result = $exception->getCode();
        }

        $filePath = APP . 'View' . DS . 'AppView.php';

        $this->assertEquals(Command::CODE_ERROR, $result);
        $this->assertEquals(
            ['<info>Modifying view...</info>'],
            $out->messages()
        );
        $this->assertEquals(
            ["<error>Could not modify `$filePath`.</error>"],
            $err->messages()
        );
    }

    public function testFileCannotBeWritten()
    {
        /** @var \BootstrapUI\Command\ModifyViewCommand|\PHPUnit\Framework\MockObject\MockObject $command */
        $command = $this
            ->getMockBuilder(ModifyViewCommand::class)
            ->onlyMethods(['_writeFile'])
            ->getMock();

        $command
            ->expects($this->once())
            ->method('_writeFile')
            ->willReturn(false);

        $args = new Arguments([], [], []);

        $out = new ConsoleOutput();
        $err = new ConsoleOutput();
        $io = new ConsoleIo($out, $err);

        try {
            $result = $command->execute($args, $io);
        } catch (StopException $exception) {
            $result = $exception->getCode();
        }

        $filePath = APP . 'View' . DS . 'AppView.php';

        $this->assertEquals(Command::CODE_ERROR, $result);
        $this->assertEquals(
            ['<info>Modifying view...</info>'],
            $out->messages()
        );
        $this->assertEquals(
            ["<error>Could not modify `$filePath`.</error>"],
            $err->messages()
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
