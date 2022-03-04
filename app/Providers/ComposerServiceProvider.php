<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\PostCategoryComposer;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('frontend.main', PostCategoryComposer::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}