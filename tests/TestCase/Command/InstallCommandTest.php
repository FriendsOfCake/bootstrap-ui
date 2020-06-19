<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\Command;

use Cake\Core\Plugin;
use Cake\Filesystem\Folder;
use Cake\TestSuite\ConsoleIntegrationTestTrait;
use Cake\TestSuite\TestCase;

class InstallCommandTest extends TestCase
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

        $folder = new Folder(WWW_ROOT);
        $folder->delete();
    }

    public function testInstall()
    {
        $pluginWebrootPath = Plugin::path('BootstrapUI') . 'webroot' . DS;
        $appWebrootPath = WWW_ROOT;
        $appWebrootPluginPath = WWW_ROOT . 'bootstrap_u_i' . DS;

        $appWebrootFolder = new Folder($appWebrootPath);
        $appWebrootFolder->delete();

        $this->assertDirectoryNotExists($appWebrootPath);

        $this->exec('bootstrap install');

        $this->assertDirectoryExists($appWebrootPath);
        $this->assertDirectoryExists($appWebrootPluginPath . 'css');
        $this->assertDirectoryExists($appWebrootPluginPath . 'js');

        $cssAssets = [
            'bootstrap.css',
            'bootstrap.min.css',
            'cover.css',
            'dashboard.css',
            'signin.css',
        ];
        foreach ($cssAssets as $asset) {
            $this->assertFileExists($pluginWebrootPath . 'css' . DS . $asset);
            $this->assertFileExists($appWebrootPluginPath . 'css' . DS . $asset);
        }

        $jsAssets = [
            'bootstrap.js',
            'bootstrap.min.js',
            'jquery.js',
            'jquery.min.js',
            'popper.js',
            'popper.min.js',
        ];
        foreach ($jsAssets as $asset) {
            $this->assertFileExists($pluginWebrootPath . 'js' . DS . $asset);
            $this->assertFileExists($appWebrootPluginPath . 'js' . DS . $asset);
        }

        $sourceFiles = (new Folder($pluginWebrootPath))->findRecursive();
        $targetFiles = (new Folder($appWebrootPluginPath))->findRecursive();
        $this->assertEquals(count($sourceFiles), count($targetFiles));
    }

    public function testHelp()
    {
        $this->exec('bootstrap install --help');

        $this->assertEquals(
            ["Installs Bootstrap dependencies and links the assets to the
application's webroot.

<info>Usage:</info>
cake bootstrap install [-h] [-q] [-v]

<info>Options:</info>

--help, -h     Display this help.
--quiet, -q    Enable quiet output.
--verbose, -v  Enable verbose output.
"],
            $this->_out->messages()
        );
        $this->assertErrorEmpty();
    }
}
