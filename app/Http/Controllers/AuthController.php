<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $authService;
    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }

    public function login(){
        return view('auth.login');
    }

    public function postLogin(Request $request){
        return $this->authService->login($request);
    }

    public function register(){
        return view('auth.register');
    }

    public function postRegister(Request $request){
        return $this->authService->register($request);
    }

    public function logOut(Request $request){
        return $this->authService->logOut($request);
    }
}
