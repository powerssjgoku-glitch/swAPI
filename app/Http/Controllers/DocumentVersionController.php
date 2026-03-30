<?php

namespace App\Http\Controllers;

use App\Models\DocumentVersion;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DocumentVersionController extends Controller
{
    public function index(): JsonResponse
    {
        $documentVersions = DocumentVersion::all();
        return response()->json($documentVersions);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'entregable_id' => 'required|integer',
            'version_number' => 'required|integer',
            'archivo_path' => 'required|string',
            'cambios' => 'nullable|string',
            'uploaded_by' => 'nullable|string',
        ]);

        $documentVersion = DocumentVersion::create($request->all());
        return response()->json($documentVersion, 201);
    }

    public function show(DocumentVersion $documentVersion): JsonResponse
    {
        return response()->json($documentVersion);
    }

    public function update(Request $request, DocumentVersion $documentVersion): JsonResponse
    {
        $request->validate([
            'entregable_id' => 'sometimes|required|integer',
            'version_number' => 'sometimes|required|integer',
            'archivo_path' => 'sometimes|required|string',
            'cambios' => 'nullable|string',
            'uploaded_by' => 'nullable|string',
        ]);

        $documentVersion->update($request->all());
        return response()->json($documentVersion);
    }

    public function destroy(DocumentVersion $documentVersion): JsonResponse
    {
        $documentVersion->delete();
        return response()->json(['message' => 'DocumentVersion deleted successfully']);
    }
}
