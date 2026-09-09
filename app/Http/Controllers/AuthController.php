<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    //Mostra a tela de login 
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Processa o cadastro de um novo usuário
    public function register(Request $request)
    {
        // 1. Valida os dados do formulário
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        // 2. Cria o usuário (a senha já é criptografada automaticamente pelo cast 'hashed' do Model)
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        // 3. Já loga o usuário automaticamente após criar a conta
        Auth::login($user);

        return redirect()->intended(route('produtos.index'));
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    //1. Processa o login
    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Tenta autenticar (Laravel compara o hash da senha por você)
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); //envita fixação de sessão (segurança)
            return redirect()->intended(route('produtos.index'));
        }

        // 3. Se falhar volta com erro 
        return back()->withErrors([
            'email' => 'Email ou senha inorretos.'
        ])->onlyInput('email');
    }
    //Logout 

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}