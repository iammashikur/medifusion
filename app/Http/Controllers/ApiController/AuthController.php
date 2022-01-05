<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(Request $request)
    {

        if (Patient::where('phone', $request->phone)->exists()) {

            return response()->json([
                'success' => false,
                'message' => 'User Already Registered',
            ], 200);
        }

        if (!$request->hasFile('avatar')) {
            return response()->json([
                'success' => false,
                'message' => 'Profile Picture Required!',
            ], 200);
        }

        $user = new Patient();
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->birth_date = $request->birth_date;
        $imagePath         = MakeImage($request, 'avatar', public_path('/uploads/images/'));
        /** Save request data to db */
        $user->avatar      = $imagePath;
        $user->gender = $request->gender;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Successfully registered ',
            'token' => $user->createToken('tokens')->plainTextToken,
            'user_data' => $user,
        ], 200);
    }


    public function login(Request $request)
    {

        $user = Patient::where('phone', $request->phone)->first();
        if (@Hash::check($request->password, $user->password)) {

            $user->tokens()->where('tokenable_id', $user->id)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Successfully logged in!',
                'token' => $user->createToken('tokens')->plainTextToken,
                'user_data' => $user,
            ], 200);
        }

        return response()->json([
            'message' => 'Invalid login details'
        ], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'success' => true,
            'message' => 'Successfully logged out!',
        ], 200);
    }

    public static function fallback()
    {
        return response()->json([
            'success' => false,
            'message' => 'Invalid Request!'
        ], 404);
    }
}
