<?php

namespace App\Http\Services;

use App\Models\Chantier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ChantierService {

    public function getChantiers() {
        try {
            return Chantier::all(); // Récupérer tous les chantiers
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function storeChantier(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'location' => 'nullable',
                'start_date' => 'required|date',
                'end_date' => 'nullable|date|after:start_date',
            ]);

            if ($validator->fails()) {
                throw new HttpResponseException(
                    response()->json($validator->errors(), 422)
                );
            }

            $chantier = new Chantier();
            $chantier->name = $request->input('name');
            $chantier->location = $request->input('location');
            $chantier->start_date = $request->input('start_date');
            $chantier->end_date = $request->input('end_date');
            $chantier->save();

            return $chantier;

        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getChantierById($id) {
        return Chantier::findOrFail($id); // Récupérer un chantier par son ID
    }

    public function updateChantier(Request $request, $id) {
        $chantier = Chantier::findOrFail($id);
        $chantier->update($request->all());
        return $chantier;
    }

    public function deleteChantier($id) {
        $chantier = Chantier::findOrFail($id);
        $chantier->delete();
    }
}
