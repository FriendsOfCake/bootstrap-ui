<?php
namespace BootstrapUI;

use Cake\Core\BasePlugin;

/**
 * Plugin class for BootstrapUI
 */
class Plugin extends BasePlugin
{
    /**
     * Plugin name.
     *
     * @var string
     */
    protected $name = 'BootstrapUI';

    /**
     * @var bool
     */
    protected $bootstrapEnabled = false;

    /**
     * @var bool
     */
    protected $routesEnabled = false;

    /**
     * @var bool
     */
    protected $consoleEnabled = false;
}
