<?php
declare(strict_types=1);

namespace BootstrapUI\View\Helper;

use Cake\View\View;

class PaginatorHelper extends \Cake\View\Helper\PaginatorHelper
{
    /**
     * Allowed sizes.
     *
     * @var string[]
     */
    protected $_allowedSizes = ['sm', 'lg'];

    /**
     * Label defaults.
     *
     * @var array
     */
    protected $_labels = [
        'first' => [
            'label' => 'First',
            'text' => '«',
        ],
        'last' => [
            'label' => 'Last',
            'text' => '»',
        ],
        'prev' => [
            'label' => 'Previous',
            'text' => '‹',
        ],
        'next' => [
            'label' => 'Next',
            'text' => '›',
        ],
    ];

    /**
     * Constructor. Overridden to merge passed args with URL options.
     *
     * @param \Cake\View\View $View The View this helper is being attached to.
     * @param array $config Configuration settings for the helper.
     */
    public function __construct(View $View, array $config = [])
    {
        $this->_defaultConfig['templates'] = [
            'nextActive' =>
                '<li class="page-item">' .
                    '<a class="page-link" rel="next" aria-label="{{label}}" href="{{url}}">' .
                        '<span aria-hidden="true">{{text}}</span></a></li>',
            'nextDisabled' =>
                '<li class="page-item disabled">' .
                    '<a class="page-link" tabindex="-1" aria-disabled="true" aria-label="{{label}}">' .
                        '<span aria-hidden="true">{{text}}</span></a></li>',
            'prevActive' =>
                '<li class="page-item">' .
                    '<a class="page-link" rel="prev" aria-label="{{label}}" href="{{url}}">' .
                        '<span aria-hidden="true">{{text}}</span></a></li>',
            'prevDisabled' =>
                '<li class="page-item disabled">' .
                    '<a class="page-link" tabindex="-1" aria-disabled="true" aria-label="{{label}}">' .
                        '<span aria-hidden="true">{{text}}</span></a></li>',
            'current' =>
                '<li class="page-item active" aria-current="page">' .
                    '<a class="page-link" href="#">{{text}}</a></li>',
            'first' =>
                '<li class="page-item first"><a class="page-link" aria-label="{{label}}" href="{{url}}">' .
                    '<span aria-hidden="true">{{text}}</span></a></li>',
            'last' =>
                '<li class="page-item last"><a class="page-link" aria-label="{{label}}" href="{{url}}">' .
                    '<span aria-hidden="true">{{text}}</span></a></li>',
            'number' =>
                '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
        ] + $this->_defaultConfig['templates'];

        parent::__construct($View, $config + [
            'labels' => $this->_labels,
        ]);
    }

    /**
     * {@inheritDoc}
     *
     * This methods supports the following options additionally to the ones supported by the core:
     *
     * - `label` The text to use for the ARIA label property.
     * - `templates` An array of templates, or template file name containing the templates you'd like to use when
     *    generating the link for first page. This method uses the `first` template.
     */
    public function first($first = '«', array $options = []): string
    {
        $options = $this->_templateOptions('first', $options);

        $templater = $this->templater();
        $templater->push();
        $templateMethod = is_string($options['templates']) ? 'load' : 'add';
        $templater->{$templateMethod}($options['templates']);

        $out = parent::first($first, $options);

        $templater->pop();

        return $out;
    }

    /**
     * {@inheritDoc}
     *
     * This methods supports the following options additionally to the ones supported by the core:
     *
     * - `label` The text to use for the ARIA label property.
     * - `templates` An array of templates, or template file name containing the templates you'd like to use when
     *    generating the link for last page. This method uses the `last` template.
     */
    public function last($last = '»', array $options = []): string
    {
        $options = $this->_templateOptions('last', $options);

        $templater = $this->templater();
        $templater->push();
        $templateMethod = is_string($options['templates']) ? 'load' : 'add';
        $templater->{$templateMethod}($options['templates']);

        $out = parent::last($last, $options);

        $templater->pop();

        return $out;
    }

    /**
     * {@inheritDoc}
     *
     * This methods supports the following options additionally to the ones supported by the core:
     *
     * - `label` The text to use for the ARIA label property.
     */
    public function prev(string $title = '‹', array $options = []): string
    {
        $options = $this->_templateOptions('prev', $options);

        return parent::prev($title, $options);
    }

    /**
     * {@inheritDoc}
     *
     * This methods supports the following options additionally to the ones supported by the core:
     *
     * - `label` The text to use for the ARIA label property.
     */
    public function next(string $title = '›', array $options = []): string
    {
        $options = $this->_templateOptions('next', $options);

        return parent::next($title, $options);
    }

