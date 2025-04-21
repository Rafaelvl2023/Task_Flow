<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::with('project');

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('project_id')) {
            $query->where('project_id', $request->project_id);
        }

        $tasks = $query->paginate(5)->appends($request->query());
        $projects = Project::all();

        return view('tasks.tasks', compact('tasks', 'projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'status' => 'required|in:pending,in_progress,done',
            'due_date' => 'required|date',
        ]);

        Task::create($request->all());
        return redirect()->route('tasks.tasks')->with('success', 'Tarefa criada com sucesso!');
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string',
            'status' => 'required|in:pending,in_progress,done',
            'due_date' => 'required|date',
        ]);

        $task->update($request->all());
        return redirect()->route('tasks.tasks')->with('success', 'Tarefa atualizada com sucesso!');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.tasks')->with('success', 'Tarefa excluída com sucesso!');
    }
}
