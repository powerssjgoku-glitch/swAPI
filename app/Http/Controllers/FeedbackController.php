<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FeedbackController extends Controller
{
    public function index(): JsonResponse
    {
        $feedbacks = Feedback::all();
        return response()->json($feedbacks);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'project_id' => 'required|integer',
            'author' => 'required|string',
            'comment' => 'required|string',
        ]);

        $feedback = Feedback::create($request->all());
        return response()->json($feedback, 201);
    }

    public function show(Feedback $feedback): JsonResponse
    {
        return response()->json($feedback);
    }

    public function update(Request $request, Feedback $feedback): JsonResponse
    {
        $request->validate([
            'project_id' => 'sometimes|required|integer',
            'author' => 'sometimes|required|string',
            'comment' => 'sometimes|required|string',
        ]);

        $feedback->update($request->all());
        return response()->json($feedback);
    }

    public function destroy(Feedback $feedback): JsonResponse
    {
        $feedback->delete();
        return response()->json(['message' => 'Feedback deleted successfully']);
    }
}
