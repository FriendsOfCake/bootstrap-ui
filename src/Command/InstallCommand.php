<?php
declare(strict_types=1);

namespace BootstrapUI\Command;

use Cake\Command\Command;
use Cake\Command\PluginAssetsRemoveCommand;
use Cake\Command\PluginAssetsSymlinkCommand;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIoInterface;
use Cake\Console\ConsoleOptionParser;
use Cake\Core\Plugin;
use Cake\Utility\Filesystem;

/**
 * Installs Bootstrap dependencies and links the assets to the application's webroot.
 */
class InstallCommand extends Command
{
    /**
     * @return string
     */
    public static function getDescription(): string
    {
        return 'Install Bootstrap dependencies and link assets.';
    }

    /**
     * @inheritDoc
     */
    public function execute(): ?int
    {
        $this->installPackages();
        $this->refreshAssetBuffer();
        $this->removePluginAssets();
        $this->linkPluginAssets();
        $this->io->out();
        $this->io->success('Installation completed.');

        return static::CODE_SUCCESS;
    }

    /**
     * Installs Bootstrap dependencies using NPM.

     * @return void
     */
    public function installPackages(): void
    {
        if (!$this->isNPMAvailable()) {
            $this->io->error('NPM (https://www.npmjs.com/) is required, but not installed. Aborting.');
            $this->abort();
        }
        $this->io->info('Clearing `node_modules` folder (this can take a while)...');
        if (!$this->deleteNodeModules()) {
            $this->io->error('Could not clear `node_modules` folder.');
            $this->abort();
        }
        $this->io->success('Cleared `node_modules` folder.');
        $this->io->info('Installing packages...');
        $output = [];
        $return = 0;
        $this->runNPMInstall($output, $return, $this->args->getOption('latest') === true);
        $this->io->out($output);
        if ($return !== 0) {
            $this->io->error('Package installation failed.');
            $this->abort($return);
        }
        $this->io->success('Packages installed successfully.');
    }

    /**
     * Extracts assets from node packages into the plugin's webroot.
     *
     * @return void
     */
    public function refreshAssetBuffer(): void
    {
        $this->io->info('Refreshing package asset buffer...');
        if (!$this->deleteBufferedPackageAssets()) {
            $this->io->error('Could not clear all buffered files.');
            $this->abort();
        } else {
            $this->io->success('All buffered files cleared.');
        }
        if (!$this->bufferPackageAssets()) {
            $this->io->error('Could not buffer all files.');
            $this->abort();
        } else {
            $this->io->success('All files buffered.');
        }
    }

    /**
     * Removes possibly already linked plugin assets from the application's webroot.
     *
     * @return void
     */
    public function removePluginAssets(): void
    {
        $this->io->info('Removing possibly existing plugin assets...');
        $result = $this->executeCommand(PluginAssetsRemoveCommand::class, ['name' => 'BootstrapUI']);
        if (
            $result !== static::CODE_SUCCESS &&
            $result !== null
        ) {
            $this->io->error('Removing plugin assets failed.');
            $this->abort($result);
        }
    }

    /**
     * Links the plugin assets into the application's webroot.
     *
     * @return void
     */
    public function linkPluginAssets(): void
    {
        $this->io->info('Linking plugin assets...');
        $result = $this->executeCommand(PluginAssetsSymlinkCommand::class, ['name' => 'BootstrapUI']);
        if (
            $result !== static::CODE_SUCCESS &&
            $result !== null
        ) {
            $this->io->error('Linking plugin assets failed.');
            $this->abort($result);
        }
    }

    /**
     * Checks whether the NPM command is available.
     *
     * @return bool
     */
    protected function isNPMAvailable(): bool
    {
        if ($this->isWindows()) {
            $command = 'where npm';
        } else {
            $command = 'which npm';
        }

        return !!shell_exec($command);
    }

    /**
     * Checks whether the OS in Windows based.
     *
     * @return bool
     */
    protected function isWindows(): bool
    {
        return strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
    }

    /**
     * Deletes the `node_modules` folder.
     *
     * @return bool
     */
    protected function deleteNodeModules(): bool
    {
        $filesystem = new Filesystem();

        return $filesystem->deleteDir(Plugin::path('BootstrapUI') . 'node_modules');
    }

