<?php

namespace App\Modules\Tasks\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskEloquent extends Model
{
    use SoftDeletes;

    protected $table = 'tasks';

    protected $fillable = [
        'uuid',
        'title',
        'description',
        'creator_id',
        'owner_id',
        'status',
        'priority',
        'due_at',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
        'due_at' => 'datetime',
    ];
}
