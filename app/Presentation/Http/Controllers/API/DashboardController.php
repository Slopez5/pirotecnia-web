<?php 

namespace App\Presentation\Http\Controllers\API;

use App\Application\Employees\Dashboard\UseCases\DashboardUseCase;
use App\Application\Employees\Dashboard\UseCases\EventDetailUseCase;
use App\Http\Controllers\Controller;
use App\Presentation\Http\Resources\DashboardResource;

class DashboardController extends Controller {

    public function dashboard(DashboardUseCase $dashboardUseCase) {
        
        $resource = DashboardResource::collection($dashboardUseCase());

        return $resource;
    }

    public function eventDetails(EventDetailUseCase $eventDetailUseCase) {
        return $eventDetailUseCase(249);
    }
}