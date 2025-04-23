<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Login de um usuário e gerar um token.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $usuario = Usuario::where('email', $request->email)->first();

        if (!$usuario || !Hash::check($request->password, $usuario->password)) {
        return response()->json([
            'status' =>'error',
            'message' => 'Credenciais inválidas'
            ], 401);
        }

        // Gerar o token
        $token = $usuario->createToken('AppName')->plainTextToken;

        return response()->json([
            'status' =>'sucesso',
            'usuario' => $usuario,
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        //$request->user()->tokens()->delete(); // deleta todos os tokens
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logout realizado com sucesso']);
    }

}
