<?php

use Illuminate\Support\Facades\Route;
use Task\Presentation\Controller\TaskCreateController;
use Task\Presentation\Controller\TaskIndexController;
use Task\Presentation\Controller\TaskUpdateController;

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

Route::group(['prefix' => 'tasks', 'as' => 'task.'], function () {
    Route::get('/', [TaskIndexController::class, 'index'])->name('index');
    Route::get('store', [TaskCreateController::class, 'store'])->name('store');
    Route::get('update/{id}', [TaskUpdateController::class, 'update'])->name('update');
});
