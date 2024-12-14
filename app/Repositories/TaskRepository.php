<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{
    public function getAllTasks()
    {
        return Task::with('user', 'category')->paginate();
    }

    public function getTaskById($id)
    {
        return Task::with(['user', 'category'])->findOrFail($id);
    }


    public function createTask(array $data)
    {
        return Task::create($data);
    }

    public function updateTask($id, array $data)
    {
        $task = Task::findOrFail($id);
        $task->update($data);
        return $task;
    }

    public function deleteTask($id)
    {
        $task = Task::find($id);
        $task->delete();
        return $task;
    }

    public function restore($id)
    {
        $task = Task::onlyTrashed()->findOrFail($id);
        $task->restore();
        return $task;
    }

    public function getTasksByStatus($status)
    {
        return Task::with(['user', 'category'])
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->get();
    }
    


}
