<?php

namespace App\Providers;

use App\Core\Data\Repositories\EquipmentRepositoryInterface;
use App\Core\Data\Repositories\EventRepositoryInterface;
use App\Core\Data\Repositories\ProductRepositoryInterface;
use App\Core\Data\Services\EmployeeAssignamentServiceInterface;
use App\Core\Data\Services\EquipmentAssignamentServiceInterface;
use App\Core\Data\Services\PackageAssignamentServiceInterface;
use App\Core\Data\Services\ProductAssignamentServiceInterface;
use App\Core\Data\Services\ReminderSchedulerServiceInterface;
use App\Core\Repositories\EloquentEquipmentRepository;
use App\Core\Repositories\EloquentEventRepository;
use App\Core\Repositories\EloquentProductRepository;
use App\Core\Services\EloquentEmployeeAssignamentService;
use App\Core\Services\EloquentEquipmentAssignamentService;
use App\Core\Services\EloquentPackageAssignamentService;
use App\Core\Services\EloquentProductAssignamentService;
use App\Core\Services\JobReminderSchedulerService;
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
        $this->app->bind(ProductRepositoryInterface::class, EloquentProductRepository::class);
        $this->app->bind(EquipmentRepositoryInterface::class, EloquentEquipmentRepository::class);
        $this->app->bind(EmployeeAssignamentServiceInterface::class, EloquentEmployeeAssignamentService::class);
        $this->app->bind(EquipmentAssignamentServiceInterface::class, EloquentEquipmentAssignamentService::class);
        $this->app->bind(PackageAssignamentServiceInterface::class, EloquentPackageAssignamentService::class);
        $this->app->bind(ProductAssignamentServiceInterface::class, EloquentProductAssignamentService::class);
        $this->app->bind(ReminderSchedulerServiceInterface::class, JobReminderSchedulerService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
