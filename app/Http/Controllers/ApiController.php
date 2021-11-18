<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Passport\HasApiTokens;


class ApiController extends Controller
{

    /**
     * @OA\Post(
     *      path="/api/register",
     *      operationId="getProjectById",
     *      tags={"Register"},
     *      summary="Get project information",
     *      description="Returns project data",
     *
     *  @OA\Parameter(
     *          name="name",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *
     *    @OA\Parameter(
     *          name="birth_date",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *
     *  @OA\Parameter(
     *          name="gender",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *
     *  @OA\Parameter(
     *          name="avatar",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *
     *  @OA\Parameter(
     *          name="email",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *
     *
     *  @OA\Parameter(
     *          name="password",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *
     *
     *
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
     *         {
     *             "oauth2_security_example": {"write:projects", "read:projects"}
     *         }
     *     },
     * )
     */



    public function register(Request $request)
    {

        if (Patient::where('phone', $request->phone)->exists()) {

            return response()->json([
                'success' => false,
                'message' => 'User Already Registered',
            ], 200);
        }

        $user = new Patient();
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->birth_date = $request->birth_date;
        $user->avatar = $request->avatar;
        $user->gender = $request->gender;
        $user->save();




        return response()->json([
            'success' => true,
            'message' => 'User Registered Successfully',
            'token' => $user->createToken('tokens')->plainTextToken
        ], 200);
    }


    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('phone', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public static function index()
    {
        return 'hello world';
    }
}
