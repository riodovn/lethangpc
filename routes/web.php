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
        'store' => 'admin.products.store',
        'edit' => 'admin.products.edit',
        'destroy' => 'admin.products.destroy',
        'store'=>'admin.products.store',
        'update'=>'admin.products.update',
    ]);

    // Thêm thông số kỹ thuật vào sản phẩm
    Route::post('/edit/add-spec', [ProductController::class,'addSpec'])->name('admin.products.addSpec');
    Route::delete('/edit/delete-spec/{id}', [ProductController::class,'deleteSpec'])->name('admin.products.deleteSpec');

    // Thêm chính sách bảo hành cho sản phẩm
    Route::post('/edit/add-warranty', [ProductController::class,'addWarranty'])->name('admin.products.addWarranty');
    Route::delete('/edit/delete-warranty/{id}', [ProductController::class,'deleteWarranty'])->name('admin.products.deleteWarranty');

    // Thêm các khuyến mãi/ưu đãi cho sản phẩm
    Route::post('/edit/add-promotion', [ProductController::class,'addPromotion'])->name('admin.products.addPromotion');
    Route::delete('/edit/delete-promotion/{id}', [ProductController::class,'deletePromotion'])->name('admin.products.deletePromotion');

    Route::resource('warranty_policies', WarrantyPolicyController::class)->names([
        'index' => 'admin.warranty_policies.index',
        'create' => 'admin.warranty_policies.create',
        'edit' => 'admin.warranty_policies.edit',
        'destroy' => 'admin.warranty_policies.destroy',
        'store' => 'admin.warranty_policies.store',
        'update' => 'admin.warranty_policies.update',
        'show'=>'admin.warranty_policies.show'
    ]);

    // Quản lý danh mục sản phẩm
    Route::get('/categories', [AdminController::class, 'categoriesList'])->name('admin.categories');

    // Quản lý thành viên
    Route::get('/members', [AdminController::class, 'usersList'])->name('admin.users');

    // Quản lý danh sách thông số kỹ thuật của sản phẩm
    Route::get('/technical-specifications', [AdminController::class, 'technicalSpecificationsList'])->name('admin.technical-specifications');

    // Quản lý khuyến mãi 
    Route::get('/promotions', [AdminController::class, 'promotionsList'])->name('admin.promotions');
});
