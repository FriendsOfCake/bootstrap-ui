<?php
declare(strict_types=1);

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
        'plugin.BootstrapUI.Authors',
    ];

    public function setUp(): void
    {
        parent::setUp();

        $this->_compareBasePath = Plugin::path('BootstrapUI') . 'tests' . DS . 'comparisons' . DS . 'Template' . DS;

        $this->loadPlugins([
            'Bake',
            'Cake/TwigView' => [
                'bootstrap' => true,
            ],
        ]);
        $this->useCommandRunner();
    }

    public function tearDown(): void
    {
        parent::tearDown();

        if ($this->generatedFile) {
            unlink($this->generatedFile);
            $this->generatedFile = '';
        }
    }

    public function testBakeAdd()
    {
        $this->generatedFile = TEST_APP . 'templates/Articles/add.php';

        $this->exec('bake template Articles add -t BootstrapUI');

        $this->assertExitCode(Shell::CODE_SUCCESS);
        $this->assertFileExists($this->generatedFile);

        $result = file_get_contents($this->generatedFile);
        $this->assertSameAsFile(__FUNCTION__ . '.php', $result);
    }

    public function testBakeEdit()
    {
        $this->generatedFile = TEST_APP . 'templates/Articles/edit.php';

        $this->exec('bake template Articles edit -t BootstrapUI');

        $this->assertExitCode(Shell::CODE_SUCCESS);
        $this->assertFileExists($this->generatedFile);

        $result = file_get_contents($this->generatedFile);
        $this->assertSameAsFile(__FUNCTION__ . '.php', $result);
    }

    public function testBakeIndex()
    {
        $this->generatedFile = TEST_APP . 'templates/Articles/index.php';

        $this->exec('bake template Articles index -t BootstrapUI');

        $this->assertExitCode(Shell::CODE_SUCCESS);
        $this->assertFileExists($this->generatedFile);

        $result = file_get_contents($this->generatedFile);
        $this->assertSameAsFile(__FUNCTION__ . '.php', $result);
    }

    public function testBakeLogin()
    {
        $this->generatedFile = TEST_APP . 'templates/Articles/login.php';

        $this->exec('bake template Articles login -t BootstrapUI');

        $this->assertExitCode(Shell::CODE_SUCCESS);
        $this->assertFileExists($this->generatedFile);

        $result = file_get_contents($this->generatedFile);
        $this->assertSameAsFile(__FUNCTION__ . '.php', $result);
    }

    public function testBakeView()
    {
        $this->generatedFile = TEST_APP . 'templates/Articles/view.php';

        $this->exec('bake template Articles view -t BootstrapUI');

        $this->assertExitCode(Shell::CODE_SUCCESS);
        $this->assertFileExists($this->generatedFile);

        $result = file_get_contents($this->generatedFile);
        $this->assertSameAsFile(__FUNCTION__ . '.php', $result);
    }
}
