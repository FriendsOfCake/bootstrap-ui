<?php
namespace BootstrapUI\View\Helper;

use Cake\View\Helper\BreadcrumbsHelper as CoreBreadcrumbsHelper;

class BreadcrumbsHelper extends CoreBreadcrumbsHelper
{
    /**
     * @inheritdoc
     */
    protected $_defaultConfig = [
        'templates' => [
            'wrapper' => '<ol{{attrs}}>{{content}}</ol>',
            'item' => '<li{{attrs}}><a href="{{url}}"{{innerAttrs}}>{{title}}</a></li>{{separator}}',
            'itemWithoutLink' => '<li{{attrs}}><span{{innerAttrs}}>{{title}}</span></li>{{separator}}',
            'separator' => '<li{{attrs}}><span{{innerAttrs}}>{{separator}}</span></li>'
        ]
    ];

    /**
     * Default attributes for the wrapper
     *
     * @var array
     */
    protected $_defaultAttributes = [
        'class' => 'breadcrumb'
    ];

    /**
     * {@inheritDoc}
     */
    public function render(array $attributes = [], array $separator = [])
    {
        $attributes += $this->_defaultAttributes;

        return parent::render($attributes, $separator);
    }
}
