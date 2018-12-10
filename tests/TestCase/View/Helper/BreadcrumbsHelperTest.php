<?php
namespace BootstrapUI\Test\TestCase\View\Helper;

use BootstrapUI\View\Helper\BreadcrumbsHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

class BreadcrumbsHelperTest extends TestCase
{
    /**
     * @var View
     */
    public $View;

    /**
     * @var BreadcrumbsHelper
     */
    public $Breadcrumbs;

    public function setUp()
    {
        parent::setUp();

        $this->View = new View();
        $this->Breadcrumbs = new BreadcrumbsHelper($this->View);
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->Breadcrumbs, $this->View);
    }

    public function testCrumbList()
    {
        $result = $this->Breadcrumbs
            ->add('jadb')
            ->add('admad')
            ->add('joe')
            ->prepend('first')
            ->insertAt(2, 'at index 2')
            ->insertAfter('admad', 'after admad')
            ->insertBefore('joe', 'before joe')
            ->render();

        $expected = [
            'nav' => ['aria-label' => 'breadcrumb'],
                'ol' => ['class' => 'breadcrumb'],
                    ['li' => ['class' => 'breadcrumb-item']],
                        ['span' => true],
                        'first',
                        '/span',
                    '/li',
                    ['li' => ['class' => 'breadcrumb-item']],
                        ['span' => true],
                        'jadb',
                        '/span',
                    '/li',
                    ['li' => ['class' => 'breadcrumb-item']],
                        ['span' => true],
                        'at index 2',
                        '/span',
                    '/li',
                    ['li' => ['class' => 'breadcrumb-item']],
                        ['span' => true],
                        'admad',
                        '/span',
                    '/li',
                    ['li' => ['class' => 'breadcrumb-item']],
                        ['span' => true],
                        'after admad',
                        '/span',
                    '/li',
                    ['li' => ['class' => 'breadcrumb-item']],
                        ['span' => true],
                        'before joe',
                        '/span',
                    '/li',
                    ['li' => ['class' => 'breadcrumb-item active', 'aria-current' => 'page']],
                        ['span' => true],
                        'joe',
                        '/span',
                    '/li',
                '/ol',
            '/nav'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testAttributes()
    {
        $attributes = [
            'wrapper' => ['class' => 'wrapper-class'],
            'separator' => ['class' => 'separator-class', 'innerAttrs' => ['class' => 'separator-inner-class']],
            'item' => ['class' => 'item-class', 'innerAttrs' => ['class' => 'item-inner-class']],
            'itemWithoutLink' => ['class' => 'itemWithoutLink-class', 'innerAttrs' => ['class' => 'itemWithoutLink-inner-class']],
        ];

        $result = $this->Breadcrumbs
            ->add('joe', null, $attributes['itemWithoutLink'])
            ->add('black', '/foo/bar', $attributes['item'])
            ->render($attributes['wrapper'], $attributes['separator']);

        $expected = [
            'nav' => ['aria-label' => 'breadcrumb'],
                'ol' => ['class' => 'wrapper-class breadcrumb'],
                    ['li' => ['class' => 'itemWithoutLink-class breadcrumb-item']],
                        ['span' => ['class' => 'itemWithoutLink-inner-class']],
                        'joe',
                        '/span',
                    '/li',
                    ['li' => ['class' => 'item-class breadcrumb-item active']],
                        ['a' => ['href' => '/foo/bar', 'class' => 'item-inner-class', 'aria-current' => 'page']],
                            'black',
                        '/a',
                    '/li',
                '/ol',
            '/nav'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testAriaCurrentLastWithLink()
    {
        $this->Breadcrumbs->setConfig('ariaCurrent', 'lastWithLink');

        $result = $this->Breadcrumbs
            ->add('first')
            ->add('last with link', '/foo/bar')
            ->add('last')
            ->render();

        $expected = [
            'nav' => ['aria-label' => 'breadcrumb'],
                'ol' => ['class' => 'breadcrumb'],
                    ['li' => ['class' => 'breadcrumb-item']],
                        ['span' => true],
                        'first',
                        '/span',
                    '/li',
                    ['li' => ['class' => 'breadcrumb-item active']],
                        ['a' => ['href' => '/foo/bar', 'aria-current' => 'page']],
                            'last with link',
                        '/a',
                    '/li',
                    ['li' => ['class' => 'breadcrumb-item']],
                        ['span' => true],
                        'last',
                        '/span',
                    '/li',
                '/ol',
            '/nav'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testAriaCurrentLastWithLinkNoCrumbWithLink()
    {
        $this->Breadcrumbs->setConfig('ariaCurrent', 'lastWithLink');

        $result = $this->Breadcrumbs
            ->add('first')
            ->add('second')
            ->render();

        $expected = [
            'nav' => ['aria-label' => 'breadcrumb'],
                'ol' => ['class' => 'breadcrumb'],
                    ['li' => ['class' => 'breadcrumb-item']],
                        ['span' => true],
                        'first',
                        '/span',
                    '/li',
                    ['li' => ['class' => 'breadcrumb-item']],
                        ['span' => true],
                        'second',
                        '/span',
                    '/li',
                '/ol',
            '/nav'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testAriaCurrentRemoveAndInject()
    {
        $result = $this->Breadcrumbs
            ->add('first')
            ->add('second')
            ->render();

        $expected = [
            'nav' => ['aria-label' => 'breadcrumb'],
                'ol' => ['class' => 'breadcrumb'],
                    ['li' => ['class' => 'breadcrumb-item']],
                        ['span' => true],
                        'first',
                        '/span',
                    '/li',
                    ['li' => ['class' => 'breadcrumb-item active', 'aria-current' => 'page']],
                        ['span' => true],
                        'second',
                        '/span',
                    '/li',
                '/ol',
            '/nav'
        ];
        $this->assertHtml($expected, $result);

        $result = $this->Breadcrumbs
            ->add('third')
            ->render();

        $expected = [
            'nav' => ['aria-label' => 'breadcrumb'],
                'ol' => ['class' => 'breadcrumb'],
                    ['li' => ['class' => 'breadcrumb-item']],
                        ['span' => true],
                        'first',
                        '/span',
                    '/li',
                    ['li' => ['class' => 'breadcrumb-item']],
                        ['span' => true],
                        'second',
                        '/span',
                    '/li',
                    ['li' => ['class' => 'breadcrumb-item active', 'aria-current' => 'page']],
                        ['span' => true],
                        'third',
                        '/span',
                    '/li',
                '/ol',
            '/nav'
        ];
        $this->assertHtml($expected, $result);
    }

    public function testNoCrumbs()
    {
        $result = $this->Breadcrumbs->render();
        $this->assertEmpty($result);
    }
}
