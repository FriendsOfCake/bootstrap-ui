<?php
namespace BootstrapUI\View\Helper;

use Cake\View\View;

class PaginatorHelper extends \Cake\View\Helper\PaginatorHelper
{

    /**
     * Constructor. Overridden to merge passed args with URL options.
     *
     * @param \Cake\View\View $View The View this helper is being attached to.
     * @param array $config Configuration settings for the helper.
     */
    public function __construct(View $View, array $config = [])
    {
        $this->_defaultConfig['templates'] = [
            'nextActive' => '<li class="next"><a rel="next" aria-label="Next" href="{{url}}">' .
                            '<span aria-hidden="true">{{text}}</span></a></li>',
            'nextDisabled' => '<li class="next disabled"><a href=""><span aria-hidden="true">{{text}}</span></a></li>',
            'prevActive' => '<li class="prev"><a rel="prev" aria-label="Previous" href="{{url}}">' .
                            '<span aria-hidden="true">{{text}}</span></a></li>',
            'prevDisabled' => '<li class="prev disabled"><a href=""><span aria-hidden="true">{{text}}</span></a></li>',
            'current' => '<li class="active"><span>{{text}} <span class="sr-only">(current)</span></span></li>',
        ] + $this->_defaultConfig['templates'];

        parent::__construct($View, $config + [
            'labels' => [
                'prev' => '&laquo;',
                'next' => '&raquo;',
            ],
        ]);
    }

    /**
     * Returns a set of numbers for the paged result set
     * uses a modulus to decide how many numbers to show on each side of the current page (default: 8).
     *
     * `$this->Paginator->numbers(['first' => 2, 'last' => 2]);`
     *
     * Using the first and last options you can create links to the beginning and end of the page set.
     *
     * ### Options
     *
     * - `before` Content to be inserted before the numbers, but after the first links.
     * - `after` Content to be inserted after the numbers, but before the last links.
     * - `model` Model to create numbers for, defaults to PaginatorHelper::defaultModel()
     * - `modulus` how many numbers to include on either side of the current page, defaults to 8.
     * - `first` Whether you want first links generated, set to an integer to define the number of 'first'
     *    links to generate.
     * - `last` Whether you want last links generated, set to an integer to define the number of 'last'
     *    links to generate.
     * - `templates` An array of templates, or template file name containing the templates you'd like to
     *    use when generating the numbers. The helper's original templates will be restored once
     *    numbers() is done.
     *
     * The generated number links will include the 'ellipsis' template when the `first` and `last` options
     * and the number of pages exceed the modulus. For example if you have 25 pages, and use the first/last
     * options and a modulus of 8, ellipsis content will be inserted after the first and last link sets.
     *
     * @param array $options Options for the numbers.
     * @return string numbers string.
     * @link http://book.cakephp.org/3.0/en/views/helpers/paginator.html#creating-page-number-links
     */
    public function numbers(array $options = [])
    {
        if (is_string($options)) {
            $options = ['size' => $options];
        }

        $class = 'pagination';

        $options += [
            'class' => $class,
            'after' => '</ul>',
            'size' => null,
        ];

        $options['class'] = implode(' ', (array)$options['class']);

        if (!empty($options['size'])) {
            $options['class'] .= " {$class}-{$options['size']}";
        }

        $options += [
            'before' => '<ul class="' . $options['class'] . '">',
        ];

        unset($options['class'], $options['size']);

        if (isset($options['prev'])) {
            if ($options['prev'] === true) {
                $options['prev'] = $this->config('labels.prev');
            }
            $options['before'] .= $this->prev($options['prev'], ['escape' => false]);
        }

        if (isset($options['next'])) {
            if ($options['next'] === true) {
                $options['next'] = $this->config('labels.next');
            }
            $options['after'] = $this->next($options['next'], ['escape' => false]) . $options['after'];
        }

        return parent::numbers($options);
    }
}
