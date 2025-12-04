<?php

namespace App\Providers;

use App\Core\Data\Repositories\EmployeeRepositoryInterface;
use App\Core\Data\Repositories\EventRepositoryInterface;
use App\Core\Data\Repositories\InventoryRepositoryInterface;
use App\Core\Data\Repositories\PackageRepositoryInterface;
use App\Core\Domains\Repositories\EloquentEmployeeRepository;
use App\Core\Domains\Repositories\EloquentEventRepository;
use App\Core\Domains\Repositories\EloquentInventoryRepository;
use App\Core\Domains\Repositories\EloquentPackageRepository;
use App\Domain\Employees\Dashboard\Contracts\DashboardRepository;
use App\Infraestructure\Persistence\Eloquent\Repositories\EloquentDashboard;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(EventRepositoryInterface::class, EloquentEventRepository::class);
        $this->app->bind(EmployeeRepositoryInterface::class, EloquentEmployeeRepository::class);
        $this->app->bind(InventoryRepositoryInterface::class, EloquentInventoryRepository::class);
        $this->app->bind(PackageRepositoryInterface::class, EloquentPackageRepository::class);
        $this->app->bind(DashboardRepository::class, EloquentDashboard::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
