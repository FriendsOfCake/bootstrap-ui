<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\View\Helper;

use BootstrapUI\View\Helper\FlashHelper;
use Cake\Http\ServerRequest;
use Cake\Http\Session;
use Cake\TestSuite\TestCase;
use Cake\View\View;
use PHPUnit\Framework\Attributes\DataProvider;
use UnexpectedValueException;

/**
 * FlashHelperTest class
 */
class FlashHelperTest extends TestCase
{
    /**
     * @var View
     */
    public $View;

    /**
     * @var FlashHelper
     */
    public $Flash;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $session = new Session();
        $this->View = new View(new ServerRequest(['session' => $session]));
        $this->View->loadHelper('BootstrapUI.Html');
        $this->Flash = new FlashHelper($this->View);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->View, $this->Flash);
    }

    public static function flashTypeDefaultsDataProvider(): array
    {
        return [
            ['default', 'info', 'info-circle-fill'],
            ['info', 'info', 'info-circle-fill'],
            ['warning', 'warning', 'exclamation-triangle-fill'],
            ['error', 'danger', 'exclamation-triangle-fill'],
            ['success', 'success', 'check-circle-fill'],
        ];
    }

    /**
     * @param string $type The flash type.
     * @param string $class The alert class.
     * @param string $icon The icon name.
     */
    #[DataProvider('flashTypeDefaultsDataProvider')]
    public function testRenderDefaults(string $type, string $class, string $icon)
    {
        $this->View->getRequest()->getSession()->write('Flash', [
            'flash' => [
                'key' => 'flash',
                'message' => 'Flash message',
                'element' => "flash/$type",
                'params' => [],
            ],
        ]);

        $result = $this->Flash->render();

        $expected = [
            'div' => [
                'role' => 'alert',
                'class' => "alert alert-dismissible fade show d-flex align-items-center alert-$class",
            ],
                'i' => ['class' => "me-2 bi bi-$icon bi-xl"],
                '/i',
                '<div',
                    'Flash message',
                '/div',
                'button' => [
                    'type' => 'button',
                    'class' => 'btn-close',
                    'data-bs-dismiss' => 'alert',
                    'aria-label' => 'Close',
                ],
                '/button',
            '/div',
        ];
        $this->assertHtml($expected, $result, true);
    }

    public function testRenderMultipleMessages()
    {
        $this->View->getRequest()->getSession()->write([
            'Flash' => [
                'flash' => [
                    [
                        'key' => 'flash',
                        'message' => 'This is a calling',
                        'element' => 'flash/default',
                        'params' => [],
                    ],
                    [
                        'key' => 'flash',
                        'message' => 'This is a second message',
                        'element' => 'flash/default',
                        'params' => ['class' => ['extra']],
                    ],
                ],
                'error' => [
                    [
                        'key' => 'error',
                        'message' => 'This is error',
                        'element' => 'flash/error',
                        'params' => [],
                    ],
                ],
            ],
        ]);

        $result = $this->Flash->render();

        $this->assertStringContainsString(
            '<div role="alert" class="alert alert-dismissible fade show d-flex align-items-center alert-info">',
            $result,
        );
        $this->assertStringContainsString('This is a calling', $result);
        $this->assertStringContainsString(
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
            $result,
        );

        $this->assertStringContainsString('<div role="alert" class="extra alert-info">', $result);
        $this->assertStringContainsString('This is a second message', $result);

        $result = $this->Flash->render('error');
        $this->assertStringContainsString(
            '<div role="alert" class="alert alert-dismissible fade show d-flex align-items-center alert-danger">',
            $result,
        );
        $this->assertStringContainsString('This is error', $result);
        $this->assertStringContainsString(
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
            $result,
        );
    }

    public function testRenderNonExistentKey()
    {
        $result = $this->Flash->render('nonExistentKey');
        $this->assertNull($result);
    }

    public function testRenderInvalidKey()
    {
        $this->expectException(UnexpectedValueException::class);
        $this->expectExceptionMessage('Value for flash setting key "invalidKey" must be an array.');

        $this->View->getRequest()->getSession()->write('Flash', [
            'invalidKey' => 'invalid',
        ]);

        $this->Flash->render('invalidKey');
    }

    public function testRenderCustomKey()
    {
        $this->View->getRequest()->getSession()->write('Flash', [
            'custom' => [
                'key' => 'custom',
                'message' => 'Flash message for custom key',
                'element' => 'flash/default',
                'params' => [],
            ],
        ]);

        $result = $this->Flash->render('custom');
        $this->assertStringContainsString('Flash message for custom key', $result);
    }

    public function testRenderOptions()
    {
        $this->View->getRequest()->getSession()->write('Flash', [
            'flash' => [
                'key' => 'flash',
                'message' => 'Flash message',
                'element' => 'flash/default',
                'params' => [],
            ],
        ]);

        $result = $this->Flash->render('flash', ['params' => ['class' => ['foo bar']]]);
        $this->assertStringContainsString('<div role="alert" class="foo bar alert-info">', $result);
    }

    public function testRenderCustomClass()
    {
        $this->View->getRequest()->getSession()->write('Flash', [
            'flash' => [
                'key' => 'flash',
                'message' => 'Flash message',
                'element' => 'flash/default',
                'params' => ['class' => 'foo bar'],
            ],
        ]);

        $result = $this->Flash->render();
        $this->assertStringContainsString('<div role="alert" class="foo bar">', $result);
        $this->assertStringNotContainsString('data-bs-dismiss="alert"', $result);
    }

    public function testRenderCustomAlertClass()
    {
        $this->View->getRequest()->getSession()->write('Flash', [
            'flash' => [
                'key' => 'flash',
                'message' => 'Flash message',
                'element' => 'flash/default',
                'params' => ['class' => 'primary'],
            ],
        ]);

        $result = $this->Flash->render();
        $this->assertStringContainsString(
            '<div role="alert" class="alert alert-dismissible fade show d-flex align-items-center alert-primary">',
            $result,
        );
        $this->assertStringContainsString('data-bs-dismiss="alert"', $result);
    }

    public function testRenderUnescapedMessage()
    {
        $this->View->getRequest()->getSession()->write('Flash', [
            'flash' => [
                'key' => 'flash',
                'message' => 'This is a <a href="#">message containing HTML</a>',
                'element' => 'flash/default',
                'params' => ['escape' => false],
            ],
        ]);

        $result = $this->Flash->render();
        $this->assertStringContainsString('This is a <a href="#">message containing HTML</a>', $result);
    }

    public function testRenderCustomElement()
    {
        $this->View->getRequest()->getSession()->write('Flash', [
            'flash' => [
                'key' => 'flash',
                'message' => 'Flash message',
                'element' => 'flash/custom',
                'params' => [],
            ],
        ]);

        $result = $this->Flash->render();

        $expected = [
            'class' => [
                'alert',
                'alert-dismissible',
                'fade',
                'show',
                'd-flex',
                'align-items-center',
            ],
            'attributes' => [
                'role' => 'alert',
            ],
            'icon' => true,
            'iconMap' => [
                'default' => 'info-circle-fill',
                'success' => 'check-circle-fill',
                'error' => 'exclamation-triangle-fill',
                'info' => 'info-circle-fill',
                'warning' => 'exclamation-triangle-fill',
            ],
            'element' => 'BootstrapUI.flash/default',
        ];
        $this->assertSame(json_encode($expected), $result);
    }

    public function testIconOptionsOnlyViaConfig()
    {
        $this->Flash->setConfig('icon', [
            'size' => '2xl',
            'class' => 'foo bar',
        ]);

        $this->View->getRequest()->getSession()->write('Flash', [
            'flash' => [
                'key' => 'flash',
                'message' => 'Flash message',
                'element' => 'flash/default',
                'params' => [],
            ],
        ]);

        $result = $this->Flash->render();
        $this->assertStringContainsString('<i class="foo bar bi bi-info-circle-fill bi-2xl"></i>', $result);
    }

    public function testIconOptionsOnlyViaParamsOption()
    {
        $this->View->getRequest()->getSession()->write('Flash', [
            'flash' => [
                'key' => 'flash',
                'message' => 'Flash message',
                'element' => 'flash/default',
                'params' => [
                    'icon' => [
                        'size' => '2xl',
                        'class' => 'foo bar',
                    ],
                ],
            ],
        ]);

        $result = $this->Flash->render();
        $this->assertStringContainsString('<i class="foo bar bi bi-info-circle-fill bi-2xl"></i>', $result);
    }

    public function testCustomIcon()
    {
        $this->View->getRequest()->getSession()->write('Flash', [
            'flash' => [
                'key' => 'flash',
                'message' => 'Flash message',
                'element' => 'flash/default',
                'params' => [
                    'icon' => 'mic-mute-fill',
                ],
            ],
        ]);

        $result = $this->Flash->render();
        $this->assertStringContainsString('<i class="me-2 bi bi-mic-mute-fill bi-xl"></i>', $result);
    }

    public function testCustomIconOptions()
    {
        $this->View->getRequest()->getSession()->write('Flash', [
            'flash' => [
                'key' => 'flash',
                'message' => 'Flash message',
                'element' => 'flash/default',
                'params' => [
                    'icon' => [
                        'name' => 'mic-mute-fill',
                        'size' => '2xl',
                        'class' => 'foo bar',
                    ],
                ],
            ],
        ]);

        $result = $this->Flash->render();
        $this->assertStringContainsString('<i class="foo bar bi bi-mic-mute-fill bi-2xl"></i>', $result);
    }

    public function testCustomIconSet()
    {
        $this->View->getRequest()->getSession()->write('Flash', [
            'flash' => [
                'key' => 'flash',
                'message' => 'Flash message',
                'element' => 'flash/default',
                'params' => [
                    'icon' => [
                        'namespace' => 'fas',
                        'prefix' => 'fa',
                        'name' => 'microphone-slash',
                        'size' => '2xl',
                    ],
                ],
            ],
        ]);

        $result = $this->Flash->render();
        $this->assertStringContainsString('<i class="me-2 fas fa-microphone-slash fa-2xl"></i>', $result);
    }

    public function testCustomHtmlIcon()
    {
        $this->View->getRequest()->getSession()->write('Flash', [
            'flash' => [
                'key' => 'flash',
                'message' => 'Flash message',
                'element' => 'flash/default',
                'params' => [
                    'icon' => '<span class="material-icons">info</span>',
                ],
            ],
        ]);

        $result = $this->Flash->render();

        $expected = [
            'div' => [
                'role' => 'alert',
                'class' => 'alert alert-dismissible fade show d-flex align-items-center alert-info',
            ],
                'span' => ['class' => 'material-icons'],
                    'info',
                '/span',
                '<div',
                    'Flash message',
                '/div',
                'button' => [
                    'type' => 'button',
                    'class' => 'btn-close',
                    'data-bs-dismiss' => 'alert',
                    'aria-label' => 'Close',
                ],
                '/button',
            '/div',
        ];
        $this->assertHtml($expected, $result, true);
    }

    public static function flashTypeDataProvider(): array
    {
        return [
            ['default'],
            ['info'],
            ['warning'],
            ['error'],
            ['success'],
        ];
    }

    /**
     * @param string $type The flash type.
     */
    #[DataProvider('flashTypeDataProvider')]
    public function testCustomDefaultIcon(string $type)
    {
        $this->Flash->setConfig('icon', 'info');

        $this->View->getRequest()->getSession()->write('Flash', [
            'flash' => [
                'key' => 'flash',
                'message' => 'Flash message',
                'element' => "flash/$type",
                'params' => [],
            ],
        ]);

        $result = $this->Flash->render();
        $this->assertStringContainsString('<i class="me-2 bi bi-info bi-xl"></i>', $result);
    }

    /**
     * @param string $type The flash type.
     */
    #[DataProvider('flashTypeDataProvider')]
    public function testDisableIconsViaConfig(string $type)
    {
        $this->Flash->setConfig('icon', false);

        $this->View->getRequest()->getSession()->write('Flash', [
            'flash' => [
                'key' => 'flash',
                'message' => 'Flash message',
                'element' => "flash/$type",
                'params' => [],
            ],
        ]);

        $result = $this->Flash->render();
        $this->assertStringNotContainsString('<i', $result);
    }

    /**
     * @dataProvider flashTypeDataProvider
     * @param string $type The flash type.
     */
    #[DataProvider('flashTypeDataProvider')]
    public function testDisableIconViaParamsOption(string $type)
    {
        $this->View->getRequest()->getSession()->write('Flash', [
            'flash' => [
                'key' => 'flash',
                'message' => 'Flash message',
                'element' => "flash/$type",
                'params' => [
                    'icon' => false,
                ],
            ],
        ]);

        $result = $this->Flash->render();
        $this->assertStringNotContainsString('<i', $result);
    }

    /**
     * @param string $type The flash type.
     */
    #[DataProvider('flashTypeDataProvider')]
    public function testCustomIconClassMap(string $type)
    {
        $iconClassMap = [
            'default' => 'info-circle',
            'info' => 'info-circle',
            'warning' => 'exclamation-triangle-fill',
            'error' => 'exclamation-triangle-fill',
            'success' => 'check2-circle',
        ];
        $this->Flash->setConfig('iconMap', $iconClassMap);

        $this->View->getRequest()->getSession()->write('Flash', [
            'flash' => [
                'key' => 'flash',
                'message' => 'Flash message',
                'element' => "flash/$type",
                'params' => [],
            ],
        ]);

        $result = $this->Flash->render();

        $this->assertStringContainsString(
            sprintf('<i class="me-2 bi bi-%s bi-xl"></i>', $iconClassMap[$type]),
            $result,
        );
    }

    /**
     * @param string $type The flash type.
     */
    #[DataProvider('flashTypeDataProvider')]
    public function testCustomIconClassMapOptions(string $type)
    {
        $options = [
            'size' => '2xl',
            'class' => 'foo bar',
        ];
        $iconClassMap = [
            'default' => [
                'name' => 'info-circle',
            ] + $options,
            'info' => [
                'name' => 'info-circle',
            ] + $options,
            'warning' => [
                'name' => 'exclamation-triangle-fill',
            ] + $options,
            'error' => [
                'name' => 'exclamation-triangle-fill',
            ] + $options,
            'success' => [
                'name' => 'check2-circle',
            ] + $options,
            'custom' => [
                'name' => 'mic-mute-fill',
            ] + $options,
        ];
        $this->Flash->setConfig('iconMap', $iconClassMap);

        $this->View->getRequest()->getSession()->write('Flash', [
            'flash' => [
                'key' => 'flash',
                'message' => 'Flash message',
                'element' => "flash/$type",
                'params' => [],
            ],
        ]);

        $result = $this->Flash->render();

        $this->assertStringContainsString(
            sprintf('<i class="foo bar bi bi-%s bi-2xl"></i>', $iconClassMap[$type]['name']),
            $result,
        );
    }
}
