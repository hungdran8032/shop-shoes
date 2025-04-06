<?php
namespace App\Services;

use App\Repositories\ImageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    protected $imageRepository;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    public function getAll()
    {
        return $this->imageRepository->getAll();
    }

    public function findById($id)
    {
        return $this->imageRepository->findById($id);
    }

    public function create(Request $request)
    {
        $data = $request->only(['productId']);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads/demo', 'public');
            $fileName = basename($path);
            $data['link'] = "uploads/demo/{$fileName}";
        } else {
            throw new \Exception('Image file is required');
        }

        return $this->imageRepository->create($data);
    }

    public function update($id, Request $request)
    {
        $data = $request->only(['productId']);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads/demo', 'public');
            $fileName = basename($path);
            $data['link'] = "uploads/demo/{$fileName}";
        }

        return $this->imageRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->imageRepository->delete($id);
    }
}