<?php
namespace BootstrapUI\Test\TestCase\View\Helper\FormHelper;

use BootstrapUI\View\Helper\FormHelper;
use Cake\Core\Configure;
use Cake\Http\ServerRequest;
use Cake\I18n\I18n;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\TestSuite\TestCase;
use Cake\Utility\Security;
use Cake\View\View;

abstract class AbstractFormHelperTest extends TestCase
{    /**
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
     * @var array
     */
    public $dateRegex = [
        'daysRegex' => 'preg:/(?:<option value="0?([\d]+)">\\1<\/option>[\r\n]*)*/',
        'monthsRegex' => 'preg:/(?:<option value="[\d]+">[\w]+<\/option>[\r\n]*)*/',
        'yearsRegex' => 'preg:/(?:<option value="([\d]+)">\\1<\/option>[\r\n]*)*/',
        'hoursRegex' => 'preg:/(?:<option value="0?([\d]+)">\\1<\/option>[\r\n]*)*/',
        'minutesRegex' => 'preg:/(?:<option value="([\d]+)">0?\\1<\/option>[\r\n]*)*/',
        'secondsRegex' => 'preg:/(?:<option value="([\d]+)">0?\\1<\/option>[\r\n]*)*/',
        'meridianRegex' => 'preg:/(?:<option value="(am|pm)">\\1<\/option>[\r\n]*)*/',
    ];

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
        Router::connect('/:controller', ['action' => 'index']);
        Router::connect('/:controller/:action/*');

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
        TableRegistry::clear();
        I18n::setLocale($this->locale);
    }
}
