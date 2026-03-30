<?php

namespace App\Http\Controllers;

use App\Models\EntregaEstudiante;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EntregaEstudianteController extends Controller
{
    public function index(): JsonResponse
    {
        $entregas = EntregaEstudiante::all();
        return response()->json($entregas);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'entregable_id' => 'required|integer',
            'user_id' => 'required|string',
            'project_id' => 'required|integer',
            'nombre_archivo' => 'required|string',
            'ruta_archivo' => 'required|string',
            'fecha_entrega' => 'required|date',
            'calificacion' => 'nullable|numeric|min:0|max:10',
            'comentarios_docente' => 'nullable|string',
        ]);

        $entrega = EntregaEstudiante::create($request->all());
        return response()->json($entrega, 201);
    }

    public function show(EntregaEstudiante $entregaEstudiante): JsonResponse
    {
        return response()->json($entregaEstudiante);
    }

    public function update(Request $request, EntregaEstudiante $entregaEstudiante): JsonResponse
    {
        $request->validate([
            'entregable_id' => 'sometimes|required|integer',
            'user_id' => 'sometimes|required|string',
            'project_id' => 'sometimes|required|integer',
            'nombre_archivo' => 'sometimes|required|string',
            'ruta_archivo' => 'sometimes|required|string',
            'fecha_entrega' => 'sometimes|required|date',
            'calificacion' => 'nullable|numeric|min:0|max:10',
            'comentarios_docente' => 'nullable|string',
        ]);

        $entregaEstudiante->update($request->all());
        return response()->json($entregaEstudiante);
    }

    public function destroy(EntregaEstudiante $entregaEstudiante): JsonResponse
    {
        $entregaEstudiante->delete();
        return response()->json(['message' => 'EntregaEstudiante deleted successfully']);
    }
}
