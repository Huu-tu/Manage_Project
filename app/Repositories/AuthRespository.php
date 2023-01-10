<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthRespository extends BaseRepository{
    public function getModel(){
        return User::class;
    }

//    public function login($data){
//        if (Auth::attempt($data)) {
//
//            // Authentication passed...
//            return redirect('/');
//        }else{
//            return redirect('/login');
//        }
//    }

    public function register(array $data){
        $this->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        return redirect('/login');
    }

    public function logOut(){
        return redirect('login');
//        $result = $this->_model->findOrFail($userId);
//        if ($result){
//            Session::flush();
//
//            Auth::logout();
//
////            return redirect('login');
//        }else{
//            echo "Koh";
//        }
    }
}
