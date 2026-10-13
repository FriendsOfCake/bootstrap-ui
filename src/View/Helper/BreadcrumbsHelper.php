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
    protected array $defaultConfig = [
        'ariaCurrent' => 'last',
        'templates' => [
            'wrapper' => '<nav aria-label="breadcrumb"><ol{{attrs}}>{{content}}</ol></nav>',
            'item' => '<li{{attrs}}><a href="{{url}}"{{innerAttrs}}>{{content}}</a></li>',
            'itemWithoutLink' => '<li{{attrs}}><span{{innerAttrs}}>{{content}}</span></li>',
            'separator' => '',
        ],
    ];

    /**
     * Default attributes for the templates
     *
     * @var array
     */
    protected array $defaultAttributes = [
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
        $attributes = $this->injectClasses($this->defaultAttributes['class']['wrapper'], $attributes);

        $this->markActiveCrumb();

        return parent::render($attributes, $separator);
    }

    /**
     * @inheritDoc
     */
    public function add(string $content, array|string|null $url = null, array $options = []): static
    {
        $options = $this->injectClasses($this->defaultAttributes['class']['item'], $options);

        parent::add($content, $url, $options);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addMany(array $crumbs, array $options = []): static
    {
        $crumbsToAdd = [];
        foreach ($crumbs as $crumb) {
            $crumbOptions = ($crumb['options'] ?? []) + $options;
            $crumb['options'] = $this->injectClasses(
                $this->defaultAttributes['class']['item'],
                $crumbOptions,
            );
            $crumbsToAdd[] = $crumb + ['content' => '', 'url' => null, 'options' => []];
        }

        parent::addMany($crumbsToAdd);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function prepend(string $content, array|string|null $url = null, array $options = []): static
    {
        $options = $this->injectClasses($this->defaultAttributes['class']['item'], $options);

        parent::prepend($content, $url, $options);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function insertAt(int $index, string $content, array|string|null $url = null, array $options = []): static
    {
        $options = $this->injectClasses($this->defaultAttributes['class']['item'], $options);

        parent::insertAt($index, $content, $url, $options);

        return $this;
    }

    /**
     * Marks the active crumb in the current set of crumbs with an
     * `active` class and the `aria-current` attribute.
     *
     * @return void
     */
    protected function markActiveCrumb(): void
    {
        if (!$this->crumbs) {
            return;
        }

        $this->clearActiveCrumb();

        $key = null;
        if ($this->getConfig('ariaCurrent') === 'lastWithLink') {
            foreach (array_reverse($this->crumbs, true) as $i => $crumb) {
                if (isset($crumb['url'])) {
                    $key = $i;
                    break;
                }
            }
        } else {
            $key = count($this->crumbs) - 1;
        }

        if ($key === null) {
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
    protected function clearActiveCrumb(): void
    {
        foreach ($this->crumbs as $key => $crumb) {
            $this->crumbs[$key]['options'] = $this->removeClasses('active', $this->crumbs[$key]['options']);

            unset(
                $this->crumbs[$key]['options']['innerAttrs']['aria-current'],
                $this->crumbs[$key]['options']['aria-current'],
            );
        }
    }
}
