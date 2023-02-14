<?php

namespace App\Http\Middleware;

use App\Models\ApiKeyAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Closure;

class ApiKeyPrivate{
    public const HEADER_NAME = 'request-id';

    public function handle(Request $request, Closure $next)
    {
        $ApiKey = $request->header("Api_key");
        $user = ApiKeyAdmin::where('apikey', '=', "{$ApiKey}")->first();
        if($user) {
           return $next($request);
        }else{
           return response()->json(['status' => false,'error' => "Invalid requst"], 503);
        }
    }
}
