<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProgress;


class UserProgressController extends Controller
{
    /**
     * Display a listing of the user progress.
     */
    public function index()
    {
        $progress = UserProgress::all();
        return response()->json($progress);
    }

    /**
     * Store a newly created user progress in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'progress_data' => 'required|string',
        ]);

        $progress = UserProgress::create($validatedData);
        return response()->json($progress, 201);
    }

    /**
     * Display the specified user progress.
     */
    public function show($id)
    {
        $progress = UserProgress::find($id);

        if (!$progress) {
            return response()->json(['message' => 'User progress not found'], 404);
        }

        return response()->json($progress);
    }

    /**
     * Update the specified user progress in storage.
     */
    public function update(Request $request, $id)
    {
        $progress = UserProgress::find($id);

        if (!$progress) {
            return response()->json(['message' => 'User progress not found'], 404);
        }

        $validatedData = $request->validate([
            'progress_data' => 'required|string',
        ]);

        $progress->update($validatedData);
        return response()->json($progress);
    }

    /**
     * Remove the specified user progress from storage.
     */
    public function destroy($id)
    {
        $progress = UserProgress::find($id);

        if (!$progress) {
            return response()->json(['message' => 'User progress not found'], 404);
        }

        $progress->delete();
        return response()->json(['message' => 'User progress deleted successfully']);
    }

    // Get progress by user ID
    public function getProgressByUserId($userId)
    {
        $progress = UserProgress::where('user_id', $userId)->get();

        if ($progress->isEmpty()) {
            return response()->json(['message' => 'No progress found for this user'], 404);
        }

        return response()->json($progress);
    }
}