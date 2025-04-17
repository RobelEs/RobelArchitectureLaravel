<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {
        try {
            DB::beginTransaction();

            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                $success['token'] = $user->createToken('app')->plainTextToken;
                $success['user'] = $user; 

                DB::commit();
                return response()->json($success, 200);
            }

            return response()->json(['error' => 'Invalid credentials'], 401);
        } catch (\Exception $e) {
            DB::rollBack();
            
            if(app()->isLocal()) {
                return response()->json(['error' => $e->getMessage()], 500);
            } else {
                return response()->json(['error' => 'An error occurred'], 500);
            }
        }
    }

    public function register(Request $request) {
        // Logique d'inscription
    }

    public function logout() {
        try {
            DB::beginTransaction();

            $user = Auth::user();
            $user->tokens()->delete(); // Révoquer tous les tokens de l'utilisateur
            DB::commit();

            return response()->json(['message' => 'Successfully logged out'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            
            if(app()->isLocal()) {
                return response()->json(['error' => $e->getMessage()], 500);
            } else {
                return response()->json(['error' => 'An error occurred'], 500);
            }
        }
    }
}