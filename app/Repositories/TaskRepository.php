<?php

namespace App\Repositories;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskRepository
{
    public function getAll()
    {
        return Project::all();
    }

    public function filterTasks(Request $request)
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

        return $query->paginate(5);
    }

    public function create(array $data)
    {
        return Task::create($data);
    }

    public function update(int $id, array $data)
    {
        $task = Task::findOrFail($id);
        $task->update($data);
        return $task;
    }

    public function delete(int $id)
    {
        $task = Task::findOrFail($id);
        return $task->delete();
    }
}
