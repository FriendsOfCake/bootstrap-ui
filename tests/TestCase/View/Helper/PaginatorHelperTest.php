<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper;

use BootstrapUI\View\Helper\PaginatorHelper;
use Cake\Http\ServerRequest;
use Cake\Routing\Router;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * PaginatorHelperTest class
 */
class PaginatorHelperTest extends TestCase
{
    /**
     * @var View
     */
    public $View;

    /**
     * @var PaginatorHelper
     */
    public $Paginator;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $request = new ServerRequest([
            'params' => [
                'plugin' => null,
                'controller' => 'Clients',
                'action' => 'index',
                '_ext' => null,
                'pass' => [],
            ],
        ]);
        $request = $request->withAttribute('paging', [
            'Client' => [
                'page' => 2,
                'current' => 1,
                'count' => 3,
                'prevPage' => 1,
                'nextPage' => 3,
                'pageCount' => 3,
            ],
        ]);

        $this->View = new View($request);
        $this->Paginator = new PaginatorHelper($this->View);

        Router::connect('/{controller}/{action}/*');
        Router::setRequest($request);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->View, $this->Paginator);
    }

    public function testLinksDefaults(): void
    {
        $result = $this->Paginator->links();
        $expected = [
            'ul' => ['class' => 'pagination'],
                ['li' => ['class' => 'page-item']],
                    ['a' => ['class' => 'page-link', 'href' => '/Clients/index']], '1', '/a',
                '/li',
                ['li' => ['class' => 'page-item active', 'aria-current' => 'page']],
                    ['a' => ['class' => 'page-link', 'href' => '#']],
                        '2',
                    '/a',
                '/li',
                ['li' => ['class' => 'page-item']],
                    ['a' => ['class' => 'page-link', 'href' => '/Clients/index?page=3']], '3', '/a',
                '/li',
            '/ul',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testLinksAllControls(): void
    {
        $result = $this->Paginator->links(['prev' => true, 'next' => true, 'first' => true, 'last' => true]);
        $expected = [
            'ul' => ['class' => 'pagination'],
                ['li' => ['class' => 'page-item first']],
                    ['a' => ['class' => 'page-link', 'aria-label' => 'First', 'href' => '/Clients/index']],
                        ['span' => ['aria-hidden' => 'true']], '«', '/span',
                    '/a',
                '/li',
                ['li' => ['class' => 'page-item']],
                    ['a' => [
                        'class' => 'page-link',
                        'rel' => 'prev',
                        'aria-label' => 'Previous',
                        'href' => '/Clients/index',
                    ]],
                        ['span' => ['aria-hidden' => 'true']], '‹', '/span',
                    '/a',
                '/li',
                ['li' => ['class' => 'page-item']],
                    ['a' => ['class' => 'page-link', 'href' => '/Clients/index']], '1', '/a',
                '/li',
                ['li' => ['class' => 'page-item active', 'aria-current' => 'page']],
                    ['a' => ['class' => 'page-link', 'href' => '#']],
                        '2',
                    '/a',
                '/li',
                ['li' => ['class' => 'page-item']],
                    ['a' => ['class' => 'page-link', 'href' => '/Clients/index?page=3']], '3', '/a',
                '/li',
                ['li' => ['class' => 'page-item']],
                    ['a' => [
                        'class' => 'page-link',
                        'rel' => 'next',
                        'aria-label' => 'Next',
                        'href' => '/Clients/index?page=3',
                    ]],
                        ['span' => ['aria-hidden' => 'true']], '›', '/span', '/a',
                '/li',
                ['li' => ['class' => 'page-item last']],
                    ['a' => ['class' => 'page-link', 'aria-label' => 'Last', 'href' => '/Clients/index?page=3']],
                        ['span' => ['aria-hidden' => 'true']], '»', '/span',
                    '/a',
                '/li',
            '/ul',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testLinksCustomTextAndLabels(): void
    {
        $result = $this->Paginator->links([
            'first' => [
                'label' => 'Beginning',
                'text' => '❰❰',
            ],
            'last' => [
                'label' => 'End',
                'text' => '❱❱',
            ],
            'prev' => [
                'label' => 'Back',
                'text' => '❮',
            ],
            'next' => [
                'label' => 'Forward',
                'text' => '❯',
            ],
        ]);
        $expected = [
            'ul' => ['class' => 'pagination'],
                ['li' => ['class' => 'page-item first']],
                    ['a' => ['class' => 'page-link', 'aria-label' => 'Beginning', 'href' => '/Clients/index']],
                        ['span' => ['aria-hidden' => 'true']], '❰❰', '/span',
                    '/a',
                '/li',
                ['li' => ['class' => 'page-item']],
                    ['a' => [
                        'class' => 'page-link',
                        'rel' => 'prev',
                        'aria-label' => 'Back',
                        'href' => '/Clients/index',
                    ]],
                        ['span' => ['aria-hidden' => 'true']], '❮', '/span',
                    '/a',
                '/li',
                ['li' => ['class' => 'page-item']],
                    ['a' => ['class' => 'page-link', 'href' => '/Clients/index']], '1', '/a',
                '/li',
                ['li' => ['class' => 'page-item active', 'aria-current' => 'page']],
                    ['a' => ['class' => 'page-link', 'href' => '#']],
                        '2',
                    '/a',
                '/li',
                ['li' => ['class' => 'page-item']],
                    ['a' => ['class' => 'page-link', 'href' => '/Clients/index?page=3']], '3', '/a',
                '/li',
                ['li' => ['class' => 'page-item']],
                    ['a' => [
                        'class' => 'page-link',
                        'rel' => 'next',
                        'aria-label' => 'Forward',
                        'href' => '/Clients/index?page=3',
                    ]],
                        ['span' => ['aria-hidden' => 'true']], '❯', '/span', '/a',
                '/li',
                ['li' => ['class' => 'page-item last']],
                    ['a' => ['class' => 'page-link', 'aria-label' => 'End', 'href' => '/Clients/index?page=3']],
                        ['span' => ['aria-hidden' => 'true']], '❱❱', '/span',
                    '/a',
                '/li',
            '/ul',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testLinksNoPreviousNext(): void
    {
        $request = $this->Paginator->getView()->getRequest();
        $request = $request->withAttribute('paging', [
            'Client' => [
                'prevPage' => false,
                'nextPage' => false,
            ] + $request->getAttribute('paging')['Client'],
        ]);
        $this->Paginator->getView()->setRequest($request);

        $result = $this->Paginator->links(['prev' => true, 'next' => true, 'first' => true, 'last' => true]);
        $expected = [
            'ul' => ['class' => 'pagination'],
                ['li' => ['class' => 'page-item first']],
                    ['a' => ['class' => 'page-link', 'aria-label' => 'First', 'href' => '/Clients/index']],
                        ['span' => ['aria-hidden' => 'true']], '«', '/span',
                    '/a',
                '/li',
                ['li' => ['class' => 'page-item disabled']],
                    ['a' => [
                        'class' => 'page-link',
                        'tabindex' => '-1',
                        'aria-disabled' => 'true',
                        'aria-label' => 'Previous',
                    ]],
                        ['span' => ['aria-hidden' => 'true']], '‹', '/span',
                    '/a',
                '/li',
                ['li' => ['class' => 'page-item']],
                    ['a' => ['class' => 'page-link', 'href' => '/Clients/index']], '1', '/a',
                '/li',
                ['li' => ['class' => 'page-item active', 'aria-current' => 'page']],
                    ['a' => ['class' => 'page-link', 'href' => '#']],
                        '2',
                    '/a',
                '/li',
                ['li' => ['class' => 'page-item']],
                    ['a' => ['class' => 'page-link', 'href' => '/Clients/index?page=3']], '3', '/a',
                '/li',
                ['li' => ['class' => 'page-item disabled']],
                    ['a' => [
                        'class' => 'page-link',
                        'tabindex' => '-1',
                        'aria-disabled' => 'true',
                        'aria-label' => 'Next',
                    ]],
                        ['span' => ['aria-hidden' => 'true']], '›', '/span', '/a',
                '/li',
                ['li' => ['class' => 'page-item last']],
                    ['a' => ['class' => 'page-link', 'aria-label' => 'Last', 'href' => '/Clients/index?page=3']],
                        ['span' => ['aria-hidden' => 'true']], '»', '/span',
                    '/a',
                '/li',
            '/ul',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testLinksSize(): void
    {
        $result = $this->Paginator->links(['size' => 'lg']);
        $expected = [
            'ul' => ['class' => 'pagination pagination-lg'],
                ['li' => ['class' => 'page-item']],
                    ['a' => ['class' => 'page-link', 'href' => '/Clients/index']], '1', '/a',
                '/li',
                ['li' => ['class' => 'page-item active', 'aria-current' => 'page']],
                    'a' => ['class' => 'page-link', 'href' => '#'],
                        '2',
                    '/a',
                '/li',
                ['li' => ['class' => 'page-item']],
                    ['a' => ['class' => 'page-link', 'href' => '/Clients/index?page=3']], '3', '/a',
                '/li',
            '/ul',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testLinksInvalidSize(): void
    {
        $result = $this->Paginator->links(['size' => 'sx']);
        $this->assertFalse($result);
    }

    public function testLinksEscape(): void
    {
        $result = $this->Paginator->links([
            'first' => '<i class="bi bi-arrow-left"></i>',
            'last' => '<i class="bi bi-arrow-right"></i>',
            'prev' => '<i class="bi bi-arrow-left-short"></i>',
            'next' => '<i class="bi bi-arrow-right-short"></i>',
        ]);
        $expected = [
            'ul' => ['class' => 'pagination'],
                ['li' => ['class' => 'page-item first']],
                    ['a' => ['class' => 'page-link', 'aria-label' => 'First', 'href' => '/Clients/index']],
                        ['span' => ['aria-hidden' => 'true']],
                            '&lt;i class=&quot;bi bi-arrow-left&quot;&gt;&lt;/i&gt;',
                        '/span',
                    '/a',
                '/li',
                ['li' => ['class' => 'page-item']],
                    ['a' => [
                        'class' => 'page-link',
                        'rel' => 'prev',
                        'aria-label' => 'Previous',
                        'href' => '/Clients/index',
                    ]],
                        ['span' => ['aria-hidden' => 'true']],
                            '&lt;i class=&quot;bi bi-arrow-left-short&quot;&gt;&lt;/i&gt;',
                        '/span',
                    '/a',
                '/li',
                ['li' => ['class' => 'page-item']],
                    ['a' => ['class' => 'page-link', 'href' => '/Clients/index']], '1', '/a',
                '/li',
                ['li' => ['class' => 'page-item active', 'aria-current' => 'page']],
                    'a' => ['class' => 'page-link', 'href' => '#'],
                        '2',
                    '/a',
                '/li',
                ['li' => ['class' => 'page-item']],
                    ['a' => ['class' => 'page-link', 'href' => '/Clients/index?page=3']], '3', '/a',
                '/li',
                ['li' => ['class' => 'page-item']],
                    ['a' => [
                        'class' => 'page-link',
                        'rel' => 'next',
                        'aria-label' => 'Next',
                        'href' => '/Clients/index?page=3',
                    ]],
                        ['span' => ['aria-hidden' => 'true']],
                            '&lt;i class=&quot;bi bi-arrow-right-short&quot;&gt;&lt;/i&gt;',
                        '/span',
                    '/a',
                '/li',
                ['li' => ['class' => 'page-item last']],
                    ['a' => ['class' => 'page-link', 'aria-label' => 'Last', 'href' => '/Clients/index?page=3']],
                        ['span' => ['aria-hidden' => 'true']],
                            '&lt;i class=&quot;bi bi-arrow-right&quot;&gt;&lt;/i&gt;',
                        '/span',
                    '/a',
                '/li',
            '/ul',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testLinksDisableEscape(): void
    {
        $result = $this->Paginator->links([
            'first' => '<i class="bi bi-arrow-left"></i>',
            'last' => '<i class="bi bi-arrow-right"></i>',
            'prev' => '<i class="bi bi-arrow-left-short"></i>',
            'next' => '<i class="bi bi-arrow-right-short"></i>',
            'escape' => false,
        ]);
        $expected = [
            'ul' => ['class' => 'pagination'],
                ['li' => ['class' => 'page-item first']],
                    ['a' => ['class' => 'page-link', 'aria-label' => 'First', 'href' => '/Clients/index']],
                        ['span' => ['aria-hidden' => 'true']],
                            ['i' => ['class' => 'bi bi-arrow-left']], '/i',
                        '/span',
                    '/a',
                '/li',
                ['li' => ['class' => 'page-item']],
                    ['a' => [
                        'class' => 'page-link',
                        'rel' => 'prev',
                        'aria-label' => 'Previous',
                        'href' => '/Clients/index',
                    ]],
                        ['span' => ['aria-hidden' => 'true']],
                            ['i' => ['class' => 'bi bi-arrow-left-short']], '/i',
                        '/span',
                    '/a',
                '/li',
                ['li' => ['class' => 'page-item']],
                    ['a' => ['class' => 'page-link', 'href' => '/Clients/index']], '1', '/a',
                '/li',
                ['li' => ['class' => 'page-item active', 'aria-current' => 'page']],
                    'a' => ['class' => 'page-link', 'href' => '#'],
                        '2',
                    '/a',
                '/li',
                ['li' => ['class' => 'page-item']],
                    ['a' => ['class' => 'page-link', 'href' => '/Clients/index?page=3']], '3', '/a',
                '/li',
                ['li' => ['class' => 'page-item']],
                    ['a' => [
                        'class' => 'page-link',
                        'rel' => 'next',
                        'aria-label' => 'Next',
                        'href' => '/Clients/index?page=3',
                    ]],
                        ['span' => ['aria-hidden' => 'true']],
                            ['i' => ['class' => 'bi bi-arrow-right-short']], '/i',
                        '/span',
                    '/a',
                '/li',
                ['li' => ['class' => 'page-item last']],
                    ['a' => ['class' => 'page-link', 'aria-label' => 'Last', 'href' => '/Clients/index?page=3']],
                        ['span' => ['aria-hidden' => 'true']],
                            ['i' => ['class' => 'bi bi-arrow-right']], '/i',
                        '/span',
                    '/a',
                '/li',
            '/ul',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testFirst()
    {
        $result = $this->Paginator->first();
        $expected = [
            ['li' => ['class' => 'page-item first']],
                ['a' => ['class' => 'page-link', 'aria-label' => 'First', 'href' => '/Clients/index']],
                    ['span' => ['aria-hidden' => 'true']],
                        '«',
                    '/span',
                '/a',
            '/li',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testFirstCustomLabel()
    {
        $result = $this->Paginator->first('«', ['label' => 'Beginning']);
        $expected = [
            ['li' => ['class' => 'page-item first']],
                ['a' => ['class' => 'page-link', 'aria-label' => 'Beginning', 'href' => '/Clients/index']],
                    ['span' => ['aria-hidden' => 'true']],
                        '«',
                    '/span',
                '/a',
            '/li',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testFirstCustomTemplate()
    {
        $result = $this->Paginator->first('«', [
            'templates' => [
                'first' => '<a data-label="{{label}}" href="{{url}}">{{text}}</a>',
            ],
        ]);
        $expected = [
            ['a' => ['data-label' => 'First', 'href' => '/Clients/index']],
                '«',
            '/a',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testLast()
    {
        $result = $this->Paginator->last();
        $expected = [
            ['li' => ['class' => 'page-item last']],
                ['a' => ['class' => 'page-link', 'aria-label' => 'Last', 'href' => '/Clients/index?page=3']],
                    ['span' => ['aria-hidden' => 'true']],
                        '»',
                    '/span',
                '/a',
            '/li',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testLastCustomLabel()
    {
        $result = $this->Paginator->last('»', ['label' => 'End']);
        $expected = [
            ['li' => ['class' => 'page-item last']],
                ['a' => ['class' => 'page-link', 'aria-label' => 'End', 'href' => '/Clients/index?page=3']],
                    ['span' => ['aria-hidden' => 'true']],
                        '»',
                    '/span',
                '/a',
            '/li',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testLastCustomTemplate()
    {
        $result = $this->Paginator->last('»', [
            'templates' => [
                'last' => '<a data-label="{{label}}" href="{{url}}">{{text}}</a>',
            ],
        ]);
        $expected = [
            ['a' => ['data-label' => 'Last', 'href' => '/Clients/index?page=3']],
                '»',
            '/a',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testPrev()
    {
        $result = $this->Paginator->prev();
        $expected = [
            ['li' => ['class' => 'page-item']],
                ['a' => ['class' => 'page-link', 'rel' => 'prev', 'aria-label' => 'Previous', 'href' => '/Clients/index']],
                    ['span' => ['aria-hidden' => 'true']],
                        '‹',
                    '/span',
                '/a',
            '/li',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testPrevCustomLabel()
    {
        $result = $this->Paginator->prev('‹', ['label' => 'Back']);
        $expected = [
            ['li' => ['class' => 'page-item']],
                ['a' => ['class' => 'page-link', 'rel' => 'prev', 'aria-label' => 'Back', 'href' => '/Clients/index']],
                    ['span' => ['aria-hidden' => 'true']],
                        '‹',
                    '/span',
                '/a',
            '/li',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testPrevCustomTemplate()
    {
        $result = $this->Paginator->prev('‹', [
            'templates' => [
                'prevActive' => '<a data-label="{{label}}" href="{{url}}">{{text}}</a>',
            ],
        ]);
        $expected = [
            ['a' => ['data-label' => 'Previous', 'href' => '/Clients/index']],
                '‹',
            '/a',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testPrevDisabledCustomTemplate()
    {
        $request = $this->Paginator->getView()->getRequest();
        $request = $request->withAttribute('paging', [
            'Client' => [
                'prevPage' => false,
            ] + $request->getAttribute('paging')['Client'],
        ]);
        $this->Paginator->getView()->setRequest($request);

        $result = $this->Paginator->prev('‹', [
            'templates' => [
                'prevDisabled' => '<a data-label="{{label}}" href="{{url}}">{{text}}</a>',
            ],
        ]);
        $expected = [
            ['a' => ['data-label' => 'Previous', 'href' => '']],
                '‹',
            '/a',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testNext()
    {
        $result = $this->Paginator->next();
        $expected = [
            ['li' => ['class' => 'page-item']],
                ['a' => ['class' => 'page-link', 'rel' => 'next', 'aria-label' => 'Next', 'href' => '/Clients/index?page=3']],
                    ['span' => ['aria-hidden' => 'true']],
                        '›',
                    '/span',
                '/a',
            '/li',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testNextCustomLabel()
    {
        $result = $this->Paginator->next('›', ['label' => 'Forward']);
        $expected = [
            ['li' => ['class' => 'page-item']],
                ['a' => ['class' => 'page-link', 'rel' => 'next', 'aria-label' => 'Forward', 'href' => '/Clients/index?page=3']],
                    ['span' => ['aria-hidden' => 'true']],
                        '›',
                    '/span',
                '/a',
            '/li',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testNextCustomTemplate()
    {
        $result = $this->Paginator->next('›', [
            'templates' => [
                'nextActive' => '<a data-label="{{label}}" href="{{url}}">{{text}}</a>',
            ],
        ]);
        $expected = [
            ['a' => ['data-label' => 'Next', 'href' => '/Clients/index?page=3']],
                '›',
            '/a',
        ];
        $this->assertHtml($expected, $result);
    }

    public function testNextDisabledCustomTemplate()
    {
        $request = $this->Paginator->getView()->getRequest();
        $request = $request->withAttribute('paging', [
            'Client' => [
                'nextPage' => false,
            ] + $request->getAttribute('paging')['Client'],
        ]);
        $this->Paginator->getView()->setRequest($request);

        $result = $this->Paginator->next('›', [
            'templates' => [
                'nextDisabled' => '<a data-label="{{label}}" href="{{url}}">{{text}}</a>',
            ],
        ]);
        $expected = [
            ['a' => ['data-label' => 'Next', 'href' => '']],
                '›',
            '/a',
        ];
        $this->assertHtml($expected, $result);
    }
}
