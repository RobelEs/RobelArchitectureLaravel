<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\UserService; 
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;


class UserController extends Controller
{
    private UserService $_userService;

    public function __construct(UserService $userService) {
        $this->_userService = $userService;
    }

    public function index() {
        try {
            $users = $this->_userService->getAll();
            return UserResource::collection($users);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request) {
        try {
            $user = $this->_userService->create($request);
            return new UserResource($user);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id) {
        try {
            $user = $this->_userService->getById($id);
            return new UserResource($user);
        } catch (\Exception $e) {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    public function update(Request $request, $id) {
        try {
            $user = $this->_userService->update($request, $id);
            return new UserResource($user);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id) {
        try {
            $this->_userService->delete($id);
            return response()->json(['message' => 'User deleted successfully'], 204);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}