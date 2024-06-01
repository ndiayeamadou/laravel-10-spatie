<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

/* Route::group(['middleware' => 'role:super-admin|admin'], function () { */
Route::group(['middleware' => 'isAdmin'], function () {

Route::resource('permissions', App\Http\Controllers\PermissionController::class);
Route::get('permissions/{permission}/delete', [App\Http\Controllers\PermissionController::class,'destroy']);

Route::resource('roles', App\Http\Controllers\RoleController::class);
Route::get('roles/{roleId}/delete', [App\Http\Controllers\RoleController::class,'destroy'])
            ;//->middleware('permission:delete role'); // or make midware in ctrller

Route::get('roles/{roleId}/give-permissions', [\App\Http\Controllers\RoleController::class, 'addPermissionToRole']);
Route::put('roles/{roleId}/give-permissions', [\App\Http\Controllers\RoleController::class, 'givePermissionToRole']);
//
Route::resource('users', App\Http\Controllers\UserController::class);
Route::get('users/{user}/delete', [App\Http\Controllers\UserController::class, 'destroy']);

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
