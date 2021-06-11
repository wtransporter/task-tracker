<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TasktypeController;
use App\Http\Controllers\ProjectInvitationController;

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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    Route::group(['middleware' => ['is_admin']], function () {
        Route::resource('projects', ProjectController::class);
        Route::resource('tasktypes', TasktypeController::class);
        Route::resource('categories', CategoryController::class);
        Route::post('invitations/{project}', [ProjectInvitationController::class, 'store'])->name('invitations.store');
    });

    Route::resource('projects.tasks', TaskController::class);
});

Auth::routes();
