<?php

namespace App\Http\Controllers;

use App\Models\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PasswordResetController extends Controller
{
    public function index(): JsonResponse
    {
        $passwordResets = PasswordReset::all();
        return response()->json($passwordResets);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'user_id' => 'required|string',
            'token' => 'required|string|unique:password_resets',
            'expires_at' => 'required|date',
        ]);

        $passwordReset = PasswordReset::create($request->all());
        return response()->json($passwordReset, 201);
    }

    public function show(PasswordReset $passwordReset): JsonResponse
    {
        return response()->json($passwordReset);
    }

    public function update(Request $request, PasswordReset $passwordReset): JsonResponse
    {
        $request->validate([
            'user_id' => 'sometimes|required|string',
            'token' => 'sometimes|required|string|unique:password_resets,token,' . $passwordReset->id,
            'expires_at' => 'sometimes|required|date',
        ]);

        $passwordReset->update($request->all());
        return response()->json($passwordReset);
    }

    public function destroy(PasswordReset $passwordReset): JsonResponse
    {
        $passwordReset->delete();
        return response()->json(['message' => 'PasswordReset deleted successfully']);
    }
}
