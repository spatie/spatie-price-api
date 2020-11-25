<?php

namespace Spatie\PriceApi;

use Illuminate\Support\ServiceProvider;
use Spatie\PriceApi\Commands\PriceApiCommand;

class PriceApiServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/spatie-price-api.php' => config_path('spatie-price-api.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../resources/views' => base_path('resources/views/vendor/spatie-price-api'),
            ], 'views');

            $migrationFileName = 'create_spatie_price_api_table.php';
            if (! $this->migrationFileExists($migrationFileName)) {
                $this->publishes([
                    __DIR__ . "/../database/migrations/{$migrationFileName}.stub" => database_path('migrations/' . date('Y_m_d_His', time()) . '_' . $migrationFileName),
                ], 'migrations');
            }

            $this->commands([
                PriceApiCommand::class,
            ]);
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'spatie-price-api');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/spatie-price-api.php', 'spatie-price-api');
    }

    public static function migrationFileExists(string $migrationFileName): bool
    {
        $len = strlen($migrationFileName);
        foreach (glob(database_path("migrations/*.php")) as $filename) {
            if ((substr($filename, -$len) === $migrationFileName)) {
                return true;
            }
        }

        return false;
    }
}
