<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Auth;

Route::group(['middleware' => ['role:Admin|Moderador']], function(){

    //Permisos y Roles
    Route::resource('permissions', App\Http\Controllers\PermisionController::class);
    Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermisionController::class, 'destroy']);

    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::get('roles/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);
    Route::get('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'addPermissionsToRole']);
    Route::put('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'givePermissionsToRole']);

    //Usuarios. Para la administracion de roles-permisos
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::get('users/{userId}/delete', [App\Http\Controllers\userController::class, 'destroy']);

}
);



Route::get('/xd', function () {
    return view('welcome');
}); 

Auth::routes();
 
// DashMix Example Routes
Route::view('/landing', 'landing');   
Route::match(['get', 'post'], '/dashboard', function(){ return view('dashboard'); })->name('dashboard');
Route::view('/pages/slick', 'pages.slick');
Route::view('/pages/datatables', 'pages.datatables');
Route::view('/pages/blank', 'pages.blank');

// Usando el espacio de nombres completo para PageController
Route::get('/', [PageController::class, 'index']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/contact', [PageController::class, 'contact']);
Route::get('/service', [PageController::class, 'service']);
Route::get('/team', [PageController::class, 'team']);
Route::get('/testimonial', [PageController::class, 'testimonial']);

