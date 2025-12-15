<?php

namespace App\Modules\Tasks\Domain\Enums;

enum TaskStatus: string
{
    case PENDING = 'pending';
    case DONE = 'done';
}
