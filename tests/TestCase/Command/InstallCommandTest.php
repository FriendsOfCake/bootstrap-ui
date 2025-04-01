<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\Command;

use BootstrapUI\Command\InstallCommand;
use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\Exception\StopException;
use Cake\Console\TestSuite\ConsoleIntegrationTestTrait;
use Cake\Console\TestSuite\StubConsoleOutput;
use Cake\Core\Plugin;
use Cake\TestSuite\TestCase;
use Cake\Utility\Filesystem;
use SplFileInfo;

class InstallCommandTest extends TestCase
{
    use ConsoleIntegrationTestTrait;

    public function testInstall()
    {
        $pluginWebrootPath = Plugin::path('BootstrapUI') . 'webroot' . DS;
        $appWebrootPath = WWW_ROOT;
        $appWebrootPluginPath = WWW_ROOT . 'bootstrap_u_i' . DS;

        $filesystem = new Filesystem();
        $filesystem->deleteDir($appWebrootPath);

        $this->assertDirectoryDoesNotExist($appWebrootPath);

        $this->exec('bootstrap install');

        $this->assertDirectoryExists($appWebrootPath);
        $this->assertDirectoryExists($appWebrootPluginPath . 'css');
        $this->assertDirectoryExists($appWebrootPluginPath . 'font');
        $this->assertDirectoryExists($appWebrootPluginPath . 'js');

        $cssAssets = [
            'bootstrap.css',
            'bootstrap.css.map',
            'bootstrap.min.css',
            'bootstrap.min.css.map',
            'cover.css',
            'dashboard.css',
            'signin.css',
        ];
        $fontAssets = [
            'bootstrap-icons.css',
            'bootstrap-icon-sizes.css',
            'fonts' . DS . 'bootstrap-icons.woff',
            'fonts' . DS . 'bootstrap-icons.woff2',
        ];
        $jsAssets = [
            'bootstrap.bundle.js',
            'bootstrap.bundle.js.map',
            'bootstrap.bundle.min.js',
            'bootstrap.bundle.min.js.map',
        ];

        foreach ($cssAssets as $asset) {
            $this->assertFileExists($pluginWebrootPath . 'css' . DS . $asset);
            $this->assertFileExists($appWebrootPluginPath . 'css' . DS . $asset);
        }
        foreach ($fontAssets as $asset) {
            $this->assertFileExists($pluginWebrootPath . 'font' . DS . $asset);
            $this->assertFileExists($appWebrootPluginPath . 'font' . DS . $asset);
        }
        foreach ($jsAssets as $asset) {
            $this->assertFileExists($pluginWebrootPath . 'js' . DS . $asset);
            $this->assertFileExists($appWebrootPluginPath . 'js' . DS . $asset);
        }

        $sourceFiles = $filesystem->findRecursive($pluginWebrootPath);
        $targetFiles = $filesystem->findRecursive($appWebrootPluginPath);
        $this->assertEquals(iterator_count($sourceFiles), iterator_count($targetFiles));

        $appWebrootPluginPath = WWW_ROOT . 'bootstrap_u_i';
        $expected = [
            '<info>Clearing `node_modules` folder (this can take a while)...</info>',
            '<success>Cleared `node_modules` folder.</success>',
            '<info>Installing packages...</info>',
            '<success>`bootstrap.css` successfully deleted.</success>',
            '<success>`bootstrap.css.map` successfully deleted.</success>',
            '<success>`bootstrap.min.css` successfully deleted.</success>',
            '<success>`bootstrap.min.css.map` successfully deleted.</success>',
            '<success>`bootstrap.bundle.js` successfully deleted.</success>',
            '<success>`bootstrap.bundle.js.map` successfully deleted.</success>',
            '<success>`bootstrap.bundle.min.js` successfully deleted.</success>',
            '<success>`bootstrap.bundle.min.js.map` successfully deleted.</success>',
            '<success>`popper.js` successfully deleted.</success>',
            '<success>`popper.js.map` successfully deleted.</success>',
            '<success>`popper.min.js` successfully deleted.</success>',
            '<success>`popper.min.js.map` successfully deleted.</success>',
            '<success>`bootstrap-icons.css` successfully deleted.</success>',
            '<success>`bootstrap-icons.woff` successfully deleted.</success>',
            '<success>`bootstrap-icons.woff2` successfully deleted.</success>',
            '<success>All buffered files cleared.</success>',
            '<info>Installing packages...</info>',
            '<success>`bootstrap.css` successfully copied.</success>',
            '<success>`bootstrap.css.map` successfully copied.</success>',
            '<success>`bootstrap.min.css` successfully copied.</success>',
            '<success>`bootstrap.min.css.map` successfully copied.</success>',
            '<success>`bootstrap.bundle.js` successfully copied.</success>',
            '<success>`bootstrap.bundle.js.map` successfully copied.</success>',
            '<success>`bootstrap.bundle.min.js` successfully copied.</success>',
            '<success>`bootstrap.bundle.min.js.map` successfully copied.</success>',
            '<success>`popper.js` successfully copied.</success>',
            '<success>`popper.js.map` successfully copied.</success>',
            '<success>`popper.min.js` successfully copied.</success>',
            '<success>`popper.min.js.map` successfully copied.</success>',
            '<success>`bootstrap-icons.css` successfully copied.</success>',
            '<success>`bootstrap-icons.woff` successfully copied.</success>',
            '<success>`bootstrap-icons.woff2` successfully copied.</success>',
            '<success>All files buffered.</success>',
            '<info>Removing possibly existing plugin assets...</info>',
            'For plugin: BootstrapUI',
            '<info>Linking plugin assets...</info>',
            'For plugin: BootstrapUI',
            "Copied assets to directory $appWebrootPluginPath",
            'Done',
            '<success>Installation completed.</success>',
        ];
        $notPresentInNonVerboseMode = [
            '<success>`bootstrap.css` successfully deleted.</success>',
            '<success>`bootstrap.css.map` successfully deleted.</success>',
            '<success>`bootstrap.min.css` successfully deleted.</success>',
            '<success>`bootstrap.min.css.map` successfully deleted.</success>',
            '<success>`bootstrap.bundle.js` successfully deleted.</success>',
            '<success>`bootstrap.bundle.js.map` successfully deleted.</success>',
            '<success>`bootstrap.bundle.min.js` successfully deleted.</success>',
            '<success>`bootstrap.bundle.min.js.map` successfully deleted.</success>',
            '<success>`popper.js` successfully deleted.</success>',
            '<success>`popper.js.map` successfully deleted.</success>',
            '<success>`popper.min.js` successfully deleted.</success>',
            '<success>`popper.min.js.map` successfully deleted.</success>',
            '<success>`bootstrap-icons.css` successfully deleted.</success>',
            '<success>`bootstrap-icons.woff` successfully deleted.</success>',
            '<success>`bootstrap-icons.woff2` successfully deleted.</success>',
            '<success>`bootstrap.css` successfully copied.</success>',
            '<success>`bootstrap.css.map` successfully copied.</success>',
            '<success>`bootstrap.min.css` successfully copied.</success>',
            '<success>`bootstrap.min.css.map` successfully copied.</success>',
            '<success>`bootstrap.bundle.js` successfully copied.</success>',
            '<success>`bootstrap.bundle.js.map` successfully copied.</success>',
            '<success>`bootstrap.bundle.min.js` successfully copied.</success>',
            '<success>`bootstrap.bundle.min.js.map` successfully copied.</success>',
            '<success>`popper.js` successfully copied.</success>',
            '<success>`popper.js.map` successfully copied.</success>',
            '<success>`popper.min.js` successfully copied.</success>',
            '<success>`popper.min.js.map` successfully copied.</success>',
            '<success>`bootstrap-icons.css` successfully copied.</success>',
            '<success>`bootstrap-icons.woff` successfully copied.</success>',
            '<success>`bootstrap-icons.woff2` successfully copied.</success>',
        ];
        $this->assertEquals($notPresentInNonVerboseMode, array_values(array_diff($expected, $this->_out->messages())));
        $this->assertExitCode(Command::CODE_SUCCESS);
    }

