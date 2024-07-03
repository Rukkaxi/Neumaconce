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
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\CotizacionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\FullCalendarController;
use App\Http\Controllers\NotificationsController;

//Permisos y Roles

Route::resource('permissions', App\Http\Controllers\PermisionController::class);
//Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermisionController::class, 'destroy']);

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

//Sucursales
Route::resource('branches', App\Http\Controllers\BranchController::class);

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
Route::post('products/{product}/change-stock', [ProductController::class, 'changeStock'])->name('products.changeStock');
Route::get('/recommended-products', [RecommendedProductController::class, 'show'])->name('recommended-products');
// Profile
//Route::resource('profiles', App\Http\Controllers\UserController::class);
Route::middleware(['auth'])->group(function () {
    Route::get('profiles', [ProfileController::class, 'index'])->name('profiles.index');
    Route::get('profiles/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
    Route::put('/profiles', [ProfileController::class, 'update'])->name('profiles.update');
});


// TIENDA Y PRODUCTOS POR SI SOLOs

//Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/product/{id}', [ShopController::class, 'show'])->name('shop.product.show');
Route::post('/shop/product/{id}/question', [ShopController::class, 'storeQuestion'])->name('shop.product.question.store');
Route::post('/shop/question/{id}/answer', [ShopController::class, 'answerQuestion'])->name('shop.product.question.answer');
Route::post('/shop/question/{id}/toggle', [ShopController::class, 'toggleVisibility'])->name('shop.product.question.toggle');
Route::post('/shop/product/{id}/review', [ShopController::class, 'storeReview'])->name('shop.product.review.store');

// Ruta para categorias
Route::get('/shop/{category?}', [ShopController::class, 'index'])->name('shop.index');


//Direccion
Route::post('/address/store', [AddressController::class, 'store'])->name('address.store');

// Gráfico de ventas
Route::get('/graphics', [SalesController::class, 'index'])->name('graphics.index');

// CALENDARIO
Route::get('full-calendar', [FullCalendarController::class, 'index'])->name('calendar');
Route::post('full-calendar/action', [FullCalendarController::class, 'action'])->name('action');

// NOTIFICACIONES
Route::get('/notifications', [NotificationsController::class, 'index']);
Route::get('/notifications/fetch', [NotificationsController::class, 'fetch']);
Route::get('/notifications/count', [NotificationsController::class, 'count']);
Route::post('/notifications/mark-read', [NotificationsController::class, 'markRead']);
Route::post('/notifications/clear', [NotificationsController::class, 'clear']);


// Galeria de imagenes
Route::get('/gallery', [PhotoController::class, 'index'])->name('gallery.index');
Route::get('/gallery/create', [PhotoController::class, 'create'])->name('gallery.create');
Route::post('/gallery', [PhotoController::class, 'store'])->name('gallery.store');
Route::delete('/gallery/{photo}', [PhotoController::class, 'destroy'])->name('gallery.destroy');

Route::get('/dashboard/gallery', [PhotoController::class, 'dashboardIndex'])->name('dashboard.gallery.index');

// Email

/* Route::get('/send-promotion', [MailController::class, 'sendPromotion']); */
Route::post('/products/{id}/promote', [ProductController::class, 'promote'])->name('products.promote');

// Lista de Deseos

Route::get('wishlist', [ProductController::class, 'wishlist'])->name('wishlist');
Route::post('/wishlist/add/{productId}', [ProductController::class, 'addToWishlist'])->name('wishlist.add');
Route::delete('/wishlist/remove/{id}', [ProductController::class, 'removeFromWishlist'])->name('wishlist.remove');

//Direcciones
Route::resource('addresses', AddressController::class);

//Ordenes
Route::get('/my_orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/my_orders/{order}', [OrderController::class, 'show'])->name('orders.show');
Route::get('/orders', [OrderController::class, 'admin'])->name('orders.admin_index');
Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.admin_index.update');
// seguimiento de pedidos
Route::get('/tracking', [OrderController::class, 'showTrackingForm'])->name('orders.tracking.form');
Route::post('/tracking/search', [OrderController::class, 'searchOrder'])->name('orders.tracking.search');
Route::get('/tracking/{buyOrder}', [OrderController::class, 'tracking'])->name('orders.tracking');
// Ruta para el seguimiento de pedidos en la vista de administrador
Route::get('/orders/{order}', [OrderController::class, 'adminTracking'])->name('orders.admin_tracking');

Route::put('/orders/{order}/update-tracking', [OrderController::class, 'updateTracking'])->name('orders.admin_tracking.update');


// Garaje
// Define the routes
Route::get('/api/vehicles/years', [VehicleController::class, 'getYears']);
Route::get('/api/vehicles/brands', [VehicleController::class, 'getBrands']);
Route::get('/api/vehicles/models', [VehicleController::class, 'getModels']);

// Rutas del carrito

Route::get('/cart/index', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add'); // Esta es la ruta que falta
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::get('/cart/preorder', [CartController::class, 'showPreOrder'])->name('cart.showPreOrder');
Route::get('/cart/preorder/purchase', [CartController::class, 'purchase'])->name('cart.purchase');


// WEB PAY

Route::post('/webpay/init', [WebpayController::class, 'initTransaction'])->name('webpay.init');
Route::match(['get', 'post'], '/webpay/response', [WebpayController::class, 'response'])->name('webpay.response');
Route::get('/webpay/finish', [WebpayController::class, 'finish'])->name('webpay.finish');

//Perfil
/* Route::resource('profile', App\Http\Controllers\UserController::class); */

// cotizaciones

Route::get('/cotizaciones', [CotizacionController::class, 'create'])->name('cotizaciones.form');
Route::post('/cotizaciones', [CotizacionController::class, 'store'])->name('cotizaciones.store');


Route::get('/xd', function () {
    return view('welcome');
});



Auth::routes([
    #'verify' => 'true'
]);

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
