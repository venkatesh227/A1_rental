<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ClientsController;

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

Route::get('/', [FrontendController::class, 'index']);

Route::get('login', [MainController::class, 'login'])->name('login');

Route::post('login_check', [MainController::class, 'login_check']);

Route::get('dashboard',  [MainController::class, 'dashboard']);
Route::get('logout', [MainController::class, 'logout']);
Route::get('user-login', [MainController::class, 'user_login'])->name('user-login');
Route::post('user-login-check', [MainController::class, 'user_login_check']);
Route::get('user-logout', [MainController::class, 'user_logout']);
Route::get('view-subCategory/{id}', [FrontendController::class, 'view_subCategory']);
Route::get('view-products/{sub_id}', [FrontendController::class, 'view_products']);
Route::get('product-details/{sub_id}/{prod_id}', [FrontendController::class, 'product_details']);

Route::group(['middleware' => ['UserAuthCheck']], function () {
    Route::post('/add-to-cart', [FrontendController::class, 'add_to_cart']);
});


Route::group(['middleware' => ['AuthCheck']], function () {
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('add-category', [CategoryController::class, 'add_category']);
    Route::post('insert-category', [CategoryController::class, 'insert_category']);
    Route::get('edit-category/{id}', [CategoryController::class, 'edit_category']);
    Route::post('upadate-category/{id}', [CategoryController::class, 'upadate_category']);
    Route::get('subcategories', [SubcategoryController::class, 'index']);
    // 

    Route::post('insert-subcategory', [SubcategoryController::class, 'insert_subcategory']);
    // 
    Route::get('add-subcategory', [SubcategoryController::class, 'add_subcategory']);

    Route::get('edit-subcategory/{id}', [SubcategoryController::class, 'edit_subcategory']);
    Route::post('upadate-subcategory/{id}', [SubcategoryController::class, 'upadate_subcategory']);


    // Products
    Route::get('products', [ProductController::class, 'index']);
    Route::get('add-product', [ProductController::class, 'add_product']);
    Route::post('fetchSubcategories', [ProductController::class, 'fetchSubcategories'])
        ->name('fetchSubcategories');
    Route::post('insert-product', [ProductController::class, 'insert_product']);
    Route::get('edit-product/{id}', [ProductController::class, 'edit_product']);
    Route::post('update-Products/{id}', [ProductController::class, 'update_products']);


    // Clients

    Route::get('clients', [ClientsController::class, 'index']);
    // edit-client

    Route::get('edit-client/{id}', [ClientsController::class, 'edit_client']);
    Route::post('update-status/{userId}/{currentStatus}', [ClientsController::class, 'update_status'])
    ->name('update-status');

    // 
});
