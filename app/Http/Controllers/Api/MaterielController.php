<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\MaterielService;
use App\Http\Resources\MaterielResource;
use Illuminate\Http\Request;

class MaterielController extends Controller
{
    private MaterielService $_materielService;

    public function __construct(MaterielService $materielService) {
        $this->_materielService = $materielService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        try {
            $materiels = $this->_materielService->getMateriels();
            return MaterielResource::collection($materiels);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        try {
            $materiel = $this->_materielService->storeMateriel($request);
            return new MaterielResource($materiel);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        try {
            $materiel = $this->_materielService->getMaterielById($id);
            return new MaterielResource($materiel);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Materiel not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        try {
            $materiel = $this->_materielService->updateMateriel($request, $id);
            return new MaterielResource($materiel);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        try {
            $this->_materielService->deleteMateriel($id);
            return response()->json(['message' => 'Materiel deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}