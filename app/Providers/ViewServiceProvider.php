<?php

namespace App\Providers;

use App\Models\Gtm;
use App\Models\Service;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        View::composer('layout.front_end', function($view) {
            $view->with(['services' => Service::where('status',1)->select('uuid','name','slug')->get(),'gtm' => Gtm::first()]);
        });
    }
}
