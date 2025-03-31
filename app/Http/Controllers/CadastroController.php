<?php
namespace App\Http\Controllers;


use App\Models\Usuario;
use Illuminate\Http\Request;

class CadastroController extends Controller
{
    public function index()
    {
        return view('nivelUsuario.cadastro');
    }

    public function FazerCadastro(Request $request)
    {
    
        $validatedData = $request->validate([
            'nome' => 'required|max:255',
            'email' => 'required|email|unique:usuarios,emailUsuario',
            'senha' => 'required|min:6|confirmed',
        ]);

        $user = new Usuario();
        $user->nomeUsuario = $validatedData['nome'];
        $user->emailUsuario = $validatedData['email'];
        $user->senhaUsuario = bcrypt($validatedData['senha']);
        $user->save();


        return redirect()->route('login');

    }
}
