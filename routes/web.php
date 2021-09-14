<?php

use App\Models\RolesNames;
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

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

// Route::get('/home', function () {
//     return view('main.index');
// });

Route::get('/home', function () {
    return redirect('/admin/list_users');
});

//Limpiar cache sistema
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

Route::middleware(['auth'])->group(function () {

    
    Route::namespace('App\Http\Controllers\Admin')->prefix('admin')
        ->middleware(['role:' . RolesNames::$admin])
        ->name('admin.')->group(function () {
            // Route::get('/', 'PageController@index')->name('index');
            Route::get('/list_users', 'PageController@list_users')->name('list_users');
            Route::get('/edit_user/{id}', 'PageController@edit_user')->name('edit_user');
            Route::get('/create_user', 'PageController@create_user')->name('create_user');
            Route::post('/store_user', 'PageController@store_user')->name('store_user');
            Route::patch('/update_user/{id}', 'PageController@update_user')->name('update_user');
            Route::get('/disable_user/{id}', 'PageController@disable_user')->name('disable_user');
            Route::get('/enable_user/{id}', 'PageController@enable_user')->name('enable_user');
            Route::get('/delete_user/{id}', 'PageController@delete_user')->name('delete_user');
        });
    
        Route::namespace('App\Http\Controllers\ProfileUser')->prefix('profile_user')
        ->name('profile_user.')->group(function () {
            Route::get('/data_profile', 'PageController@data_profile')->name('data_profile');
            Route::post('/update_data_profile', 'PageController@update_data_profile')->name('update_data_profile');
            Route::get('/change_password', 'PageController@change_password')->name('change_password');
            Route::post('/update_password', 'PageController@update_password')->name('update_password');
            Route::post('/update_signature_image', 'PageController@update_signature_image')->name('update_signature_image');
        });

        Route::namespace('App\Http\Controllers\Cuenta')->prefix('cuenta')
        ->name('cuenta.')->group(function () {
            Route::get('/', 'PageController@index')->name('index');
            Route::get('/edit/{id}', 'PageController@edit')->name('edit');
            Route::get('/create', 'PageController@create')->name('create');
            Route::post('/store', 'PageController@store')->name('store');
            Route::patch('/update/{id}', 'PageController@update')->name('update');
            Route::get('/delete/{id}', 'PageController@delete')->name('delete');

            Route::get('/api_getAll', 'PageController@api_getAll')->name('api_getAll');
            Route::get('/api_getById/{id}', 'PageController@api_getById')->name('api_getById');
            Route::get('/api_getAllByUsuarioID/{id}', 'PageController@api_getAllByUsuarioID')->name('api_getAllByUsuarioID');
            Route::post('/api_add', 'PageController@api_add')->name('api_add');
        });
});