<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Panel\DashboardController;
use App\Http\Controllers\Panel\EquipamentController;
use App\Http\Controllers\Panel\EventController;
use App\Http\Controllers\Panel\InventoryController;
use App\Http\Controllers\Panel\MenuController;
use App\Http\Controllers\Panel\PackageController;
use App\Http\Controllers\Panel\ProductController;
use App\Http\Controllers\Panel\ProductGroupController;
use App\Http\Controllers\Panel\PurchaseController;
use App\Http\Controllers\Panel\SaleController;
use App\Http\Controllers\Panel\UserController;
use Illuminate\Support\Facades\Route;

//Auth
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginSubmit'])->name('login.submit');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerSubmit'])->name('register.submit');


Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    //Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/panel/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/panel/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/panel/inventories', [InventoryController::class, 'index'])->name('inventories.index');
    Route::get('/panel/purchases', [PurchaseController::class, 'index'])->name('purchases.index');
    Route::get('/panel/sales', [SaleController::class, 'index'])->name('sales.index');
    Route::get('/settings/menu', [MenuController::class, 'index'])->name('settings.menu.index');
    Route::get('/settings/packages', [PackageController::class, 'index'])->name('settings.packages.index');
    Route::get('/settings/productgroups', [ProductGroupController::class, 'index'])->name('settings.productgroups.index');
    Route::get('/settings/products', [ProductController::class, 'index'])->name('settings.products.index');
    Route::get('/settings/equipaments', [EquipamentController::class, 'index'])->name('settings.equipaments.index');

    //Events
    Route::get('panel/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('panel/events', [EventController::class, 'store'])->name('events.store');
    Route::get('panel/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('panel/events/{id}', [EventController::class, 'update'])->name('events.update');
    Route::delete('panel/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');
    Route::get('panel/events/{id}', [EventController::class, 'show'])->name('events.show');

    //Inventory
    Route::get('panel/inventory/create', [InventoryController::class, 'create'])->name('inventory.create');
    Route::post('panel/inventory', [InventoryController::class, 'store'])->name('inventory.store');
    Route::get('panel/inventory/{id}/edit', [InventoryController::class, 'edit'])->name('inventory.edit');
    Route::put('panel/inventory/{id}', [InventoryController::class, 'update'])->name('inventory.update');
    Route::delete('panel/inventory/{id}', [InventoryController::class, 'destroy'])->name('inventory.destroy');
    Route::get('panel/inventory/{id}', [InventoryController::class, 'show'])->name('inventory.show');


    //Menu
    Route::get('settings/menu/create', [MenuController::class, 'create'])->name('menu.create');
    Route::post('settings/menu', [MenuController::class, 'store'])->name('menu.store');
    Route::get('settings/menu/{id}/edit', [MenuController::class, 'edit'])->name('menu.edit');
    Route::put('settings/menu/{id}', [MenuController::class, 'update'])->name('menu.update');
    Route::delete('settings/menu/{id}', [MenuController::class, 'destroy'])->name('menu.destroy');
    Route::get('settings/menu/{id}', [MenuController::class, 'show'])->name('menu.show');

    //Packages
    Route::get('settings/packages/create', [PackageController::class, 'create'])->name('packages.create');
    Route::post('settings/packages', [PackageController::class, 'store'])->name('packages.store');
    Route::get('settings/packages/{id}/edit', [PackageController::class, 'edit'])->name('packages.edit');
    Route::put('settings/packages/{id}', [PackageController::class, 'update'])->name('packages.update');
    Route::delete('settings/packages/{id}', [PackageController::class, 'destroy'])->name('packages.destroy');
    Route::get('settings/packages/{id}', [PackageController::class, 'show'])->name('packages.show');

    //ProductGroups
    Route::get('settings/productgroups/create', [ProductGroupController::class, 'create'])->name('product-groups.create');
    Route::post('settings/productgroups', [ProductGroupController::class, 'store'])->name('product-groups.store');
    Route::get('settings/productgroups/{id}/edit', [ProductGroupController::class, 'edit'])->name('product-groups.edit');
    Route::put('settings/productgroups/{id}', [ProductGroupController::class, 'update'])->name('product-groups.update');
    Route::delete('settings/productgroups/{id}', [ProductGroupController::class, 'destroy'])->name('product-groups.destroy');
    Route::get('settings/productgroups/{id}', [ProductGroupController::class, 'show'])->name('product-groups.show');

    //Products
    Route::get('settings/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('settings/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('settings/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('settings/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('settings/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('settings/products/{id}', [ProductController::class, 'show'])->name('products.show');

    //Equipaments
    Route::get('settings/equipaments/create', [EquipamentController::class, 'create'])->name('equipaments.create');
    Route::post('settings/equipaments', [EquipamentController::class, 'store'])->name('equipaments.store');
    Route::get('settings/equipaments/{id}/edit', [EquipamentController::class, 'edit'])->name('equipaments.edit');
    Route::put('settings/equipaments/{id}', [EquipamentController::class, 'update'])->name('equipaments.update');
    Route::delete('settings/equipaments/{id}', [EquipamentController::class, 'destroy'])->name('equipaments.destroy');
    Route::get('settings/equipaments/{id}', [EquipamentController::class, 'show'])->name('equipaments.show');
});
