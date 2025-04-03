<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChantierRequest extends FormRequest
{
    public function authorize()
    {
        // Permet d'autoriser ou refuser la requête. Pour l'instant, on autorise tout.
        return true;
    }

    public function rules()
    {
        // Règles de validation des données entrantes
        return [
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
        ];
    }
}
