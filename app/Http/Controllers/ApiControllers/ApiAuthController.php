<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Passport\HasApiTokens;

class ApiAuthController extends Controller
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
            'message' => 'Successfully registered ',
            'token' => $user->createToken('tokens')->plainTextToken
        ], 200);
    }


    public function login(Request $request)
    {


        $user = Patient::where('phone', $request->phone)->first();
        if (Hash::check($request->password, $user->password)) {

            $user->tokens()->where('tokenable_id', $user->id)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Successfully logged in!',
                'token' => $user->createToken('tokens')->plainTextToken
            ], 200);
        }

        return response()->json([
            'message' => 'Invalid login details'
        ], 401);
    }

    public static function profile()
    {
        return 'hello world';
    }
}
