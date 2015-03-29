<?php
namespace BootstrapUI\View\Helper;

use Cake\View\View;

class PaginatorHelper extends \Cake\View\Helper\PaginatorHelper
{

    /**
     * {@inheritdoc}
     */
    public function __construct(View $view, array $config = [])
    {
        $this->_defaultConfig['templates'] = [
            'nextActive' => '<li class="next"><a rel="next" aria-label="Next" href="{{url}}"><span aria-hidden="true">{{text}}</span></a></li>',
            'nextDisabled' => '<li class="next disabled"><a href=""><span aria-hidden="true">{{text}}</span></a></li>',
            'prevActive' => '<li class="prev"><a rel="prev" aria-label="Previous" href="{{url}}"><span aria-hidden="true">{{text}}</span></a></li>',
            'prevDisabled' => '<li class="prev disabled"><a href=""><span aria-hidden="true">{{text}}</span></a></li>',
            'current' => '<li class="active">{{text}} <span class="sr-only">(current)</span></li>',
        ] + $this->_defaultConfig['templates'];

        parent::__construct($view, $config);
    }

    /**
     * {@inheritdoc}
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
            $options['before'] .= $this->prev($options['prev']);
        }

        if (isset($options['next'])) {
            $options['after'] = $this->next($options['next']) . $options['after'];
        }

        return parent::numbers($options);
    }
}