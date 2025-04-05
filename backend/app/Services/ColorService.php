<?php

namespace App\Services;

use App\Repositories\ColorRepository;

class ColorService
{
    protected $colorRepository;

    public function __construct(ColorRepository $colorRepository)
    {
        $this->colorRepository = $colorRepository;
    }

    public function getAllColors()
    {
        return $this->colorRepository->getAll();
    }

    public function getColorById($id)
    {
        return $this->colorRepository->find($id);
    }

    public function createColor(array $data)
    {
        return $this->colorRepository->create($data);
    }

    public function updateColor($id, array $data)
    {
        return $this->colorRepository->update($id, $data);
    }

    public function deleteColor($id)
    {
        return $this->colorRepository->delete($id);
    }
}
