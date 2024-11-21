<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrapFive();
        if (Schema::hasTable('categories')) {
            $categories = Category::where('parent_id', null)
                ->with('childrenRecursive') // Load nested children
                ->get();
            View::share('categories', $categories);
        }
    }
}
