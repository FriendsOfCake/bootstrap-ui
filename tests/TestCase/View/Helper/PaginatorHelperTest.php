<?php
namespace BootstrapUI\Test\TestCase\View\Helper;

use BootstrapUI\View\Helper\PaginatorHelper;
use Cake\Http\ServerRequest as Request;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * PaginatorHelperTest class
 *
 */
class PaginatorHelperTest extends TestCase
{
    /**
     * @var \Cake\View\View
     */
    protected $View;

    /**
     * @var \BootstrapUI\View\Helper\PaginatorHelper
     */
    protected $Paginator;

    /**
     * @var \Cake\Http\ServerRequest
     */
    protected $request;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        Router::reload();
        Router::defaultRouteClass(DashedRoute::class);

        $this->request = (new Request('/clients'))
            ->withParam('controller', 'Clients')
            ->withParam('action', 'index');

        Router::connect('/:controller', ['action' => 'index']);
        Router::connect('/:controller/:action/*');
        Router::pushRequest($this->request);
    }

    /**
     * testNumbers method
     *
     * @return void
     */
    public function testNumbers()
    {
        $this->setupHelper([
            'Clients' => [
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
            '<li', ['a' => ['href' => '/clients?page=4']], '4', '/a', '/li',
            '<li', ['a' => ['href' => '/clients?page=5']], '5', '/a', '/li',
            '<li', ['a' => ['href' => '/clients?page=6']], '6', '/a', '/li',
            '<li', ['a' => ['href' => '/clients?page=7']], '7', '/a', '/li',
            ['li' => ['class' => 'active']], '<span', '8', 'span' => ['class' => 'sr-only'], '(current)', '/span', '/span', '/li',
            '<li', ['a' => ['href' => '/clients?page=9']], '9', '/a', '/li',
            '<li', ['a' => ['href' => '/clients?page=10']], '10', '/a', '/li',
            '<li', ['a' => ['href' => '/clients?page=11']], '11', '/a', '/li',
            '<li', ['a' => ['href' => '/clients?page=12']], '12', '/a', '/li',
            '/ul',
        ];
        $this->assertHtml($expected, $result);

        $this->Paginator->request = $this->Paginator->request->withParam('paging', [
            'Clients' => [
                'page' => 8,
                'current' => 3,
                'count' => 30,
                'prevPage' => false,
                'nextPage' => 2,
                'pageCount' => 15,
            ],
        ]);
        $result = $this->Paginator->numbers(['prev' => true, 'next' => true]);
        $expected = [
            'ul' => ['class' => 'pagination'],
            ['li' => ['class' => 'previous disabled']], ['a' => []], ['span' => ['aria-hidden' => 'true']], '&laquo;', '/span', '/a', '/li',
            '<li', ['a' => ['href' => '/clients?page=4']], '4', '/a', '/li',
            '<li', ['a' => ['href' => '/clients?page=5']], '5', '/a', '/li',
            '<li', ['a' => ['href' => '/clients?page=6']], '6', '/a', '/li',
            '<li', ['a' => ['href' => '/clients?page=7']], '7', '/a', '/li',
            ['li' => ['class' => 'active']], '<span', '8', 'span' => ['class' => 'sr-only'], '(current)', '/span', '/span', '/li',
            '<li', ['a' => ['href' => '/clients?page=9']], '9', '/a', '/li',
            '<li', ['a' => ['href' => '/clients?page=10']], '10', '/a', '/li',
            '<li', ['a' => ['href' => '/clients?page=11']], '11', '/a', '/li',
            '<li', ['a' => ['href' => '/clients?page=12']], '12', '/a', '/li',
            ['li' => ['class' => 'next']], ['a' => ['rel' => 'next', 'aria-label' => 'Next', 'href' => '/clients?page=9']], ['span' => ['aria-hidden' => 'true']], '&raquo;', '/span', '/a', '/li',
            '/ul',
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
            '<li', ['a' => ['href' => '/clients?page=2']], '2', '/a', '/li',
            '/ul',
        ];
        $this->assertHtml($expected, $result);
    }

    protected function setupHelper($options)
    {
        $request = $this->request->withAttribute('params', [
            'pass' => [],
            'paging' => $options,
        ]);

        $this->View = new View($request);
        $this->Paginator = new PaginatorHelper($this->View);
    }
}