    public function testReInstall()
    {
        $pluginWebrootPath = Plugin::path('BootstrapUI') . 'webroot' . DS;
        $appWebrootPath = WWW_ROOT;
        $appWebrootPluginPath = WWW_ROOT . 'bootstrap_u_i' . DS;

        $this->assertDirectoryExists($appWebrootPath);
        $this->assertDirectoryExists($appWebrootPluginPath . 'css');
        $this->assertDirectoryExists($appWebrootPluginPath . 'js');

        $cssAssets = [
            'bootstrap.css',
            'bootstrap.css.map',
            'bootstrap.min.css',
            'bootstrap.min.css.map',
            'cover.css',
            'dashboard.css',
            'signin.css',
        ];
        $fontAssets = [
            'bootstrap-icons.css',
            'bootstrap-icon-sizes.css',
            'fonts' . DS . 'bootstrap-icons.woff',
            'fonts' . DS . 'bootstrap-icons.woff2',
        ];
        $jsAssets = [
            'bootstrap.bundle.js',
            'bootstrap.bundle.js.map',
            'bootstrap.bundle.min.js',
            'bootstrap.bundle.min.js.map',
        ];

        foreach ($cssAssets as $asset) {
            $this->assertFileExists($pluginWebrootPath . 'css' . DS . $asset);
            $this->assertFileExists($appWebrootPluginPath . 'css' . DS . $asset);
        }
        foreach ($fontAssets as $asset) {
            $this->assertFileExists($pluginWebrootPath . 'font' . DS . $asset);
            $this->assertFileExists($appWebrootPluginPath . 'font' . DS . $asset);
        }
        foreach ($jsAssets as $asset) {
            $this->assertFileExists($pluginWebrootPath . 'js' . DS . $asset);
            $this->assertFileExists($appWebrootPluginPath . 'js' . DS . $asset);
        }

        $this->exec('bootstrap install');

        foreach ($cssAssets as $asset) {
            $this->assertFileExists($pluginWebrootPath . 'css' . DS . $asset);
            $this->assertFileExists($appWebrootPluginPath . 'css' . DS . $asset);
        }
        foreach ($fontAssets as $asset) {
            $this->assertFileExists($pluginWebrootPath . 'font' . DS . $asset);
            $this->assertFileExists($appWebrootPluginPath . 'font' . DS . $asset);
        }
        foreach ($jsAssets as $asset) {
            $this->assertFileExists($pluginWebrootPath . 'js' . DS . $asset);
            $this->assertFileExists($appWebrootPluginPath . 'js' . DS . $asset);
        }

        $filesystem = new Filesystem();
        $sourceFiles = $filesystem->findRecursive($pluginWebrootPath);
        $targetFiles = $filesystem->findRecursive($appWebrootPluginPath);
        $this->assertEquals(iterator_count($sourceFiles), iterator_count($targetFiles));

        $this->assertExitCode(Command::CODE_SUCCESS);

        $filesystem->deleteDir(WWW_ROOT);
    }

