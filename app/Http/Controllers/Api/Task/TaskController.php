<?php

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Support\Str;

class TaskController extends Controller
{
    public function index()
    {
        try {
            $user_id = sanctum()->id();
            $tasks = Task::where('user_id', $user_id)->orderByDesc('id')->get();
            $data = TaskResource::collection($tasks)->response()->getData(true);
            return api_response_success($data);
        } catch (\Throwable $th) {
            return api_response_error();
        }
    }

    public function store(TaskRequest $request)
    {
        try {
            $request['user_id'] = sanctum()->id();
            $task = Task::create($request->all());
            return api_response_success(['message' => 'Task created successfully.']);
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            return api_response_error();
        }
    }


    public function update(TaskRequest $request, Task $task)
    {
        try {
            $task->update($request->all());
            return api_response_success(['message' => 'Task updated successfully.']);
        } catch (\Throwable $th) {
            return api_response_error();
        }
    }

    public function destroy(Task $task)
    {
        try {
            $task->delete();
            return api_response_success(['message' => 'Task deleted successfully.']);
        } catch (\Throwable $th) {
            return api_response_error();
        }
    }
}