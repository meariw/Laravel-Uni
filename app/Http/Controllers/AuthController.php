<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    // Отдаёт страницу с формой регистрации.
    public function create()
    {
        return view('auth.signin');
    }

    // Валидирует данные формы и возвращает их в виде JSON.
    public function registration(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'min:2', 'max:255'],
            'email'    => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        return response()->json([
            'status' => 'success',
            'data'   => $validated,
        ]);
    }
}