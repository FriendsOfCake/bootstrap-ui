<?php

namespace BootstrapUI\View\Helper;

/**
 * CndHelper class to insert Bootstrap CDN css and javascript assests into layout.
 *
 */
//class CdnHelper extends \Cake\View\Helper
class CdnHelper extends \Cake\View\Helper\HtmlHelper
{

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
     *
     * @return
     */
    public function getCss() {
        return parent::css($this->config('css'));
    }

    /**
     *
     * @return
     */
    public function getScript() {
        return parent::script($this->config('script'));
    }
}
