<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Asset;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    
public function boot()
{
    View::composer('assets.*', function($view) {
        $view->with('subkategoris', Asset::whereNotNull('kategori_1')
            ->distinct()->pluck('kategori_1')->filter()->values());
        $view->with('kategoris', Asset::whereNotNull('kategori')
            ->distinct()->pluck('kategori')->filter()->values());
    });
}
}
