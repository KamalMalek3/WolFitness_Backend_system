<?php

namespace App\Http\Controllers;

use App\Models\UserPersonalDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDetailController extends Controller
{
    public function index()
    {
        $details = UserPersonalDetail::where('user_id', Auth::id())->get();
        return response()->json($details, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'profile_picture' => 'nullable|string',
            'age'             => 'nullable|integer',
            'gender'          => 'nullable|string',
            'weight'          => 'nullable|numeric',
            'height'          => 'nullable|numeric',
        ]);

        $data = array_merge($validated, ['user_id' => Auth::id()]);
        $detail = UserPersonalDetail::createUserPersonalDetail($data);

        return response()->json([
            'message' => 'Personal detail created',
            'data'    => $detail
        ], 201);
    }

    public function show($id)
    {
        $detail = UserPersonalDetail::getUserPersonalDetailById($id);
        if (!$detail || $detail->user_id !== Auth::id()) {
            return response()->json(['message' => 'Not found'], 404);
        }
        return response()->json($detail, 200);
    }

    public function update(Request $request, $id)
    {
        $detail = UserPersonalDetail::getUserPersonalDetailById($id);
        if (!$detail || $detail->user_id !== Auth::id()) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $validated = $request->validate([
            'profile_picture' => 'nullable|string',
            'age'             => 'nullable|integer',
            'gender'          => 'nullable|string',
            'weight'          => 'nullable|numeric',
            'height'          => 'nullable|numeric',
        ]);

        $updated = UserPersonalDetail::updateUserPersonalDetail($id, $validated);

        return response()->json([
            'message' => 'Personal detail updated',
            'data'    => $updated
        ], 200);
    }

    public function destroy($id)
    {
        $detail = UserPersonalDetail::getUserPersonalDetailById($id);
        if (!$detail || $detail->user_id !== Auth::id()) {
            return response()->json(['message' => 'Not found'], 404);
        }

        UserPersonalDetail::deleteUserPersonalDetail($id);
        return response()->json(['message' => 'Personal detail deleted'], 200);
    }
}