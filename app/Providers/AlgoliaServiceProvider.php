<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Algolia\AlgoliaSearch\SearchClient;

class AlgoliaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
{
    $this->app->singleton(SearchClient::class, function ($app) {
        return SearchClient::create(
            config('services.algolia.application_id'),
            config('services.algolia.secret')
        );
    });
}
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
