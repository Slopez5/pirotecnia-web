<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $menus = [
            [
                "name" => "web"
            ]
        ];

        Menu::insert($menus);

        $menuItems = [
            [
                "menu_id" => 1,
                "parent_id" => null,
                "menu_open" => false,
                "title" => "Inicio",
                "url" => "dashboard",
                "icon" => "fas fa-tachometer-alt",
                "active" => true,
                "order" => 0
            ],
            [
                "menu_id" => 1,
                "parent_id" => null,
                "menu_open" => false,
                "title" => "Usuarios",
                "url" => "users.index",
                "icon" => "fas fa-users",
                "active" => false,
                "order" => 1
            ],
            [
                "menu_id" => 1,
                "parent_id" => null,
                "menu_open" => false,
                "title" => "Eventos",
                "url" => "events.index",
                "icon" => "fas fa-calendar-alt",
                "active" => false,
                "order" => 2
            ],
            [
                "menu_id" => 1,
                "parent_id" => null,
                "menu_open" => false,
                "title" => "Inventario",
                "url" => "inventories.index",
                "icon" => "fas fa-boxes",
                "active" => false,
                "order" => 3
            ],
            //Purchases
            [
                "menu_id" => 1,
                "parent_id" => null,
                "menu_open" => false,
                "title" => "Compras",
                "url" => "purchases.index",
                "icon" => "fas fa-shopping-cart",
                "active" => false,
                "order" => 4
            ],
            //Sales
            [
                "menu_id" => 1,
                "parent_id" => null,
                "menu_open" => false,
                "title" => "Ventas",
                "url" => "sales.index",
                "icon" => "fas fa-cash-register",
                "active" => false,
                "order" => 5
            ],
            [
                "menu_id" => 1,
                "parent_id" => null,
                "menu_open" => false,
                "title" => "Configuración",
                "url" => null,
                "icon" => "fas fa-th",
                "active" => false,
                "order" => 6
            ],
            [
                "menu_id" => 1,
                "parent_id" => 7,
                "menu_open" => false,
                "title" => "Menu",
                "url" => "settings.menu.index",
                "icon" => "fas fa-bars",
                "active" => true,
                "order" => 0
            ],
            [
                "menu_id" => 1,
                "parent_id" => 7,
                "menu_open" => false,
                "title" => "Paquetes",
                "url" => "settings.packages.index",
                "icon" => "fas fa-box",
                "active" => false,
                "order" => 1
            ],
            [
                "menu_id" => 1,
                "parent_id" => 7,
                "menu_open" => false,
                "title" => "Productos",
                "url" => "settings.products.index",
                "icon" => "fas fa-cube",
                "active" => false,
                "order" => 2
            ],
            [
                "menu_id" => 1,
                "parent_id" => 7,
                "menu_open" => false,
                "title" => "Equipo",
                "url" => "settings.equipaments.index",
                "icon" => "fas fa-tools",
                "active" => false,
                "order" => 3
            ],
            [
                "menu_id" => 1,
                "parent_id" => 7,
                "menu_open" => false,
                "title" => "productos (modo cliente)",
                "url" => "settings.productgroups.index",
                "icon" => "fas fa-cubes",
                "active" => false,
                "order" => 4
            ]
        ];

        MenuItem::insert($menuItems);
    }
}
