<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request){

      $validatedData= $request->validate([
        'email' => 'required|email',
        'senha' => 'required|min:6',

      ]);

      $usuario = Usuario::where('emailUsuario', $request->email)->first();

      if ($usuario && Hash::check($request->senha, $usuario->senhaUsuario)) {
        Auth::guard('web')->login($usuario);
        return redirect()->route('home'); 
    }

    return back()->withErrors(['email' => 'Email ou senha inválidos']);
    }

    public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
}
}