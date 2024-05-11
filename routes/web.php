<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Models\User;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/xd', function () {
    return view('welcome');
}); 

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
#Route::get('/pages/users', [UserController::class, 'index']);
Route::get('pages/users', [UserController::class, 'index'])->name('pages.users');

//editar usuario
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
//eliminar usuario
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::view('/pages/vehicles', 'pages.vehicles');
Route::view('/pages/products', 'pages.products');
 
// DashMix Example Routes
Route::view('/landing', 'landing');   
Route::match(['get', 'post'], '/dashboard', function(){
    return view('dashboard');
});

// Usando el espacio de nombres completo para PageController
Route::get('/', [PageController::class, 'index']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/contact', [PageController::class, 'contact']);
Route::get('/service', [PageController::class, 'service']);
Route::get('/team', [PageController::class, 'team']);
Route::get('/testimonial', [PageController::class, 'testimonial']);


