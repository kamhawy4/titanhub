<?php

namespace App\Modules\Tasks\Application\Commands;

use App\Modules\Tasks\Domain\Entities\Task;
use App\Modules\Tasks\Domain\Contracts\TaskRepositoryInterface;

class CreateTaskCommand
{
    private array $data;
    private TaskRepositoryInterface $repository;

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->repository = app(TaskRepositoryInterface::class);
    }

    public function handle(): Task
    {
        $task = new Task($this->data);

        return $this->repository->save($task);
    }
}
