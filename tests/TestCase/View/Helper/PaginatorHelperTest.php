<?php
namespace BootstrapUI\Test\TestCase\View\Helper;

use BootstrapUI\View\Helper\PaginatorHelper;
use Cake\Core\Configure;
use Cake\Http\ServerRequest;
use Cake\I18n\I18n;
use Cake\Routing\Router;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * PaginatorHelperTest class
 *
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
     * @var string
     */
    public $locale;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        Configure::write('Config.language', 'eng');

        $request = new ServerRequest();
        $request = $request->withParam('paging', [
                'Article' => [
                    'page' => 1,
                    'current' => 9,
                    'count' => 62,
                    'prevPage' => false,
                    'nextPage' => true,
                    'pageCount' => 7,
                    'sort' => null,
                    'direction' => null,
                    'limit' => null,
                ]
        ]);

        $this->View = new View($request);
        $this->Paginator = new PaginatorHelper($this->View);
        $this->Paginator->Js = $this->getMockBuilder('Cake\View\Helper\PaginatorHelper')
            ->setConstructorArgs([$this->View])
            ->getMock();

        Configure::write('Routing.prefixes', []);
        Router::reload();
        Router::connect('/:controller/:action/*');
        Router::connect('/:plugin/:controller/:action/*');

        $this->locale = I18n::getLocale();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();
        unset($this->View, $this->Paginator);

        I18n::setLocale($this->locale);
    }

    /**
     * testLinks method
     *
     * @return void
     */
    public function testLinks()
    {
        $request = $this->Paginator->getView()->getRequest()->withParam('paging', [
            'Client' => [
                'page' => 8,
                'current' => 3,
                'count' => 30,
                'prevPage' => false,
                'nextPage' => 2,
                'pageCount' => 15,
            ]
        ]);
        $this->Paginator->getView()->setRequest($request);
        $result = $this->Paginator->links();
        $expected = [
            'ul' => ['class' => 'pagination'],
            ['li' => ['class' => 'page-item']], ['a' => ['class' => 'page-link', 'href' => '/index?page=4']], '4', '/a', '/li',
            ['li' => ['class' => 'page-item']], ['a' => ['class' => 'page-link', 'href' => '/index?page=5']], '5', '/a', '/li',
            ['li' => ['class' => 'page-item']], ['a' => ['class' => 'page-link', 'href' => '/index?page=6']], '6', '/a', '/li',
            ['li' => ['class' => 'page-item']], ['a' => ['class' => 'page-link', 'href' => '/index?page=7']], '7', '/a', '/li',
            ['li' => ['class' => 'page-item active']], ['a' => ['class' => 'page-link', 'href' => '#']], '8', ['span' => ['class' => 'sr-only']], '(current)', '/span', '/a', '/li',
            ['li' => ['class' => 'page-item']], ['a' => ['class' => 'page-link', 'href' => '/index?page=9']], '9', '/a', '/li',
            ['li' => ['class' => 'page-item']], ['a' => ['class' => 'page-link', 'href' => '/index?page=10']], '10', '/a', '/li',
            ['li' => ['class' => 'page-item']], ['a' => ['class' => 'page-link', 'href' => '/index?page=11']], '11', '/a', '/li',
            ['li' => ['class' => 'page-item']], ['a' => ['class' => 'page-link', 'href' => '/index?page=12']], '12', '/a', '/li',
            '/ul'
        ];
        $this->assertHtml($expected, $result);

        $request = $this->Paginator->getView()->getRequest()->withParam('paging', [
            'Client' => [
                'page' => 8,
                'current' => 3,
                'count' => 30,
                'prevPage' => false,
                'nextPage' => 2,
                'pageCount' => 15,
            ]
        ]);
        $this->Paginator->getView()->setRequest($request);
        $result = $this->Paginator->links(['prev' => true, 'next' => true, 'first' => true, 'last' => true]);
        $expected = [
            'ul' => ['class' => 'pagination'],
            ['li' => ['class' => 'page-item first']], ['a' => ['class' => 'page-link', 'href' => '/index']], '&laquo;', '/a', '/li',
            ['li' => ['class' => 'page-item disabled']], ['a' => ['class' => 'page-link', 'tabindex' => '-1']], ['span' => ['aria-hidden' => 'true']], '&lsaquo;', '/span', '/a', '/li',
            ['li' => ['class' => 'page-item']], ['a' => ['class' => 'page-link', 'href' => '/index?page=4']], '4', '/a', '/li',
            ['li' => ['class' => 'page-item']], ['a' => ['class' => 'page-link', 'href' => '/index?page=5']], '5', '/a', '/li',
            ['li' => ['class' => 'page-item']], ['a' => ['class' => 'page-link', 'href' => '/index?page=6']], '6', '/a', '/li',
            ['li' => ['class' => 'page-item']], ['a' => ['class' => 'page-link', 'href' => '/index?page=7']], '7', '/a', '/li',
            ['li' => ['class' => 'page-item active']], ['a' => ['class' => 'page-link', 'href' => '#']], '8', ['span' => ['class' => 'sr-only']], '(current)', '/span', '/a', '/li',
            ['li' => ['class' => 'page-item']], ['a' => ['class' => 'page-link', 'href' => '/index?page=9']], '9', '/a', '/li',
            ['li' => ['class' => 'page-item']], ['a' => ['class' => 'page-link', 'href' => '/index?page=10']], '10', '/a', '/li',
            ['li' => ['class' => 'page-item']], ['a' => ['class' => 'page-link', 'href' => '/index?page=11']], '11', '/a', '/li',
            ['li' => ['class' => 'page-item']], ['a' => ['class' => 'page-link', 'href' => '/index?page=12']], '12', '/a', '/li',
            ['li' => ['class' => 'page-item']], ['a' => ['class' => 'page-link', 'rel' => 'next', 'aria-label' => 'Next', 'href' => '/index?page=9']], ['span' => ['aria-hidden' => 'true']], '&rsaquo;', '/span', '/a', '/li',
            ['li' => ['class' => 'page-item last']], ['a' => ['class' => 'page-link', 'href' => '/index?page=15']], '&raquo;', '/a', '/li',
            '/ul'
        ];
        $this->assertHtml($expected, $result);

        $request = $this->Paginator->getView()->getRequest()->withParam('paging', [
            'Client' => [
                'page' => 1,
                'current' => 1,
                'count' => 2,
                'prevPage' => false,
                'nextPage' => 2,
                'pageCount' => 2,
            ]
        ]);
        $this->Paginator->getView()->setRequest($request);
        $result = $this->Paginator->links(['size' => 'lg']);
        $expected = [
            'ul' => ['class' => 'pagination pagination-lg'],
            ['li' => ['class' => 'page-item active']], 'a' => ['class' => 'page-link', 'href' => '#'], '1', 'span' => ['class' => 'sr-only'], '(current)', '/span', '/a', '/li',
            ['li' => ['class' => 'page-item']], ['a' => ['class' => 'page-link', 'href' => '/index?page=2']], '2', '/a', '/li',
            '/ul'
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Paginator->links(['size' => 'sx']);
        $this->assertFalse($result);
    }
}
