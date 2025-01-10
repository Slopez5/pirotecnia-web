<?php 

namespace App\Core\Services;

use App\Core\Data\Entities\Employee;
use App\Core\Data\Entities\Event;
use App\Core\Data\Services\EmployeeAssignamentServiceInterface;
use App\Models\Event as ModelsEvent;
use Illuminate\Support\Collection;

class EloquentEmployeeAssignamentService implements EmployeeAssignamentServiceInterface
{
    public function assignToEvent(Event $event, Collection $employees): Event
    {
        logger('assignEmployyeToEvent');
        $eloquentEvent = ModelsEvent::find($event->id);
        $eloquentEvent->employees()->sync($employees);
        $employees = $eloquentEvent->employees->map(function ($employee) {
            $employee = new Employee([
                'id' => $employee->id,
                'name' => $employee->name,
                'email' => $employee->email,
                'phone' => $employee->phone,
                'address' => $employee->address,
                'salary' => $employee->salary,
                'photo' => $employee->photo,
                'experience_level_id' => $employee->experience_level_id,
            ]);
        });

        $event->employees = $employees;

        return $event;
    }
}
