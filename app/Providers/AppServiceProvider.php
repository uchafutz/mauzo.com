<?php

namespace App\Providers;

use App\View\Components\Form\CustomInput;
use App\View\Components\Form\CustomTextarea;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();
        Blade::component('form.custom-input', CustomInput::class);
        Blade::component('form.custom-textarea', CustomTextarea::class);
    }
}
