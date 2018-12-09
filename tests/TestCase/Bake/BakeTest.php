<?php
namespace BootstrapUI\Shell;

use Cake\Console\Shell;
use Cake\Core\Plugin;
use Cake\TestSuite\ConsoleIntegrationTestCase;
use Cake\TestSuite\StringCompareTrait;

class BakeTest extends ConsoleIntegrationTestCase
{
    use StringCompareTrait;

    protected $generatedFile = '';

    public $fixtures = [
        'plugin.BootstrapUI.Articles',
        'plugin.BootstrapUI.Authors'
    ];

    public function setUp()
    {
        parent::setUp();

        $this->_compareBasePath = Plugin::path('BootstrapUI') . 'tests' . DS . 'comparisons' . DS . 'Template' . DS;

        $this->loadPlugins([
            'Bake',
            'WyriHaximus/TwigView' => [
                'bootstrap' => true,
            ]
        ]);
    }

    public function tearDown()
    {
        parent::tearDown();

        if ($this->generatedFile) {
            unlink($this->generatedFile);
            $this->generatedFile = '';
        }
    }

    public function testBakeAdd()
    {
        $this->generatedFile = APP . 'Template/Articles/add.ctp';

        $this->exec('bake template Articles add -t BootstrapUI');

        $this->assertExitCode(Shell::CODE_SUCCESS);
        $this->assertFileExists($this->generatedFile);

        $result = file_get_contents($this->generatedFile);
        $this->assertSameAsFile(__FUNCTION__ . '.ctp', $result);
    }

    public function testBakeEdit()
    {
        $this->generatedFile = APP . 'Template/Articles/edit.ctp';

        $this->exec('bake template Articles edit -t BootstrapUI');

        $this->assertExitCode(Shell::CODE_SUCCESS);
        $this->assertFileExists($this->generatedFile);

        $result = file_get_contents($this->generatedFile);
        $this->assertSameAsFile(__FUNCTION__ . '.ctp', $result);
    }

    public function testBakeIndex()
    {
        $this->generatedFile = APP . 'Template/Articles/index.ctp';

        $this->exec('bake template Articles index -t BootstrapUI');

        $this->assertExitCode(Shell::CODE_SUCCESS);
        $this->assertFileExists($this->generatedFile);

        $result = file_get_contents($this->generatedFile);
        $this->assertSameAsFile(__FUNCTION__ . '.ctp', $result);
    }

    public function testBakeLogin()
    {
        $this->generatedFile = APP . 'Template/Articles/login.ctp';

        $this->exec('bake template Articles login -t BootstrapUI');

        $this->assertExitCode(Shell::CODE_SUCCESS);
        $this->assertFileExists($this->generatedFile);

        $result = file_get_contents($this->generatedFile);
        $this->assertSameAsFile(__FUNCTION__ . '.ctp', $result);
    }

    public function testBakeView()
    {
        $this->generatedFile = APP . 'Template/Articles/view.ctp';

        $this->exec('bake template Articles view -t BootstrapUI');

        $this->assertExitCode(Shell::CODE_SUCCESS);
        $this->assertFileExists($this->generatedFile);

        $result = file_get_contents($this->generatedFile);
        $this->assertSameAsFile(__FUNCTION__ . '.ctp', $result);
    }
}