    public function testInstallQuiet()
    {
        $this->exec('bootstrap install -q');

        $this->assertOutputEmpty();
        $this->assertErrorEmpty();
        $this->assertExitCode(Command::CODE_SUCCESS);

        $filesystem = new Filesystem();
        $filesystem->deleteDir(WWW_ROOT);
    }

    public function testInstallVerbose()
    {
        $this->exec('bootstrap install -v');

        $appWebrootPluginPath = WWW_ROOT . 'bootstrap_u_i';
        $expected = [
            '<info>Clearing `node_modules` folder (this can take a while)...</info>',
            '<success>Cleared `node_modules` folder.</success>',
            '<info>Installing packages...</info>',
            '<success>`bootstrap.css` successfully deleted.</success>',
            '<success>`bootstrap.css.map` successfully deleted.</success>',
            '<success>`bootstrap.min.css` successfully deleted.</success>',
            '<success>`bootstrap.min.css.map` successfully deleted.</success>',
            '<success>`bootstrap.bundle.js` successfully deleted.</success>',
            '<success>`bootstrap.bundle.js.map` successfully deleted.</success>',
            '<success>`bootstrap.bundle.min.js` successfully deleted.</success>',
            '<success>`bootstrap.bundle.min.js.map` successfully deleted.</success>',
            '<success>`bootstrap-icons.css` successfully deleted.</success>',
            '<success>`bootstrap-icons.woff` successfully deleted.</success>',
            '<success>`bootstrap-icons.woff2` successfully deleted.</success>',
            '<success>All buffered files cleared.</success>',
            '<info>Installing packages...</info>',
            '<success>`bootstrap.css` successfully copied.</success>',
            '<success>`bootstrap.css.map` successfully copied.</success>',
            '<success>`bootstrap.min.css` successfully copied.</success>',
            '<success>`bootstrap.min.css.map` successfully copied.</success>',
            '<success>`bootstrap.bundle.js` successfully copied.</success>',
            '<success>`bootstrap.bundle.js.map` successfully copied.</success>',
            '<success>`bootstrap.bundle.min.js` successfully copied.</success>',
            '<success>`bootstrap.bundle.min.js.map` successfully copied.</success>',
            '<success>`bootstrap-icons.css` successfully copied.</success>',
            '<success>`bootstrap-icons.woff` successfully copied.</success>',
            '<success>`bootstrap-icons.woff2` successfully copied.</success>',
            '<success>All files buffered.</success>',
            '<info>Removing possibly existing plugin assets...</info>',
            'For plugin: BootstrapUI',
            '<info>Linking plugin assets...</info>',
            'For plugin: BootstrapUI',
            "Copied assets to directory $appWebrootPluginPath",
            'Done',
            '<success>Installation completed.</success>',
        ];
        $this->assertEmpty(array_diff($expected, $this->_out->messages()));
        $this->assertExitCode(Command::CODE_SUCCESS);

        $filesystem = new Filesystem();
        $filesystem->deleteDir(WWW_ROOT);
    }

