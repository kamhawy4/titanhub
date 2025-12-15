<?php

namespace App\Modules\Tasks\Domain\Entities;

use Carbon\Carbon;

final class Task
{
    public ?int $id;
    public string $uuid;
    public string $title;
    public ?string $description;
    public int $creatorId;
    public ?int $ownerId;
    public string $status;
    public int $priority;
    public ?Carbon $dueAt;
    public array $meta;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->uuid = $data['uuid'] ?? \Str::uuid()->toString();
        $this->title = $data['title'];
        $this->description = $data['description'] ?? null;
        $this->creatorId = $data['creator_id'];
        $this->ownerId = $data['owner_id'] ?? null;
        $this->status = $data['status'] ?? 'open';
        $this->priority = $data['priority'] ?? 2;
        $this->dueAt = isset($data['due_at']) ? Carbon::parse($data['due_at']) : null;
        $this->meta = $data['meta'] ?? [];
    }

    public function markInProgress(): void
    {
        $this->status = 'in_progress';
    }

    public function markDone(): void
    {
        $this->status = 'done';
    }
}
