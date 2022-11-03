<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\MethodController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

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

\Illuminate\Support\Facades\Auth::routes();
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {

    Route::resources([
        'users' => UserController::class,
        'providers' => ProviderController::class,
        'inventory/products' => ProductController::class,
        'clients' => ClientController::class,
        'inventory/categories' => ProductCategoryController::class,
        'transactions/transfer' => TransactionController::class,
        'methods' => MethodController::class,
    ]);

    Route::resource('transactions', TransactionController::class)->except(['create', 'show']);
    Route::get('transactions/stats/{year?}/{month?}/{day?}', [TransactionController::class, 'stats'])->name('transactions.stats');
    Route::get('transactions/{type}',[TransactionController::class,'type'])->name('transactions.type');
    Route::get('transactions/{type}/create',[TransactionController::class, 'create'] )->name('transactions.create');
    Route::get('transactions/{transaction}/edit', [TransactionController::class, 'edit'])->name('transactions.edit');

    Route::get('inventory/stats/{year?}/{month?}/{day?}', ['as' => 'inventory.stats', 'uses' => 'App\Http\Controllers\InventoryController@stats']);
    Route::resource('inventory/receipts', ReceiptController::class)->except(['edit', 'update']);
    Route::get('inventory/receipts/{receipt}/finalize', [ReceiptController::class, 'finalize'])->name('receipts.finalize');
    Route::get('inventory/receipts/{receipt}/product/add', ['as' => 'receipts.product.add', 'uses' => 'App\Http\Controllers\ReceiptController@addproduct']);
    Route::get('inventory/receipts/{receipt}/product/{receivedproduct}/edit', ['as' => 'receipts.product.edit', 'uses' => 'App\Http\Controllers\ReceiptController@editproduct']);
    Route::post('inventory/receipts/{receipt}/product', ['as' => 'receipts.product.store', 'uses' => 'App\Http\Controllers\ReceiptController@storeproduct']);
    Route::match(['put', 'patch'], 'inventory/receipts/{receipt}/product/{receivedproduct}', ['as' => 'receipts.product.update', 'uses' => 'App\Http\Controllers\ReceiptController@updateproduct']);
    Route::delete('inventory/receipts/{receipt}/product/{receivedproduct}', ['as' => 'receipts.product.destroy', 'uses' => 'App\Http\Controllers\ReceiptController@destroyproduct']);

    Route::resource('sales', SaleController::class)->except(['edit', 'update']);
    Route::get('sales/{sale}/finalize', ['as' => 'sales.finalize', 'uses' => 'App\Http\Controllers\SaleController@finalize']);
    Route::get('sales/{sale}/product/add', ['as' => 'sales.product.add', 'uses' => 'App\Http\Controllers\SaleController@addproduct']);
    Route::get('sales/{sale}/product/{soldproduct}/edit', ['as' => 'sales.product.edit', 'uses' => 'App\Http\Controllers\SaleController@editproduct']);
    Route::post('sales/{sale}/product', ['as' => 'sales.product.store', 'uses' => 'App\Http\Controllers\SaleController@storeproduct']);
    Route::match(['put', 'patch'], 'sales/{sale}/product/{soldproduct}', ['as' => 'sales.product.update', 'uses' => 'App\Http\Controllers\SaleController@updateproduct']);
    Route::delete('sales/{sale}/product/{soldproduct}', ['as' => 'sales.product.destroy', 'uses' => 'App\Http\Controllers\SaleController@destroyproduct']);

    Route::get('clients/{client}/transactions/add', ['as' => 'clients.transactions.add', 'uses' => 'App\Http\Controllers\ClientController@addtransaction']);

    Route::get('profile', ['as' => 'profile.edit', 'uses' => [ProfileController::class, "edit"]]);
    Route::match(['put', 'patch'], 'profile', ['as' => 'profile.update', 'uses' => [ProfileController::class, 'update']]);
    Route::match(['put', 'patch'], 'profile/password', ['as' => 'profile.password', 'uses' => [ProfileController::class, "password"]]);
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('icons', ['as' => 'pages.icons', 'uses' => 'App\Http\Controllers\PageController@icons']);
    Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'App\Http\Controllers\PageController@notifications']);
    Route::get('tables', ['as' => 'pages.tables', 'uses' => 'App\Http\Controllers\PageController@tables']);
    Route::get('typography', ['as' => 'pages.typography', 'uses' => 'App\Http\Controllers\PageController@typography']);
});
