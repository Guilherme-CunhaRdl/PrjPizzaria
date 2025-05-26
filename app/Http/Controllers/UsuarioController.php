<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

    public function perfil()
    {

        $usuario = auth()->user(); 

        return view('perfil', compact('usuario'));
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('home')->with('success', 'Logout realizado com sucesso!');
    }
    public function atualizarPerfil(Request $request)
    {
        try {
            $usuario = auth()->user();
    
            $validated = $request->validate([
                'nome' => 'required|string|max:100',
                'email' => 'required|email|unique:usuarios,emailUsuario,' . $usuario->id,
                'data_nascimento' => 'nullable|date',
                'cpf' => 'nullable|string|max:14',
                'cep' => 'nullable|string|max:9',
                'logradouro' => 'nullable|string|max:255',
                'numero' => 'nullable|string|max:10',
                'complemento' => 'nullable|string|max:100',
                'bairro' => 'nullable|string|max:100',
                'cidade' => 'nullable|string|max:100',
                'estado' => 'nullable|string|max:2'
            ]);
    
            $usuario->update([
                'nomeUsuario' => $validated['nome'],
                'emailUsuario' => $validated['email'],
                'dataNasc' => $validated['data_nascimento'] ?? null,
                'cpfUsuario' => $validated['cpf'] ?? null,
                'cepUsuario' => $validated['cep'] ?? null,
                'logradouroUsuario' => $validated['logradouro'] ?? null,
                'numeroUsuario' => $validated['numero'] ?? null,
                'complementoUsuario' => $validated['complemento'] ?? null,
                'bairroUsuario' => $validated['bairro'] ?? null,
                'cidadeUsuario' => $validated['cidade'] ?? null,
                'estadoUsuario' => $validated['estado'] ?? null,
            ]);
    
            return back()->with('success', 'Perfil atualizado com sucesso!');
        
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validação falhou — Laravel redireciona automaticamente com os erros
            return back()->withErrors($e->validator)->withInput();
        
        } catch (\Exception $e) {
            // Outro erro qualquer (ex: banco de dados, conexão etc.)
            return back()->with('error', 'Erro ao atualizar perfil: ' . $e->getMessage())->withInput();
        }
    }

public function atualizarFoto(Request $request)
{
    $request->validate([
        'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    if ($request->hasFile('foto')) {
        $usuario = auth()->user();
        
        // Remove foto antiga se existir
        if ($usuario->imgUsuario && Storage::exists('uploads/'.$usuario->imgUsuario)) {
            Storage::delete('uploads/'.$usuario->imgUsuario);
        }
        
        // Salva nova foto
        $nomeArquivo = time().'.'.$request->foto->extension();
        $request->foto->storeAs('uploads', $nomeArquivo);
        
        $usuario->imgUsuario = $nomeArquivo;
        $usuario->save();
    }

    return back();
}

public function alterarSenha(Request $request)
{
    $request->validate([
        'senha_atual' => 'required',
        'nova_senha' => 'required|min:8|confirmed'
    ]);

    $usuario = auth()->user();
    
    if (!Hash::check($request->senha_atual, $usuario->senhaUsuario)) {
        return back()->withErrors(['senha_atual' => 'Senha atual incorreta']);
    }

    $usuario->senhaUsuario = Hash::make($request->nova_senha);
    $usuario->save();

    return back()->with('success', 'Senha alterada com sucesso!');
}
}
