<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;

Route::get('/', function () {
  return response()->json([
    'message' => 'Welcome!'
  ], 200);
});

Route::get('/tasks', [TasksController::class, 'index']);

Route::post('/tasks', [TasksController::class, 'store']);

Route::patch('/tasks/{id}', [TasksController::class, 'update']);

Route::delete('/tasks/{id}', [TasksController::class, 'destroy']);