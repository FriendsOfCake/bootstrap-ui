<?php
declare(strict_types=1);

namespace BootstrapUI\View\Helper;

use Cake\View\Helper\BreadcrumbsHelper as CoreBreadcrumbsHelper;

class BreadcrumbsHelper extends CoreBreadcrumbsHelper
{
    use OptionsAwareTrait;

    /**
     * @inheritDoc
     */
    protected $_defaultConfig = [
        'ariaCurrent' => 'last',
        'templates' => [
            'wrapper' => '<nav aria-label="breadcrumb"><ol{{attrs}}>{{content}}</ol></nav>',
            'item' => '<li{{attrs}}><a href="{{url}}"{{innerAttrs}}>{{title}}</a></li>',
            'itemWithoutLink' => '<li{{attrs}}><span{{innerAttrs}}>{{title}}</span></li>',
            'separator' => '',
        ],
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
        ],
    ];

    /**
     * @inheritDoc
     */
    public function render(array $attributes = [], array $separator = []): string
    {
        $attributes = $this->injectClasses($this->_defaultAttributes['class']['wrapper'], $attributes);

        $this->_markActiveCrumb();

        return parent::render($attributes, $separator);
    }

    /**
     * @inheritDoc
     */
    public function add($title, $url = null, array $options = [])
    {
        if (is_array($title)) {
            $crumbs = [];
            foreach ($title as $crumb) {
                $options = [];
                if (isset($crumb['options'])) {
                    $options = $crumb['options'];
                }

                $crumb['options'] = $this->injectClasses($this->_defaultAttributes['class']['item'], $options);
                $crumbs[] = $crumb + ['title' => '', 'url' => null, 'options' => []];
            }

            return parent::add($crumbs);
        }

        $options = $this->injectClasses($this->_defaultAttributes['class']['item'], $options);

        return parent::add($title, $url, $options);
    }

    /**
     * @inheritDoc
     */
    public function prepend($title, $url = null, array $options = [])
    {
        $options = $this->injectClasses($this->_defaultAttributes['class']['item'], $options);

        return parent::prepend($title, $url, $options);
    }

    /**
     * @inheritDoc
     */
    public function insertAt(int $index, string $title, $url = null, array $options = [])
    {
        $options = $this->injectClasses($this->_defaultAttributes['class']['item'], $options);

        return parent::insertAt($index, $title, $url, $options);
    }

    /**
     * Marks the active crumb in the current set of crumbs with an
     * `active` class and the `aria-current` attribute.
     *
     * @return void
     */
    protected function _markActiveCrumb(): void
    {
        if (!$this->crumbs) {
            return;
        }

        $this->_clearActiveCrumb();

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

        $this->crumbs[$key]['options'] = $this->injectClasses('active', $this->crumbs[$key]['options']);

        if (isset($this->crumbs[$key]['url'])) {
            $this->crumbs[$key]['options']['innerAttrs']['aria-current'] = 'page';
        } else {
            $this->crumbs[$key]['options']['aria-current'] = 'page';
        }
    }

    /**
     * Removes the `active` class and the `aria-current` attribute from
     * the active crumb in the current set of crumbs.
     *
     * @return void
     */
    protected function _clearActiveCrumb(): void
    {
        foreach ($this->crumbs as $key => $crumb) {
            $this->crumbs[$key]['options'] = $this->removeClasses('active', $this->crumbs[$key]['options']);

            unset(
                $this->crumbs[$key]['options']['innerAttrs']['aria-current'],
                $this->crumbs[$key]['options']['aria-current']
            );
        }
    }
}
