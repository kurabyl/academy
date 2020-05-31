<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\UseCases\Section\SectionService;
class SectionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->bind(
            SectionService::class
        );
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
