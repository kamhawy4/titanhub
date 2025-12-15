<?php

namespace App\Modules\Tasks\UI\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // ممكن تحط authorization logic حسب المستخدم
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'owner_id' => 'nullable|exists:users,id',
            'due_at' => 'nullable|date',
            'priority' => 'nullable|integer|in:1,2,3',
        ];
    }
}
