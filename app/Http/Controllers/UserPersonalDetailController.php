<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserPersonalDetail;
use App\Models\User;

class UserPersonalDetailController extends Controller
{
public function index()
{
    $userPersonalDetails = UserPersonalDetail::all();
    return response()->json($userPersonalDetails);
}

public function show($id)
{
    $userPersonalDetail = UserPersonalDetail::find($id);

    if (!$userPersonalDetail) {
        return response()->json(['message' => 'User personal detail not found'], 404);
    }

    return response()->json($userPersonalDetail);
}

public function store(Request $request)
{
    $validatedData = $request->validate([
        'user_id' => 'required|exists:users,id',
        'address' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
        'dob' => 'required|date',
    ]);

    $userPersonalDetail = UserPersonalDetail::create($validatedData);

    return response()->json($userPersonalDetail, 201);
}

public function update(Request $request, $id)
{
    $userPersonalDetail = UserPersonalDetail::find($id);

    if (!$userPersonalDetail) {
        return response()->json(['message' => 'User personal detail not found'], 404);
    }

    $validatedData = $request->validate([
        'address' => 'sometimes|string|max:255',
        'phone' => 'sometimes|string|max:15',
        'dob' => 'sometimes|date',
    ]);

    $userPersonalDetail->update($validatedData);

    return response()->json($userPersonalDetail);
}

public function destroy($id)
{
    $userPersonalDetail = UserPersonalDetail::find($id);

    if (!$userPersonalDetail) {
        return response()->json(['message' => 'User personal detail not found'], 404);
    }

    $userPersonalDetail->delete();

    return response()->json(['message' => 'User personal detail deleted successfully']);
}
public function getUserPersonalDetailByUserId($userId)
{
    $user = User::find($userId);

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    $userPersonalDetail = $user->personalDetails;

    if (!$userPersonalDetail) {
        return response()->json(['message' => 'User personal detail not found'], 404);
    }

    return response()->json($userPersonalDetail);
}

//--------------------------Additional Methods--------------------------//

// get user BMI
public function getUserBMI($userId)
{
    $userPersonalDetail = UserPersonalDetail::where('user_id', $userId)->first();

    if (!$userPersonalDetail) {
        return response()->json(['message' => 'User personal detail not found'], 404);
    }

    $weight = $userPersonalDetail->weight;
    $height = $userPersonalDetail->height;

    if ($height == 0) {
        return response()->json(['message' => 'Height cannot be zero'], 400);
    }

    $bmi = $weight / ($height * $height);

    return response()->json(['bmi' => $bmi]);

}

}