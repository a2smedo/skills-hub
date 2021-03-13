<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
      $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:5|max:255|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $studentRole = Role::where('name', 'student')->first();
        $user = User::create([
            'name' => $request->name,
            'email' =>  $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $studentRole->id,
        ]);

        $token = $user->createToken('auth_token');

        return ['token' => $token->plainTextToken];


    }


    /*
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:5|max:255',
            // 'device_name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'email' => ['The provided credentials are incorrect.'],
            ], 404);
        }

        $token = $user->createToken('token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

       // return ['token' => $token->plainTextToken];
        return response($response , 201);


    }
    */
    public function login(Request $request)
    {

        try {

            $request->validate([
                'email' => 'required|email|max:255',
                'password' => 'required|string|min:5|max:255',
            ]);

            $credentials = request(['email','password']);

            if (! Auth::attempt($credentials) ) {
                return response()->json([
                    'status_code' => 422,
                    'message' =>  'not login',
                ]);
            }

            $user = User::where('email', $request->email)->first();

            if (! Hash::check($request->password, $user->password, []) ) {
                return response()->json([
                    'status_code' => 422,
                    'message' =>  'Password is not Match',
                ]);
            }

            $token = $user->createToken('token')->plainTextToken;
            return response()->json([
                'status_code' => 200,
                'message' => '',
                'user' => $user,
                'token' => $token
            ]);


        } catch (Exception $e) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error in login',
                'error' => $e
            ]);

        }
    }


    public function logout()
    {
       Auth::user()->tokens()->delete();
    }


}