    public function testInstallLatest()
    {
        $testPackageFileContents = <<<EOT
{
    "dependencies": {
        "bootstrap": "^5.3.3",
        "bootstrap-icons": "^1.11.3"
    }
}

EOT;

        $testLockFileContents = <<<EOT
{
    "name": "bootstrap-ui",
    "lockfileVersion": 2,
    "requires": true,
    "packages": {
        "": {
            "dependencies": {
                "bootstrap": "^5.3.3",
                "bootstrap-icons": "^1.11.3"
            }
        },
        "node_modules/@popperjs/core": {
            "version": "2.11.8",
            "resolved": "https://registry.npmjs.org/@popperjs/core/-/core-2.11.8.tgz",
            "integrity": "sha512-P1st0aksCrn9sGZhp8GMYwBnQsbvAWsZAX44oXNNvLHGqAOcoVxmjZiohstwQ7SqKnbR47akdNi+uleWD8+g6A==",
            "peer": true,
            "funding": {
                "type": "opencollective",
                "url": "https://opencollective.com/popperjs"
            }
        },
        "node_modules/bootstrap": {
            "version": "5.3.3",
            "resolved": "https://registry.npmjs.org/bootstrap/-/bootstrap-5.3.3.tgz",
            "integrity": "sha512-8HLCdWgyoMguSO9o+aH+iuZ+aht+mzW0u3HIMzVu7Srrpv7EBBxTnrFlSCskwdY1+EOFQSm7uMJhNQHkdPcmjg==",
            "funding": [
                {
                    "type": "github",
                    "url": "https://github.com/sponsors/twbs"
                },
                {
                    "type": "opencollective",
                    "url": "https://opencollective.com/bootstrap"
                }
            ],
            "peerDependencies": {
                "@popperjs/core": "^2.11.8"
            }
        },
        "node_modules/bootstrap-icons": {
            "version": "1.11.3",
            "resolved": "https://registry.npmjs.org/bootstrap-icons/-/bootstrap-icons-1.11.3.tgz",
            "integrity": "sha512-+3lpHrCw/it2/7lBL15VR0HEumaBss0+f/Lb6ZvHISn1mlK83jjFpooTLsMWbIjJMDjDjOExMsTxnXSIT4k4ww==",
            "funding": [
                {
                    "type": "github",
                    "url": "https://github.com/sponsors/twbs"
                },
                {
                    "type": "opencollective",
                    "url": "https://opencollective.com/bootstrap"
                }
            ]
        }
    },
    "dependencies": {
        "@popperjs/core": {
            "version": "2.11.8",
            "resolved": "https://registry.npmjs.org/@popperjs/core/-/core-2.11.8.tgz",
            "integrity": "sha512-P1st0aksCrn9sGZhp8GMYwBnQsbvAWsZAX44oXNNvLHGqAOcoVxmjZiohstwQ7SqKnbR47akdNi+uleWD8+g6A==",
            "peer": true
        },
        "bootstrap": {
            "version": "5.3.3",
            "resolved": "https://registry.npmjs.org/bootstrap/-/bootstrap-5.3.3.tgz",
            "integrity": "sha512-8HLCdWgyoMguSO9o+aH+iuZ+aht+mzW0u3HIMzVu7Srrpv7EBBxTnrFlSCskwdY1+EOFQSm7uMJhNQHkdPcmjg==",
            "requires": {}
        },
        "bootstrap-icons": {
            "version": "1.11.3",
            "resolved": "https://registry.npmjs.org/bootstrap-icons/-/bootstrap-icons-1.11.3.tgz",
            "integrity": "sha512-+3lpHrCw/it2/7lBL15VR0HEumaBss0+f/Lb6ZvHISn1mlK83jjFpooTLsMWbIjJMDjDjOExMsTxnXSIT4k4ww=="
        }
    }
}

EOT;

        $pluginPath = Plugin::path('BootstrapUI');

        $this->assertTrue(rename($pluginPath . 'package.json', $pluginPath . 'package.json.bak'));
        $this->assertTrue(rename($pluginPath . 'package-lock.json', $pluginPath . 'package-lock.json.bak'));

        $this->assertNotFalse(file_put_contents($pluginPath . 'package.json', $testPackageFileContents));
        $this->assertNotFalse(file_put_contents($pluginPath . 'package-lock.json', $testLockFileContents));

        $this->exec('bootstrap install');

        $this->assertStringEqualsFile($pluginPath . 'package.json', $testPackageFileContents);
        $this->assertStringEqualsFile($pluginPath . 'package-lock.json', $testLockFileContents);

        $package = json_decode(
            file_get_contents($pluginPath . 'node_modules' . DS . 'bootstrap' . DS . 'package.json'),
            true,
        );
        $this->assertSame('5.3.3', $package['version']);

        $package = json_decode(
            file_get_contents($pluginPath . 'node_modules' . DS . 'bootstrap-icons' . DS . 'package.json'),
            true,
        );
        $this->assertSame('1.11.3', $package['version']);

        $this->exec('bootstrap install --latest');

        $this->assertStringEqualsFile($pluginPath . 'package.json', $testPackageFileContents);
        $this->assertStringEqualsFile($pluginPath . 'package-lock.json', $testLockFileContents);

        $package = json_decode(
            file_get_contents($pluginPath . 'node_modules' . DS . 'bootstrap' . DS . 'package.json'),
            true,
        );
        $this->assertTrue(version_compare($package['version'], '5.3.3', '>='));
        $this->assertTrue(version_compare($package['version'], '6.0.0', '<'));

        $package = json_decode(
            file_get_contents($pluginPath . 'node_modules' . DS . 'bootstrap-icons' . DS . 'package.json'),
            true,
        );
        $this->assertTrue(version_compare($package['version'], '1.11.3', '>='));
        $this->assertTrue(version_compare($package['version'], '2.0.0', '<'));

        $this->assertTrue(rename($pluginPath . 'package.json.bak', $pluginPath . 'package.json'));
        $this->assertTrue(rename($pluginPath . 'package-lock.json.bak', $pluginPath . 'package-lock.json'));

        $filesystem = new Filesystem();
        $filesystem->deleteDir(WWW_ROOT);
    }

