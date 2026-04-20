<?php

namespace Tests\Feature\Events;

use App\Core\Data\Entities\Event as EventEntity;
use App\Livewire\Panel\Events\EventForm;
use App\Models\Equipment;
use App\Models\Event;
use App\Models\EventType;
use App\Models\Inventory;
use App\Models\Package;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;
use Livewire\Livewire;
use Tests\TestCase;

class CreateEventSnapshotTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_registered_events_with_snapshots_and_deferred_inventory_discount(): void
    {
        Queue::fake();

        $this->seedCatalog();

        $eventType = $this->createEventType('Boda');
        $inventory = $this->createInventory();
        $product = Product::create([
            'product_role_id' => 1,
            'name' => 'Volcan Plata',
            'description' => 'Efecto de piso',
            'unit' => 'pz',
            'duration' => '30s',
            'shots' => '1',
            'caliber' => '2',
            'shape' => 'Volcan',
        ]);
        $equipment = $this->createEquipment('Base de disparo');
        $package = Package::create([
            'name' => 'Paquete Premium',
            'description' => 'Paquete con show completo',
            'price' => 5000,
            'duration' => '15 min',
            'video_url' => null,
            'experience_level_id' => null,
        ]);

        $this->attachInventoryStock($inventory, $product, 50, 300);
        $package->materials()->attach($product->id, ['quantity' => 4, 'price' => 125.5]);
        $package->equipments()->attach($equipment->id, ['quantity' => 2]);

        Livewire::test(EventForm::class)
            ->set('date', '2026-05-01')
            ->set('phone', '3121234567')
            ->set('client_name', 'Maria Lopez')
            ->set('client_address', 'Colima Centro')
            ->set('event_address', 'Salon Real')
            ->set('event_date', '2026-05-20')
            ->set('event_time', '21:00')
            ->set('event_type_id', $eventType->id)
            ->set('packageMode', 'registered')
            ->set('package_id', [$package->id])
            ->set('discountString', '10%')
            ->set('deposit', '1500')
            ->set('viatic', '300')
            ->set('notes', 'Montaje principal')
            ->call('save')
            ->assertRedirect(route('events.index'));

        $event = Event::query()->latest('id')->firstOrFail();

        $this->assertDatabaseHas('events', [
            'id' => $event->id,
            'client_name' => 'Maria Lopez',
            'event_type_id' => $eventType->id,
            'price' => 0,
        ]);

        $this->assertDatabaseHas('event_package', [
            'event_id' => $event->id,
            'package_id' => $package->id,
            'quantity' => 1,
            'price' => 5000,
        ]);

        $this->assertDatabaseHas('equipment_event', [
            'event_id' => $event->id,
            'equipment_id' => $equipment->id,
            'quantity' => 2,
            'check_almacen' => 0,
            'check_employee' => 0,
        ]);

        $this->assertDatabaseHas('productables', [
            'product_id' => $product->id,
            'productable_type' => Event::class,
            'productable_id' => $event->id,
            'quantity' => 4,
            'price' => 125.5,
            'check_almacen' => 0,
            'check_employee' => 0,
        ]);

        $this->assertDatabaseHas('productables', [
            'product_id' => $product->id,
            'productable_type' => Inventory::class,
            'productable_id' => $inventory->id,
            'quantity' => 50,
            'price' => 300,
        ]);

        $package->update(['price' => 9999]);
        $inventory->products()->updateExistingPivot($product->id, ['price' => 480]);

        $this->assertDatabaseHas('event_package', [
            'event_id' => $event->id,
            'package_id' => $package->id,
            'price' => 5000,
        ]);

        $this->assertDatabaseHas('productables', [
            'product_id' => $product->id,
            'productable_type' => Event::class,
            'productable_id' => $event->id,
            'price' => 125.5,
        ]);

        $snapshot = EventEntity::fromEvent($event->fresh(['packages', 'products', 'equipments']));

        $this->assertSame(5000.0, (float) $snapshot->packages->first()->price);
        $this->assertSame(125.5, (float) $snapshot->products->first()->price);

        Inventory::updateQuantityProducts($event->fresh(['products', 'equipments']));

        $this->assertDatabaseHas('productables', [
            'product_id' => $product->id,
            'productable_type' => Inventory::class,
            'productable_id' => $inventory->id,
            'quantity' => 46,
            'price' => 480,
        ]);

        $this->assertDatabaseHas('productables', [
            'product_id' => $product->id,
            'productable_type' => Event::class,
            'productable_id' => $event->id,
            'check_almacen' => 1,
        ]);

        $this->assertDatabaseHas('equipment_event', [
            'event_id' => $event->id,
            'equipment_id' => $equipment->id,
            'check_almacen' => 1,
        ]);
    }

    public function test_it_creates_custom_events_with_snapshotted_products_and_reserved_inventory(): void
    {
        Queue::fake();

        $this->seedCatalog();

        $eventType = $this->createEventType('Cumpleanos');
        $inventory = $this->createInventory();
        $product = Product::create([
            'product_role_id' => 1,
            'name' => 'Bengala fria',
            'description' => 'Bengala decorativa',
            'unit' => 'pz',
            'duration' => '20s',
            'shots' => '1',
            'caliber' => '1',
            'shape' => 'Lineal',
        ]);
        $material = Product::create([
            'product_role_id' => 2,
            'name' => 'Confeti metalico',
            'description' => 'Carga de confeti',
            'unit' => 'kg',
            'duration' => null,
            'shots' => null,
            'caliber' => null,
            'shape' => 'Carga',
        ]);

        $this->attachInventoryStock($inventory, $product, 25, 180);
        $this->attachInventoryStock($inventory, $material, 20, 60);

        Livewire::test(EventForm::class)
            ->set('date', '2026-06-01')
            ->set('phone', '3127654321')
            ->set('client_name', 'Juan Perez')
            ->set('client_address', 'Villa de Alvarez')
            ->set('event_address', 'Jardin Central')
            ->set('event_date', '2026-06-10')
            ->set('event_time', '19:00')
            ->set('event_type_id', $eventType->id)
            ->set('packageMode', 'custom')
            ->set('customProducts', [
                ['product_id' => $product->id, 'quantity' => 3],
                ['product_id' => $material->id, 'quantity' => 2],
            ])
            ->set('price', '4200')
            ->set('deposit', '1000')
            ->set('viatic', '250')
            ->set('notes', 'Show personalizado')
            ->call('save')
            ->assertRedirect(route('events.index'));

        $event = Event::query()->latest('id')->firstOrFail();

        $this->assertDatabaseHas('events', [
            'id' => $event->id,
            'client_name' => 'Juan Perez',
            'event_type_id' => $eventType->id,
            'price' => 4200,
            'package_id' => null,
        ]);

        $this->assertDatabaseMissing('event_package', [
            'event_id' => $event->id,
        ]);

        $this->assertDatabaseMissing('equipment_event', [
            'event_id' => $event->id,
        ]);

        $this->assertDatabaseHas('productables', [
            'product_id' => $product->id,
            'productable_type' => Event::class,
            'productable_id' => $event->id,
            'quantity' => 3,
            'price' => 180,
            'check_almacen' => 0,
            'check_employee' => 0,
        ]);

        $this->assertDatabaseHas('productables', [
            'product_id' => $material->id,
            'productable_type' => Event::class,
            'productable_id' => $event->id,
            'quantity' => 2,
            'price' => 60,
            'check_almacen' => 0,
            'check_employee' => 0,
        ]);

        $this->assertDatabaseHas('productables', [
            'product_id' => $product->id,
            'productable_type' => Inventory::class,
            'productable_id' => $inventory->id,
            'quantity' => 25,
            'price' => 180,
        ]);

        $inventory->products()->updateExistingPivot($product->id, ['price' => 250]);
        $inventory->products()->updateExistingPivot($material->id, ['price' => 90]);

        $snapshot = EventEntity::fromEvent($event->fresh(['packages', 'products', 'equipments']));

        $this->assertTrue($snapshot->packages->isEmpty());
        $this->assertSame(180.0, (float) $snapshot->products->firstWhere('id', $product->id)->price);
        $this->assertSame(60.0, (float) $snapshot->products->firstWhere('id', $material->id)->price);

        Inventory::updateQuantityProducts($event->fresh(['products', 'equipments']));

        $this->assertDatabaseHas('productables', [
            'product_id' => $product->id,
            'productable_type' => Inventory::class,
            'productable_id' => $inventory->id,
            'quantity' => 22,
            'price' => 250,
        ]);

        $this->assertDatabaseHas('productables', [
            'product_id' => $material->id,
            'productable_type' => Inventory::class,
            'productable_id' => $inventory->id,
            'quantity' => 18,
            'price' => 90,
        ]);

        $this->assertDatabaseHas('productables', [
            'product_id' => $product->id,
            'productable_type' => Event::class,
            'productable_id' => $event->id,
            'check_almacen' => 1,
        ]);

        $this->assertDatabaseHas('productables', [
            'product_id' => $material->id,
            'productable_type' => Event::class,
            'productable_id' => $event->id,
            'check_almacen' => 1,
        ]);
    }

    private function seedCatalog(): void
    {
        DB::table('product_roles')->insert([
            ['id' => 1, 'name' => 'Productos', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Materiales', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Productos Paquete', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    private function createEventType(string $name): EventType
    {
        $eventType = new EventType();
        $eventType->forceFill([
            'name' => $name,
            'description' => $name.' descripcion',
        ])->save();

        return $eventType;
    }

    private function createInventory(): Inventory
    {
        $inventory = new Inventory();
        $inventory->forceFill([
            'id' => 1,
            'name' => 'Polvorin Central',
            'location' => 'Bodega principal',
        ])->save();

        return $inventory;
    }

    private function createEquipment(string $name): Equipment
    {
        $equipment = new Equipment();
        $equipment->forceFill([
            'name' => $name,
            'description' => $name.' descripcion',
            'unit' => 'pz',
        ])->save();

        return $equipment;
    }

    private function attachInventoryStock(Inventory $inventory, Product $product, int $quantity, float $price): void
    {
        $inventory->products()->attach($product->id, [
            'quantity' => $quantity,
            'price' => $price,
        ]);
    }
}
