<?php

namespace Tests\Feature\Packages;

use App\Livewire\Panel\Settings\Packages\PackageBuilder;
use App\Models\Equipment;
use App\Models\Package;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Livewire\Livewire;
use Tests\TestCase;

class PackageBuilderTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_allows_adding_materials_and_equipment_before_saving_the_package(): void
    {
        $this->seedCatalog();

        $product = Product::create([
            'product_role_id' => 1,
            'name' => 'Bateria Titan',
            'description' => 'Bateria principal',
            'unit' => 'pz',
            'duration' => '30s',
            'shots' => '25',
            'caliber' => '2"',
            'shape' => 'Recta',
        ]);

        $equipment = Equipment::create([
            'name' => 'Consola DMX',
            'description' => 'Control principal',
            'unit' => 'pz',
        ]);

        $component = Livewire::test(PackageBuilder::class)
            ->set('selected_material_id', (string) $product->id)
            ->set('selected_material_quantity', 3)
            ->call('addMaterial')
            ->set('selected_equipment_id', (string) $equipment->id)
            ->set('selected_equipment_quantity', 1)
            ->call('addEquipment');

        $this->assertDatabaseCount('packages', 0);
        $component->assertSee('Bateria Titan');
        $component->assertSee('Consola DMX');
        $component->assertSet('pendingMaterials.' . $product->id . '.quantity', 3.0);
        $component->assertSet('pendingEquipments.' . $equipment->id . '.quantity', 1.0);

        $component
            ->set('name', 'Paquete Builder')
            ->set('description', 'Paquete armado desde el builder')
            ->set('price', '3500')
            ->set('duration', '15')
            ->call('saveDraft');

        $package = Package::query()->firstOrFail();

        $this->assertDatabaseHas('packages', [
            'id' => $package->id,
            'name' => 'Paquete Builder',
            'status' => 'draft',
        ]);

        $this->assertDatabaseHas('productables', [
            'productable_type' => Package::class,
            'productable_id' => $package->id,
            'product_id' => $product->id,
            'quantity' => 3,
            'price' => 0,
        ]);

        $this->assertDatabaseHas('equipment_package', [
            'package_id' => $package->id,
            'equipment_id' => $equipment->id,
            'quantity' => 1,
        ]);
    }

    public function test_it_loads_existing_package_data_in_edit_mode(): void
    {
        $this->seedCatalog();

        $product = Product::create([
            'product_role_id' => 2,
            'name' => 'Mortero 4 pulgadas',
            'description' => 'Base de disparo',
            'unit' => 'pz',
            'duration' => null,
            'shots' => null,
            'caliber' => '4"',
            'shape' => 'Mortero',
        ]);

        $equipment = Equipment::create([
            'name' => 'Mesa de control',
            'description' => 'Operacion central',
            'unit' => 'pz',
        ]);

        $package = Package::create([
            'name' => 'Paquete de edicion',
            'description' => 'Paquete existente',
            'price' => 5200,
            'duration' => '18',
            'video_url' => 'https://example.com/demo',
            'status' => 'active',
        ]);

        $package->materials()->attach($product->id, ['quantity' => 6, 'price' => 0]);
        $package->equipments()->attach($equipment->id, ['quantity' => 2]);

        Livewire::test(PackageBuilder::class, ['package' => $package])
            ->assertSet('name', 'Paquete de edicion')
            ->assertSet('description', 'Paquete existente')
            ->assertSet('price', '5200')
            ->assertSet('duration', '18')
            ->assertSet('video_url', 'https://example.com/demo')
            ->assertSee('Editar paquete')
            ->assertSee('Mortero 4 pulgadas')
            ->assertSee('Mesa de control');
    }

    private function seedCatalog(): void
    {
        DB::table('product_roles')->insert([
            ['id' => 1, 'name' => 'Productos', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Materiales', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Productos Paquete', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
