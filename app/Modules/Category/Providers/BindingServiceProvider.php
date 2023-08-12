<?php

namespace App\Modules\Category\Providers;

use Illuminate\Support\ServiceProvider;

use App\Modules\Category\Models\Category;
use App\Modules\Category\Observers\CategoryObserver;
use App\Modules\Category\Repositories\CategoryRepository;
use App\Modules\Category\Repositories\CategoryRepositoryImplementation;
use App\Modules\Category\Services\CategoryService;
use App\Modules\Category\Services\CategoryServiceImplementation;

class BindingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryService::class,    CategoryServiceImplementation::class);
        $this->app->bind(CategoryRepository::class, CategoryRepositoryImplementation::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Category::observe(CategoryObserver::class);
    }
}