    /**
     * Runs the NPM install command.
     *
     * @param array<int, string> $output The variable to write the output to.
     * @param int $return The variable to write the return status code to.
     * @param bool $useLatest Whether to install the latest minor versions.
     * @return void
     */
    protected function runNPMInstall(array &$output, int &$return, bool $useLatest = false): void
    {
        $pluginPath = Plugin::path('BootstrapUI');
        $previousCwd = getcwd();
        if (!$this->changeWorkingDirectory($pluginPath)) {
            $this->io->error("Could not change into plugin directory `$pluginPath`.");
            $this->abort();
        }

        try {
            $args = [];
            if ($useLatest) {
                $args[] = '--package-lock false';
            }
            switch ($this->io->level()) {
                case ConsoleIoInterface::QUIET:
                    if ($this->isWindows()) {
                        $null = 'NUL';
                    } else {
                        $null = '/dev/null';
                    }

                    $args[] = "--silent > $null";
                    break;

                case ConsoleIoInterface::VERBOSE:
                    $args[] = '--verbose';
                    break;
            }
            $args = implode(' ', $args);

            exec("npm install $args", $output, $return);
        } finally {
            if ($previousCwd !== false) {
                $this->changeWorkingDirectory($previousCwd);
            }
        }
    }

    /**
     * Changes the current working directory.
     *
     * @param string $path The path to change to.
     * @return bool
     */
    protected function changeWorkingDirectory(string $path): bool
    {
        return chdir($path);
    }

    /**
     * Deletes the buffered package assets.
     *
     * @return bool
     */
    protected function deleteBufferedPackageAssets(): bool
    {
        $result = true;
        foreach ($this->findBufferedPackageAssets() as $file) {
            if (
                is_file($file->getPathname()) &&
                unlink($file->getPathname())
            ) {
                $this->io->success("`{$file->getFilename()}` successfully deleted.", 1, ConsoleIoInterface::VERBOSE);
            } else {
                $this->io->warning("`{$file->getFilename()}` could not be deleted.");
                $result = false;
            }
        }

        return $result;
    }

    /**
     * Finds the buffered package assets.
     *
     * @return array<\SplFileInfo>
     */
    protected function findBufferedPackageAssets(): array
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
     * @return bool
     */
    protected function bufferPackageAssets(): bool
    {
        $filesystem = new Filesystem();
        $webrootPath = Plugin::path('BootstrapUI') . 'webroot' . DS;
        $cssPath = $webrootPath . 'css' . DS;
        $fontPath = $webrootPath . 'font' . DS;
        $jsPath = $webrootPath . 'js' . DS;
        $result = true;
        foreach ($this->findPackageAssets() as $file) {
            $assetPath = null;

            $matches = [];
            $DS = preg_quote(DS, '/');
            if (
                preg_match(
                    "/{$DS}font{$DS}(?P<subdirs>.+{$DS})?.+\\.(css|woff|woff2)$/",
                    $file->getPathname(),
                    $matches,
                )
            ) {
                $assetPath = $fontPath;
            } elseif (preg_match('/\.css(\.map)?$/', $file->getFilename())) {
                $assetPath = $cssPath;
            } elseif (preg_match('/\.js(\.map)?$/', $file->getFilename())) {
                $assetPath = $jsPath;
            }

            if ($assetPath === null) {
                $this->io->info("Skipped `{$file->getFilename()}`.", 1, ConsoleIoInterface::VERBOSE);
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
                $this->io->success("`{$file->getFilename()}` successfully copied.", 1, ConsoleIoInterface::VERBOSE);
            } else {
                $this->io->warning("`{$file->getFilename()}` could not be copied.");
                $result = false;
            }
        }

        return $result;
    }

    /**
     * Finds the package assets to buffer.
     *
     * @return array<\SplFileInfo>
     */
    protected function findPackageAssets(): array
    {
        $filesystem = new Filesystem();

        $nodeModulesPath = Plugin::path('BootstrapUI') . 'node_modules' . DS;
        $paths = [
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
                'Installs Bootstrap dependencies and links the assets to the application\'s webroot.',
            )
            ->addOption('latest', [
                'help' => 'To install the latest minor versions of required assets.',
                'required' => false,
                'boolean' => true,
                'short' => 'l',
            ]);
    }

    /**
     * Sets the command line arguments.
     *
     * @param \Cake\Console\Arguments $args The command line arguments.
     * @return void
     */
    public function setArgs(Arguments $args): void
    {
        $this->args = $args;
    }
}