    public function testNPMNotAvailable()
    {
        /** @var \BootstrapUI\Command\InstallCommand|\PHPUnit\Framework\MockObject\MockObject $command */
        $command = $this
            ->getMockBuilder(InstallCommand::class)
            ->onlyMethods(['_isNPMAvailable'])
            ->getMock();

        $command
            ->expects($this->once())
            ->method('_isNPMAvailable')
            ->willReturn(false);

        $out = new StubConsoleOutput();
        $err = new StubConsoleOutput();
        $args = new Arguments([], [], []);
        $io = new ConsoleIo($out, $err);

        try {
            $result = $command->installPackages($args, $io);
        } catch (StopException $exception) {
            $result = $exception->getCode();
        }

        $this->assertEquals(Command::CODE_ERROR, $result);
        $this->assertEmpty($out->messages());
        $this->assertEquals(
            ['<error>NPM (https://www.npmjs.com/) is required, but not installed. Aborting.</error>'],
            $err->messages(),
        );
    }

    public function testDeleteNodeModulesFailure()
    {
        /** @var \BootstrapUI\Command\InstallCommand|\PHPUnit\Framework\MockObject\MockObject $command */
        $command = $this
            ->getMockBuilder(InstallCommand::class)
            ->onlyMethods(['_deleteNodeModules'])
            ->getMock();

        $command
            ->expects($this->once())
            ->method('_deleteNodeModules')
            ->willReturn(false);

        $out = new StubConsoleOutput();
        $err = new StubConsoleOutput();
        $args = new Arguments([], [], []);
        $io = new ConsoleIo($out, $err);

        try {
            $result = $command->installPackages($args, $io);
        } catch (StopException $exception) {
            $result = $exception->getCode();
        }

        $this->assertEquals(Command::CODE_ERROR, $result);
        $this->assertEquals(
            ['<info>Clearing `node_modules` folder (this can take a while)...</info>'],
            $out->messages(),
        );
        $this->assertEquals(
            ['<error>Could not clear `node_modules` folder.</error>'],
            $err->messages(),
        );
    }

