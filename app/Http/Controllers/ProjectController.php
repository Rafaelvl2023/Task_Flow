<?php

namespace App\Http\Controllers;

use App\Services\ProjectService;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{
    protected $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function index()
    {
        $projects = $this->projectService->getAllPaginated();
        return view('projects.projects', compact('projects'));
    }

    public function store(StoreProjectRequest $request)
    {
        $this->projectService->create($request->validated());
        return redirect()->route('projects.index')->with('success', 'Projeto criado com sucesso!');
    }

    public function update(UpdateProjectRequest $request, $id)
    {
        $this->projectService->update($id, $request->only('name'));
        return redirect()->route('projects.index')->with('success', 'Projeto atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $this->projectService->delete($id);
        return redirect()->route('projects.index')->with('success', 'Projeto excluído com sucesso!');
    }
}
