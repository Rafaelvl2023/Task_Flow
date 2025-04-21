<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\TaskRepository;

class TaskService
{
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function getAllProjects()
    {
        return $this->taskRepository->getAll();
    }

    public function getFilteredTasks(Request $request)
    {
        return $this->taskRepository->filterTasks($request);
    }

    public function createTask(array $data)
    {
        return $this->taskRepository->create($data);
    }

    public function updateTask(int $id, array $data)
    {
        return $this->taskRepository->update($id, $data);
    }

    public function deleteTask(int $id)
    {
        return $this->taskRepository->delete($id);
    }
}
