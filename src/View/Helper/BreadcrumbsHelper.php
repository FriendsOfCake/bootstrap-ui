<?php
namespace BootstrapUI\View\Helper;

use Cake\View\Helper\BreadcrumbsHelper as CoreBreadcrumbsHelper;

class BreadcrumbsHelper extends CoreBreadcrumbsHelper
{
    use OptionsAwareTrait;
    /**
     * @inheritdoc
     */
    protected $_defaultConfig = [
        'templates' => [
            'wrapper' => '<nav aria-label="breadcrumb"><ol{{attrs}}>{{content}}</ol></nav>',
            'item' => '<li{{attrs}}><a href="{{url}}"{{innerAttrs}}>{{title}}</a></li>',
            'itemWithoutLink' => '<li{{attrs}} aria-current="page"><span{{innerAttrs}}>{{title}}</span></li>',
            'separator' => ''
        ]
    ];

    /**
     * Default attributes for the templates
     *
     * @var array
     */
    protected $_defaultAttributes = [
        'class' => [
            'wrapper' => 'breadcrumb',
            'item' => 'breadcrumb-item',
            'itemWithoutLink' => 'breadcrumb-item active'
        ]
    ];

    /**
     * {@inheritDoc}
     */
    public function render(array $attributes = [], array $separator = [])
    {
        $attributes = $this->injectClasses($this->_defaultAttributes['class']['wrapper'], $attributes);

        return parent::render($attributes, $separator);
    }

    /**
     * {@inheritDoc}
     */
    public function add($title, $url = null, array $options = [])
    {
        $options = $this->injectClasses($this->_defaultAttributes['class']['item'], $options);

        return parent::add($title, $url, $options);
    }
}
