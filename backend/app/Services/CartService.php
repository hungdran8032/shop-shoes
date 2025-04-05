<?php

namespace App\Services;

use App\Repositories\CartRepository;

class CartService
{
    protected $cartRepo;

    public function __construct(CartRepository $cartRepo)
    {
        $this->cartRepo = $cartRepo;
    }

    public function getAll()
    {
        return $this->cartRepo->getAll();
    }

    public function getById($id)
    {
        return $this->cartRepo->findById($id);
    }

    public function create(array $data)
    {
        return $this->cartRepo->create($data);
    }

    public function update($id, array $data)
    {
        return $this->cartRepo->update($id, $data);
    }

    public function delete($id)
    {
        return $this->cartRepo->delete($id);
    }
}
