<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::defaultView('vendor.pagination.tailwind'); // ← remplacer useTailwind()

        if (config('app.env') === 'production') {
            \URL::forceScheme('https');
        }
    }
}