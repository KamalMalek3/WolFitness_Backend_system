<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserPersonalDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Register a new user with optional personal details
     */
    public function register(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            
            // Optional personal details
            'profile_picture' => 'nullable|string',
            'age' => 'nullable|integer|min:1|max:120',
            'gender' => 'nullable|in:male,female,other',
            'weight' => 'nullable|numeric|min:1|max:500',
            'height' => 'nullable|numeric|min:1|max:300',
        ]);

        // Create the user
        $userData = [
            'full_name' => $request->full_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
        
        $user = User::createUser($userData);
        
        // Create personal details if provided
        if ($request->has(['age', 'gender', 'weight', 'height']) || $request->has('profile_picture')) {
            $personalData = [
                'user_id' => $user->id,
                'profile_picture' => $request->profile_picture,
                'age' => $request->age,
                'gender' => $request->gender,
                'weight' => $request->weight,
                'height' => $request->height,
            ];
            
            // Filter out null values
            $personalData = array_filter($personalData, function ($value) {
                return $value !== null;
            });
            
            UserPersonalDetail::createUserPersonalDetail($personalData);
        }
        
        // Generate token for the new user
        $token = $user->createToken('auth_token')->plainTextToken;
        
        return response()->json([
            'message' => 'Registration successful',
            'user' => $user,
            'token' => $token
        ], 201);
    }

    /**
     * Login user and create token
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Delete previous tokens
        $user->tokens()->delete();
        
        // Create new token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token
        ]);
    }

    /**
     * Logout user (revoke token)
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
    
    /**
     * Get authenticated user profile
     */
    public function profile(Request $request)
    {
        $user = $request->user();
        $personalDetails = $user->personalDetails;
        
        return response()->json([
            'user' => $user,
            'personal_details' => $personalDetails
        ]);
    }
}