<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Reusables\FetchAnyItemController;
use App\Http\Controllers\StockInventoryController;
use App\Http\Controllers\CheckoutInventoryController;
use App\Http\Controllers\ReportsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
/*
Stock Man API routes
*/
//Login Routes
Route::post('fetch_users', [UsersController::class, 'fetchUsers']);

/*
* *
 * Fetch any item controller routes
 *
 * */
//fetch all departments
Route::get('fetch_departments', [FetchAnyItemController::class, 'fetchDepartments']);
//fetch all departments
Route::get('fetch_suppliers', [FetchAnyItemController::class, 'fetchSuppliers']);
//fetch clothes size
Route::get('fetch_sizes', [FetchAnyItemController::class, 'fetchSizes']);

//save inventory and return product ids
Route::post('add_individual_product_to_cart', [StockInventoryController::class, 'addIndividualProductToCart']);
//save submit stock inventory
Route::post('submit_stock_inventory', [StockInventoryController::class, 'saveSubmitStockInventory']);
//checkout products
Route::post('checkout_individual_product_to_cart', [CheckoutInventoryController::class, 'checkoutIndividualProductToCart']);
//checkout products from stock
Route::post('save_checkout_stock', [CheckoutInventoryController::class, 'saveCheckoutInventory']);


/*Reports*/
Route::get('fetch_reports_data', [ReportsController::class, 'fetchReportsData']);
//daily report
Route::get('generate_daily_report/{date}', [ReportsController::class, 'generateDailyReport']);
