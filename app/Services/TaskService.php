<?php

namespace App\Services;

use App\Repositories\TaskRepositoryInterface;

class TaskService
{
    protected $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function getAllTasks()
    {
        return $this->taskRepository->getAllTasks();
    }

    public function getTaskById($id)
    {
        return $this->taskRepository->getTaskById($id);
    }

    public function createTask($data)
    {
        return $this->taskRepository->createTask($data);
    }

    public function updateTask($id, $data)
    {
        return $this->taskRepository->updateTask($id, $data);
    }

    public function deleteTask($id)
    {
        return $this->taskRepository->deleteTask($id);
    }

    public function restoreTask($id)
    {
        return $this->taskRepository->restore($id);
    }

    public function filterTasksByStatus($status)
    {
        return $this->taskRepository->getTasksByStatus($status);
    }


}
