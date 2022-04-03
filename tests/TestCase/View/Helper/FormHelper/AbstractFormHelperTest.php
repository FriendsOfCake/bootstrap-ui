<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper;

use BootstrapUI\View\Helper\FormHelper;
use Cake\Core\Configure;
use Cake\Http\ServerRequest;
use Cake\I18n\I18n;
use Cake\Routing\Router;
use Cake\TestSuite\TestCase;
use Cake\Utility\Security;
use Cake\View\View;

abstract class AbstractFormHelperTest extends TestCase
{
    /**
     * @var \Cake\View\View
     */
    public $View;

    /**
     * @var \BootstrapUI\View\Helper\FormHelper
     */
    public $Form;

    /**
     * @var array
     */
    public $article;

    /**
     * @var string
     */
    public $locale;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        Configure::write('Config.language', 'eng');
        Configure::write('App.base', '');
        Configure::write('App.namespace', 'BootstrapUI\Test\TestCase\View\Helper');
        Configure::delete('Asset');

        $request = new ServerRequest([
            'webroot' => '',
            'base' => '',
            'url' => '/articles/add',
            'params' => [
                'controller' => 'articles',
                'action' => 'add',
                'plugin' => null,
            ],
        ]);
        $this->View = new View($request);
        $this->Form = new FormHelper($this->View);

        Router::reload();
        Router::setRequest($request);

        $this->article = [
            'schema' => [
                'id' => ['type' => 'integer'],
                'author_id' => ['type' => 'integer', 'null' => true],
                'title' => ['type' => 'string', 'null' => true],
                'body' => 'text',
                'published' => ['type' => 'boolean', 'length' => 1, 'default' => 0],
                '_constraints' => ['primary' => ['type' => 'primary', 'columns' => ['id']]],
            ],
            'required' => [
                'author_id' => true,
                'title' => true,
            ],
        ];

        Security::setSalt('foo!');

        $routeBuilder = Router::createRouteBuilder('/');
        $routeBuilder->connect('/{controller}', ['action' => 'index']);
        $routeBuilder->connect('/{controller}/{action}/*');

        $this->locale = I18n::getLocale();
        I18n::setLocale('eng');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->Form, $this->View);
        $this->getTableLocator()->clear();
        I18n::setLocale($this->locale);
    }
}
