<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\UserService; 
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;  

class UserController extends Controller
{
    use AuthorizesRequests;   
    private UserService $_userService;

    public function __construct(UserService $userService) {
        $this->_userService = $userService;
    }

    public function index() {
        $this->authorize('view user');
        try {
            $users = $this->_userService->getAll();
            return UserResource::collection($users);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request) {
        $this->authorize('create user');
        try {
            $user = $this->_userService->create($request);
            return new UserResource($user);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id) {
        $this->authorize('view user');
        try {
            $user = $this->_userService->getById($id);
            return new UserResource($user);
        } catch (\Exception $e) {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    public function update(Request $request, $id) {
        $this->authorize('update user');
        try {
            $user = $this->_userService->update($request, $id);
            return new UserResource($user);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id) {
        $this->authorize('delete user');
        try {
            $this->_userService->delete($id);
            return response()->json(['message' => 'User deleted successfully'], 204);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}