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
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

//Auth
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginSubmit'])->name('login.submit');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerSubmit'])->name('register.submit');

Route::post('/print-ticket', [TicketController::class, 'printReceipt'])->name('print-ticket');


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
    Route::get('/settings/products', [ProductController::class, 'index'])->name('settings.products.index');
    Route::get('/settings/equipaments', [EquipamentController::class, 'index'])->name('settings.equipaments.index');

    //Users
    Route::get('panel/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('panel/users', [UserController::class, 'store'])->name('users.store');
    Route::get('panel/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('panel/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('panel/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('panel/users/{id}', [UserController::class, 'show'])->name('users.show');

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

    //Purchases
    Route::get('panel/purchases/create', [PurchaseController::class, 'create'])->name('purchases.create');
    Route::post('panel/purchases', [PurchaseController::class, 'store'])->name('purchases.store');
    Route::get('panel/purchases/{id}/edit', [PurchaseController::class, 'edit'])->name('purchases.edit');
    Route::put('panel/purchases/{id}', [PurchaseController::class, 'update'])->name('purchases.update');
    Route::delete('panel/purchases/{id}', [PurchaseController::class, 'destroy'])->name('purchases.destroy');
    Route::get('panel/purchases/{id}', [PurchaseController::class, 'show'])->name('purchases.show');

    //Sales
    Route::get('panel/sales/create', [SaleController::class, 'create'])->name('sales.create');
    Route::post('panel/sales', [SaleController::class, 'store'])->name('sales.store');
    Route::get('panel/sales/{id}/edit', [SaleController::class, 'edit'])->name('sales.edit');
    Route::put('panel/sales/{id}', [SaleController::class, 'update'])->name('sales.update');
    Route::delete('panel/sales/{id}', [SaleController::class, 'destroy'])->name('sales.destroy');
    Route::get('panel/sales/{id}', [SaleController::class, 'show'])->name('sales.show');

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
