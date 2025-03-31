<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    // Método para exibir o formulário de cadastro
    public function create()
    {
        return view('usuario.cadastro');
    }

    // Método para processar o cadastro
    public function store(Request $request)
    {
        // Validar os dados do formulário
        $request->validate([
            'nomeUsuario' => 'required|string|max:100',
            'dataNasc' => 'required|date',
            'cpfUsuario' => 'required|string|max:15',
            'rgUsuario' => 'nullable|string|max:15',
            'emailUsuario' => 'required|email|max:100',
            'senhaUsuario' => 'required|string|min:6',
            'logradouroUsuario' => 'required|string|max:255',
            'numeroUsuario' => 'required|string|max:10',
            'bairroUsuario' => 'required|string|max:100',
            'cidadeUsuario' => 'required|string|max:100',
            'estadoUsuario' => 'required|string|max:2',
            'cepUsuario' => 'required|string|max:9',
        ]);

        // Criar o novo usuário no banco de dados
        Usuario::create([
            'nomeUsuario' => $request->nomeUsuario,
            'dataNasc' => $request->dataNasc,
            'cpfUsuario' => $request->cpfUsuario,
            'rgUsuario' => $request->rgUsuario,
            'emailUsuario' => $request->emailUsuario,
            'senhaUsuario' => bcrypt($request->senhaUsuario), // Hash da senha
            'logradouroUsuario' => $request->logradouroUsuario,
            'numeroUsuario' => $request->numeroUsuario,
            'complementoUsuario' => $request->complementoUsuario,
            'bairroUsuario' => $request->bairroUsuario,
            'cidadeUsuario' => $request->cidadeUsuario,
            'estadoUsuario' => $request->estadoUsuario,
            'cepUsuario' => $request->cepUsuario,
        ]);

        // Redirecionar para uma página de sucesso ou para o login
        return redirect()->route('usuario.create')->with('success', 'Usuário cadastrado com sucesso!');
    }
}
