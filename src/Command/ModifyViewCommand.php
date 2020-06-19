<?php
declare(strict_types=1);

namespace BootstrapUI\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\Filesystem\File;

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
        $view = new File($file);

        $result = $view->replaceText(
            'use Cake\\View\\View',
            'use BootstrapUI\\View\\UIView'
        );
        $result = $result && $view->replaceText(
            'class AppView extends View',
            'class AppView extends UIView'
        );
        $result = $result && $view->replaceText(
            "    public function initialize(): void\n    {\n",
            "    public function initialize(): void\n    {\n        parent::initialize();\n"
        );

        if (!$result) {
            $io->error("Could not modify `$file`.");
            $this->abort();
        }

        $io->success("Modified `$file`.");

        return static::CODE_SUCCESS;
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
