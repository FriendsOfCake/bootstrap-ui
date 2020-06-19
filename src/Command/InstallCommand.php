<?php
declare(strict_types=1);

namespace BootstrapUI\Command;

use Cake\Command\Command;
use Cake\Command\PluginAssetsRemoveCommand;
use Cake\Command\PluginAssetsSymlinkCommand;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\Core\Plugin;
use Cake\Filesystem\File;
use Cake\Filesystem\Folder;

/**
 * Installs Bootstrap dependencies and links the assets to the application's webroot.
 */
class InstallCommand extends Command
{
    /**
     * @inheritDoc
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {
        $this->_installPackages($io);
        $this->_extractAssets($io);
        $this->_removePluginAssets($io);
        $this->_linkPluginAssets($io);

        return static::CODE_SUCCESS;
    }

    /**
     * Installs Bootstrap dependencies using NPM.
     *
     * @param \Cake\Console\ConsoleIo $io The console io.
     * @return void
     */
    protected function _installPackages(ConsoleIo $io): void
    {
        $io->info('Checking npm...');
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $command = 'where npm';
        } else {
            $command = 'which npm';
        }
        if (!`$command`) {
            $io->error('NPM (https://www.npmjs.com/) is required, but not installed. Aborting.');
            $this->abort();
        }

        $pluginPath = Plugin::path('BootstrapUI');
        if (!chdir($pluginPath)) {
            $io->error("Could not change into plugin directory `$pluginPath`.");
            $this->abort();
        }

        $io->info('Clearing `node_modules` folder (this can take a while)...');
        $nodeModules = new Folder('node_modules');
        if ($nodeModules->delete()) {
            $io->success('Cleared `node_modules` folder.');
        }

        $io->info('Installing packages...');
        exec('npm install --verbose', $output, $return);
        $io->out($output);

        if ($return !== 0) {
            $io->error('Package installation failed.');
            $this->abort();
        }

        $io->success('Packages installed successfully.');
    }

    /**
     * Extracts assets from node packages into the plugin's webroot.
     *
     * @param \Cake\Console\ConsoleIo $io The console io.
     * @return void
     */
    protected function _extractAssets(ConsoleIo $io): void
    {
        $assetDir = new Folder(Plugin::path('BootstrapUI') . 'webroot', true);
        $nodeDir = new Folder(Plugin::path('BootstrapUI') . 'node_modules', true);

        $io->info('Clearing plugin webroot and extracting assets from installed packages...');
        if (!$this->_clear($assetDir, '^(?!cover)(?!dashboard)(?!signin)(?!baked-with-cakephp\.svg).*$', $io)) {
            $io->warning('Could not clear all files.');
        } else {
            $io->success('All files cleared.');
        }

        $files = [];
        $folders = [];
        $folders[] = new Folder($nodeDir->path . DS . 'bootstrap/dist');
        $folders[] = new Folder($nodeDir->path . DS . 'jquery/dist');
        $folders[] = new Folder($nodeDir->path . DS . 'popper.js/dist/umd');

        foreach ($folders as $folder) {
            foreach ($folder->findRecursive() as $file) {
                $files[] = new File($file);
            }
        }
        $this->_copy($files, $io);
    }

    /**
     * Removes possibly already linked plugin assets from the application's webroot.
     *
     * @param \Cake\Console\ConsoleIo $io The console io.
     * @return void
     */
    protected function _removePluginAssets(ConsoleIo $io): void
    {
        $io->info('Removing possibly existing plugin assets...');

        $result = $this->executeCommand(PluginAssetsRemoveCommand::class, ['name' => 'BootstrapUI'], $io);
        if (
            $result !== static::CODE_SUCCESS &&
            $result !== null
        ) {
            $this->abort($result);
        }
    }

    /**
     * Links the plugin assets into the application's webroot.
     *
     * @param \Cake\Console\ConsoleIo $io The console io.
     * @return void
     */
    protected function _linkPluginAssets(ConsoleIo $io): void
    {
        $io->info('Linking plugin assets...');

        $result = $this->executeCommand(PluginAssetsSymlinkCommand::class, ['name' => 'BootstrapUI'], $io);
        if (
            $result !== static::CODE_SUCCESS &&
            $result !== null
        ) {
            $this->abort($result);
        }
    }

    /**
     * Copies asset files into their respective css/js asset directories.
     *
     * @param array $files Asset files to copy.
     * @param \Cake\Console\ConsoleIo $io The console io.
     * @return void
     */
    protected function _copy(array $files, ConsoleIo $io): void
    {
        $assetDir = new Folder(Plugin::path('BootstrapUI') . 'webroot', true);
        $cssDir = new Folder($assetDir->path . DS . 'css', true);
        $jsDir = new Folder($assetDir->path . DS . 'js', true);

        foreach ($files as $file) {
            $dir = null;
            if (preg_match('/\.css/', $file->name)) {
                $dir = $cssDir;
            } elseif (preg_match('/\.js|\.min\.map/', $file->name)) {
                $dir = $jsDir;
            }
            if ($dir === null) {
                $io->warning("Skipped `{$file->name}`.");
                continue;
            }

            if ($file->copy($dir->path . DS . $file->name)) {
                $io->success("`{$file->name}` successfully copied.");
            } else {
                $io->warning("`{$file->name}` could not be copied.");
            }
        }
    }

    /**
     * Deletes files from a directory except those matching the given exclusion regex.
     *
     * @param \Cake\Filesystem\Folder $folder Folder to clear.
     * @param string $except Files to skip.
     * @param \Cake\Console\ConsoleIo $io The console io.
     * @return bool
     */
    protected function _clear(Folder $folder, string $except, ConsoleIo $io): bool
    {
        $files = $folder->findRecursive($except);
        foreach ($files as $file) {
            $file = new File($file);
            if (!$file->delete()) {
                $io->warning("`{$file->name}` could not be deleted.");

                return false;
            }
            $io->success("`{$file->name}` successfully deleted.");
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    protected function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        return $parser
            ->setDescription(
                'Installs Bootstrap dependencies and links the assets to the application\'s webroot.'
            );
    }
}
