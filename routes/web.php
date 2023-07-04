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

Route::post("addRole", [RolesController::class, 'createRole'])->middleware('role:editPage');
Route::get("listOfRoles", [RolesController::class, 'existRole']);
Route::post("getRoleToEdit", [RolesController::class, 'getForEdit']);
Route::post("updateRole", [RolesController::class, 'editRole']);
Route::post("destroyRole", [RolesController::class, 'deleteRole']);

Route::get('/user', function () {
    return "test";
})->middleware('role:watchPage,editPage');

