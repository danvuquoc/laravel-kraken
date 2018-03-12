<?php
/**
 * Created by PhpStorm.
 * User: danvuquoc
 * Date: 3/12/18
 * Time: 10:53 AM
 */

namespace Danvuquoc\Kraken\Tests;

use Danvuquoc\Kraken\KrakenFacade;
use Danvuquoc\Kraken\KrakenServiceProvider;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Orchestra\Testbench\TestCase;
use Kraken;

class KrakenTest extends TestCase
{
    /**
     * @var string The path to the configuration file.
     */
    protected $configPath = 'config/kraken.php';

    /**
     * @var Local
     */
    protected $adapter;

    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * Set up the testing environment.
     */
    public function setUp()
    {
        parent::setUp();

        $this->adapter = new Local(base_path());
        $this->filesystem = new Filesystem($this->adapter);

        $this->cleanConfiguration();
    }

    /**
     * Tear down the testing environment.
     */
    public function tearDown()
    {
        parent::tearDown();
        $this->cleanConfiguration();
    }

    /**
     * Clean up any existing configs.
     */
    public function cleanConfiguration()
    {
        if ($this->filesystem->has($this->configPath)) {
            $this->filesystem->delete($this->configPath);
        }
    }

    /**
     * Load the provider.
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [KrakenServiceProvider::class];
    }

    /**
     * Load the facade.
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return ['KrakenIO' => KrakenFacade::class];
    }

    /**
     * Test to make sure configuration publishing works.
     */
    public function testConfigurationPublishing()
    {
        $exists = $this->filesystem->has($this->configPath);
        $this->assertFalse($exists);

        $this->artisan('vendor:publish', [
            '--provider' => KrakenServiceProvider::class,
        ]);

        $exists = $this->filesystem->has($this->configPath);
        $this->assertTrue($exists);
    }

    /**
     * Test to make sure the app singleton exists.
     */
    public function testKrakenObject()
    {
        $this->assertInstanceOf(Kraken::class, $this->app['Kraken']);
    }
}