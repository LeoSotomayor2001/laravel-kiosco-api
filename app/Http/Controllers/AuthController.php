<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistroRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
   
    public function login(LoginRequest $request)
    {
        $data=$request->validated();
        $user=User::where('email',$data['email'])->first();
    }

    public function register(RegistroRequest $request)
    {
        $data=$request->validated();
        //crear el usuario
        $user=User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>bcrypt($data['password']),

        ]);   

        return [
            'token'=>$user->createToken('token')->plainTextToken,
            'user'=>$user
        ];
    }
    public function logout(Request $request)
    {
        
    }
}