<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use App\Helpers\DeferredSection;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register a singleton for deferred rendering
        $this->app->singleton('deferred_section', function () {
            return new DeferredSection();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Define @defer Blade directive
        Blade::directive('defer', function ($expression) {
            return "<?php ob_start() ?>";
        });

        // Define @enddefer Blade directive
        Blade::directive('enddefer', function ($expression) {
            return "<?php echo app('deferred_section')->push(ob_get_clean()) ?>";
        });

        Schema::defaultStringLength(191);
    }
}
