<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){
        $name = 'Do huu Tu';
        return view('profiles.profiles') ->with('name',$name);
    }
}
