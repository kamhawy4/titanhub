<?php
// app/Listeners/SendTaskCreatedNotification.php
namespace App\Listeners;

use App\Modules\Tasks\Domain\Events\TaskCreated;
use App\Jobs\SendTaskNotificationJob;

class SendTaskCreatedNotification {
    public function handle(TaskCreated $event){
        SendTaskNotificationJob::dispatch($event->task);
    }
}
