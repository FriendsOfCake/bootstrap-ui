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

    public function testInstall()
    {
        $this->Shell->install();
        Configure::write('debug', false);
        $this->Shell->install();

        $this->_assetDir = new Folder(Plugin::path('BootstrapUI') . 'webroot');
        $this->assertDirectoryExists($this->_assetDir->path . DS . 'css');
        $this->assertDirectoryExists($this->_assetDir->path . DS . 'js');
    }

    public function testCopyLayouts()
    {
        $this->Shell->copyLayouts();
        $this->assertDirectoryExists(APP . 'Template' . DS . 'Layout' . DS . 'TwitterBootstrap');
    }

    public function testModifyView()
    {
        $view = new File(APP . 'View' . DS . 'AppView.php');
        $this->Shell->modifyView();
        $this->assertContains('use BootstrapUI\\View\\UIView', (string)$view->read());
        $this->assertContains('class AppView extends UIView', (string)$view->read());
        $this->assertContains('parent::initialize();', (string)$view->read());
    }
}
