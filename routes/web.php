<?php

use App\Http\Controllers\AttributeSetController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\EavAttributeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\ThemeController;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ThemeController::class, 'index']);
Route::get('/test', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('/admin/', [HomeController::class, 'home']);
    Route::get('admin/dashboard', function () {
        return view('admin/dashboard');
    })->name('dashboard');

    Route::get('admin/user-management', function () {
        return view('admin.user.user-management');
    })->name('user-management');

    Route::get('/admin/logout', [SessionsController::class, 'destroy']);
    Route::get('/admin/user-profile', [InfoUserController::class, 'create']);
    Route::post('/admin/user-profile', [InfoUserController::class, 'store']);
    Route::get('/admin/login', function () {
        return view('admin/dashboard');
    })->name('sign-up');
    Route::get('admin/attributes', [EavAttributeController::class, 'index']);
    Route::get('admin/attribute/add', [EavAttributeController::class, 'create']);
    Route::get('admin/attribute_set', [AttributeSetController::class, 'index']);
    Route::get('admin/attribute_set/add', [AttributeSetController::class, 'create']);
    Route::post('admin/attribute_set/save', [AttributeSetController::class, 'store']);
    Route::post('admin/attribute_set/update', [AttributeSetController::class, 'update']);
    Route::get('admin/attribute_set/edit/{id}', [AttributeSetController::class, 'edit']);
    Route::post('admin/attribute/save', [EavAttributeController::class, 'store']);
    Route::get('admin/attribute/edit/{id}', [EavAttributeController::class, 'edit']);
    Route::post('admin/attribute/update', [EavAttributeController::class, 'update']);

    Route::get('admin/category', [CategoryController::class, 'index']);
    Route::get('admin/category/add/{id}', [CategoryController::class, 'addSubCategory']);
    Route::get('admin/category/edit/{id}', [CategoryController::class, 'edit']);
    Route::post('admin/category/save', [CategoryController::class, 'store']);
    Route::get('admin/product/add', [ProductController::class, 'create']);
    Route::get('admin/product/edit/{id}', [ProductController::class, 'edit']);
    Route::get('admin/products', [ProductController::class, 'index']);
    Route::post('admin/product/update', [ProductController::class, 'update']);
    Route::post('admin/product/save', [ProductController::class, 'store']);
});
Route::get('/product/{sku}', [ProductController::class, 'show']);
Route::post('checkout/cart/add', [CartController::class, 'store']);
Route::get('checkout/cart', [CartController::class, 'index']);
Route::get('checkout/cart/update-item/{id}/{type}', [CartItemController::class, 'update']);
Route::get('checkout/cart-item/delete/{id}', [CartItemController::class, 'destroy']);
Route::get('checkout', [CartController::class, 'checkout']);
Route::post('place-order', [\App\Http\Controllers\OrdersController::class, 'store']);
Route::group(['middleware' => 'guest'], function () {
    Route::get('/admin/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/admin/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
    Route::get('/admin/login/forgot-password', [ResetController::class, 'create']);
    Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
    Route::get('/admin/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
    Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::get('/admin/login', function () {
    return view('session/login-session');
})->name('login');
Route::get('login', [\App\Http\Controllers\CustomerController::class, 'viewLogin']);
Route::post('login', [\App\Http\Controllers\CustomerController::class, 'login']);
Route::get('register', [\App\Http\Controllers\CustomerController::class, 'register']);
Route::post('register', [\App\Http\Controllers\CustomerController::class, 'store']);
Route::get('logout', [\App\Http\Controllers\CustomerController::class, 'logout']);
Route::get('all-products', [ThemeController::class, 'list']);
