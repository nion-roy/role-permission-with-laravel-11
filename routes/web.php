<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('welcome');
});




Route::middleware(['isUser'])->group(function () {

  Route::get('/dashboard', function () {
    return view('dashboard');
  })->name('dashboard');


  Route::resource('users', App\Http\Controllers\UserController::class);
  Route::resource('roles', App\Http\Controllers\RoleController::class);
  Route::resource('permissions', App\Http\Controllers\PermissionController::class);
});


require __DIR__ . '/auth.php';
