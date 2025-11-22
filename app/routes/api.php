<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::prefix('task')->group(function () {
    Route::get('/', [TaskController::class, 'listTasks']);
    Route::get('/{id}', [TaskController::class, 'findTaskById']);
    Route::get('/project/{projectId}', [TaskController::class, 'listTasksFromProject']);
    Route::post('/create', [TaskController::class, 'create']);
    Route::put('/{id}/update', [TaskController::class, 'update']);
    Route::delete('/{id}/delete', [TaskController::class, 'delete']);
});

Route::prefix('project')->group(function () {
    Route::get('/', [ProjectController::class, 'listProjects']);
    Route::get('/{id}', [ProjectController::class, 'findProjectById']);
    Route::post('/create', [ProjectController::class, 'create']);
    Route::put('/{id}/update', [ProjectController::class, 'update']);
    Route::delete('/{id}/delete', [ProjectController::class, 'delete']);
});
