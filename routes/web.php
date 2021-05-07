<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes([
    'register' => false,
]);
/** Dashboard Routes*/
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    /** Notifications Routes */
    Route::get('/notifications', [\App\Http\Controllers\UserController::class, 'notifications'])->name('users.notifications');
    Route::get('/notifications/markAsRead/{id?}', [\App\Http\Controllers\UserController::class, 'markNotificationAsRead'])->name('users.notifications.markAsRead');

    /** Users Routes */
    Route::get('users/search', [App\Http\Controllers\UserController::class, 'search'])->name('user.search');
    Route::resource('users', App\Http\Controllers\UserController::class);
    /** Departments Routes */
    Route::resource('departements', App\Http\Controllers\DepartementController::class);

    /** Services Routes */
    Route::resource('services', App\Http\Controllers\ServiceController::class);

    /** Projects Routes */
    Route::get('projects/export/', [App\Http\Controllers\ProjectController::class, 'export'])->name('projects.export');
    Route::get('projects/exportToPDF/', [App\Http\Controllers\ProjectController::class, 'exportToPDF'])->name('projects.exportToPDF');
    Route::resource('projects', App\Http\Controllers\ProjectController::class);
    Route::get('/projects/{id}/task/create', [App\Http\Controllers\TaskController::class, 'create'])->name('projects.task.create');
    Route::get('/tasks/start/{id}', [App\Http\Controllers\TaskController::class, 'startTask'])->name('projects.task.start');

    /** Tasks Routes */
    Route::get('/task/{id}/validate/', [App\Http\Controllers\TaskController::class, 'validateTask'])->name('task.validate');
    Route::get('/task/{id}/perform-validation/', [App\Http\Controllers\TaskController::class, 'performValidation'])->name('task.perform-validation');
    Route::post('/task/{id}/validate/', [App\Http\Controllers\TaskController::class, 'submitValidationFile'])->name('task.submit-validation');
    Route::resource('tasks', App\Http\Controllers\TaskController::class);
    /** Roles And Permissions Routes */
    Route::resource('roles', App\Http\Controllers\RoleController::class)->middleware(['role:Admin']);


    /**Testing The Downloadable View */
    Route::get('/tableview' , [App\Http\Controllers\ProjectController::class, 'testview']);
});
