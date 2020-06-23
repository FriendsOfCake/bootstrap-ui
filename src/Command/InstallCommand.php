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
        $this->installPackages($io);
        $this->refreshAssetBuffer($io);
        $this->removePluginAssets($io);
        $this->linkPluginAssets($io);

        $io->out();
        $io->success('Installation completed.');

        return static::CODE_SUCCESS;
    }

    /**
     * Installs Bootstrap dependencies using NPM.
     *
     * @param \Cake\Console\ConsoleIo $io The console io.
     * @return void
     */
    public function installPackages(ConsoleIo $io): void
    {
        if (!$this->_isNPMAvailable()) {
            $io->error('NPM (https://www.npmjs.com/) is required, but not installed. Aborting.');
            $this->abort();
        }

        $io->info('Clearing `node_modules` folder (this can take a while)...');
        if (!$this->_deleteNodeModules()) {
            $io->error('Could not clear `node_modules` folder.');
            $this->abort();
        }
        $io->success('Cleared `node_modules` folder.');

        $io->info('Installing packages...');
        $this->_runNPMInstall($output, $return, $io);
        $io->out($output);

        if ($return !== 0) {
            $io->error('Package installation failed.');
            $this->abort($return);
        }
        $io->success('Packages installed successfully.');
    }

    /**
     * Extracts assets from node packages into the plugin's webroot.
     *
     * @param \Cake\Console\ConsoleIo $io The console io.
     * @return void
     */
    public function refreshAssetBuffer(ConsoleIo $io): void
    {
        $io->info('Refreshing package asset buffer...');
        if (!$this->_deleteBufferedPackageAssets($io)) {
            $io->error('Could not clear all buffered files.');
            $this->abort();
        } else {
            $io->success('All buffered files cleared.');
        }

        if (!$this->_bufferPackageAssets($io)) {
            $io->error('Could not buffer all files.');
            $this->abort();
        } else {
            $io->success('All files buffered.');
        }
    }

    /**
     * Removes possibly already linked plugin assets from the application's webroot.
     *
     * @param \Cake\Console\ConsoleIo $io The console io.
     * @return void
     */
    public function removePluginAssets(ConsoleIo $io): void
    {
        $io->info('Removing possibly existing plugin assets...');

        $result = $this->executeCommand(PluginAssetsRemoveCommand::class, ['name' => 'BootstrapUI'], $io);
        if (
            $result !== static::CODE_SUCCESS &&
            $result !== null
        ) {
            $io->error('Removing plugin assets failed.');
            $this->abort($result);
        }
    }

    /**
     * Links the plugin assets into the application's webroot.
     *
     * @param \Cake\Console\ConsoleIo $io The console io.
     * @return void
     */
    public function linkPluginAssets(ConsoleIo $io): void
    {
        $io->info('Linking plugin assets...');

        $result = $this->executeCommand(PluginAssetsSymlinkCommand::class, ['name' => 'BootstrapUI'], $io);
        if (
            $result !== static::CODE_SUCCESS &&
            $result !== null
        ) {
            $io->error('Linking plugin assets failed.');
            $this->abort($result);
        }
    }

    /**
     * Checks whether the NPM command is available.
     *
     * @return bool
     */
    protected function _isNPMAvailable(): bool
    {
        if ($this->_isWindows()) {
            $command = 'where npm';
        } else {
            $command = 'which npm';
        }

        return !!`$command`;
    }

    /**
     * Checks whether the OS in Windows based.
     *
     * @return bool
     */
    protected function _isWindows(): bool
    {
        return strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
    }

    /**
     * Deletes the `node_modules` folder.
     *
     * @return bool
     */
    protected function _deleteNodeModules(): bool
    {
        $path = Plugin::path('BootstrapUI') . 'node_modules';
        if (!is_dir($path)) {
            return true;
        }

        $nodeModulesFolder = new Folder($path);

        return $nodeModulesFolder->delete();
    }

    /**
     * Runs the NPM install command.
     *
     * @param array $output The variable to write the output to.
     * @param int $return The variable to write the return status code to.
     * @param \Cake\Console\ConsoleIo $io The console io.
     * @return void
     */
    protected function _runNPMInstall(&$output, &$return, ConsoleIo $io): void
    {
        $pluginPath = Plugin::path('BootstrapUI');
        if (!$this->_changeWorkingDirectory($pluginPath)) {
            $io->error("Could not change into plugin directory `$pluginPath`.");
            $this->abort();
        }

        switch ($io->level()) {
            case ConsoleIo::QUIET:
                if ($this->_isWindows()) {
                    $null = 'NUL';
                } else {
                    $null = '/dev/null';
                }

                $args = "--silent > $null";
                break;

            case ConsoleIo::VERBOSE:
                $args = '--verbose';
                break;

            default:
                $args = '';
        }
        exec("npm install $args", $output, $return);
    }

    /**
     * Changes the current working directory.
     *
     * @param string $path The path to change to.
     * @return bool
     */
    protected function _changeWorkingDirectory(string $path): bool
    {
        return chdir($path);
    }

    /**
     * Deletes the buffered package assets.
     *
     * @param \Cake\Console\ConsoleIo $io The console io.
     * @return bool
     */
    protected function _deleteBufferedPackageAssets(ConsoleIo $io): bool
    {
        $result = true;

        foreach ($this->_findBufferedPackageAssets() as $file) {
            if ($file->delete()) {
                $io->success("`{$file->name}` successfully deleted.", 1, ConsoleIo::VERBOSE);
            } else {
                $io->warning("`{$file->name}` could not be deleted.");
                $result = false;
            }
        }

        return $result;
    }

    /**
     * Finds the buffered package assets.
     *
     * @return \Cake\Filesystem\File[]
     */
    protected function _findBufferedPackageAssets(): array
    {
        $folder = new Folder(Plugin::path('BootstrapUI') . 'webroot', true);
        $except = '^(?!cover)(?!dashboard)(?!signin)(?!baked-with-cakephp\.svg).*$';

        $files = [];
        foreach ($folder->findRecursive($except) as $path) {
            $files[] = new File($path);
        }

        return $files;
    }

    /**
     * Buffers the MPN package assets in the respective folders in the plugin's webroot.
     *
     * @param \Cake\Console\ConsoleIo $io The console io.
     * @return bool
     */
    protected function _bufferPackageAssets(ConsoleIo $io): bool
    {
        $assetFolder = new Folder(Plugin::path('BootstrapUI') . 'webroot', true);
        $cssFolder = new Folder($assetFolder->path . DS . 'css', true);
        $jsFolder = new Folder($assetFolder->path . DS . 'js', true);

        $result = true;
        foreach ($this->_findPackageAssets() as $file) {
            $dir = null;
            if (preg_match('/\.css/', $file->name)) {
                $dir = $cssFolder;
            } elseif (preg_match('/\.js|\.min\.map/', $file->name)) {
                $dir = $jsFolder;
            }
            if ($dir === null) {
                $io->warning("Skipped `{$file->name}`.");
                continue;
            }

            if ($file->copy($dir->path . DS . $file->name)) {
                $io->success("`{$file->name}` successfully copied.", 1, ConsoleIo::VERBOSE);
            } else {
                $io->warning("`{$file->name}` could not be copied.");
                $result = false;
            }
        }

        return $result;
    }

    /**
     * Finds the package assets to buffer.
     *
     * @return \Cake\Filesystem\File[]
     */
    protected function _findPackageAssets(): array
    {
        $nodeDir = new Folder(Plugin::path('BootstrapUI') . 'node_modules', true);

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

        return $files;
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
