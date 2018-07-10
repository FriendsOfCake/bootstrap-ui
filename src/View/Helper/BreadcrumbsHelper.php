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
        'ariaCurrent' => 'last',
        'templates' => [
            'wrapper' => '<nav aria-label="breadcrumb"><ol{{attrs}}>{{content}}</ol></nav>',
            'item' => '<li{{attrs}}><a href="{{url}}"{{innerAttrs}}>{{title}}</a></li>',
            'itemWithoutLink' => '<li{{attrs}}><span{{innerAttrs}}>{{title}}</span></li>',
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
            'item' => 'breadcrumb-item'
        ]
    ];

    /**
     * {@inheritDoc}
     */
    public function render(array $attributes = [], array $separator = [])
    {
        $attributes = $this->injectClasses($this->_defaultAttributes['class']['wrapper'], $attributes);

        $this->_injectAriaCurrentAttribute();

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

    /**
     * {@inheritDoc}
     */
    public function prepend($title, $url = null, array $options = [])
    {
        $options = $this->injectClasses($this->_defaultAttributes['class']['item'], $options);

        return parent::prepend($title, $url, $options);
    }

    /**
     * {@inheritDoc}
     */
    public function insertAt($index, $title, $url = null, array $options = [])
    {
        $options = $this->injectClasses($this->_defaultAttributes['class']['item'], $options);

        return parent::insertAt($index, $title, $url, $options);
    }

    /**
     * Injects the `aria-current` attribute into the current set of crumbs.
     *
     * @return void
     */
    protected function _injectAriaCurrentAttribute()
    {
        if (!$this->crumbs) {
            return;
        }

        $this->_removeAriaCurrentAttribute();

        $key = null;
        if ($this->getConfig('ariaCurrent') === 'lastWithLink') {
            foreach (array_reverse($this->crumbs, true) as $key => $crumb) {
                if (isset($crumb['url'])) {
                    break;
                }
            }
        } else {
            $key = count($this->crumbs) - 1;
        }

        if (!$key) {
            return;
        }

        if (isset($this->crumbs[$key]['url'])) {
            $this->crumbs[$key]['options']['innerAttrs']['aria-current'] = 'page';
        } else {
            $this->crumbs[$key]['options']['aria-current'] = 'page';
        }
    }

    /**
     * Removes the `aria-current` attribute from the current set of crumbs.
     *
     * @return void
     */
    protected function _removeAriaCurrentAttribute()
    {
        foreach ($this->crumbs as $key => $crumb) {
            unset(
                $this->crumbs[$key]['options']['innerAttrs']['aria-current'],
                $this->crumbs[$key]['options']['aria-current']
            );
        }
    }
}
