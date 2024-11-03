<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SocialLoginController extends Controller
{
    public function social_login(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [

                'email' => 'required',
                'type' => 'required'

            ],
            [
                'email.required' => trans('auth.email.register'),

            ]
        );
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 422);
        }
        $user = User::where('email', $request->email)->first();
        if($user) {
            $user->update([
                'sign_in_type' => $request->type,
                'device_token' => $request->device_token,
            ]);


            $token = auth()->guard('user-api')->login($user);


            return $this->respondWithToken($token);
        }
        else{
            $user = User::create([
                'email' => $request->email,
                'device_token' => $request->device_token,
                'sign_in_type' => $request->type,
            ]);

            $token = auth()->guard('user-api')->login($user);
            return $this->respondWithToken($token);
        }
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'status' => 200,
            'message' => trans('auth.login.success'),
            'user' => Auth::guard('user-api')->user(),
        ]);
    }
    //
}
