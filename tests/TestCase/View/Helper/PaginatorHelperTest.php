<?php
namespace BootstrapUI\Test\TestCase\View\Helper;

use BootstrapUI\View\Helper\PaginatorHelper;
use Cake\Core\Configure;
use Cake\I18n\I18n;
use Cake\Network\Request;
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
        $this->View = new View();
        $this->Paginator = new PaginatorHelper($this->View);
        $this->Paginator->Js = $this->getMock('Cake\View\Helper\PaginatorHelper', [], [$this->View]);
        $this->Paginator->request = new Request();
        $this->Paginator->request->addParams([
            'paging' => [
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
            ]
        ]);

        Configure::write('Routing.prefixes', []);
        Router::reload();
        Router::connect('/:controller/:action/*');
        Router::connect('/:plugin/:controller/:action/*');

        $this->locale = I18n::locale();
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

        I18n::locale($this->locale);
    }

    /**
     * testNumbers method
     *
     * @return void
     */
    public function testNumbers()
    {
        $this->Paginator->request->params['paging'] = [
            'Client' => [
                'page' => 8,
                'current' => 3,
                'count' => 30,
                'prevPage' => false,
                'nextPage' => 2,
                'pageCount' => 15,
            ]
        ];
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

        $this->Paginator->request->params['paging'] = [
            'Client' => [
                'page' => 8,
                'current' => 3,
                'count' => 30,
                'prevPage' => false,
                'nextPage' => 2,
                'pageCount' => 15,
            ]
        ];
        $result = $this->Paginator->numbers(['prev' => true, 'next' => true]);
        $expected = [
            'ul' => ['class' => 'pagination'],
            ['li' => ['class' => 'prev disabled']], ['a' => []], ['span' => ['aria-hidden' => 'true']], '&laquo;', '/span', '/a', '/li',
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

        $this->Paginator->request->params['paging'] = [
            'Client' => [
                'page' => 1,
                'current' => 1,
                'count' => 2,
                'prevPage' => false,
                'nextPage' => 2,
                'pageCount' => 2,
            ]
        ];
        $result = $this->Paginator->numbers(['size' => 'lg']);
        $expected = [
            'ul' => ['class' => 'pagination pagination-lg'],
            ['li' => ['class' => 'active']], '<span', '1', 'span' => ['class' => 'sr-only'], '(current)', '/span', '/span', '/li',
            '<li', ['a' => ['href' => '/index?page=2']], '2', '/a', '/li',
            '/ul'
        ];
        $this->assertHtml($expected, $result);
    }
}
