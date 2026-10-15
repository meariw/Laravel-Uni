<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Форма регистрации
    public function create()
    {
        return view('auth.register');
    }

    // Валидация и сохранение пользователя
    public function registration(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'min:2', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        User::create($validated); // пароль хешируется кастом 'hashed' в модели

        return redirect()->route('login')
            ->with('success', 'Регистрация прошла успешно. Войдите в систему.');
    }

    // Форма авторизации
    public function login()
    {
        return view('auth.login');
    }

    // Аутентификация и выдача токена
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt($credentials)) {
            return back()
                ->withErrors(['email' => 'Неверный email или пароль.'])
                ->onlyInput('email');
        }

        $token = $request->user()->createToken('auth_token')->plainTextToken;
        $request->session()->put('api_token', $token);

        return redirect()->route('home');
    }

    // Выход
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}