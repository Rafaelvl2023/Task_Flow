<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::paginate(5);
        return view('projects.projects', compact('projects'));
    }

    public function store(StoreProjectRequest $request)
    {
        Project::create([
            'name' => $request->name,
            'description' => $request->description ?? 'Sem descrição',
        ]);

        return redirect()->route('projects.index')->with('success', 'Projeto criado com sucesso!');
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        $project->update($request->only('name'));

        return redirect()->route('projects.index')->with('success', 'Projeto atualizado com sucesso!');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Projeto excluído com sucesso!');
    }
}
