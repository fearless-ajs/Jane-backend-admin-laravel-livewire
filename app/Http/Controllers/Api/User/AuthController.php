<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\ApiController;
use App\Mail\PasswordUpdateMail;
use App\Mail\ResetPasswordMail;
use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends ApiController
{
    public function register(Request $request) {
        $request->validate([
            'lastname'     => 'required|string|max:255',
            'firstname'    => 'required|string|max:255',
            'email'        => 'required|email|unique:users',
            'image'        => 'image',
            'password'     => 'required|min:6|confirmed'
        ]);

        // Store the contact data in the database
        $data = $request->all();
        $data['verification_token'] = Str::random(50);
        if ($request->hasFile('image')){
            $data['image'] = $request->image->store('/', 'images');
        }

        $user = User::create($data);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'contact' => $user,
            'token' => $token
        ];
        return $this->successResponse(
            [
                'errorCode' => 'SUCCESS',
                'data'   => $response
            ],201);
    }

    public function login(Request $request) {
        $fields = $request->validate([
            'email'    => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return $this->errorResponse([
                'errorCode' => 'AUTHENTICATION_ERROR',
                'message' => 'Invalid username and password'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'contact' => $user,
            'token' => $token
        ];

        return $token-$this->successResponse([
            'errorCode' => 'SUCCESS',
            'data'      => $response
            ], 200);
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return $this->successResponse([
            'errorCode' => 'SUCCESS',
            'message'   => 'Logged out'
        ], 200);
    }

    public function verifyUser(Request $request, $token){
        $user = User::where('verification_token', $token)->first();
        if (!$user){
            return $this->errorResponse([
                'errorCode' => "VERIFICATION_ERROR",
                'message' => 'Invalid verification token'
            ], 404);
        }

        // Update the contact registration records
        $user->verification_token = null;
        $user->email_verified_at = Carbon::now();
        $user->save();


        return $this->errorResponse([
            'errorCode' => "SUCCESS",
            'message' => 'Email verified successfully'
        ], 202);

    }

    public function resetPassword(Request $request){
        $request->validate([
            'email' => 'required|string|email',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user){
            return $this->errorResponse([
                'errorCode' => "AUTHENTICATION_ERROR",
                'message' => 'Email not found'
            ], 404);
        }

        // Check if exist then update else create
        $reset = PasswordReset::where('email', $request->email)->first();
        $token = Str::random(50);
        if ($reset){
            $reset->token = $token;
            $reset->expires_at = Carbon::now()->addMinutes(10);
            $reset->save();
        }else{
            PasswordReset::create([
                'email'        => $request->email,
                'token'        => $token,
                'expires_at'   => Carbon::now()->addMinutes(10)
            ]);
        }

        // Mail the contact concerning the update
        Mail::to($user->email)->send(new ResetPasswordMail($user, $token));

        // Send r
        return $this->errorResponse([
            'errorCode' => "SUCCESS",
            'message' => 'Reset link has been sent to you email address'
        ], 202);


    }

    public function chooseNewPassword(Request $request, $token){
        $request->validate([
            'password'  => 'required|string|confirmed'
        ]);

        $token = PasswordReset::where('token', $token)->first();
        if (!$token){
            return $this->errorResponse([
                'errorCode' => "VALIDATION_ERROR",
                'message' => 'Invalid reset token'
            ], 422);
        }

        $tokenDate = Carbon::parse($token->expires_at);
        // Check if it has not expired
        if ($tokenDate <= Carbon::now()){
            // Delete the token and send response to contact
            $token->delete();
            return $this->errorResponse([
                'errorCode' => "VALIDATION_ERROR",
                'message' => 'Invalid reset token'
            ], 422);
        }

        // Update contact password
        $user = User::where('email', $token->email)->first();
        $user->password = $request->password;
        $user->save();

        // Delete token
        $token->delete();

        // Mail the contact concerning the update
        Mail::to($user->email)->send(new PasswordUpdateMail($user));

        // Send r
        return $this->errorResponse([
            'errorCode' => "SUCCESS",
            'message' => 'Your password has been updated successfully'
        ], 202);


    }

}
