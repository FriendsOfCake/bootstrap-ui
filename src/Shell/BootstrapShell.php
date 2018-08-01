<?php

namespace BootstrapUI\Shell;

use Cake\Console\Shell;
use Cake\Filesystem\File;

/**
 * @property \BootstrapUI\Shell\Task\TwbsAssetsTask $TwbsAssets
 * @property \Cake\Shell\Task\AssetsTask $Assets
 */
class BootstrapShell extends Shell
{
    /**
     * Tasks used by this shell.
     *
     * @var array
     */
    public $tasks = ['BootstrapUI.TwbsAssets', 'Assets'];

    /**
     * Installs assets via npm and symlinks them wo app's webroot
     *
     * @return void
     */
    public function install()
    {
        $this->TwbsAssets->installAssets();
        $this->TwbsAssets->copyAssets();
        $this->Assets->remove('BootstrapUI');
        $this->Assets->symlink('BootstrapUI');
    }

    /**
     * Copies sample layouts to app's Template/Layout/TwitterBootstrap folder
     *
     * @return void
     */
    public function copyLayouts()
    {
        $this->TwbsAssets->copyLayouts();
    }

    /**
     * Modifies AppView to extend UIView
     *
     * @param string|null $path Path to AppView
     * @return void
     */
    public function modifyView($path = null)
    {
        if ($path == null) {
            $path = APP . 'View' . DS . 'AppView.php';
        }
        $view = new File($path);

        $view->replaceText('use Cake\\View\\View', 'use BootstrapUI\\View\\UIView');
        $view->replaceText('class AppView extends View', 'class AppView extends UIView');
        $view->replaceText("    public function initialize()\n    {\n", "    public function initialize()\n    {\n        parent::initialize();\n");

        $view->write((string)$view->read());
    }

    /**
     * Get the option parser.
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();

        return $parser->setDescription([
            'Bootstrap Shell',
            '',
            ''
        ])->addSubcommand('install', [
            'help' => 'Installs Bootstrap assets and links them to app\'s webroot.'
        ])->addSubcommand('copyLayouts', [
            'help' => 'Copies sample layouts to app\'s Template/Layout/TwitterBootstrap folder.'
        ])->addSubcommand('modifyView', [
            'help' => 'Modifies AppView.php to extend this plugin\'s UIView. Don\'t use, if you have a already modified AppView'
        ]);
    }
}