    public function testChangeWorkingDirectoryFailure()
    {
        /** @var \BootstrapUI\Command\InstallCommand|\PHPUnit\Framework\MockObject\MockObject $command */
        $command = $this
            ->getMockBuilder(InstallCommand::class)
            ->onlyMethods(['_deleteNodeModules', '_changeWorkingDirectory'])
            ->getMock();

        $command
            ->expects($this->once())
            ->method('_deleteNodeModules')
            ->willReturn(true);
        $command
            ->expects($this->once())
            ->method('_changeWorkingDirectory')
            ->willReturn(false);

        $out = new StubConsoleOutput();
        $err = new StubConsoleOutput();
        $args = new Arguments([], [], []);
        $io = new ConsoleIo($out, $err);

        try {
            $result = $command->installPackages($args, $io);
        } catch (StopException $exception) {
            $result = $exception->getCode();
        }

        $pluginPath = Plugin::path('BootstrapUI');

        $this->assertEquals(Command::CODE_ERROR, $result);
        $this->assertEquals(
            [
                '<info>Clearing `node_modules` folder (this can take a while)...</info>',
                '<success>Cleared `node_modules` folder.</success>',
                '<info>Installing packages...</info>',
            ],
            $out->messages(),
        );
        $this->assertEquals(
            ["<error>Could not change into plugin directory `$pluginPath`.</error>"],
            $err->messages(),
        );
    }

