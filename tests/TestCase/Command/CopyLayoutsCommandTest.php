<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\Command;

use BootstrapUI\Command\CopyLayoutsCommand;
use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\Exception\StopException;
use Cake\Core\Plugin;
use Cake\Filesystem\Filesystem;
use Cake\TestSuite\ConsoleIntegrationTestTrait;
use Cake\TestSuite\Stub\ConsoleOutput;
use Cake\TestSuite\TestCase;

class CopyLayoutsCommandTest extends TestCase
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

        $filesystem = new Filesystem();

        $targetPath =
            Plugin::path('BootstrapUI') . 'tests' . DS . 'test_app' . DS .
            'templates' . DS . 'layout' . DS . 'TwitterBootstrap' . DS;

        $filesystem->deleteDir($targetPath);

        $customTargetPath =
            Plugin::path('BootstrapUI') . 'tests' . DS . 'test_app' . DS .
            'templates' . DS . 'layout' . DS . 'CustomPath' . DS;

        $filesystem->deleteDir($customTargetPath);
    }

    public function testCopyLayouts()
    {
        $sourcePath =
            Plugin::path('BootstrapUI') . 'templates' . DS . 'layout' . DS . 'examples' . DS;

        $targetPath =
            Plugin::path('BootstrapUI') . 'tests' . DS . 'test_app' . DS .
            'templates' . DS . 'layout' . DS . 'TwitterBootstrap' . DS;

        $this->assertFileNotExists($targetPath . 'cover.php');
        $this->assertFileNotExists($targetPath . 'dashboard.php');
        $this->assertFileNotExists($targetPath . 'signin.php');

        $this->exec('bootstrap copy_layouts');

        $this->assertFileExists($targetPath . 'cover.php');
        $this->assertFileExists($targetPath . 'dashboard.php');
        $this->assertFileExists($targetPath . 'signin.php');

        $this->assertFileEquals($sourcePath . 'cover.php', $targetPath . 'cover.php');
        $this->assertFileEquals($sourcePath . 'dashboard.php', $targetPath . 'dashboard.php');
        $this->assertFileEquals($sourcePath . 'signin.php', $targetPath . 'signin.php');

        $this->assertEquals(
            [
                '<info>Copying sample layouts...</info>',
                "<success>Sample layouts copied successfully to `$targetPath`.</success>",
            ],
            $this->_out->messages()
        );
        $this->assertErrorEmpty();
    }

    public function testCustomTargetPath()
    {
        $sourcePath =
            Plugin::path('BootstrapUI') . 'templates' . DS . 'layout' . DS . 'examples' . DS;

        $targetPath =
            Plugin::path('BootstrapUI') . 'tests' . DS . 'test_app' . DS .
            'templates' . DS . 'layout' . DS . 'CustomPath' . DS;

        $compatTargetPath = substr($targetPath, 0, -1);

        $this->assertFileNotExists($targetPath . 'cover.php');
        $this->assertFileNotExists($targetPath . 'dashboard.php');
        $this->assertFileNotExists($targetPath . 'signin.php');

        $this->exec('bootstrap copy_layouts ' . escapeshellarg($compatTargetPath));

        $this->assertFileExists($targetPath . 'cover.php');
        $this->assertFileExists($targetPath . 'dashboard.php');
        $this->assertFileExists($targetPath . 'signin.php');

        $this->assertFileEquals($sourcePath . 'cover.php', $targetPath . 'cover.php');
        $this->assertFileEquals($sourcePath . 'dashboard.php', $targetPath . 'dashboard.php');
        $this->assertFileEquals($sourcePath . 'signin.php', $targetPath . 'signin.php');

        $this->assertEquals(
            [
                '<info>Copying sample layouts...</info>',
                "<success>Sample layouts copied successfully to `$compatTargetPath`.</success>",
            ],
            $this->_out->messages()
        );
        $this->assertErrorEmpty();
    }

    public function testFilesCannotBeCopied()
    {
        /** @var \BootstrapUI\Command\CopyLayoutsCommand|\PHPUnit\Framework\MockObject\MockObject $command */
        $command = $this
            ->getMockBuilder(CopyLayoutsCommand::class)
            ->onlyMethods(['_copyLayouts'])
            ->getMock();

        $command
            ->expects($this->once())
            ->method('_copyLayouts')
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

        $targetPath = dirname(APP) . DS . 'templates' . DS . 'layout' . DS . 'TwitterBootstrap' . DS;

        $this->assertEquals(Command::CODE_ERROR, $result);
        $this->assertEquals(
            ['<info>Copying sample layouts...</info>'],
            $out->messages()
        );
        $this->assertEquals(
            ["<error>Sample layouts could not be copied to `$targetPath`.</error>"],
            $err->messages()
        );
    }

    public function testHelp()
    {
        $targetPath = dirname(APP) . DS . 'templates' . DS . 'layout' . DS . 'TwitterBootstrap' . DS;

        $this->exec('bootstrap copy_layouts --help');

        $this->assertEquals(
            ["Copies the sample layouts into the application's layout templates
folder.

<info>Usage:</info>
cake bootstrap copy_layouts [-h] [-q] [-v] [<target>]

<info>Options:</info>

--help, -h     Display this help.
--quiet, -q    Enable quiet output.
--verbose, -v  Enable verbose output.

<info>Arguments:</info>

target  The target path into which to copy the layout files. Defaults to
        `$targetPath`.
        <comment>(optional)</comment>
"],
            $this->_out->messages()
        );
        $this->assertErrorEmpty();
    }
}
