<?php


use App\Http\Controllers\Accounts\PermissionController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\UnitController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\SupplierController;
use App\Http\Controllers\Accounts\RoleController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Accounts\Setting\SettingsController;
use Illuminate\Support\Facades\Auth;
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

Route::group(['prefix' => 'dashboard'], function () {

    Route::get('home', [HomeController::class, 'index'])->name('dashboard');
    // Product
    Route::resource('accounts/category', CategoryController::class, ['as' => 'dashboard.accounts']);
    Route::resource('accounts/unit', UnitController::class, ['as' => 'dashboard.accounts']);
    Route::resource('accounts/products', ProductController::class, ['as' => 'dashboard.accounts']);
    ///Supplier
    Route::resource('accounts/supplier', SupplierController::class, ['as' => 'dashboard.accounts']);
    ////User
    Route::resource('accounts/users', UserController::class, ['as' => 'dashboard.accounts']);
    Route::resource('accounts/roles', RoleController::class, ['as' => 'dashboard.accounts']);
    Route::resource('accounts/permissions', PermissionController::class, ['as' => 'dashboard.accounts']);
    Route::get('accounts/permissions/sync/all', [PermissionController::class, 'syncPermissions'])->name('dashboard.accounts.permissions.sync');





    // Settings > Software Setting
    Route::resource('accounts/settings', SettingsController::class, ['as' => 'dashboard.accounts']);
    Route::get('/manage_company', [SettingsController::class, 'ManageCompany'])->name('manage.company');

    // Stock


});

Route::get('/', function () {
    return redirect()->route('dashboard');
});




Route::get('/dash', [HomeController::class, 'index'])->name('dashboard');


// Settings > Role Permission
Route::resource('role', 'App\Http\Controllers\Dashboard\RoleController');
Route::get('/user_assign_role', [RoleController::class, 'user_assign_role'])->name('user.role');


//Authentication Routes
Auth::routes();
/**
 *  Return to dashboard...
 */
