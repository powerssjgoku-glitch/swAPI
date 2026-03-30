<?php

namespace App\Http\Controllers;

use App\Models\DocumentTag;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DocumentTagController extends Controller
{
    public function index(): JsonResponse
    {
        $documentTags = DocumentTag::all();
        return response()->json($documentTags);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'nombre' => 'required|string|unique:document_tags',
            'descripcion' => 'nullable|string',
            'color' => 'nullable|string',
        ]);

        $documentTag = DocumentTag::create($request->all());
        return response()->json($documentTag, 201);
    }

    public function show(DocumentTag $documentTag): JsonResponse
    {
        return response()->json($documentTag);
    }

    public function update(Request $request, DocumentTag $documentTag): JsonResponse
    {
        $request->validate([
            'nombre' => 'sometimes|required|string|unique:document_tags,nombre,' . $documentTag->id,
            'descripcion' => 'nullable|string',
            'color' => 'nullable|string',
        ]);

        $documentTag->update($request->all());
        return response()->json($documentTag);
    }

    public function destroy(DocumentTag $documentTag): JsonResponse
    {
        $documentTag->delete();
        return response()->json(['message' => 'DocumentTag deleted successfully']);
    }
}
