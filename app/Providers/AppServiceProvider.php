<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Optional gitignored host scratch — see docs/local-modules.md
        if (is_file(app_path('Providers/LocalServiceProvider.php'))) {
            $this->app->register(LocalServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $localRoutes = base_path('routes/local.php');

        if (is_file($localRoutes)) {
            Route::middleware('web')->group($localRoutes);
        }

        $localMigrations = database_path('migrations/local');

        if (is_dir($localMigrations)) {
            $this->loadMigrationsFrom($localMigrations);
        }
    }
}
