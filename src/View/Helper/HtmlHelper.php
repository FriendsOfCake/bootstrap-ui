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
     * - `iconDefaults`: Default options for icons. Accepts the following options:
     *      - `tag`: The HTML tag to use for the icon. Default `i`.
     *      - `namespace`: Common class name for the icon set. Default `bi`.
     *      - `prefix`: Prefix for class names. Default `bi`.
     *      - `size`: Size class will be generated based of this. For e.g. if you use
     *        size `lg` class '<prefix>-lg` will be added. Default null.
     *
     * @param \Cake\View\View $View The View this helper is being attached to.
     * @param array $config Configuration settings for the helper.
     */
    public function __construct(View $View, array $config = [])
    {
        $this->_defaultConfig['iconDefaults'] = [
            'tag' => 'i',
            'namespace' => 'bi',
            'prefix' => 'bi',
            'size' => null,
        ];

        parent::__construct($View, $config);
    }

    /**
     * Returns Bootstrap badge markup. By default, uses `<span>`.
     *
     * ### Options
     *
     * - `tag`: The HTML tag to use for the badge. Default `span`.
     *
     * @param string $text Text to show in badge.
     * @param array $options Additional options and HTML attributes.
     * @return string HTML badge markup.
     */
    public function badge(string $text, array $options = []): string
    {
        $options += ['tag' => 'span'];
        $tag = $options['tag'];
        unset($options['tag']);

        $allClasses = $this->genAllClassNames('bg');

        if ($this->hasAnyClass($allClasses, $options)) {
            $options = $this->injectClasses('badge', $options);
        } else {
            $options = $this->injectClasses(['badge', 'secondary'], $options);
        }

        $classes = $this->renameClasses('bg', $options);

        return $this->tag($tag, $text, $classes);
    }

    /**
     * Returns bootstrap icon markup. By default, uses `<i>` tag and the bootstrap icon set.
     *
     * ### Options
     *
     * - `tag`: The HTML tag to use for the icon. Default `i`.
     * - `namespace`: Common class name for the icon set. Default `bi`.
     * - `prefix`: Prefix for class names. Default `bi`.
     * - `size`: Size class will be generated based of this. For e.g. if you use
     *   size `lg` class '<prefix>-lg` will be added. Default null.
     *
     * You can use `iconDefaults` option for the helper to set default values
     * for above options.
     *
     * @param string $name Name of icon (i.e. `search`, `exclamation`, etc.).
     * @param array $options Additional options and HTML attributes.
     * @return string HTML icon markup.
     */
    public function icon(string $name, array $options = []): string
    {
        $options += $this->getConfig('iconDefaults') + [
            'class' => null,
        ];

        $classes = [$options['namespace'], $options['prefix'] . '-' . $name];
        if (!empty($options['size'])) {
            $classes[] = $options['prefix'] . '-' . $options['size'];
        }
        $options = $this->injectClasses($classes, $options);

        return $this->formatTemplate('tag', [
            'tag' => $options['tag'],
            'attrs' => $this->templater()->formatAttributes(
                $options,
                ['tag', 'namespace', 'prefix', 'size']
            ),
        ]);
    }
}
