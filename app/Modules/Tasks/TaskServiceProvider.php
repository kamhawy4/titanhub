<?php

// app/Modules/Tasks/TaskServiceProvider.php
namespace App\Modules\Tasks;

use Illuminate\Support\ServiceProvider;
use App\Modules\Tasks\Domain\Contracts\TaskRepositoryInterface;
use App\Modules\Tasks\Infrastructure\Repositories\TaskRepositoryEloquent;

class TaskServiceProvider extends ServiceProvider {
    public function register(){
        $this->app->bind(TaskRepositoryInterface::class, TaskRepositoryEloquent::class);
    }

    public function boot(){
        $this->loadRoutesFrom(__DIR__.'/UI/routes.php');
    }
}
