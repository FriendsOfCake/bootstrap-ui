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
use Cake\Filesystem\Filesystem;

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
        $this->installPackages($args, $io);
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
     * @param \Cake\Console\Arguments $args The command arguments.
     * @param \Cake\Console\ConsoleIo $io The console io.
     * @return void
     */
    public function installPackages(Arguments $args, ConsoleIo $io): void
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

        $output = [];
        $return = 0;
        $this->_runNPMInstall($output, $return, $io, $args->getOption('latest') === true);
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
        $filesystem = new Filesystem();

        return $filesystem->deleteDir(Plugin::path('BootstrapUI') . 'node_modules');
    }

    /**
     * Runs the NPM install command.
     *
     * @param array $output The variable to write the output to.
     * @param int $return The variable to write the return status code to.
     * @param \Cake\Console\ConsoleIo $io The console io.
     * @param bool $useLatest Whether to install the latest minor versions.
     * @return void
     */
    protected function _runNPMInstall(array &$output, int &$return, ConsoleIo $io, bool $useLatest = false): void
    {
        $pluginPath = Plugin::path('BootstrapUI');
        if (!$this->_changeWorkingDirectory($pluginPath)) {
            $io->error("Could not change into plugin directory `$pluginPath`.");
            $this->abort();
        }

        $args = [];
        if ($useLatest) {
            $args[] = '--package-lock false';
        }
        switch ($io->level()) {
            case ConsoleIo::QUIET:
                if ($this->_isWindows()) {
                    $null = 'NUL';
                } else {
                    $null = '/dev/null';
                }

                $args[] = "--silent > $null";
                break;

            case ConsoleIo::VERBOSE:
                $args[] = '--verbose';
                break;
        }
        $args = implode(' ', $args);

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
            if (
                is_file($file->getPathname()) &&
                unlink($file->getPathname())
            ) {
                $io->success("`{$file->getFilename()}` successfully deleted.", 1, ConsoleIo::VERBOSE);
            } else {
                $io->warning("`{$file->getFilename()}` could not be deleted.");
                $result = false;
            }
        }

        return $result;
    }

    /**
     * Finds the buffered package assets.
     *
     * @return \SplFileInfo[]
     */
    protected function _findBufferedPackageAssets(): array
    {
        $filesystem = new Filesystem();

        $path = Plugin::path('BootstrapUI') . 'webroot';
        $except = '@
            ^.*
            (?<!(\\\\|\/)cover\.css)
            (?<!(\\\\|\/)dashboard\.css)
            (?<!(\\\\|\/)signin\.css)
            (?<!(\\\\|\/)bootstrap-icon-sizes\.css)
            (?<!(\\\\|\/)baked-with-cakephp\.svg)
            $
        @ix';

        $files = [];
        /** @var \SplFileInfo $file */
        foreach ($filesystem->findRecursive($path, $except) as $file) {
            if ($file->isFile()) {
                $files[] = $file;
            }
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
        $filesystem = new Filesystem();

        $webrootPath = Plugin::path('BootstrapUI') . 'webroot' . DS;
        $cssPath = $webrootPath . 'css' . DS;
        $fontPath = $webrootPath . 'font' . DS;
        $jsPath = $webrootPath . 'js' . DS;

        $result = true;
        foreach ($this->_findPackageAssets() as $file) {
            $assetPath = null;

            $matches = [];
            $DS = preg_quote(DS, '/');
            if (
                preg_match(
                    "/{$DS}font{$DS}(?P<subdirs>.+{$DS})?.+\\.(css|woff|woff2)$/",
                    $file->getPathname(),
                    $matches
                )
            ) {
                $assetPath = $fontPath;
            } elseif (preg_match('/\.css(\.map)?$/', $file->getFilename())) {
                $assetPath = $cssPath;
            } elseif (preg_match('/\.js(\.map)?$/', $file->getFilename())) {
                $assetPath = $jsPath;
            }

            if ($assetPath === null) {
                $io->info("Skipped `{$file->getFilename()}`.", 1, ConsoleIo::VERBOSE);
                continue;
            }

            if (
                isset($matches['subdirs']) &&
                $matches['subdirs']
            ) {
                $assetPath .= $matches['subdirs'];
            }

            $filesystem->mkdir($assetPath);

            if (
                is_file($file->getPathname()) &&
                copy($file->getPathname(), $assetPath . $file->getFilename())
            ) {
                $io->success("`{$file->getFilename()}` successfully copied.", 1, ConsoleIo::VERBOSE);
            } else {
                $io->warning("`{$file->getFilename()}` could not be copied.");
                $result = false;
            }
        }

        return $result;
    }

    /**
     * Finds the package assets to buffer.
     *
     * @return \SplFileInfo[]
     */
    protected function _findPackageAssets(): array
    {
        $filesystem = new Filesystem();

        $nodeModulesPath = Plugin::path('BootstrapUI') . 'node_modules' . DS;
        $paths = [
            $nodeModulesPath . '@popperjs/core/dist/umd',
            $nodeModulesPath . 'bootstrap/dist',
            $nodeModulesPath . 'bootstrap-icons',
        ];

        $files = [];
        foreach ($paths as $path) {
            /** @var \SplFileInfo $file */
            foreach ($filesystem->findRecursive($path) as $file) {
                if ($file->isFile()) {
                    $files[] = $file;
                }
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
            )
            ->addOption('latest', [
                'help' => 'To install the latest minor versions of required assets.',
                'required' => false,
                'boolean' => true,
                'short' => 'l',
            ]);
    }
}
