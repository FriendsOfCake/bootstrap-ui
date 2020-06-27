<?php
declare(strict_types=1);

namespace BootstrapUI\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;

/**
 * Modifies `AppView.php` to extend this plugin's `UIView` class.
 */
class ModifyViewCommand extends Command
{
    /**
     * @inheritDoc
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {
        $io->info('Modifying view...');

        $file = $args->getArgument('file');
        if ($file === null) {
            $file = $this->_getDefaultFilePath();
        }

        if (!$this->_modifyView($file)) {
            $io->error("Could not modify `$file`.");
            $this->abort();
        }

        $io->success("Modified `$file`.");

        return static::CODE_SUCCESS;
    }

    /**
     * Modifies the view file at the given path.
     *
     * @param string $filePath The path of the file to modify.
     * @return bool
     */
    protected function _modifyView(string $filePath): bool
    {
        if (!$this->_isFile($filePath)) {
            return false;
        }

        $content = $this->_readFile($filePath);
        if ($content === false) {
            return false;
        }

        $content = str_replace(
            'use Cake\\View\\View',
            'use BootstrapUI\\View\\UIView',
            $content
        );
        $content = str_replace(
            'class AppView extends View',
            'class AppView extends UIView',
            $content
        );
        $content = str_replace(
            "    public function initialize(): void\n    {\n",
            "    public function initialize(): void\n    {\n        parent::initialize();\n",
            $content
        );

        return $this->_writeFile($filePath, $content);
    }

    /**
     * Checks whether the given path points to a file.
     *
     * @param string $filePath The file path.
     * @return bool
     */
    protected function _isFile(string $filePath): bool
    {
        return is_file($filePath);
    }

    /**
     * Reads a files contents.
     *
     * @param string $filePath The file path.
     * @return false|string
     */
    protected function _readFile(string $filePath)
    {
        return file_get_contents($filePath);
    }

    /**
     * Writes to a file.
     *
     * @param string $filePath The file path.
     * @param string $content The content to write.
     * @return bool
     */
    protected function _writeFile(string $filePath, string $content): bool
    {
        return file_put_contents($filePath, $content) !== false;
    }

    /**
     * Returns the default `AppView.php` file path.
     *
     * @return string
     */
    protected function _getDefaultFilePath(): string
    {
        return APP . 'View' . DS . 'AppView.php';
    }

    /**
     * @inheritDoc
     */
    protected function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        return $parser
            ->setDescription(
                'Modifies `AppView.php` to extend this plugin\'s `UIView` class.'
            )
            ->addArgument('file', [
                'help' => sprintf(
                    'The path of the `AppView.php` file. Defaults to `%s`.',
                    $this->_getDefaultFilePath()
                ),
                'required' => false,
            ])
            ->setEpilog(
                '<warning>Don\'t run this command if you have a already modified the `AppView` class!</warning>'
            );
    }
}
