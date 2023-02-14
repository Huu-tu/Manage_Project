<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\ApiKeyAdmin;

class ApiKeyAdminController extends Controller
{

    public function index(){
        return Response()->json("Success");
    }

    public function createApiKey(Request $request){
        $name = $request->only('name');
        $email = $request->only('email');
        $date = date('d-m-y h:i:s');
        $value = $email['email'] . '_'  . $date;
        $apiKey = Hash::make($value);

        ApiKeyAdmin::create([
            'name' => $name['name'],
            'email' => $email['email'],
            'apikey' => $apiKey
        ]);

        return Response()->json("Success");

        // tuhuu7165@gmmil.com_12-02-23 12:08:02
        // "$2y$10$25bFggjEBYxDWeymD36gOeThXDh2RHhpBmAfIdIaiv3ogMb1B4EYu"

        // if (Hash::check('tuhuu7165@gmmil.com_12-02-23 12:08:02', "$2y$10$25bFggjEBYxDWeymD36gOeThXDh2RHhpBmAfIdIaiv3ogMb1B4EYu")) {
        //     return Response()->json("thanh cong");
        // }else{
        //     return Response()->json("KO");
        // }
        // return Response()->json($apiKey);
    }
}
