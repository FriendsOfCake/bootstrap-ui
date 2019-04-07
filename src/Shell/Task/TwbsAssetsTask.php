<?php

namespace BootstrapUI\Shell\Task;

use Cake\Console\Shell;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Filesystem\File;
use Cake\Filesystem\Folder;

/**
 * Task for installing Bootstrap assets and layouts to app.
 */
class TwbsAssetsTask extends Shell
{
    protected $_assetDir;
    protected $_nodeDir;
    protected $_cssDir;
    protected $_jsDir;

    /**
     * TwbsAssetsTask constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->_assetDir = new Folder(Plugin::path('BootstrapUI') . 'webroot', true);
        $this->_nodeDir = new Folder(Plugin::path('BootstrapUI') . 'node_modules', true);
        $this->_cssDir = new Folder($this->_assetDir->path . DS . 'css', true);
        $this->_jsDir = new Folder($this->_assetDir->path . DS . 'js', true);
    }

    /**
     * Installs Bootstrap assets using npm
     *
     * @return void
     */
    public function installAssets()
    {
        $this->info('Checking npm...');
        if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN' && !`which npm`) {
            $this->abort('NPM (https://www.npmjs.com/) is required, but not installed. Aborting.');
        }

        chdir(Plugin::path('BootstrapUI'));
        $node_mod = new Folder('node_modules');
        if ($node_mod->delete()) {
            $this->success('Cleared node_modules...');
        }

        exec('npm install --verbose', $output, $return);
        $this->out($output);
        if ($return === 0) {
            $this->success('Bootstrap assets installed successfully.');
        } else {
            $this->abort('Bootstrap assets could not be installed.');
        }
    }

    /**
     * Copy assets from node_modules folder to plugin's webroot
     * If in production mode, just copies min. required and minified assets
     *
     * @return void
     */
    public function copyAssets()
    {
        $this->info('Clearing webroot and copying assets...');
        if ($this->_clear($this->_assetDir, '^(?!cover)(?!dashboard)(?!signin)(?!baked-with-cakephp.svg).*$')) {
            $this->success('All files cleared...');
        }

        $files = [];
        $folders = [];
        $folders[] = new Folder($this->_nodeDir->path . DS . 'bootstrap/dist');
        $folders[] = new Folder($this->_nodeDir->path . DS . 'jquery/dist');
        $folders[] = new Folder($this->_nodeDir->path . DS . 'popper.js/dist/umd');

        foreach ($folders as $folder) {
            foreach ($folder->findRecursive() as $file) {
                $files[] = new File($file);
            }
        }
        $this->_copy($files);
    }

    /**
     * Copy sample layouts to app's layout dir
     *
     * @param string $target The destination path
     * @return void
     */
    public function copyLayouts($target = null)
    {
        $this->info('Copying sample layouts...');
        $layoutDir = new Folder(Plugin::path('BootstrapUI') . 'src' . DS . 'Template' . DS . 'Layout' . DS . 'examples');

        if ($target == null) {
            $target = APP . 'Template' . DS . 'Layout' . DS . 'TwitterBootstrap';
        }

        if (!$layoutDir->copy($target)) {
            $this->abort('Sample layouts could not be copied.');
        }
        $this->success('Sample layouts copied successfully.');
    }

    /**
     * Copy files to assetdir's css/js path
     *
     * @param array $files Assetfiles to copy
     * @return void
     */
    protected function _copy(array $files)
    {
        foreach ($files as $file) {
            $dir = null;
            if (preg_match('/.css/', $file->name)) {
                $dir = $this->_cssDir;
            } elseif (preg_match('/.js|.min.map/', $file->name)) {
                $dir = $this->_jsDir;
            }

            if ($file->copy($dir->path . DS . $file->name)) {
                $this->success($file->name . ' successfully copied.');
            } else {
                $this->warn($file->name . ' could not be copied.');
            }
        }
    }

    /**
     * Clear folder of assets
     *
     * @param \Cake\Filesystem\Folder $folder Folder to clear
     * @param string $except Files to skip
     * @return bool
     */
    protected function _clear(Folder $folder, $except)
    {
        $files = $folder->findRecursive($except);
        foreach ($files as $file) {
            $file = new File($file);
            if (!$file->delete()) {
                return false;
            }
        }

        return true;
    }
}