    public function testNPMInstallFailure()
    {
        /** @var \BootstrapUI\Command\InstallCommand|\PHPUnit\Framework\MockObject\MockObject $command */
        $command = $this
            ->getMockBuilder(InstallCommand::class)
            ->onlyMethods(['_deleteNodeModules', '_runNPMInstall'])
            ->getMock();

        $command
            ->expects($this->once())
            ->method('_deleteNodeModules')
            ->willReturn(true);
        $command
            ->expects($this->once())
            ->method('_runNPMInstall')
            ->willReturnCallback(function (&$out, &$return) {
                $out = [
                    'installer output',
                ];
                $return = 1234;
            });

        $out = new StubConsoleOutput();
        $err = new StubConsoleOutput();
        $args = new Arguments([], [], []);
        $io = new ConsoleIo($out, $err);

        try {
            $result = $command->installPackages($args, $io);
        } catch (StopException $exception) {
            $result = $exception->getCode();
        }

        $this->assertEquals(1234, $result);
        $this->assertEquals(
            [
                '<info>Clearing `node_modules` folder (this can take a while)...</info>',
                '<success>Cleared `node_modules` folder.</success>',
                '<info>Installing packages...</info>',
                'installer output',
            ],
            $out->messages(),
        );
        $this->assertEquals(
            ['<error>Package installation failed.</error>'],
            $err->messages(),
        );
    }

    public function testDeleteBufferedPackageAssetsFailure()
    {
        /** @var \BootstrapUI\Command\InstallCommand|\PHPUnit\Framework\MockObject\MockObject $command */
        $command = $this
            ->getMockBuilder(InstallCommand::class)
            ->onlyMethods(['_findBufferedPackageAssets'])
            ->getMock();

        file_put_contents(TMP . 'style.css', '');
        file_put_contents(TMP . 'script.js', '');

        $command
            ->expects($this->once())
            ->method('_findBufferedPackageAssets')
            ->willReturn([
                new SplFileInfo(TMP . 'style.css'),
                new SplFileInfo(TMP . 'non-existent.file'),
                new SplFileInfo(TMP . 'script.js'),
            ]);

        $out = new StubConsoleOutput();
        $err = new StubConsoleOutput();
        $io = new ConsoleIo($out, $err);

        try {
            $result = $command->refreshAssetBuffer($io);
        } catch (StopException $exception) {
            $result = $exception->getCode();
        }

        $this->assertEquals(Command::CODE_ERROR, $result);
        $this->assertEquals(
            [
                '<info>Refreshing package asset buffer...</info>',
            ],
            $out->messages(),
        );
        $this->assertEquals(
            [
                '<warning>`non-existent.file` could not be deleted.</warning>',
                '<error>Could not clear all buffered files.</error>',
            ],
            $err->messages(),
        );
    }

    public function testBufferPackageAssetsSkipUnsupportedFileTypes()
    {
        /** @var \BootstrapUI\Command\InstallCommand|\PHPUnit\Framework\MockObject\MockObject $command */
        $command = $this
            ->getMockBuilder(InstallCommand::class)
            ->onlyMethods(['_deleteBufferedPackageAssets', '_findPackageAssets'])
            ->getMock();

        $command
            ->expects($this->once())
            ->method('_deleteBufferedPackageAssets')
            ->willReturn(true);

        file_put_contents(TMP . 'style.css', '');
        file_put_contents(TMP . 'script.js', '');

        $command
            ->expects($this->once())
            ->method('_findPackageAssets')
            ->willReturn([
                new SplFileInfo(TMP . 'style.css'),
                new SplFileInfo(TMP . 'unsupported.file'),
                new SplFileInfo(TMP . 'script.js'),
            ]);

        $out = new StubConsoleOutput();
        $err = new StubConsoleOutput();
        $io = new ConsoleIo($out, $err);
        $io->level(ConsoleIo::VERBOSE);

        try {
            $result = $command->refreshAssetBuffer($io);
        } catch (StopException $exception) {
            $result = $exception->getCode();
        }

        $this->assertEquals(Command::CODE_SUCCESS, $result);
        $this->assertEquals(
            [
                '<info>Refreshing package asset buffer...</info>',
                '<success>All buffered files cleared.</success>',
                '<success>`style.css` successfully copied.</success>',
                '<info>Skipped `unsupported.file`.</info>',
                '<success>`script.js` successfully copied.</success>',
                '<success>All files buffered.</success>',
            ],
            $out->messages(),
        );
    }

