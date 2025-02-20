<?php

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

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
}