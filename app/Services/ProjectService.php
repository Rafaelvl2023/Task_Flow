<?php

namespace App\Services;

use App\Repositories\ProjectRepository;

class ProjectService
{
    protected $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function getAllPaginated($perPage = 5)
    {
        return $this->projectRepository->paginate($perPage);
    }

    public function create(array $data)
    {
        if (empty($data['description'])) {
            $data['description'] = 'Sem descrição';
        }

        return $this->projectRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->projectRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->projectRepository->delete($id);
    }
}
