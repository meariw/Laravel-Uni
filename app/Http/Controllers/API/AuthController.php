<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Валидация и сохранение пользователя
    public function registration(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'min:2', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        User::create($validated); // пароль хешируется кастом 'hashed' в модели

        return response()->json([
            'message' => 'Регистрация прошла успешно. Войдите в систему.',
        ], 201);
    }

    // Аутентификация и выдача токена
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'errors' => ['email' => 'Неверный email или пароль.'],
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['token' => $token]);
    }

    // Выход
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Вы вышли из системы']);
    }
}