<?php

namespace App\Repositories;

use App\Models\Brand;

class BrandRepository
{
    public function getAll()
    {
        return Brand::all();
    }

    public function findById($id)
    {
        return Brand::find($id);
    }

    public function create(array $data)
    {
        return Brand::create($data);
    }

    public function update(Brand $brand, array $data)
    {
        $brand->update($data);
        return $brand;
    }

    public function delete(Brand $brand)
    {
        return $brand->delete();
    }
}
