<?php

namespace App\Providers;

use App\Infrastructures\EloquentAnnouncementRepository;
use App\Infrastructures\LocalStorageRepository;
use App\Models\User;
use App\Repositories\AnnouncementRepository;
use App\Repositories\StorageRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(StorageRepository::class,LocalStorageRepository::class);
        $this->app->bind(AnnouncementRepository::class,EloquentAnnouncementRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Gate::define('admin', function (User $user) {
            return $user->is_admin === 'admin';
        });

        Paginator::useBootstrap();
    }
}
