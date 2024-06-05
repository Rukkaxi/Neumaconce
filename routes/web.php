<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WebpayController;

/* Route::group(['middleware' => ['role:Admin|Moderador']], function(){
 */


/* }
); */
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

// Métodos de Pago
Route::resource('payment-methods', App\Http\Controllers\PaymentMethodController::class);
Route::get('payment-methods/{id}/delete', [App\Http\Controllers\PaymentMethodController::class, 'destroy']);

// Marcas
Route::resource('brands', App\Http\Controllers\BrandController::class);
Route::get('brands/{id}/delete', [App\Http\Controllers\BrandController::class, 'destroy']);

// Vehiculos
Route::resource('vehicles', App\Http\Controllers\VehicleController::class);
Route::get('vehicles/{id}/delete', [App\Http\Controllers\VehicleController::class, 'destroy']);

// Etiquetas
Route::resource('tags', App\Http\Controllers\TagController::class);
Route::get('tags/{id}/delete', [App\Http\Controllers\TagController::class, 'destroy']);

// Regiones
Route::resource('regions', App\Http\Controllers\RegionController::class);
Route::get('regions/{id}/delete', [App\Http\Controllers\RegionController::class, 'destroy']);

// Comunas
Route::resource('communes', App\Http\Controllers\CommuneController::class);
Route::get('communes/{id}/delete', [App\Http\Controllers\CommuneController::class, 'destroy']);

// Categorias
Route::resource('categories', App\Http\Controllers\CategoryController::class);
Route::get('categories/{id}/delete', [App\Http\Controllers\CategoryController::class, 'destroy']);

// Products
Route::resource('products', App\Http\Controllers\ProductController::class);
Route::get('products/{id}/delete', [App\Http\Controllers\ProductController::class, 'destroy']);

// Profile
//Route::resource('profiles', App\Http\Controllers\UserController::class);
Route::middleware(['auth'])->group(function () {
    Route::get('profiles', [ProfileController::class, 'index'])->name('profiles.index');
    Route::get('profiles/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
    Route::put('/profiles', [ProfileController::class, 'update'])->name('profiles.update');
});


// TIENDA Y PRODUCTOS POR SI SOLOs

//Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/product/{id}', [ProductController::class, 'show'])->name('shop.product.show');

// Ruta para categorias
Route::get('/shop/{category?}', [ShopController::class, 'index'])->name('shop.index');



// Lista de Deseos

Route::get('wishlist', [ProductController::class, 'wishlist'])->name('wishlist');


Route::resource('addresses', AddressController::class);


// Garaje
// Define the routes
Route::get('/api/vehicles/years', [VehicleController::class, 'getYears']);
Route::get('/api/vehicles/brands', [VehicleController::class, 'getBrands']);
Route::get('/api/vehicles/models', [VehicleController::class, 'getModels']);

// DerrylDecode Cart

// *TEST* PORQUE MARCA CADA INSTANCIA DE \CART COMO INDEFINIDA PERO REALMENTE SI FUNCIONA
/* Route::get('/test-cart', function () {
    \Cart::add([
        'id' => 1,
        'name' => 'Test Product',
        'price' => 1001,
        'quantity' => 1,
        'attributes' => []
    ]);

    return \Cart::getContent();
}); */

/* test ajax */

Route::get('/test-ajax', function () {
    return response()->json(['message' => 'AJAX is working!']);
});


Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');




// WEB PAY

Route::get('/webpay/init', [WebpayController::class, 'initTransaction'])->name('webpay.init');
Route::match(['get', 'post'], '/webpay/response', [WebpayController::class, 'response'])->name('webpay.response');
Route::get('/webpay/finish', [WebpayController::class, 'finish'])->name('webpay.finish');


Route::get('/xd', function () {
    return view('welcome');
});

Auth::routes();

// DashMix Example Routes
Route::view('/landing', 'landing');
Route::match(['get', 'post'], '/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
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
