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
    private $_assetDir;
    private $_nodeDir;
    private $_cssDir;
    private $_jsDir;

    /**
     * TwbsAssetsTask constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->_assetDir = new Folder(Plugin::path('BootstrapUI') . 'webroot');
        $this->_nodeDir = new Folder(Plugin::path('BootstrapUI') . 'node_modules');
        $this->_cssDir = new Folder($this->_assetDir->path . DS . 'css');
        $this->_jsDir = new Folder($this->_assetDir->path . DS . 'js');
    }

    /**
     * Installs Bootstrap assets using npm
     *
     * @return void
     */
    public function installAssets()
    {
        $this->out('<info>Checking npm...</info>');
        if (!`which npm`) {
            $this->abort(__('NPM (https://www.npmjs.com/) is required, but not installed. Aborting.'));
        }

        chdir(Plugin::path('BootstrapUI'));
        $node_mod = new Folder('node_modules');
        if ($node_mod->delete()) {
            $this->out(__('<success>Cleared node_modules...</success>'));
        }

        exec('npm install --verbose', $output, $return);
        $this->out($output);
        if ($return === 0) {
            $this->out('<success>Bootstrap assets installed successfully.</success>');
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
        $this->out('<info>Clearing webroot and copying assets...</info>');
        if ($this->_clear($this->_assetDir, '^(?!cover)(?!dashboard)(?!signin).*$')) {
            $this->out('<success>All files cleared...</success>');
        }

        if (Configure::read('debug') === true) {
            $folders[] = new Folder($this->_nodeDir->path . DS . 'bootstrap/dist');
            $folders[] = new Folder($this->_nodeDir->path . DS . 'jquery/dist');
            $folders[] = new Folder($this->_nodeDir->path . DS . 'popper.js/dist');

            foreach ($folders as $folder) {
                foreach ($folder->findRecursive() as $file) {
                    $files[] = new File($file);
                }
            }
        } else {
            $files[] = new File($this->_nodeDir->path . DS . 'bootstrap' . DS . 'dist' . DS . 'css' . DS . 'bootstrap.min.css');
            $files[] = new File($this->_nodeDir->path . DS . 'bootstrap' . DS . 'dist' . DS . 'js' . DS . 'bootstrap.min.js');
            $files[] = new File($this->_nodeDir->path . DS . 'jquery' . DS . 'dist' . DS . 'jquery.min.js');
            $files[] = new File($this->_nodeDir->path . DS . 'popper.js' . DS . 'dist' . DS . 'popper.min.js');
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
        $this->out(__('<info>Copying sample layouts...</info>'));
        $layoutDir = new Folder(Plugin::path('BootstrapUI') . 'src' . DS . 'Template' . DS . 'Layout' . DS . 'examples');

        if ($target == null) {
            $target = APP . 'Template' . DS . 'Layout' . DS . 'TwitterBootstrap';
        }

        if (!$layoutDir->copy($target)) {
            $this->abort('Sample layouts could not be copied.');
        }
        $this->out('<success>Sample layouts copied successfully.</success>');
    }

    /**
     * Copy files to assetdir's css/js path
     *
     * @param array $files Assetfiles to copy
     * @return void
     */
    private function _copy(array $files)
    {
        foreach ($files as $file) {
            if ($file->ext() == 'css') {
                $dir = $this->_cssDir;
            } elseif ($file->ext() == 'js') {
                $dir = $this->_jsDir;
            }

            if ($file->copy($dir->path . DS . $file->name)) {
                $this->out('<success>' . $file->name . ' successfully copied.</success>');
            } else {
                $this->out('<warning>' . $file->name . ' could not be copied.</warning>');
            }
        }
    }

    /**
     * Clear folder of assets
     * 
     * @param Cake\Filesystem\Folder $folder Folder to clear
     * @param string $except Files to skip
     * @return bool
     */
    private function _clear($folder, $except)
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
