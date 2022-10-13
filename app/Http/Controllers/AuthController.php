<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request) {
        $rules = [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string'
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()) {
            return response()->json([
                'status' => 'fails',
                'error' => $validator->errors()->toArray()
            ]);
        }
        $user = new User([
            "name" => $request->input('name'),
            "email" => $request->input('email'),
            "password"=> Hash::make($request->input('pasword'))
        ]);
            $user->save();
            return response()->json([
                "status" => 'success'
            ]);
    }
}
