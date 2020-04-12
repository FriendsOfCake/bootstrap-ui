<?php
declare(strict_types=1);

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
    public function badge(string $text, array $options = []): string
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
     * @return string HTML icon markup.
     */
    public function icon(string $name, array $options = []): string
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
     * Wrapper for Bootstrap badge component
     *
     * @param string $text Text to show in label.
     * @param array|string $options Additional HTML attributes.
     * @deprecated Label component has been removed from Bootstrap. Use badge component instead.
     * @return string HTML badge markup.
     */
    public function label(string $text, $options = []): string
    {
        if (is_string($options)) {
            $options = ['class' => $options];
        } else {
            if (isset($options['type'])) {
                $options['class'] = $options['type'];
                unset($options['type']);
            }
        }

        return $this->badge($text, $options);
    }
}
