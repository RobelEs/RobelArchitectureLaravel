<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\ChantierService;
use App\Http\Resources\ChantierResource;
use Illuminate\Http\Request;

class ChantierController extends Controller
{
    private ChantierService $_chantierService;

    public function __construct(ChantierService $chantierService) {
        $this->_chantierService = $chantierService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        try {
            $chantiers = $this->_chantierService->getChantiers();
            return ChantierResource::collection($chantiers);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        try {
            $chantier = $this->_chantierService->storeChantier($request);
            return new ChantierResource($chantier);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        try {
            $chantier = $this->_chantierService->getChantierById($id);
            return new ChantierResource($chantier);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Chantier not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        try {
            $chantier = $this->_chantierService->updateChantier($request, $id);
            return new ChantierResource($chantier);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        try {
            $this->_chantierService->deleteChantier($id);
            return response()->json(['message' => 'Chantier deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
