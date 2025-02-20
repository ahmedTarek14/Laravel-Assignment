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
        $user_id = sanctum()->id();
        $tasks = Task::where('user_id', $user_id)->orderByDesc('id')->get();

        $data = TaskResource::collection($tasks)->response()->getData(true);

        try {
            return api_response_success($data);
        } catch (\Throwable $th) {
            return api_response_error();
        }
    }

    public function store(TaskRequest $request)
    {
        $request['user_id'] = sanctum()->id();

        $task = Task::create($request->all());

        try {
            $data = new TaskResource($task);

            return api_response_success($data);
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            return api_response_error();
        }
    }
}