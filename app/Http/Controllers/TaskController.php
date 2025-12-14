<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(): JsonResponse
    {
        $tasks = auth()->user()->tasks()
            ->orderBy('completed', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($tasks);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $task = auth()->user()->tasks()->create($validatedData);

        return response()->json($task, 201);
    }

    public function update(UpdateRequest $request, string $id): JsonResponse
    {
        $validatedData = $request->validated();

        $task = auth()->user()->tasks()->findOrFail($id);

        $task->update($validatedData);

        return response()->json($task);
    }

    public function destroy(string $id): JsonResponse
    {
        $task = auth()->user()->tasks()->findOrFail($id);
        $task->delete();

        return response()->json(null, 204);
    }
}
