<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $users = User::all();
        return response()->json($users);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'id' => 'required|string|unique:users',
            'nombres' => 'required|string',
            'apa' => 'required|string',
            'ama' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'curp' => 'nullable|string',
            'direccion' => 'nullable|string',
            'telefonos' => 'nullable|string',
            'perfil_id' => 'required|integer|in:1,2,3',
            'activo' => 'boolean',
        ]);

        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    public function show(User $user): JsonResponse
    {
        return response()->json($user);
    }

    public function update(Request $request, User $user): JsonResponse
    {
        $request->validate([
            'nombres' => 'sometimes|required|string',
            'apa' => 'sometimes|required|string',
            'ama' => 'sometimes|required|string',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|string|min:8',
            'curp' => 'nullable|string',
            'direccion' => 'nullable|string',
            'telefonos' => 'nullable|string',
            'perfil_id' => 'sometimes|required|integer|in:1,2,3',
            'activo' => 'boolean',
        ]);

        $user->update($request->all());
        return response()->json($user);
    }

    public function destroy(User $user): JsonResponse
    {
        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }
}
