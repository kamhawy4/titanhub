<?php

namespace App\Modules\Tasks\Domain\Contracts;

use App\Modules\Tasks\Domain\Entities\Task;

interface TaskRepositoryInterface
{
    public function save(Task $task): Task;

    public function findById(int $id): ?Task;

    public function findByUuid(string $uuid): ?Task;

    public function paginate(array $filters = [], int $perPage = 15);
}
