<?php

namespace App\Modules\Tasks\Application\Services;

use App\Modules\Tasks\Domain\Contracts\TaskRepositoryInterface;
use App\Modules\Tasks\Domain\Entities\Task;
use App\Modules\Tasks\Domain\Events\TaskCreated;

class CreateTaskService
{
    private TaskRepositoryInterface $repo;

    public function __construct(TaskRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function execute(array $data): Task
    {
        // إنشاء الـ Entity
        $task = new Task($data);

        // حفظه في DB عبر Repository
        $saved = $this->repo->save($task);

        // إطلاق Domain Event
        event(new TaskCreated($saved));

        return $saved;
    }
}
