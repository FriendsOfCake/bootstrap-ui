<?php
declare(strict_types=1);

namespace BootstrapUI\Command;

use Cake\Command\Command;
use Cake\Console\ConsoleOptionParser;

/**
 * Modifies `AppView.php` to extend this plugin's `UIView` class.
 */
class ModifyViewCommand extends Command
{
    /**
     * @return string
     */
    public static function getDescription(): string
    {
        return 'Modify AppView to extend UIView.';
    }

    /**
     * @inheritDoc
     */
    public function execute(): ?int
    {
        $this->io->info('Modifying view...');
        $file = $this->args->getArgument('file');
        if ($file === null) {
            $file = $this->getDefaultFilePath();
        }
        if (!$this->modifyView($file)) {
            $this->io->error("Could not modify `$file`.");
            $this->abort();
        }
        $this->io->success("Modified `$file`.");

        return static::CODE_SUCCESS;
    }

    /**
     * Modifies the view file at the given path.
     *
     * @param string $filePath The path of the file to modify.
     * @return bool
     */
    protected function modifyView(string $filePath): bool
    {
        if (!$this->isFile($filePath)) {
            return false;
        }

        $content = $this->readFile($filePath);
        if ($content === false) {
            return false;
        }

        $original = $content;

        if (!str_contains($content, 'use BootstrapUI\\View\\UIView')) {
            $content = str_replace(
                'use Cake\\View\\View',
                'use BootstrapUI\\View\\UIView',
                $content,
            );
        }
        if (!str_contains($content, 'class AppView extends UIView')) {
            $content = str_replace(
                'class AppView extends View',
                'class AppView extends UIView',
                $content,
            );
        }
        if (!str_contains($content, 'parent::initialize();')) {
            $content = str_replace(
                "    public function initialize(): void\n    {\n",
                "    public function initialize(): void\n    {\n        parent::initialize();\n",
                $content,
            );
        }

        if ($content === $original) {
            return false;
        }

        return $this->writeFile($filePath, $content);
    }

    /**
     * Checks whether the given path points to a file.
     *
     * @param string $filePath The file path.
     * @return bool
     */
    protected function isFile(string $filePath): bool
    {
        return is_file($filePath);
    }

    /**
     * Reads a files contents.
     *
     * @param string $filePath The file path.
     * @return string|false
     */
    protected function readFile(string $filePath): false|string
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
    protected function writeFile(string $filePath, string $content): bool
    {
        return file_put_contents($filePath, $content) !== false;
    }

    /**
     * Returns the default `AppView.php` file path.
     *
     * @return string
     */
    protected function getDefaultFilePath(): string
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
                'Modifies `AppView.php` to extend this plugin\'s `UIView` class.',
            )
            ->addArgument('file', [
                'help' => sprintf(
                    'The path of the `AppView.php` file. Defaults to `%s`.',
                    $this->getDefaultFilePath(),
                ),
                'required' => false,
            ])
            ->setEpilog(
                '<warning>Don\'t run this command if you have a already modified the `AppView` class!</warning>',
            );
    }
}
