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
                "title" => "Eventos",
                "url" => "events.index",
                "icon" => "fas fa-calendar-alt",
                "active" => false,
                "order" => 1
            ],
            [
                "menu_id" => 1,
                "parent_id" => null,
                "menu_open" => false,
                "title" => "Inventario",
                "url" => "inventory.index",
                "icon" => "fas fa-boxes",
                "active" => false,
                "order" => 2
            ],
            [
                "menu_id" => 1,
                "parent_id" => null,
                "menu_open" => false,
                "title" => "Configuración",
                "url" => null,
                "icon" => "fas fa-th",
                "active" => false,
                "order" => 3
            ],
            [
                "menu_id" => 1,
                "parent_id" => 4,
                "menu_open" => false,
                "title" => "Menu",
                "url" => "settings.menu.index",
                "icon" => "fas fa-bars",
                "active" => true,
                "order" => 0
            ],
            [
                "menu_id" => 1,
                "parent_id" => 4,
                "menu_open" => false,
                "title" => "Paquetes",
                "url" => "settings.packages.index",
                "icon" => "fas fa-box",
                "active" => false,
                "order" => 1
            ],
            [
                "menu_id" => 1,
                "parent_id" => 4,
                "menu_open" => false,
                "title" => "Productos",
                "url" => "settings.products.index",
                "icon" => "fas fa-cube",
                "active" => false,
                "order" => 2
            ]
        ];

        MenuItem::insert($menuItems);
    }
}
