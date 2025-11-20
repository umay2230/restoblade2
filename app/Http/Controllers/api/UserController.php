<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Iluminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    
    public function login(Request $request)
    {
        $request->validate(
            [
                'email'=> 'required|email',
                'password'=> 'required'
            
            ]);
            if (Auth::attempt($request->only('email','password'))){
                return response()->json(['message' => 'Invalid credentials'], 401  );

            }

            return response()->json([
                'status'=> 'success',
                'message'=> 'Login successful',
                'user'=> Auth::user(),

            ]);
    }
    

    
}