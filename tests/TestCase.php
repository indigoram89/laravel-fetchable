<?php

namespace Indigoram89\Fetchable\Test;

use DB;
use File;
use Illuminate\Database\Schema\Blueprint;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->createDirectory();

        $this->setupDatabase();

        $this->runMigrations();
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');

        $app['config']->set('database.connections.sqlite', [
            'driver'   => 'sqlite',
            'database' => $this->getTempDirectory('/database.sqlite'),
            'prefix'   => '',
        ]);
    }

    /**
     * Create temp directory for database.
     *
     * @return void
     */
    protected function createDirectory()
    {
        $directory = $this->getTempDirectory();

        if (File::isDirectory($directory)) {
            File::deleteDirectory($directory);
        }

        File::makeDirectory($directory);
    }

    /**
     * Run migrations.
     *
     * @return void
     */
    protected function setupDatabase()
    {
        file_put_contents($this->getTempDirectory('/database.sqlite'), null);
    }

    /**
     * Get temp directory path.
     *
     * @param  string|null $path
     * @return string
     */
    protected function getTempDirectory(string $path = null) : string
    {
        return __DIR__.'/temp' . $path;
    }

    /**
     * Run migrations.
     *
     * @return void
     */
    protected function runMigrations()
    {
        DB::connection()->getSchemaBuilder()->create('currencies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->string('fetchable');
            $table->json('translated')->nullable();
        });
    }
}
