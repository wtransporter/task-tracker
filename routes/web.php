<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\BackupController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\TasktypeController;
use App\Http\Controllers\TaskCommentController;
use App\Http\Controllers\ProjectInvitationController;
use App\Http\Controllers\UserNotificationController;

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
    return redirect()->route('home');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/user-tasks', [HomeController::class, 'tasks'])->name('user-tasks');
    Route::get('/available-tasks', [HomeController::class, 'allTasks'])->name('available-tasks');
    Route::get('/user-projects', [HomeController::class, 'projects'])->name('user-projects');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('user.edit');
    Route::patch('/profile/{user}', [ProfileController::class, 'update'])->name('user.update');
    Route::get('/notifications', [UserNotificationController::class, 'index'])->name('notifications');
    Route::post('/notifications/{id}/store', [UserNotificationController::class, 'store'])->name('notifications.store');
    Route::post('/notifications/read', [UserNotificationController::class, 'readAll'])->name('notifications.read');

    Route::group(['middleware' => ['is_admin']], function () {
        Route::resource('projects', ProjectController::class);
        Route::resource('tasktypes', TasktypeController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('statuses', StatusController::class);
        Route::resource('priorities', PriorityController::class);
        Route::post('invitations/{project}', [ProjectInvitationController::class, 'store'])->name('invitations.store');
        Route::post('tasks/{task}/comments', [TaskCommentController::class, 'store'])->name('tasks.comments.store');
        Route::get('backups', [BackupController::class, 'index'])->name('backups');
        Route::post('backups', [BackupController::class, 'store'])->name('backups.store');
    });
    Route::get('activities', [ActivityController::class, 'index'])->name('activities');
    Route::resource('projects.tasks', TaskController::class)->except(['create', 'store']);
});

Auth::routes();
