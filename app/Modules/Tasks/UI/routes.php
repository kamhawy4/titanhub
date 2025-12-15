<?php

// app/Modules/Tasks/UI/routes.php
use Illuminate\Support\Facades\Route;
use App\Modules\Tasks\UI\Http\Controllers\TaskController;

Route::middleware(['auth:sanctum'])->prefix('api/tasks')->group(function(){
    Route::post('/', [TaskController::class,'store']);
});