    /**
     * Returns a set of numbers for the paged result set, wrapped in a ul.
     *
     * In addition to the numbers, the method can also generate previous/next and first/last
     * links using additional options as shown below which are not available in
     * CakePHP core's PaginatorHelper::numbers(). It also wraps the numbers into a ul tag.
     *
     * ### Options
     *
     * - `first` If set generates "first" link. Can be `true`, a string, or an array.
     * - `prev` If set generates "previous" link. Can be `true`, a string, or an array.
     * - `next` If set generates "next" link. Can be `true`, a string, or an array.
     * - `last` If set generates "last" link. Can be `true`, a string, or an array.
     * - `size` Used to control sizing class added to UL tag. For eg.
     *   using `'size' => 'lg'` would add class `pagination-lg` to UL tag.
     * - `escape` Whether to escape the link text. Defaults to `true`.
     *
     * @param array $options Options for the numbers.
     * @return string|false Pagination controls markup, or `false` in case of an invalid `size` option.
     * @link http://book.cakephp.org/3.0/en/views/helpers/paginator.html#creating-page-number-links
     */
    public function links(array $options = [])
    {
        $class = 'pagination';

        $options += [
            'class' => $class,
            'after' => '',
            'size' => null,
            'escape' => true,
        ];

        $escape = $options['escape'];
        unset($options['escape']);

        $options['class'] = implode(' ', (array)$options['class']);

        if (!empty($options['size'])) {
            if (!in_array($options['size'], $this->_allowedSizes)) {
                return false;
            }
            $options['class'] .= " {$class}-{$options['size']}";
        }

        $options += [
            'before' => '<ul class="' . $options['class'] . '">',
        ];

        unset($options['class'], $options['size']);

        if (isset($options['first'])) {
            $options = $this->_labelOptions('first', $options);
            $options['before'] .= $this->first($options['first']['text'], [
                'label' => $options['first']['label'],
                'escape' => $escape,
            ]);
            unset($options['first']);
        }

        if (isset($options['prev'])) {
            $options = $this->_labelOptions('prev', $options);
            $options['before'] .= $this->prev($options['prev']['text'], [
                'label' => $options['prev']['label'],
                'escape' => $escape,
            ]);
            unset($options['prev']);
        }

        if (isset($options['next'])) {
            $options = $this->_labelOptions('next', $options);
            $options['after'] = $this->next($options['next']['text'], [
                'label' => $options['next']['label'],
                'escape' => $escape,
            ]);
            unset($options['next']);
        }

        if (isset($options['last'])) {
            $options = $this->_labelOptions('last', $options);
            $options['after'] .= $this->last($options['last']['text'], [
                'label' => $options['last']['label'],
                'escape' => $escape,
            ]);
            unset($options['last']);
        }

        $options['after'] .= '</ul>';

        return parent::numbers($options);
    }

    /**
     * Prepares label options.
     *
     * @param string $name The name of the control for which to prepare the label options.
     * @param array $options The array containing the label option.
     * @return array
     */
    protected function _labelOptions(string $name, array $options): array
    {
        if ($options[$name] === true) {
            $options[$name] = $this->getConfig("labels.$name");
        }
        if (!is_array($options[$name])) {
            $options[$name] = [
                'text' => $options[$name],
            ];
        }
        $options[$name] += $this->_labels[$name];

        return $options;
    }

    /**
     * Prepares template options.
     *
     * @param string $name The name of the control for which to prepare the template options.
     * @param array $options The array containing the template option.
     * @return array
     */
    protected function _templateOptions(string $name, array $options): array
    {
        $options += [
            'label' => $this->getConfig("labels.{$name}.label"),
            'templates' => [],
        ];
        $label = $options['label'];
        unset($options['label']);

        $options['templates'] += [
            "{$name}" => $this->getConfig("templates.{$name}", ''),
            "{$name}Active" => $this->getConfig("templates.{$name}Active", ''),
            "{$name}Disabled" => $this->getConfig("templates.{$name}Disabled", ''),
        ];

        $options['templates']["{$name}"] =
            str_replace('{{label}}', h($label), $options['templates']["{$name}"]);
        $options['templates']["{$name}Active"] =
            str_replace('{{label}}', h($label), $options['templates']["{$name}Active"]);
        $options['templates']["{$name}Disabled"] =
            str_replace('{{label}}', h($label), $options['templates']["{$name}Disabled"]);

        return $options;
    }
}
