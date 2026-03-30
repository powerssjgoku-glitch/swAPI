<?php

namespace App\Http\Controllers;

use App\Models\Deliverable;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DeliverableController extends Controller
{
    public function index(): JsonResponse
    {
        $deliverables = Deliverable::all();
        return response()->json($deliverables);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'project_id' => 'required|integer',
            'nombre' => 'required|string',
            'autores' => 'nullable|string',
            'descripcion' => 'nullable|string',
            'palabra_clave' => 'nullable|string',
            'archivo_path' => 'nullable|string',
            'url_descarga' => 'nullable|string',
            'tipo_documento' => 'nullable|string',
            'rama_asociada' => 'nullable|string',
            'fecha_publicacion' => 'nullable|date',
            'estado' => 'nullable|string',
            'submitted_by' => 'nullable|string',
            'submitted_at' => 'nullable|date',
        ]);

        $deliverable = Deliverable::create($request->all());
        return response()->json($deliverable, 201);
    }

    public function show(Deliverable $deliverable): JsonResponse
    {
        return response()->json($deliverable);
    }

    public function update(Request $request, Deliverable $deliverable): JsonResponse
    {
        $request->validate([
            'project_id' => 'sometimes|required|integer',
            'nombre' => 'sometimes|required|string',
            'autores' => 'nullable|string',
            'descripcion' => 'nullable|string',
            'palabra_clave' => 'nullable|string',
            'archivo_path' => 'nullable|string',
            'url_descarga' => 'nullable|string',
            'tipo_documento' => 'nullable|string',
            'rama_asociada' => 'nullable|string',
            'fecha_publicacion' => 'nullable|date',
            'estado' => 'nullable|string',
            'submitted_by' => 'nullable|string',
            'submitted_at' => 'nullable|date',
        ]);

        $deliverable->update($request->all());
        return response()->json($deliverable);
    }

    public function destroy(Deliverable $deliverable): JsonResponse
    {
        $deliverable->delete();
        return response()->json(['message' => 'Deliverable deleted successfully']);
    }
}
