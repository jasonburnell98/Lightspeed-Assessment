<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;



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


Route::controller(UserController::class)->group(function () {
    Route::post('/user/get', 'getUserList');
    Route::post('/user/create', 'createUser');
});


Route::controller(ProjectController::class)->group(function () {
    Route::post('/project/get', 'getProjectList');
    Route::post('/project/create', 'createProject');
});

Route::controller(TaskController::class)->group(function () {
    Route::get('/task/get', 'getTaskList');
    Route::post('/task/create', 'createTask');
});
