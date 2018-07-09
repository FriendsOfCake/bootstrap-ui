<?php

namespace BootstrapUI\Shell;

use BootstrapUI\Shell\BootstrapShell;
use BootstrapUI\Shell\Task\TwbsAssetsTask;
use Cake\Console\Shell;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Filesystem\File;
use Cake\Filesystem\Folder;
use Cake\TestSuite\TestCase;

class BootstrapShellTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $io = $this->getMockBuilder('Cake\Console\ConsoleIo')
            ->disableOriginalConstructor()
            ->getMock();

        $this->Shell = new BootstrapShell($io);
        $this->Shell->loadTasks();
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->Shell);
    }

    public function testInstallInDebugMode()
    {
        $this->Shell->install();

        $pluginPath = Plugin::path('BootstrapUI');
        $nodePath = $pluginPath . 'node_modules';
        $webrootPath = $pluginPath . 'webroot' . DS;
        $cssPath = $webrootPath . 'css' . DS;
        $jsPath = $webrootPath . 'js' . DS;

        $this->assertDirectoryExists($nodePath);
        $this->assertDirectoryExists($webrootPath);
        $this->assertDirectoryExists($cssPath);
        $this->assertDirectoryExists($jsPath);

        $appWebrootPath = WWW_ROOT . 'bootstrap_u_i' . DS;
        $appCssPath = $webrootPath . 'css' . DS;
        $appJsPath = $webrootPath . 'js' . DS;

        $this->assertDirectoryExists($appWebrootPath);
        $this->assertDirectoryExists($appCssPath);
        $this->assertDirectoryExists($appJsPath);

        $sourceFiles = (new Folder($webrootPath))->findRecursive();
        $targetFiles = (new Folder($appWebrootPath))->findRecursive();
        $this->assertEquals(count($sourceFiles), count($targetFiles));

        (new Folder(WWW_ROOT))->delete();
    }

    public function testInstallInProductionMode()
    {
        Configure::write('debug', false);
        $this->Shell->install();
        Configure::write('debug', true);

        $pluginPath = Plugin::path('BootstrapUI');
        $nodePath = $pluginPath . 'node_modules';
        $webrootPath = $pluginPath . 'webroot' . DS;
        $cssPath = $webrootPath . 'css' . DS;
        $jsPath = $webrootPath . 'js' . DS;

        $this->assertDirectoryExists($nodePath);
        $this->assertDirectoryExists($webrootPath);

        $this->assertDirectoryExists($cssPath);
        $this->assertFileExists($cssPath . 'bootstrap.min.css');

        $this->assertDirectoryExists($jsPath);
        $this->assertFileExists($jsPath . 'bootstrap.min.js');
        $this->assertFileExists($jsPath . 'jquery.min.js');
        $this->assertFileExists($jsPath . 'popper.min.js');

        $appWebrootPath = WWW_ROOT . 'bootstrap_u_i' . DS;
        $appCssPath = $webrootPath . 'css' . DS;
        $appJsPath = $webrootPath . 'js' . DS;

        $this->assertDirectoryExists($appWebrootPath);
        $this->assertDirectoryExists($appCssPath);
        $this->assertDirectoryExists($appJsPath);

        $sourceFiles = (new Folder($webrootPath))->findRecursive();
        $targetFiles = (new Folder($appWebrootPath))->findRecursive();
        $this->assertEquals(count($sourceFiles), count($targetFiles));

        (new Folder(WWW_ROOT))->delete();
    }

    public function testCopyLayouts()
    {
        $this->Shell->copyLayouts();
        $this->assertDirectoryExists(APP . 'Template' . DS . 'Layout' . DS . 'TwitterBootstrap');

        (new Folder(APP . 'Template' . DS . 'Layout'))->delete();
    }

    public function testModifyView()
    {
        $view = new File(APP . 'View' . DS . 'AppView.php');
        $original = $view->read();

        $this->Shell->modifyView();
        $this->assertContains('use BootstrapUI\\View\\UIView', (string)$view->read());
        $this->assertContains('class AppView extends UIView', (string)$view->read());
        $this->assertContains('parent::initialize();', (string)$view->read());

        if ($view->writable()) {
            $view->write($original);
        }
    }
}
