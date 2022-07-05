<?php

use App\Http\Livewire\Admin\Users;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\Customers;
use App\Http\Livewire\Admin\CustomersTemplate;

Route::get('/users', Users::class)->name('users');
Route::get('/clientes', CustomersTemplate::class)->name('admin.customers');
