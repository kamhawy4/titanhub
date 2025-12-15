<?php

namespace App\Modules\Tasks\Infrastructure\Repositories;

use App\Modules\Tasks\Domain\Contracts\TaskRepositoryInterface;
use App\Modules\Tasks\Domain\Entities\Task;
use App\Modules\Tasks\Infrastructure\Models\TaskEloquent;

class TaskRepositoryEloquent implements TaskRepositoryInterface
{
    protected TaskEloquent $model;

    public function __construct(TaskEloquent $model)
    {
        $this->model = $model;
    }

    public function save(Task $task): Task
    {
        $data = [
            'uuid' => $task->uuid,
            'title' => $task->title,
            'description' => $task->description,
            'creator_id' => $task->creatorId,
            'owner_id' => $task->ownerId,
            'status' => $task->status,
            'priority' => $task->priority,
            'due_at' => $task->dueAt,
            'meta' => $task->meta,
        ];

        $model = $this->model->updateOrCreate(['uuid' => $task->uuid], $data);
        $task->id = $model->id;

        return $task;
    }

    public function findById(int $id): ?Task
    {
        $m = $this->model->find($id);
        return $m ? $this->mapToEntity($m) : null;
    }

    public function findByUuid(string $uuid): ?Task
    {
        $m = $this->model->where('uuid', $uuid)->first();
        return $m ? $this->mapToEntity($m) : null;
    }

    public function paginate(array $filters = [], int $perPage = 15)
    {
        $q = $this->model->newQuery();

        if (isset($filters['owner_id'])) $q->where('owner_id', $filters['owner_id']);
        if (isset($filters['status'])) $q->where('status', $filters['status']);

        return $q->paginate($perPage);
    }

    protected function mapToEntity(TaskEloquent $m): Task
    {
        return new Task([
            'id' => $m->id,
            'uuid' => $m->uuid,
            'title' => $m->title,
            'description' => $m->description,
            'creator_id' => $m->creator_id,
            'owner_id' => $m->owner_id,
            'status' => $m->status,
            'priority' => $m->priority,
            'due_at' => $m->due_at,
            'meta' => $m->meta,
        ]);
    }
}
