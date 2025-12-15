<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Tasks\UI\Http\Controllers\TaskController;

Route::middleware('api')->group(function () {
    Route::post('/tasks', [TaskController::class, 'store']);
});
