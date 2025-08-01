<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\RazorpayController;
use App\Http\Controllers\Frontend\UsersController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\OfferController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// ========== Home Page Routes =========

Route::get('/cart', [CartController::class, 'index']);

Auth::routes();

Route::controller(App\Http\Controllers\Frontend\FrontendController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/collections', 'categories');
    Route::get('/collections/{category_slug}', 'products');
    Route::get('/collections/{category_slug}/{product_slug}', 'productView');
    Route::get('/newArrivals', 'newArrivals');
    Route::get('/about', 'about');
    Route::get('/contact', 'contact');

    Route::get('/searchajax', 'searchProducts')->name('searchproductsajax');
    Route::get('/search', 'searchProductsDetails');
    
});

Route::middleware(['auth'])->group(function(){
    Route::get('/wishlist', [WishlistController::class, 'index']);
    
    Route::get('/checkout', [CheckoutController::class, 'index']);
    Route::post('/checkout', [CheckoutController::class, 'applyCoupon']);

    Route::get('/razorpay/payment', function () {
    return view('frontend.razorpay.payment');
});

    Route::post('/razorpay/payment', [RazorpayController::class, 'payment'])->name('razorpay.payment');
    Route::post('/razorpay/success', [RazorpayController::class, 'success'])->name('razorpay.success');
    

    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/{orderId}', [OrderController::class, 'show']);

    Route::get('/invoice/{orderId}',  [OrderController::class, 'viewInvoice']);
    Route::get('/invoice/{orderId}/generate', [OrderController::class, 'generateInvoice']);

    Route::get('/profile', [UsersController::class, 'index']);
    Route::post('/profile', [UsersController::class, 'updateUserDetails']);
    Route::get('/change-password' , [UsersController::class, 'passwordCreate']);
    Route::post('/change-password' , [UsersController::class, 'changePassword']);

});

Route::get('thank-you', [FrontendController::class, 'thankyou']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('/admin')->middleware(['auth', 'isAdmin'])->group(function(){

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/settings', [SettingController::class, 'index']);
    Route::post('/settings', [SettingController::class, 'store']);
    Route::get('/settings/edit', [SettingController::class, 'edit']);

    // Route::get('/settings/{setting_id}/delete', [SettingController::class, 'destroy']);

    Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function () {
    Route::get('/category', 'index');
    Route::get('/category/create','create');
    Route::post('/category', 'store');
    Route::get('/category/{category}/edit', 'edit');
    Route::put('/category/{category}', 'update');
    Route::get('/category/{category}', 'destroy');
});

    Route::get('/brands', App\Livewire\Admin\Brand\Index::class);

    Route::controller(App\Http\Controllers\Admin\ProductController::class)->group(function () {
        Route::get('/products', 'index');
        Route::get('/products/create', 'create');
        Route::post('/products', 'store');
        Route::get('/products/{products}/edit', 'edit');
        Route::put('/products/{products}', 'update');
        
        Route::get('/product-image/{product_image_id}/delete', 'destroyImage'); // for remove the image only
        Route::get('/products/{product_id}/delete', 'destroy');
    });

    Route::controller(App\Http\Controllers\Admin\DiscountController::class)->group(function () {
        Route::get('/discounts','index');
        Route::get('/discounts/create','create');
        Route::post('/discounts', 'store');
        Route::get('/discounts/{discounts}/edit', 'edit');
        Route::put('/discounts/{discounts}', 'update');
        Route::get('/discounts/{discounts}/delete', 'destroy');
    });

    Route::controller(App\Http\Controllers\Admin\OfferController::class)->group(function () {
        Route::get('/offers','index');
        Route::get('/offers/create','create');
        Route::post('/offers','store');
        Route::get('/offers/{offers}/edit','edit');
        Route::put('/offers/{offers}', 'update');
        Route::get('/offers/{offers}/destroy','destroy');
    });

    Route::controller(App\Http\Controllers\Admin\SliderController::class)->group(function () {
        Route::get('/sliders', 'index');
        Route::get('/sliders/create', 'create');
        Route::post('/sliders', 'store');
        Route::get('/sliders/{slider}/edit', 'edit');
        Route::put('/sliders/{slider}', 'update');
        Route::get('/sliders/{slider}/destroy', 'destroy');
    });

    Route::controller(App\Http\Controllers\Admin\OrderController::class)->group(function () {
        Route::get('/orders', 'index');
        Route::get('/orders/{orderId}', 'show');
        Route::put('/orders/{orderId}', 'updateOrderStatus');

        Route::get('/invoice/{orderId}', 'viewInvoice');
        Route::get('/invoice/{orderId}/generate', 'generateInvoice');
        Route::get('/invoice/{orderId}/mail', 'mailInvoice');
    });

    Route::controller(App\Http\Controllers\Admin\UserController::class)->group(function () {
        Route::get('/users', 'index');
        Route::get('/users/create', 'create');
        Route::post('users', 'store');
        Route::get('users/{users}/edit', 'edit');
        Route::put('/users/{users}', 'update');
        Route::get('/users/{users}/delete', 'destroy');
    });
    
});