<?php

namespace App\Http\Controllers;

use App\Models\Avance;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AvanceController extends Controller
{
    public function index(): JsonResponse
    {
        $avances = Avance::all();
        return response()->json($avances);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'project_id' => 'required|integer',
            'note' => 'required|string',
            'milestone_date' => 'required|date',
        ]);

        $avance = Avance::create($request->all());
        return response()->json($avance, 201);
    }

    public function show(Avance $avance): JsonResponse
    {
        return response()->json($avance);
    }

    public function update(Request $request, Avance $avance): JsonResponse
    {
        $request->validate([
            'project_id' => 'sometimes|required|integer',
            'note' => 'sometimes|required|string',
            'milestone_date' => 'sometimes|required|date',
        ]);

        $avance->update($request->all());
        return response()->json($avance);
    }

    public function destroy(Avance $avance): JsonResponse
    {
        $avance->delete();
        return response()->json(['message' => 'Avance deleted successfully']);
    }
}
