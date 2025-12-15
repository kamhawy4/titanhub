<?php

namespace App\Modules\Tasks\Application\DTOs;

class CreateTaskDTO
{
    public string $title;
    public ?string $description;
    public ?int $ownerId;
    public ?string $dueAt;
    public int $priority;
    public int $creatorId;

    public function __construct(array $data)
    {
        $this->title = $data['title'];
        $this->description = $data['description'] ?? null;
        $this->ownerId = $data['owner_id'] ?? null;
        $this->dueAt = $data['due_at'] ?? null;
        $this->priority = $data['priority'] ?? 2;
        $this->creatorId = $data['creator_id'];
    }
}
