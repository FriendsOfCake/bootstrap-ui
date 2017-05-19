<?php
namespace BootstrapUI\View\Helper;

class HtmlHelper extends \Cake\View\Helper\HtmlHelper
{
    use OptionsAwareTrait;

    private $grid = [];

    private $gridOptions = [];

    private $gridCounter = 0;

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

        return $this->tag($tag, $text, $this->injectClasses('badge', $options));
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
     * Returns Bootstrap icon markup. By default, uses `<I>` and `glypicon`.
     *
     * @param string $name Name of icon (i.e. search, leaf, etc.).
     * @param array $options Additional HTML attributes.
     * @return string HTML icon markup.
     */
    public function icon($name, array $options = [])
    {
        $options += [
            'tag' => 'i',
            'iconSet' => 'glyphicon',
            'class' => null,
        ];

        $classes = [$options['iconSet'], $options['iconSet'] . '-' . $name];
        $options = $this->injectClasses($classes, $options);

        return $this->formatTemplate('tag', [
            'tag' => $options['tag'],
            'attrs' => $this->templater()->formatAttributes($options, ['tag', 'iconSet']),
        ]);
    }

    /**
     * Returns Bootstrap label markup. By default, uses `<SPAN>`.
     *
     * @param string $text Text to show in label.
     * @param array $options Additional HTML attributes.
     * @return string HTML icon markup.
     */
    public function label($text, $options = [])
    {
        if (is_string($options)) {
            $options = ['type' => $options];
        }

        $options += [
            'tag' => 'span',
            'type' => 'default',
        ];

        $classes = ['label', 'label-' . $options['type']];
        $tag = $options['tag'];
        unset($options['tag'], $options['type']);

        return $this->tag($tag, $text, $this->injectClasses($classes, $options));
    }

    /**
     * Set the content of a cell in a Bootstrap's grid
     *
     * @param  string $text Text, or Html content will be insert in a cell of grid
     * @return $this
     */
    public function gridContent($text = null)
    {
        $this->gridCounter++;

        $this->grid[$this->gridCounter] = $text;

        return $this;
    }

    /**
     * Configure atribututes of a cell
     *
     * @param  array $options set the cell configuration
     * @return $this
     */
    public function gridConfig($options = [])
    {
        $options += [
            'type' => 'md',
            'size' => 12,
            'offset' => null, //['type'] => 'md', ['size'] => 12
        ];

        $this->gridOptions[$this->gridCounter][] = $options;

        return $this;
    }

    /**
     * Return html of all grid
     *
     * @return string $html of a Bootstrap grid
     */
    public function gridRender()
    {
        $html = '<div class="row">';
        foreach ($this->grid as $key => $value) {
            $class = null;
            foreach ($this->gridOptions[$key] as $key2 => $config) {
                if ($key2 > 0) {
                    $class .= ' ';
                }
                $offset = null;
                $class .= 'col-' . $config['type'] . '-' . $config['size'];
                if (!empty($config['offset'])) {
                    $offset .= 'col-' . $config['offset']['type'] . '-offset-' . $config['offset']['size'];
                    $class .= ' ' . $offset;
                }
            }
            if (empty($class)) {
                $class = 'col-md-12';
            }
            $html .= '<div class="' . $class . '">' . $value . '</div>';
        }
        $html .= '</div>';
        $this->gridCounter = 0;
        $this->grid = $this->gridConfig = [];
        return $html;
    }
}
