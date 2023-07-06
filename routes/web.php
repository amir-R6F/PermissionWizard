<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\RolesController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->middleware('role:editPage,watchPage')
    ->name('home');

Route::controller(RolesController::class)->middleware('role:editPage')->group(function(){
    Route::post("addRole", 'createRole');
    Route::get("listOfRoles", 'existRole');
    Route::post("getRoleToEdit", 'getForEdit');
    Route::post("updateRole", 'editRole');
    Route::post("destroyRole", 'deleteRole');
});

Route::get('/user', function () {
    return "test";
})->middleware('role:watchPage,editPage');

