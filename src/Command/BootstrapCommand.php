<?php
declare(strict_types=1);

namespace BootstrapUI\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\CommandCollection;
use Cake\Console\CommandCollectionAwareInterface;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\Utility\Text;

/**
 * Provides an entry point with help information and a list of the available commands.
 */
class BootstrapCommand extends Command implements CommandCollectionAwareInterface
{
    /**
     * The command collection to get help on.
     *
     * @var \Cake\Console\CommandCollection
     */
    protected $commands;

    /**
     * @inheritDoc
     */
    public function setCommandCollection(CommandCollection $commands): void
    {
        $this->commands = $commands;
    }

    /**
     * @inheritDoc
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {
        $io->warning('No command provided. Run `bootstrap --help` to get a list of commands.');

        return static::CODE_ERROR;
    }

    /**
     * @inheritDoc
     */
    protected function displayHelp(ConsoleOptionParser $parser, Arguments $args, ConsoleIo $io): void
    {
        $io->out(Text::wrap($parser->getDescription(), 72), 2);
        $io->info('Available Commands:', 2);

        foreach ($this->commands as $command => $class) {
            if (substr($command, 0, 10) === 'bootstrap ') {
                $io->out("- $command");
            }
        }

        $io->out();
        $io->out('To run a command, type <info>`bootstrap command_name [args|options]`</info>');
        $io->out('To get help on a specific command, type <info>`bootstrap command_name --help`</info>', 2);
    }

    /**
     * @inheritDoc
     */
    protected function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        return $parser
            ->setDescription(
                'The BootstrapUI console provides commands for installing dependencies ' .
                'and samples, and for modifying your application to use BootstrapUI.'
            );
    }
}
