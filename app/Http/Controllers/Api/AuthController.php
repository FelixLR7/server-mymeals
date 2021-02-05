<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{User, SocialAccount};
use Auth;
use Validator;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'name'     => 'required|string',
            // 'email'    => 'required|string|email|unique:users',
            // 'password' => 'required|string|confirmed',
            'token'    => 'required|string',
            'provider' => 'required|string'
        ]);
   
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        

        $user = new User([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->save();
        

        $socialAccount = new SocialAccount([
            'token'         => $request->token,
            'provider_id'   => $request->provider
        ]);

        $user->socialaccounts()->save($socialAccount);

        return response()->json([
            'message' => __('api.user_succesfully_created')], 201);
    }
    
    public function login(Request $request)
    {
        $request->validate([
            'email'       => 'required|string|email',
            'password'    => 'required|string'
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'], 401);
        }

        $user = $request->user();

        // Don't allow multiple tokens same user
        $user->tokens->each(function($token, $key) {
            $token->delete();
        });

        $tokenResult = $user->createToken('Personal Access Token');

        $token = $tokenResult->token;
        
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type'   => 'Bearer',
            'expires_at'   => Carbon::parse(
                $tokenResult->token->expires_at)
                    ->toDateTimeString(),
            'timezone'  => date_default_timezone_get()
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->delete();

        return response()->json(['message' => 
            'Successfully logged out']);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
