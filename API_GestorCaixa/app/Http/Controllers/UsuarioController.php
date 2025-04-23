<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use Illuminate\Http\Request;
use App\Models\Usuario;


class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::all();
        return response()->json($usuarios);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUsuarioRequest $request)
    {
        $dados = $request->validated();
        $novoUsuario = new Usuario();
        
        $novoUsuario->nome = $dados['nome'];
        $novoUsuario->email = $dados['email'];
        $novoUsuario->password = $dados['password'];
               
        $novoUsuario->save();

        return response()->json([
            'status' => 'sucesso',
            'data' => $novoUsuario
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $usuario = Usuario::find($request->id);
        if(!$usuario){
            return response()->json([
                'status' => 'erro',
                'data' => 'Usuario não encontrado'
            ]);
        }
        return response()->json([
            'status' => 'sucesso',
            'data' => $usuario
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsuarioRequest $request)
    {
        $dados = $request->validated();
        $usuario = Usuario::find($dados['id']);
        if(!$usuario){
            return response()->json([
                'status' => 'erro',
                'data' => 'Usuario não encontrado'
            ]);
        }
        $usuario->nome = $dados['nome'];
        $usuario->email = $dados['email'];
        $usuario->password = $dados['password'];
        $usuario->save();

        return response()->json([
            'status' => 'sucesso',
            'data' => $usuario
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $usuario = Usuario::find($request->id);
        if(!$usuario){
            return response()->json([
                'status' => 'erro',
                'data' => 'Usuario não encontrado'
            ]);
        }
        $usuario->delete();
        return response()->json([
            'status' => 'sucesso',
            'mensagem' => 'Usuário removido com sucesso'
        ]);

    }
}
