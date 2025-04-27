<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\ChantierService;
use App\Http\Resources\ChantierResource;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;       
use Spatie\Permission\Models\Permission;



class ChantierController extends Controller
{
    use AuthorizesRequests;
    private ChantierService $_chantierService;

    public function __construct(ChantierService $chantierService) {
        $this->_chantierService = $chantierService;
    }


    public function index() {
        $this->authorize('view chantier');
        try {
            $chantiers = $this->_chantierService->getChantiers();
            return ChantierResource::collection($chantiers);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request) {
        $this->authorize('create chantier');
        try {
            $chantier = $this->_chantierService->storeChantier($request);
            return new ChantierResource($chantier);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show(string $id) {
        $this->authorize('view chantier');
        try {
            $chantier = $this->_chantierService->getChantierById($id);
            return new ChantierResource($chantier);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Chantier not found'], 404);
        }
    }


    public function update(Request $request, string $id) {
        $this->authorize('update chantier');
        try {
            $chantier = $this->_chantierService->updateChantier($request, $id);
            return new ChantierResource($chantier);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function destroy(string $id) {
        $this->authorize('delete chantier');
        try {
            $this->_chantierService->deleteChantier($id);
            return response()->json(['message' => 'Chantier deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
            //
            //
        }
    }
}
