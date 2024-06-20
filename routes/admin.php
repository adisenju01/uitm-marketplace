<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\PaypalSettingController;
use App\Http\Controllers\Backend\SellerProductController;
use App\Http\Controllers\Backend\SellerServiceController;
use App\Http\Controllers\Backend\StripeSettingController;
use App\Http\Controllers\Backend\PaymentSettingController;
use App\Http\Controllers\Backend\ProductListingAppController;
use App\Http\Controllers\Backend\AdminVendorProfileController;




/** Admin Routes */
Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

/** Profile Routes */
Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::post('profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('profile/update/password', [ProfileController::class, 'updatePassword'])->name('password.update');

/** Vendor Profile Routes */
Route::resource('vendor-profile', AdminVendorProfileController::class);

/** Products Routes */
Route::put('product/change-status', [ProductController::class, 'changeStatus'])->name('product.change-status'); //route for jquery, must be create before resource route to prevent issue //for every new route oso
Route::resource('products', ProductController::class);


/** Service Routes */
Route::put('service/change-status', [ServiceController::class, 'changeStatus'])->name('service.change-status'); //route for jquery, must be create before resource route to prevent issue //for every new route oso
Route::resource('service', ServiceController::class);


/** Seller product routes */
Route::get('seller-products', [SellerProductController::class, 'index'])->name('seller-products.index');
Route::get('seller-pending-products', [SellerProductController::class, 'pendingProducts'])->name('seller-pending-products.index');
Route::put('change-approve-status-product', [SellerProductController::class, 'changeApproveStatus'])->name('change-approve-status-product');

/** Seller service routes */
Route::get('seller-services', [SellerServiceController::class, 'index'])->name('seller-services.index');
Route::get('seller-pending-services', [SellerServiceController::class, 'pendingServices'])->name('seller-pending-services.index');
Route::put('change-approve-status-service', [SellerServiceController::class, 'changeApproveStatusService'])->name('change-approve-status'); //takleh sama nanti error kat product

/** Product Listing App Routes */
Route::get('product-listing-app', [ProductListingAppController::class, 'index'])->name('product-listing-app.index');
Route::post('product-listing-app/add-product', [ProductListingAppController::class, 'addProduct'])->name('product-listing-app.add-product');
Route::put('product-listing-app/show-at-home/status-change', [ProductListingAppController::class, 'chageShowAtHomeStatus'])->name('product-listing-app.show-at-home.change-status');
Route::put('product-listing-app-status', [ProductListingAppController::class, 'changeStatus'])->name('product-listing-app-sale-status');
Route::delete('product-listing-app/{id}', [ProductListingAppController::class, 'destroy'])->name('product-listing-app.destory');

/** Order roures */
Route::get('payment-status', [OrderController::class, 'changePaymentStatus'])->name('payment.status'); //route for jquery, must be create before resource route to prevent issue and for every new route oso
Route::get('order-status', [OrderController::class, 'changeOrderStatus'])->name('order.status'); //route for jquery, must be create before resource route to prevent issue and for every new route oso
Route::resource('order', OrderController::class);

/** Setting routes */
Route::get('settings', [SettingController::class, 'index'])->name('setting.index');
Route::put('general-setting-update', [SettingController::class, 'generalSettingUpdate'])->name('general-setting-update');

/** Payment settings route */
Route::get('payment-settings', [PaymentSettingController::class, 'index'])->name('payment-settings.index');
Route::resource('paypal-setting', PaypalSettingController::class);
Route::put('stripe-setting/{id}', [StripeSettingController::class, 'update'])->name('stripe-setting.update');

