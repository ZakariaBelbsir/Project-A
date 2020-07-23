<?php

namespace App\Http\Controllers;


use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @var bool
     */
    public $loginAfterSignUp = true;

    /**
     * @param Request $request
     * @return JsonResponse
     */

    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $token = null;

        if (!$token = \JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Email ou mot de passe invalide.',
            ], 401);
        }

        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => auth()->user(),
        ]);
    }

    /**
     * @param RegistrationFormRequest $request
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:10|confirmed'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        if ($this->loginAfterSignUp) {
            return $this->login($request);
        }

        return response()->json([
            'success'   =>  true,
            'data'      =>  $user
        ], 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }
}
