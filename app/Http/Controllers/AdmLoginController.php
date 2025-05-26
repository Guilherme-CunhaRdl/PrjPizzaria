<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class AdmLoginController extends Controller
{

    public function index()
    {
        return view('admin/loginAdmin');
    }

    public function login(Request $request){
        $validatedData= $request->validate([
            'email' => 'required|email',
            'senha' => 'required|min:6',
    
          ]);
          
        $admin = Admin::where('emailAdmin', $request->email)->first();
        if ($admin && Hash::check($request->senha, $admin->senhaAdmin)) {
            Auth::guard('admin')->login($admin);
            return redirect()->route('dashboardAdm'); 
        }

        return back()->withErrors(['email' => 'Email ou senha inválidos']);
    }
}
