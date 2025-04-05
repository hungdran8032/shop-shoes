<?php
namespace App\Services;

use App\Repositories\SizeRepository;
use App\Models\Size;

class SizeService
{
    protected $repository;

    public function __construct(SizeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllSizes()
    {
        return $this->repository->getAll();
    }

    public function getSizeById($id)
    {
        return $this->repository->findById($id);
    }

    public function createSize(array $data)
    {
        return $this->repository->create($data);
    }

    public function updateSize($id, array $data)
    {
        $size = $this->repository->findById($id);
        if (!$size)
            return null;

        return $this->repository->update($size, $data);
    }

    public function deleteSize($id)
    {
        $size = $this->repository->findById($id);
        if (!$size)
            return null;

        return $this->repository->delete($size);
    }
}