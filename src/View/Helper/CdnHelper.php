<?php

namespace BootstrapUI\View\Helper;

/**
 * CndHelper class to insert Bootstrap CDN css and javascript assests into layout.
 *
 */
 class CdnHelper extends \Cake\View\Helper
{

    /**
     * @var xxx
     */
    public $helpers = [
        'Html'
    ];

    /**
     * Default config
     *
     * - css: Full URL to most current TwitterBootstrap minified css
     * - script: Full URL to most current TwitterBootstrap minified js
     *
     * @var array
     */
    protected $_defaultConfig = [
        'css' => 'http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css',
        'script' => 'http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js'
    ];

    /**
     * xxx
     *
     * @return
     */
    public function getCss() {
        return $this->Html->css($this->config('css'));
    }

    /**
     * xxx
     *
     * @return
     */
    public function getScript() {
        return $this->Html->script($this->config('script'));
    }
}
