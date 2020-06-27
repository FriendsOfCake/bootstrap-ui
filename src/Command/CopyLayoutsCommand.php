<?php
declare(strict_types=1);

namespace BootstrapUI\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\Core\Plugin;
use Cake\Filesystem\Filesystem;

/**
 * Copies the sample layouts into the application's layout templates folder.
 */
class CopyLayoutsCommand extends Command
{
    /**
     * @inheritDoc
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {
        $io->info('Copying sample layouts...');

        $target = $args->getArgument('target');
        if ($target === null) {
            $target = $this->_getDefaultTargetPath();
        }

        if (!$this->_copyLayouts($target)) {
            $io->error("Sample layouts could not be copied to `$target`.");
            $this->abort();
        }

        $io->success("Sample layouts copied successfully to `$target`.");

        return static::CODE_SUCCESS;
    }

    /**
     * Copies the layouts to the given path.
     *
     * @param string $targetPath The path where to copy the files to.
     * @return bool
     */
    protected function _copyLayouts(string $targetPath): bool
    {
        $source = Plugin::path('BootstrapUI') . 'templates' . DS . 'layout' . DS . 'examples';

        $filesystem = new Filesystem();

        return $filesystem->copyDir($source, $targetPath);
    }

    /**
     * Returns the default layouts target path.
     *
     * @return string
     */
    protected function _getDefaultTargetPath(): string
    {
        return dirname(APP) . DS . 'templates' . DS . 'layout' . DS . 'TwitterBootstrap' . DS;
    }

    /**
     * @inheritDoc
     */
    protected function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        return $parser
            ->setDescription(
                'Copies the sample layouts into the application\'s layout templates folder.'
            )
            ->addArgument('target', [
                'help' => sprintf(
                    'The target path into which to copy the layout files. Defaults to `%s`.',
                    $this->_getDefaultTargetPath()
                ),
                'required' => false,
            ]);
    }
}
