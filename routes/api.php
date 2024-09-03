<?php
  
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\CustomerController;

Route::get('/', [CustomerController::class, 'index'])->name('customers.index');