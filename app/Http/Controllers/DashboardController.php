<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProjects = Project::count();

        $totalTasks = Task::count();

        $completedTasks = Task::where('status', 'completed')->count();

        $inProgressTasks = Task::where('status', 'in_progress')->count();

        $pendingTasks = Task::where('status', 'pending')->count();

        $tasksNoProject = Task::whereNull('project_id')->count();

        return view('dashboard.dashboard', compact(
            'totalProjects',
            'totalTasks',
            'completedTasks',
            'pendingTasks',
            'inProgressTasks',
            'tasksNoProject'
        ));
    }
}
