<?php

use App\Http\Livewire\Admin\Cars;
use App\Http\Livewire\Admin\Users;
use App\Http\Livewire\Admin\Products;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\CustomersTemplate;
use App\Http\Livewire\Admin\Inventories;
use App\Http\Livewire\Admin\Mileages;
use App\Http\Livewire\Admin\Sales;
use App\Http\Livewire\Admin\SalesCreate;
use App\Models\Mileage;

// routes for Sales
Route::get('/users', Users::class)->name('users');
Route::get('/clientes', CustomersTemplate::class)->name('admin.customers');
Route::get('/productos', Products::class)->name('admin.products');
Route::get('/inventario', Inventories::class)->name('admin.inventories');
Route::get('/inventario/{productId}', Inventories::class)->name('admin.showInventories');
Route::get('/ventas', Sales::class)->name('admin.sales');
Route::get('/crearventa', SalesCreate::class)->name('admin.salesCreate');
Route::get('/coches', Cars::class)->name('admin.cars');
Route::get('/kilometraje/{carId}', Mileages::class)->name('admin.showMileages');