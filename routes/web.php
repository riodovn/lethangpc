<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WarrantyPolicyController;

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

Route::get('/', [GuestController::class,'index'])->name('home');
Route::get('products/{id}', [ProductController::class,'show'])->name('product.show');


// Admin Group

Route::prefix('he-thong')->group(function () {
    Route::get('/dashboard', [AdminController::class,'dashboard'])->name('admin.dashboard');
    // Thêm các route khác cho trang quản trị nếu cần
    // Quản lí sản phẩm 
    Route::resource('products', ProductController::class)->names([
        'index'=>'admin.products.index',
        'create' => 'admin.products.create',
        'edit' => 'admin.products.edit',
        'destroy' => 'admin.products.destroy',
        'store'=>'admin.products.store',
        'update'=>'admin.products.update',
    ]);
    Route::resource('warranty_policies', WarrantyPolicyController::class)->names([
        'index' => 'admin.warranty_policies.index',
        'create' => 'admin.warranty_policies.create',
        'edit' => 'admin.warranty_policies.edit',
        'destroy' => 'admin.warranty_policies.destroy',
        'store' => 'admin.warranty_policies.store',
        'update' => 'admin.warranty_policies.update',
        'show'=>'admin.warranty_policies.show'
    ]);

});
