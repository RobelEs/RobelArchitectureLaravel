<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\RoleService;
use App\Http\Resources\RoleResource;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private RoleService $_roleService;

    public function __construct(RoleService $roleService) {
        $this->_roleService = $roleService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        try {
            $roles = $this->_roleService->getAll();
            return RoleResource::collection($roles);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        try {
            $role = $this->_roleService->create($request);
            return new RoleResource($role);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id) {
        try {
            $role = $this->_roleService->getById($id);
            return new RoleResource($role);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Role not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        try {
            $role = $this->_roleService->update($request, $id);
            return new RoleResource($role);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        try {
            
            $this->_roleService->destroy($id);
            return response()->json(['message' => 'Role deleted successfully'], 204);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
