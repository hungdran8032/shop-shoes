<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryService
{
    protected $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function getById($id)
    {
        $category = $this->repository->findById($id);
        if (!$category) {
            throw new ModelNotFoundException("Không tìm thấy danh mục");
        }
        return $category;
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update($id, array $data)
    {
        $category = $this->getById($id);
        return $this->repository->update($category, $data);
    }

    public function delete($id)
    {
        $category = $this->getById($id);
        return $this->repository->delete($category);
    }
}
