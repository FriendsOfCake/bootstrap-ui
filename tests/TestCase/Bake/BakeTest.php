<?php
declare(strict_types=1);

namespace BootstrapUI\Test\TestCase\Bake;

use Cake\Command\Command;
use Cake\Console\TestSuite\ConsoleIntegrationTestTrait;
use Cake\Core\Plugin;
use Cake\TestSuite\StringCompareTrait;
use Cake\TestSuite\TestCase;

class BakeTest extends TestCase
{
    use ConsoleIntegrationTestTrait;
    use StringCompareTrait;

    protected string $generatedFile = '';

    protected array $fixtures = [
        'plugin.BootstrapUI.Articles',
        'plugin.BootstrapUI.Authors',
    ];

    public function setUp(): void
    {
        parent::setUp();

        $this->compareBasePath = Plugin::path('BootstrapUI') . 'tests' . DS . 'comparisons' . DS . 'Template' . DS;
    }

    public function tearDown(): void
    {
        parent::tearDown();

        if ($this->generatedFile) {
            unlink($this->generatedFile);
            $this->generatedFile = '';
        }
    }

    public function testBakeAdd(): void
    {
        $this->generatedFile = TEST_APP . 'templates/Articles/add.php';

        $this->exec('bake template Articles add -t BootstrapUI');

        $this->assertExitCode(Command::CODE_SUCCESS);
        $this->assertFileExists($this->generatedFile);

        $result = file_get_contents($this->generatedFile);
        $this->assertSameAsFile(__FUNCTION__ . '.php', $result);
    }

    public function testBakeEdit(): void
    {
        $this->generatedFile = TEST_APP . 'templates/Articles/edit.php';

        $this->exec('bake template Articles edit -t BootstrapUI');

        $this->assertExitCode(Command::CODE_SUCCESS);
        $this->assertFileExists($this->generatedFile);

        $result = file_get_contents($this->generatedFile);
        $this->assertSameAsFile(__FUNCTION__ . '.php', $result);
    }

    public function testBakeIndex(): void
    {
        $this->generatedFile = TEST_APP . 'templates/Articles/index.php';

        $this->exec('bake template Articles index -t BootstrapUI');

        $this->assertExitCode(Command::CODE_SUCCESS);
        $this->assertFileExists($this->generatedFile);

        $result = file_get_contents($this->generatedFile);
        $this->assertSameAsFile(__FUNCTION__ . '.php', $result);
    }

    public function testBakeLogin(): void
    {
        $this->generatedFile = TEST_APP . 'templates/Articles/login.php';

        $this->exec('bake template Articles login -t BootstrapUI');

        $this->assertExitCode(Command::CODE_SUCCESS);
        $this->assertFileExists($this->generatedFile);

        $result = file_get_contents($this->generatedFile);
        $this->assertSameAsFile(__FUNCTION__ . '.php', $result);
    }

    public function testBakeView(): void
    {
        $this->generatedFile = TEST_APP . 'templates/Articles/view.php';

        $this->exec('bake template Articles view -t BootstrapUI');

        $this->assertExitCode(Command::CODE_SUCCESS);
        $this->assertFileExists($this->generatedFile);

        $result = file_get_contents($this->generatedFile);
        $this->assertSameAsFile(__FUNCTION__ . '.php', $result);
    }
}
