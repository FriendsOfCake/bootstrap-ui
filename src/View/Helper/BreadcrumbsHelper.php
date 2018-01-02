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
            'wrapper' => '<nav aria-label="breadcrumb"><ol{{attrs}}>{{content}}</ol></nav>',
            'item' => '<li class="breadcrumb-item"{{attrs}}><a href="{{url}}"{{innerAttrs}}>{{title}}</a></li>',
            'itemWithoutLink' => '<li class="breadcrumb-item active" aria-current="page"{{attrs}}><span{{innerAttrs}}>{{title}}</span></li>',
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
