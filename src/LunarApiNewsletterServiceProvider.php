<?php

namespace Dystcz\LunarApiNewsletter;

use Dystcz\LunarApi\Domain\JsonApi\Extensions\Facades\SchemaManifest;
use Dystcz\LunarApiNewsletter\Domain\Newsletter\JsonApi\V1\NewsletterSchema;
use Illuminate\Support\ServiceProvider;

class LunarApiNewsletterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/lunar-api-newsletter.php' => config_path('lunar-api-newsletter.php'),
            ], 'config');
        }

        SchemaManifest::registerSchema(NewsletterSchema::class);
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/lunar-api-newsletter.php', 'lunar-api-newsletter');

        // Register the main class to use with the facade
        $this->app->singleton('lunar-api-newsletter', function () {
            return new LunarApiNewsletter();
        });
    }
}
