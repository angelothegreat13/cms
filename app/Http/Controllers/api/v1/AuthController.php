<?php

namespace App\Http\Controllers\api\v1;

use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => ['email','required'],
            'password' => ['required']
        ]);

        if ($validation->fails()) {
            return $this->respondError('Validation Errors.', ['errors' => $validation->errors()], 401);
        }

        if (!auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            return $this->respondError('Invalid Credentials.', [], 401);
        }

        $user = auth()->user(); 

        return $this->respondSuccess('Login Success.', [
            'user' => $user, 
            'token' => $user->createToken('cms')->plainTextToken
        ]);
    }

    public function register(Request $request)
    {   
        $validation  = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required','email','unique:users'],
            'password' => ['required','confirmed']
        ]);

        if ($validation->fails()) {
            return $this->respondError('Validation Errors.', ['errors' => $validation->errors()], 401);
        }

        $validatedData = $validation->valid();
        $validatedData['password'] = bcrypt($request->password);
        $user = User::create($validatedData);

        return $this->respondSuccess('Signup Success.', [
            'user' => $user, 
            'token' => $user->createToken('cms')->plainTextToken
        ], 201);
    }

}