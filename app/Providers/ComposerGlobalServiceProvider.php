<?php

namespace App\Providers;

use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Support\ServiceProvider;

class ComposerGlobalServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param ViewFactory $view
     */
    public function boot(ViewFactory $view)
    {
        $view->composer('*', 'App\omega\Composer\GlobalVariables');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
