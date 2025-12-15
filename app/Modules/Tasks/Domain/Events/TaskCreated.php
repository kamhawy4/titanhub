<?php

namespace App\Modules\Tasks\Domain\Events;

use App\Modules\Tasks\Domain\Entities\Task;

class TaskCreated
{
    public Task $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }
}
