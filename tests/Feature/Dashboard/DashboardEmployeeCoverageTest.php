<?php

namespace Tests\Feature\Dashboard;

use App\Models\Employee;
use App\Models\Event;
use App\Models\ExperienceLevel;
use App\Models\Package;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardEmployeeCoverageTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_shows_employee_coverage_within_selected_range(): void
    {
        Carbon::setTestNow('2026-05-15 10:00:00');

        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'phone' => '3120000000',
            'password' => bcrypt('secret'),
        ]);

        $experienceLevel = new ExperienceLevel();
        $experienceLevel->forceFill([
            'name' => 'Senior',
            'description' => 'Cobertura avanzada',
        ]);
        $experienceLevel->save();

        $package = Package::create([
            'name' => 'Paquete Operativo',
            'description' => 'Base para pruebas de dashboard',
            'price' => 5000,
            'duration' => '15',
            'status' => 'active',
        ]);

        $leadEmployee = new Employee();
        $leadEmployee->forceFill([
            'name' => 'Maria Operaciones',
            'email' => 'maria@example.com',
            'phone' => '3121111111',
            'address' => 'Centro',
            'salary' => '10000',
            'experience_level_id' => $experienceLevel->id,
        ]);
        $leadEmployee->save();

        $supportEmployee = new Employee();
        $supportEmployee->forceFill([
            'name' => 'Luis Cobertura',
            'email' => 'luis@example.com',
            'phone' => '3122222222',
            'address' => 'Norte',
            'salary' => '9000',
            'experience_level_id' => $experienceLevel->id,
        ]);
        $supportEmployee->save();

        $firstEvent = $this->createEvent($package, '2026-05-10 20:00:00', 'Cliente Uno');
        $firstEvent->employees()->attach($leadEmployee->id);

        $secondEvent = $this->createEvent($package, '2026-05-20 21:00:00', 'Cliente Dos');
        $secondEvent->employees()->attach([$leadEmployee->id, $supportEmployee->id]);

        $thirdEvent = $this->createEvent($package, '2026-05-25 19:00:00', 'Cliente Tres');

        $outOfRangeEvent = $this->createEvent($package, '2026-06-10 19:00:00', 'Cliente Fuera');
        $outOfRangeEvent->employees()->attach($leadEmployee->id);

        $response = $this
            ->actingAs($user)
            ->get(route('dashboard', [
                'start_date' => '2026-05-01',
                'end_date' => '2026-05-31',
            ]));

        $response->assertOk();
        $response->assertViewHas('coveredEmployeesCount', 2);
        $response->assertViewHas('employeeCoverageAssignments', '3');
        $response->assertViewHas('eventsWithoutEmployeesCount', 1);
        $response->assertViewHas('topCoverageEmployeeName', 'Maria Operaciones');
        $response->assertViewHas('topCoverageEmployeeCount', '2');
        $response->assertViewHas('employeeCoverageRows', function (array $rows) {
            $coverage = collect($rows);
            $lead = $coverage->firstWhere('name', 'Maria Operaciones');
            $support = $coverage->firstWhere('name', 'Luis Cobertura');

            return $coverage->count() === 2
                && $lead !== null
                && $support !== null
                && $lead['eventCount'] === 2
                && $support['eventCount'] === 1;
        });
        $response->assertViewHas('upcomingEvents', function (array $events) {
            $upcomingEvents = collect($events)->values();

            return $upcomingEvents->count() === 2
                && $upcomingEvents->get(0)['client'] === 'Cliente Dos'
                && $upcomingEvents->get(1)['client'] === 'Cliente Tres';
        });
        $response->assertSee('Cobertura de empleados');
        $response->assertSee('Maria Operaciones');
        $response->assertSee('Luis Cobertura');
        $response->assertSee('Eventos pendientes del rango');
        $response->assertDontSee('Cliente Uno');
    }

    private function createEvent(Package $package, string $eventDate, string $clientName): Event
    {
        return Event::create([
            'package_id' => $package->id,
            'date' => substr($eventDate, 0, 10),
            'phone' => '3123333333',
            'client_name' => $clientName,
            'client_address' => 'Colima',
            'event_address' => 'Salon principal',
            'event_date' => $eventDate,
            'discount' => 0,
            'advance' => 0,
            'travel_expenses' => 0,
            'notes' => null,
            'price' => 0,
        ]);
    }
}
