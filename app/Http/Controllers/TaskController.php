<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TaskService;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index(Request $request)
    {
        $tasks = $this->taskService->getFilteredTasks($request);
        $projects = $this->taskService->getAllProjects();
        return view('tasks.tasks', compact('tasks', 'projects'));
    }

    public function store(StoreTaskRequest $request)
    {
        $this->taskService->createTask($request->validated());
        return redirect()->route('tasks.index')->with('success', 'Tarefa criada com sucesso!');
    }

    public function update(UpdateTaskRequest $request, $id)
    {
        $this->taskService->updateTask($id, $request->validated());
        return redirect()->route('tasks.index')->with('success', 'Tarefa atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $this->taskService->deleteTask($id);
        return redirect()->route('tasks.index')->with('success', 'Tarefa excluída com sucesso!');
    }
}
