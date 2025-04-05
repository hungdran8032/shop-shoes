<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->userService->getAll());
    }

    public function show($id): JsonResponse
    {
        return response()->json($this->userService->getById($id));
    }

    public function store(UserRequest $request): JsonResponse
    {
        return response()->json($this->userService->create($request->validated()));
    }

    public function update(UserRequest $request, $id): JsonResponse
    {
        return response()->json($this->userService->update($id, $request->validated()));
    }

    public function destroy($id): JsonResponse
    {
        return response()->json(['message' => 'Deleted successfully', 'result' => $this->userService->delete($id)]);
    }
}
