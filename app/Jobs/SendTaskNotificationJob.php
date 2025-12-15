<?php
// app/Jobs/SendTaskNotificationJob.php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Modules\Tasks\Domain\Entities\Task;
use App\Models\User;
use App\Notifications\TaskAssignedNotification;

class SendTaskNotificationJob implements ShouldQueue {
    use InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Task $task){}

    public function handle(){
        if($this->task->ownerId){
            $user = User::find($this->task->ownerId);
            if($user) $user->notify(new TaskAssignedNotification($this->task));
        }
    }
}
