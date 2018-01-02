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
            'nextActive' => '<li class="page-item"><a class="page-link" rel="next" aria-label="Next" href="{{url}}">' .
                            '<span aria-hidden="true">{{text}}</span></a></li>',
            'nextDisabled' => '<li class="page-item disabled"><a class="page-link" tabindex="-1"><span aria-hidden="true">{{text}}</span></a></li>',
            'prevActive' => '<li class="page-item"><a class="page-link" rel="prev" aria-label="Previous" href="{{url}}">' .
                            '<span aria-hidden="true">{{text}}</span></a></li>',
            'prevDisabled' => '<li class="page-item disabled"><a class="page-link" tabindex="-1"><span aria-hidden="true">{{text}}</span></a></li>',
            'current' => '<li class="page-item active"><a class="page-link" href="#">{{text}} <span class="sr-only">(current)</span></a></li>',
            'first' => '<li class="page-item first"><a class="page-link" href="{{url}}">{{text}}</a></li>',
            'last' => '<li class="page-item last"><a class="page-link" href="{{url}}">{{text}}</a></li>',
            'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
            'current' => '<li class="page-item active"><a class="page-link" href="">{{text}}</a></li>',
        ] + $this->_defaultConfig['templates'];

        parent::__construct($View, $config + [
            'labels' => [
                'prev' => '&laquo;',
                'next' => '&raquo;',
            ],
        ]);
    }

    /**
     * Returns a set of numbers for the paged result set.
     *
     * In addition to the numbers, the method can also generate previous and next
     * links using additional options as shown below which are not available in
     * CakePHP core's PaginatorHelper::numbers().
     *
     * ### Options
     *
     * - `prev` If set generates "previous" link. Can be `true` or string.
     * - `next` If set generates "next" link. Can be `true` or string.
     * - `size` Used to control sizing class added to UL tag. For eg.
     *   using `'size' => 'lg'` would add class `pagination-lg` to UL tag.
     *
     * @param array $options Options for the numbers.
     * @return string Numbers string.
     * @link http://book.cakephp.org/3.0/en/views/helpers/paginator.html#creating-page-number-links
     */
    public function numbers(array $options = [])
    {
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
                $options['prev'] = $this->setConfig('labels.prev');
            }
            $options['before'] .= $this->prev($options['prev'], ['escape' => false]);
        }

        if (isset($options['next'])) {
            if ($options['next'] === true) {
                $options['next'] = $this->setConfig('labels.next');
            }
            $options['after'] = $this->next($options['next'], ['escape' => false]) . $options['after'];
        }

        return parent::numbers($options);
    }
}
