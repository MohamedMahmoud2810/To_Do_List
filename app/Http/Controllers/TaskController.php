<?php

namespace App\Http\Controllers;

use App\DTO\TaskDTO;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index()
    {
        $tasks = $this->taskService->getAllTasks();
        return TaskResource::collection($tasks);
    }

    public function show($id)
    {
        $task = $this->taskService->getTaskById($id);
        if(!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }
        return new TaskResource($task);
    }

    public function store(StoreTaskRequest $request)
    {
        // Validate incoming request data
        $validatedData = $request->validated();
    
        // Create a TaskDTO from the validated data
        $data = TaskDTO::fromRequest($validatedData, []);
    
        // Use the service to create the task
        $task = $this->taskService->createTask($data->toArray());
    
        // Return the created task as a resource
        return new TaskResource($task);
    }
    

    public function update(UpdateTaskRequest $request, $id)
    {
        // Retrieve the existing task
        $task = $this->taskService->getTaskById($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        // Prepare the old data array
        $oldData = [
            'title' => $task->title,
            'description' => $task->description,
            'user_id' => $task->user_id,
            'status' => $task->status,
        ];

        // Validate the request and merge with old data
        $validatedData = $request->validated();
        $data = TaskDTO::fromRequest($validatedData, $oldData)->toArray();

        // Update the task
        $updatedTask = $this->taskService->updateTask($id, $data);

        // Return the updated task as a resource
        return new TaskResource($updatedTask);
    }



    public function destroy($id)
    {
        $task = $this->taskService->getTaskById($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }
        $this->taskService->deleteTask($id);
        return response()->json(['message' => 'Task deleted successfully']);
    }

    public function restore($id)
    {
        $task = $this->taskService->restoreTask($id);
        return response()->json([
            'message' => 'Task restored successfully.',
            'data' => new TaskResource($task)
        ], 200);
    }

    public function filterTasks(Request $request)
    {
        $status = $request->query('status', null);
        $validStatuses = ['completed', 'pending', 'in_progress'];
        if ($status && !in_array($status, $validStatuses)) {
            return response()->json(['message' => 'Invalid status value'], 400);
        }
        $tasks = $this->taskService->filterTasksByStatus($status);
        if ($tasks->isEmpty()) {
            return response()->json(['message' => 'No tasks found for the given status'], 404);
        }
    
        return TaskResource::collection($tasks);
    }
    



}
