<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ApiTaskController extends Controller
{
    public function index()
    {
        return TaskResource::collection(Task::all());
    }

    public function store(TaskRequest $request)
    {
        $task = Task::create($request->validated());
        return new TaskResource($task);
    }

    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    public function update(TaskRequest $request, Task $task)
    {
        $task->update($request->validated());
        return new TaskResource($task);
    }

    public function restore($id)
    {
        $task = Task::withTrashed()->find($id);
        $task->restore();
        return response(null, 204);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response(null, 204);
    }

    public function forceDelete($id)
    {
        $task = Task::withTrashed()->find($id);
        $task->forceDelete();
        return response(null, 204);
    }


    public function search(Request $request)
    {
        $query = Task::query();

        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->has('deadline')) {
            $deadline = Carbon::createFromFormat('d.m.Y', $request->input('deadline'))->format('Y-m-d');
            $query->whereDate('deadline', $deadline);
        }

        return TaskResource::collection($query->get());
    }
}
