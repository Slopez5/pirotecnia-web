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
                "active" => true,
                "order" => 1
            ],
            [
                "menu_id" => 1,
                "parent_id" => null,
                "menu_open" => false,
                "title" => "Eventos",
                "url" => "events.index",
                "icon" => "fas fa-calendar-alt",
                "active" => true,
                "order" => 2
            ],
            [
                "menu_id" => 1,
                "parent_id" => null,
                "menu_open" => false,
                "title" => "Inventario",
                "url" => "inventories.index",
                "icon" => "fas fa-boxes",
                "active" => true,
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
                "active" => true,
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
                "active" => true,
                "order" => 5
            ],
            [
                "menu_id" => 1,
                "parent_id" => null,
                "menu_open" => false,
                "title" => "Configuración",
                "url" => null,
                "icon" => "fas fa-th",
                "active" => true,
                "order" => 6
            ],
            [
                "menu_id" => 1,
                "parent_id" => 7,
                "menu_open" => false,
                "title" => "Paquetes",
                "url" => "settings.packages.index",
                "icon" => "fas fa-box",
                "active" => true,
                "order" => 0
            ],
            [
                "menu_id" => 1,
                "parent_id" => 7,
                "menu_open" => false,
                "title" => "Productos",
                "url" => "settings.products.index",
                "icon" => "fas fa-cube",
                "active" => true,
                "order" => 1
            ],
            [
                "menu_id" => 1,
                "parent_id" => 7,
                "menu_open" => false,
                "title" => "Equipo",
                "url" => "settings.equipaments.index",
                "icon" => "fas fa-tools",
                "active" => true,
                "order" => 2
            ]
        ];

        MenuItem::insert($menuItems);
    }
}
