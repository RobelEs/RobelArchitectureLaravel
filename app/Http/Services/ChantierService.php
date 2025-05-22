<?php

namespace App\Http\Services;

use App\Models\Chantier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ChantierService {

    public function getChantiers() {

        try {
            $user = Auth::user();

            if($user->hasRole("admin")){
                return Chantier::all(); // Récupérer tous les chantiers
            }
            else{
                return $user->chantiers()->get();
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function storeChantier(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'address' => 'nullable|string',
                'start_date' => 'required|date',
                'end_date' => 'nullable|date|after:start_date',
                'client_id' => 'required|exists:users,id',
              //'client_id' => 'required',
              
            ]);

            if ($validator->fails()) {
                throw new HttpResponseException(
                    response()->json($validator->errors(), 422)
                );
            }

            $chantier = new Chantier();
            $chantier->name = $request->input('name');
            $chantier->address = $request->input('address');
            $chantier->start_date = $request->input('start_date');
            $chantier->end_date = $request->input('end_date');
            $chantier->client_id = $request->input('client_id');

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
    
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|max:255',
            'address' => 'nullable|string',
            'start_date' => 'sometimes|required|date',
            'end_date' => 'nullable|date|after:start_date',
            'client_id' => 'sometimes|required|exists:users,id',
        ]);
    
        if ($validator->fails()) {
            throw new HttpResponseException(
                response()->json($validator->errors(), 422)
            );
        }
    
        // On met à jour uniquement les champs attendus
        $chantier->update($request->only([
            'name',
            'address',
            'start_date',
            'end_date',
            'client_id'
        ]));
    
        return $chantier;
    }
    
    public function deleteChantier($id) {
        $chantier = Chantier::findOrFail($id);
        $chantier->delete();
    }
}

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// class RenameChantierColumns extends Migration
// {
//     public function up()
//     {
//         Schema::table('chantiers', function (Blueprint $table) {
//             $table->renameColumn('name', 'name');
//             $table->renameColumn('address', 'address');
//             $table->renameColumn('start_date', 'start_date');
//             $table->renameColumn('end_date', 'end_date');
//         });
//     }

//     public function down()
//     {
//         Schema::table('chantiers', function (Blueprint $table) {
//             $table->renameColumn('name', 'name');
//             $table->renameColumn('address', 'address');
//             $table->renameColumn('start_date', 'start_date');
//             $table->renameColumn('end_date', 'end_date');
//         });
//     }
// }
