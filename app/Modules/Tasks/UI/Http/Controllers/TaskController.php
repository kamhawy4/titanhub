<?php

namespace App\Modules\Tasks\UI\Http\Controllers;
// app/Modules/Tasks/UI/Http/Controllers/TaskController.php
namespace App\Modules\Tasks\UI\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Tasks\Application\Services\CreateTaskService;

class TaskController extends Controller {
    private CreateTaskService $createService;

    public function __construct(CreateTaskService $createService) {
        $this->createService = $createService;
    }

    public function store(Request $request){
        $data = $request->validate([
            'title'=>'required|string|max:255',
            'description'=>'nullable|string',
            'owner_id'=>'nullable|exists:users,id',
            'due_at'=>'nullable|date',
        ]);
        $data['creator_id'] = $request->user()->id;

        $task = $this->createService->execute($data);
        return response()->json(['uuid'=>$task->uuid],201);
    }
}
