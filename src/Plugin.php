<?php
declare(strict_types=1);

namespace BootstrapUI;

use BootstrapUI\Command\BootstrapCommand;
use BootstrapUI\Command\CopyLayoutsCommand;
use BootstrapUI\Command\InstallCommand;
use BootstrapUI\Command\ModifyViewCommand;
use Cake\Console\CommandCollection;
use Cake\Core\BasePlugin;

class Plugin extends BasePlugin
{
    /**
     * Plugin name.
     *
     * @var string
     */
    protected $name = 'BootstrapUI';

    /**
     * @inheritDoc
     */
    public function console(CommandCollection $commands): CommandCollection
    {
        return $commands
            ->add('bootstrap', BootstrapCommand::class)
            ->add('bootstrap install', InstallCommand::class)
            ->add('bootstrap modify_view', ModifyViewCommand::class)
            ->add('bootstrap copy_layouts', CopyLayoutsCommand::class);
    }
}
