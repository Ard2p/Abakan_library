<?php

namespace App\Modules\MediaLibrary\Providers;

use App\Modules\MediaLibrary\Repositories\MediaLibraryRepository;
use App\Modules\MediaLibrary\Repositories\MediaLibraryRepositoryImplementation;
use App\Modules\MediaLibrary\Services\MediaLibraryService;
use App\Modules\MediaLibrary\Services\MediaLibraryServiceImplementation;
use Illuminate\Support\ServiceProvider;

class BindingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(MediaLibraryRepository::class, MediaLibraryRepositoryImplementation::class);
        $this->app->bind(MediaLibraryService::class, MediaLibraryServiceImplementation::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
