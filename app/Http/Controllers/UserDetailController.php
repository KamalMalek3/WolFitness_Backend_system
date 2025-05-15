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
        $detail = UserPersonalDetail::getUserPersonalDetailsByUserId($id)->first();
        if (!$detail || $detail->user_id !== Auth::id()) {
            return response()->json(['message' => 'Not found'], 404);
        }
        return response()->json($detail, 200);
    }

    public function update(Request $request, $id)
    {
        $detail = UserPersonalDetail::getUserPersonalDetailsByUserId($id)->first();
        
        if (!$detail || $detail->user_id !== Auth::id()) {
            
            // log details and auth id for debugging
            return response()->json(['message' => 'Not found!'], 404);
        }
        
        $validated = $request->validate([
            'profile_picture' => 'nullable|string',
            'age'             => 'nullable|integer',
            'gender'          => 'nullable|string',
            'weight'          => 'nullable|numeric',
            'height'          => 'nullable|numeric',
        ]);

        

        $updated = UserPersonalDetail::updateUserPersonalDetail($detail->id, $validated);

        return response()->json([
            'message' => 'Personal detail updated',
            'data'    => $updated
        ], 200);
    }

    public function destroy($id)
    {
        $detail = UserPersonalDetail::getUserPersonalDetailsByUserId($id)->first();
        if (!$detail || $detail->user_id !== Auth::id()) {
            return response()->json(['message' => 'Not found'], 404);
        }

        UserPersonalDetail::deleteUserPersonalDetail($detail->id);
        return response()->json(['message' => 'Personal detail deleted'], 200);
    }

    //get user bmi
    public function getCurrentUserBMI()
    {
        $user = Auth::user();
        $detail = UserPersonalDetail::where('user_id', $user->id)->first();

        if (!$detail) {
            return response()->json(['message' => 'User personal detail not found'], 404);
        }

        $weight = $detail->weight;
        $height = $detail->height;

        if ($weight && $height) {
            $bmi = $weight / (($height / 100) ** 2);
            return response()->json(['bmi' => round($bmi, 2)], 200);
        }

        return response()->json(['message' => 'Weight or height not set'], 400);
    }
}