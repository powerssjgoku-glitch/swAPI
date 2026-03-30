<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AsignaturaController extends Controller
{
    public function index(): JsonResponse
    {
        $asignaturas = Asignatura::all();
        return response()->json($asignaturas);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'clave' => 'required|string|unique:asignaturas',
            'nombre' => 'required|string',
        ]);

        $asignatura = Asignatura::create($request->all());
        return response()->json($asignatura, 201);
    }

    public function show(Asignatura $asignatura): JsonResponse
    {
        return response()->json($asignatura);
    }

    public function update(Request $request, Asignatura $asignatura): JsonResponse
    {
        $request->validate([
            'clave' => 'sometimes|required|string|unique:asignaturas,clave,' . $asignatura->id,
            'nombre' => 'sometimes|required|string',
        ]);

        $asignatura->update($request->all());
        return response()->json($asignatura);
    }

    public function destroy(Asignatura $asignatura): JsonResponse
    {
        $asignatura->delete();
        return response()->json(['message' => 'Asignatura deleted successfully']);
    }
}