    public function testBufferPackageAssetsFailure()
    {
        /** @var \BootstrapUI\Command\InstallCommand|\PHPUnit\Framework\MockObject\MockObject $command */
        $command = $this
            ->getMockBuilder(InstallCommand::class)
            ->onlyMethods(['_deleteBufferedPackageAssets', '_findPackageAssets'])
            ->getMock();

        $command
            ->expects($this->once())
            ->method('_deleteBufferedPackageAssets')
            ->willReturn(true);

        $command
            ->expects($this->once())
            ->method('_findPackageAssets')
            ->willReturn([
                new SplFileInfo(TMP . 'non-existent.css'),
            ]);

        $out = new StubConsoleOutput();
        $err = new StubConsoleOutput();
        $io = new ConsoleIo($out, $err);

        try {
            $result = $command->refreshAssetBuffer($io);
        } catch (StopException $exception) {
            $result = $exception->getCode();
        }

        $this->assertEquals(Command::CODE_ERROR, $result);
        $this->assertEquals(
            [
                '<info>Refreshing package asset buffer...</info>',
                '<success>All buffered files cleared.</success>',
            ],
            $out->messages(),
        );
        $this->assertEquals(
            [
                '<warning>`non-existent.css` could not be copied.</warning>',
                '<error>Could not buffer all files.</error>',
            ],
            $err->messages(),
        );
    }

    public function testRemovePluginAssetsFailure()
    {
        /** @var \BootstrapUI\Command\InstallCommand|\PHPUnit\Framework\MockObject\MockObject $command */
        $command = $this
            ->getMockBuilder(InstallCommand::class)
            ->onlyMethods(['executeCommand'])
            ->getMock();

        $command
            ->expects($this->once())
            ->method('executeCommand')
            ->willReturn(1234);

        $out = new StubConsoleOutput();
        $err = new StubConsoleOutput();
        $io = new ConsoleIo($out, $err);

        try {
            $result = $command->removePluginAssets($io);
        } catch (StopException $exception) {
            $result = $exception->getCode();
        }

        $this->assertEquals(1234, $result);
        $this->assertEquals(
            ['<info>Removing possibly existing plugin assets...</info>'],
            $out->messages(),
        );
        $this->assertEquals(
            ['<error>Removing plugin assets failed.</error>'],
            $err->messages(),
        );
    }

    public function testLinkPluginAssetsFailure()
    {
        /** @var \BootstrapUI\Command\InstallCommand|\PHPUnit\Framework\MockObject\MockObject $command */
        $command = $this
            ->getMockBuilder(InstallCommand::class)
            ->onlyMethods(['executeCommand'])
            ->getMock();

        $command
            ->expects($this->once())
            ->method('executeCommand')
            ->willReturn(1234);

        $out = new StubConsoleOutput();
        $err = new StubConsoleOutput();
        $io = new ConsoleIo($out, $err);

        try {
            $result = $command->linkPluginAssets($io);
        } catch (StopException $exception) {
            $result = $exception->getCode();
        }

        $this->assertEquals(1234, $result);
        $this->assertEquals(
            ['<info>Linking plugin assets...</info>'],
            $out->messages(),
        );
        $this->assertEquals(
            ['<error>Linking plugin assets failed.</error>'],
            $err->messages(),
        );
    }

    public function testHelp()
    {
        $this->exec('bootstrap install --help');

        $this->assertEquals(
            ["Installs Bootstrap dependencies and links the assets to the
application's webroot.

<info>Usage:</info>
cake bootstrap install [-h] [-l] [-q] [-v]

<info>Options:</info>

--help, -h     Display this help.
--latest, -l   To install the latest minor versions of required assets.
--quiet, -q    Enable quiet output.
--verbose, -v  Enable verbose output.
"],
            $this->_out->messages(),
        );
        $this->assertErrorEmpty();
    }
}
