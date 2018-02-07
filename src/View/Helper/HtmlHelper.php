<?php
namespace BootstrapUI\View\Helper;

use Cake\View\View;

class HtmlHelper extends \Cake\View\Helper\HtmlHelper
{
    use OptionsAwareTrait;

    /**
     * Constructor
     *
     * ### Settings
     *
     * - `iconDefaults`: Default for icons.
     *
     * @param \Cake\View\View $View The View this helper is being attached to.
     * @param array $config Configuration settings for the helper.
     */
    public function __construct(View $View, array $config = [])
    {
        $this->_defaultConfig['iconDefaults'] = [
            'tag' => 'i',
            'iconSet' => 'fas',
            'prefix' => 'fa',
            'size' => null,
        ];

        parent::__construct($View, $config);
    }

    /**
     * Returns Bootstrap badge markup. By default, uses `<SPAN>`.
     *
     * @param string $text Text to show in badge.
     * @param array $options Additional HTML attributes.
     * @return string HTML badge markup.
     */
    public function badge($text, array $options = [])
    {
        $options += ['tag' => 'span'];
        $tag = $options['tag'];
        unset($options['tag']);

        $allClasses = $this->genAllClassNames('badge');

        if ($this->hasAnyClass($allClasses, $options)) {
            $options = $this->injectClasses('badge', $options);
        } else {
            $options = $this->injectClasses(['badge', 'secondary'], $options);
        }

        $classes = $this->renameClasses('badge', $options);

        return $this->tag($tag, $text, $classes);
    }

    /**
     * Returns breadcrumbs as a (x)html list
     *
     * This method uses HtmlHelper::tag() to generate list and its elements. Works
     * similar to HtmlHelper::getCrumbs(), so it uses options which every
     * crumb was added with.
     *
     * ### Options
     *
     * - `separator` Separator content to insert in between breadcrumbs, defaults to ''
     * - `firstClass` Class for wrapper tag on the first breadcrumb, defaults to 'first'
     * - `lastClass` Class for wrapper tag on current active page, defaults to 'last'
     *
     * @param array $options Array of HTML attributes to apply to the generated list elements.
     * @param string|array|bool $startText This will be the first crumb, if false it defaults to first crumb in
     *   array. Can also be an array, see `HtmlHelper::getCrumbs` for details.
     * @return string|null Breadcrumbs HTML list.
     * @link http://book.cakephp.org/3.0/en/views/helpers/html.html#creating-breadcrumb-trails-with-htmlhelper
     */
    public function getCrumbList(array $options = [], $startText = false)
    {
        $options += [
            'separator' => '',
        ];

        return parent::getCrumbList($this->injectClasses('breadcrumb', $options), $startText);
    }

    /**
     * Returns bootstrap icon markup. By default, uses `<i>` tag and font awesome icon set.
     *
     * @param string $name Name of icon (i.e. search, leaf, etc.).
     * @param array $options Additional options and HTML attributes.
     * ### Options
     *
     * - `iconSet`: Common class name for the icon set. Default 'fas'.
     * - `prefix`: Prefix for class names. Default 'fa'.
     * - `size`: Size class will be generated based of this. For e.g. if you use
     *   size 'lg' class '<prefix>-lg` will be added. Default null.
     *
     * You can use `iconDefaults` option for the helper to set default values
     * for above options.
     *
     * @return string HTML icon markup.
     */
    public function icon($name, array $options = [])
    {
        $options += $this->getConfig('iconDefaults') + [
            'class' => null,
        ];

        $classes = [$options['iconSet'], $options['prefix'] . '-' . $name];
        if (!empty($options['size'])) {
            $classes[] = $options['prefix'] . '-' . $options['size'];
        }
        $options = $this->injectClasses($classes, $options);

        return $this->formatTemplate('tag', [
            'tag' => $options['tag'],
            'attrs' => $this->templater()->formatAttributes(
                $options,
                ['tag', 'iconSet', 'prefix', 'size']
            ),
        ]);
    }

    /**
     * Wrapper for Bootstrap baddge component
     *
     * @param string $text Text to show in label.
     * @param array|string $options Additional HTML attributes.
     * @deprecated label component has been removed from Bootstrap. Use badge component instead.
     * @return string HTML badge markup.
     */
    public function label($text, $options = [])
    {
        if (is_string($options)) {
            $options = ['class' => $options];
        }

        return $this->badge($text, $options);
    }
}
