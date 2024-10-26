<?php

namespace App\Providers;

use App\Infrastructures\EloquentAnnouncementRepository;
use App\Infrastructures\EloquentMappingShiftRepository;
use App\Infrastructures\EloquentPengajuanAbsensiRepository;
use App\Infrastructures\EloquentShiftPatternRepository;
use App\Infrastructures\EloquentShiftRepository;
use App\Infrastructures\EloquentUserRepository;
use App\Infrastructures\LocalStorageRepository;
use App\Models\User;
use App\Repositories\AnnouncementRepository;
use App\Repositories\MappingShiftRepository;
use App\Repositories\PengajuanAbsensiRepository;
use App\Repositories\ShiftPatternRepository;
use App\Repositories\ShiftRepository;
use App\Repositories\StorageRepository;
use App\Repositories\UserRepository;
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
        $this->app->bind(UserRepository::class,EloquentUserRepository::class);
        $this->app->bind(PengajuanAbsensiRepository::class,EloquentPengajuanAbsensiRepository::class);
        $this->app->bind(MappingShiftRepository::class,EloquentMappingShiftRepository::class);
        $this->app->bind(ShiftRepository::class,EloquentShiftRepository::class);
        $this->app->bind(ShiftPatternRepository::class,EloquentShiftPatternRepository::class);
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
