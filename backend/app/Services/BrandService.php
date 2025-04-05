<?php
namespace App\Services;

use App\Repositories\BrandRepository;
use Exception;

class BrandService
{
    protected $brandRepository;

    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function getAllBrands()
    {
        return $this->brandRepository->all();
    }

    public function getBrandById($id)
    {
        $brand = $this->brandRepository->find($id);
        if (!$brand) {
            throw new Exception('Không tìm thấy thương hiệu', 404);
        }
        return $brand;
    }

    public function createBrand(array $data)
    {
        return $this->brandRepository->create($data);
    }

    public function updateBrand($id, array $data)
    {
        $brand = $this->brandRepository->update($id, $data);
        if (!$brand) {
            throw new Exception('Không tìm thấy thương hiệu', 404);
        }
        return $brand;
    }

    public function deleteBrand($id)
    {
        $deleted = $this->brandRepository->delete($id);
        if (!$deleted) {
            throw new Exception('Không tìm thấy thương hiệu', 404);
        }
        return true;
    }
}