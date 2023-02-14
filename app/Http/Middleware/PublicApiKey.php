<?php

namespace App\Http\Middleware;
use Closure;
use App\Models\APIKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class PublicApiKey{


    // public function handle(Request $request, Closure $next, Schedule $schedule)
    // {
    //     $requestId = $request->header("Apikey");

    //     //  $request->headers->set("Apikey","xxxx");

    //     if ($requestId === null) {
    //         $request->headers->set(self::HEADER_NAME, $requestId);
    //     }

    //     // return $next($request);
    // }


   public function handle(Request $request, Closure $next)
   {
        $ApiKey = $request->header("Api_key");
        $user = APIKey::where('apikey', '=', "{$ApiKey}")->first();
        $date = date('d-m-y h:i:s');
        $value = $user['email'] . '_'  . $date;
        $apiKeyHash = Hash::make($value);
        if($user) {
            APIKey::where('apikey', '=', "{$ApiKey}")->first()->update(['apikey' => $apiKeyHash]);      
           return $next($request);
        }else{
           return response()->json(['status' => false,'error' => "Invalid requst"], 503);
        }
   }
}
