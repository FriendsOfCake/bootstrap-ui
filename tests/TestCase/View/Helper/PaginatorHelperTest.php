<?php
namespace BootstrapUI\Test\TestCase\View\Helper;

use BootstrapUI\View\Helper\PaginatorHelper;
use Cake\Core\Configure;
use Cake\Http\ServerRequest as Request;
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
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        Router::reload();
        Router::connect('/:controller/:action/*');
        Router::connect('/:plugin/:controller/:action/*');
    }

    /**
     * testNumbers method
     *
     * @return void
     */
    public function testNumbers()
    {
        $this->setupHelper([
            'Client' => [
                'page' => 8,
                'current' => 3,
                'count' => 30,
                'prevPage' => false,
                'nextPage' => 2,
                'pageCount' => 15,
            ],
        ]);
        $result = $this->Paginator->numbers();
        $expected = [
            'ul' => ['class' => 'pagination'],
            '<li', ['a' => ['href' => '/index?page=4']], '4', '/a', '/li',
            '<li', ['a' => ['href' => '/index?page=5']], '5', '/a', '/li',
            '<li', ['a' => ['href' => '/index?page=6']], '6', '/a', '/li',
            '<li', ['a' => ['href' => '/index?page=7']], '7', '/a', '/li',
            ['li' => ['class' => 'active']], '<span', '8', 'span' => ['class' => 'sr-only'], '(current)', '/span', '/span', '/li',
            '<li', ['a' => ['href' => '/index?page=9']], '9', '/a', '/li',
            '<li', ['a' => ['href' => '/index?page=10']], '10', '/a', '/li',
            '<li', ['a' => ['href' => '/index?page=11']], '11', '/a', '/li',
            '<li', ['a' => ['href' => '/index?page=12']], '12', '/a', '/li',
            '/ul'
        ];
        $this->assertHtml($expected, $result);

        $this->Paginator->request = $this->Paginator->request->withParam('paging', [
            'Client' => [
                'page' => 8,
                'current' => 3,
                'count' => 30,
                'prevPage' => false,
                'nextPage' => 2,
                'pageCount' => 15,
            ]
        ]);
        $result = $this->Paginator->numbers(['prev' => true, 'next' => true]);
        $expected = [
            'ul' => ['class' => 'pagination'],
            ['li' => ['class' => 'previous disabled']], ['a' => []], ['span' => ['aria-hidden' => 'true']], '&laquo;', '/span', '/a', '/li',
            '<li', ['a' => ['href' => '/index?page=4']], '4', '/a', '/li',
            '<li', ['a' => ['href' => '/index?page=5']], '5', '/a', '/li',
            '<li', ['a' => ['href' => '/index?page=6']], '6', '/a', '/li',
            '<li', ['a' => ['href' => '/index?page=7']], '7', '/a', '/li',
            ['li' => ['class' => 'active']], '<span', '8', 'span' => ['class' => 'sr-only'], '(current)', '/span', '/span', '/li',
            '<li', ['a' => ['href' => '/index?page=9']], '9', '/a', '/li',
            '<li', ['a' => ['href' => '/index?page=10']], '10', '/a', '/li',
            '<li', ['a' => ['href' => '/index?page=11']], '11', '/a', '/li',
            '<li', ['a' => ['href' => '/index?page=12']], '12', '/a', '/li',
            ['li' => ['class' => 'next']], ['a' => ['rel' => 'next', 'aria-label' => 'Next', 'href' => '/index?page=9']], ['span' => ['aria-hidden' => 'true']], '&raquo;', '/span', '/a', '/li',
            '/ul'
        ];
        $this->assertHtml($expected, $result);

        $this->setupHelper([
            'Client' => [
                'page' => 1,
                'current' => 1,
                'count' => 2,
                'prevPage' => false,
                'nextPage' => 2,
                'pageCount' => 2,
            ],
        ]);
        $result = $this->Paginator->numbers(['size' => 'lg']);
        $expected = [
            'ul' => ['class' => 'pagination pagination-lg'],
            ['li' => ['class' => 'active']], '<span', '1', 'span' => ['class' => 'sr-only'], '(current)', '/span', '/span', '/li',
            '<li', ['a' => ['href' => '/index?page=2']], '2', '/a', '/li',
            '/ul'
        ];
        $this->assertHtml($expected, $result);
    }

    protected function setupHelper($options)
    {
        $request = new Request();
        $request = $request->withAttribute('params', [
            'pass' => [],
            'paging' => $options,
        ]);

        $this->View = new View($request);
        $this->Paginator = new PaginatorHelper($this->View);
    }
}
