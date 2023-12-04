<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('apiLogin');
    }

    /**
     * Handle an incoming authentication request for API.
     */
    public function apiLogin(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            // $request->session()->regenerate();
            return response()->json([
                'status' => true,
                'message' => 'Login successful',
                'user' => Auth::guard('admin')->user()
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Invalid credentials'
        ], 401);
    }
}
