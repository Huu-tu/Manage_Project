<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\AuthRespository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService{
    public function __construct(AuthRespository $authRepository){
        $this->authRepository = $authRepository;
    }

    public function login(Request $request){
        request()->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $data = $request->only('email', 'password');

//        return $this->authRepository->login($data);
        if (Auth::attempt($data)) {
            $request->session()->put('key',$data['email']);
            return redirect('/');
        }else{
            return redirect('/login');
        }
    }

    public function register(Request $request){
        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();

        return $this->authRepository->register($data);
    }
}
