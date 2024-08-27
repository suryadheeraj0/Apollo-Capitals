<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\Paginator as PaginationPaginator;
use Illuminate\Support\Facades\View as FacadesView;
use Illuminate\Support\Facades\Blade;



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
    public function boot(): void
    {
        //Paginator::useBootstrap() ;
        PaginationPaginator::useBootstrap() ;
    }
}
