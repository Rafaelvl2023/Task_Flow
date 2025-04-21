<?php

namespace App\Repositories;

use App\Models\Project;

class ProjectRepository
{
    public function paginate($perPage = 5)
    {
        return Project::paginate($perPage);
    }

    public function create(array $data)
    {
        return Project::create($data);
    }

    public function update(int $id, array $data)
    {
        $project = Project::findOrFail($id);
        $project->update($data);
        return $project;
    }

    public function delete(int $id)
    {
        $project = Project::findOrFail($id);
        return $project->delete();
    }
}
