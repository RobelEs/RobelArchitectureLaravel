<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Http\Request;

class UserService
{
    /**
     * Récupère tous les utilisateurs.
     */
    public function getAll()
    {
        return User::all();
    }

    /**
     * Récupère un utilisateur par son ID.
     */
    public function getById($id)
    {
        return User::findOrFail($id);
    }

    /**
     * Crée un nouvel utilisateur.
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        return User::create($validated);
    }

    /**
     * Met à jour un utilisateur existant.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $id,
            'password' => 'sometimes|required|string|min:8',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }

        $user->update($validated);

        return $user;
    }

    /**
     * Supprime un utilisateur.
     */
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }
}