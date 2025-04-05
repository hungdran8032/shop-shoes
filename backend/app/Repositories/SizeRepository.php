<?php
namespace App\Repositories;

use App\Models\Size;

class SizeRepository
{
    public function getAll()
    {
        return Size::all();
    }

    public function findById($id)
    {
        return Size::find($id);
    }

    public function create(array $data)
    {
        return Size::create($data);
    }

    public function update(Size $size, array $data)
    {
        $size->update($data);
        return $size;
    }

    public function delete(Size $size)
    {
        return $size->delete();
    }
}