<?php

namespace Dystcz\LunarNewsletter\Tests;

use Cartalyst\Converter\Laravel\ConverterServiceProvider;
use Dystcz\LunarApi\LunarApiServiceProvider;
use Dystcz\LunarNewsletter\LunarNewsletterServiceProvider;
use Dystcz\LunarNewsletter\Tests\Stubs\JsonApi\Server;
use Dystcz\LunarNewsletter\Tests\Stubs\Users\User;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Application;
use Kalnoy\Nestedset\NestedSetServiceProvider;
use LaravelJsonApi\Testing\MakesJsonApiRequests;
use LaravelJsonApi\Testing\TestExceptionHandler;
use Lunar\Database\Factories\LanguageFactory;
use Lunar\LunarServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\Activitylog\ActivitylogServiceProvider;
use Spatie\LaravelBlink\BlinkServiceProvider;
use Spatie\MediaLibrary\MediaLibraryServiceProvider;

abstract class TestCase extends Orchestra
{
    use MakesJsonApiRequests;

    protected function setUp(): void
    {
        parent::setUp();

        LanguageFactory::new()->create([
            'code' => 'en',
            'name' => 'English',
        ]);

        config()->set('auth.providers.users.model', User::class);

        activity()->disableLogging();
    }

    /**
     * @param  Application  $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        config()->set('lunar-api.additional_servers', [Server::class]);

        return [
            LunarNewsletterServiceProvider::class,

            // Laravel JsonApi
            \LaravelJsonApi\Encoder\Neomerx\ServiceProvider::class,
            \LaravelJsonApi\Laravel\ServiceProvider::class,
            \LaravelJsonApi\Spec\ServiceProvider::class,

            // Lunar Api
            LunarApiServiceProvider::class,

            // Lunar core
            LunarServiceProvider::class,
            MediaLibraryServiceProvider::class,
            ActivitylogServiceProvider::class,
            ConverterServiceProvider::class,
            NestedSetServiceProvider::class,
            BlinkServiceProvider::class,
        ];
    }

    /**
     * @param  Application  $app
     */
    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'sqlite');

        config()->set('database.migrations', 'migrations');

        config()->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    protected function resolveApplicationExceptionHandler($app): void
    {
        $app->singleton(
            ExceptionHandler::class,
            TestExceptionHandler::class
        );
    }

    /**
     * Define database migrations.
     */
    protected function defineDatabaseMigrations(): void
    {
        $this->loadLaravelMigrations();
    }
}
