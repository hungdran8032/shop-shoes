<?php

namespace App\Services;

use App\Repositories\BrandRepository;
use Illuminate\Support\Facades\Log;

class BrandService
{
    protected $brandRepo;

    public function __construct(BrandRepository $brandRepo)
    {
        $this->brandRepo = $brandRepo;
    }

    public function getAllBrands()
    {
        return $this->brandRepo->getAll();
    }

    public function getBrandById($id)
    {
        return $this->brandRepo->findById($id);
    }

    public function createBrand(array $data)
    {
        return $this->brandRepo->create($data);
    }

    public function updateBrand($id, array $data)
    {
        $brand = $this->brandRepo->findById($id);
        if (!$brand) {
            return null;
        }
        return $this->brandRepo->update($brand, $data);
    }

    public function deleteBrand($id)
    {
        $brand = $this->brandRepo->findById($id);
        if (!$brand) {
            return false;
        }
        return $this->brandRepo->delete($brand);
    }
}
