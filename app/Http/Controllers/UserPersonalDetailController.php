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

/**
 * Get the authenticated user's personal details
 */
public function getCurrentUserDetails(Request $request)
{
    $user = $request->user();
    $personalDetail = $user->personalDetails;
    
    if (!$personalDetail) {
        return response()->json([
            'message' => 'No personal details found'
        ], 404);
    }
    
    return response()->json($personalDetail);
}

/**
 * Store personal details for the authenticated user
 */
public function storeCurrentUserDetails(Request $request)
{
    $user = $request->user();
    
    // Check if user already has personal details
    if ($user->personalDetails) {
        return response()->json([
            'message' => 'Personal details already exist. Use update instead.'
        ], 422);
    }
    
    $validatedData = $request->validate([
        'profile_picture' => 'nullable|string',
        'age' => 'required|integer|min:1|max:120',
        'gender' => 'required|in:male,female,other',
        'weight' => 'required|numeric|min:1|max:500',
        'height' => 'required|numeric|min:1|max:300',
    ]);
    
    $validatedData['user_id'] = $user->id;
    
    $personalDetail = UserPersonalDetail::createUserPersonalDetail($validatedData);
    
    return response()->json($personalDetail, 201);
}

/**
 * Update the authenticated user's personal details
 */
public function updateCurrentUserDetails(Request $request)
{
    $user = $request->user();
    $personalDetail = $user->personalDetails;
    
    if (!$personalDetail) {
        return response()->json([
            'message' => 'No personal details found. Create them first.'
        ], 404);
    }
    
    $validatedData = $request->validate([
        'profile_picture' => 'nullable|string',
        'age' => 'nullable|integer|min:1|max:120',
        'gender' => 'nullable|in:male,female,other',
        'weight' => 'nullable|numeric|min:1|max:500',
        'height' => 'nullable|numeric|min:1|max:300',
    ]);
    
    $personalDetail = UserPersonalDetail::updateUserPersonalDetail($personalDetail->id, $validatedData);
    
    return response()->json($personalDetail);
}

/**
 * Get the authenticated user's BMI
 */
public function getCurrentUserBMI(Request $request)
{
    $user = $request->user();
    
    return $this->getUserBMI($user->id);
}

}