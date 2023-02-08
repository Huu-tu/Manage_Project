<?php

namespace App\Services;

use App\Interfaces\FileUploadInterface;
use GuzzleHttp\Client;

class OneDriveCloudService implements FileUploadInterface {
    public $accesstoken;

    public function __construct(){
        $guzzle = new Client();
        $tenantId = 'f8cdef31-a31e-4b4a-93e4-5f571e91255a';
        $url = 'https://login.microsoftonline.com/' . $tenantId . '/oauth2/token?api-version=1.0';
        $token = json_decode($guzzle->post($url, [
            'form_params' => [
                'client_id' => '8aecdbff-50a1-493f-88b9-4d28a8997df7',///$clientId,
                'client_secret' => 'bd26b9de-8f45-4b1e-beed-0d1fbc93dc3e', // $clientSecret,
                'resource' => 'https://graph.microsoft.com/',
//                'scope' => 'https://graph.microsoft.com/.default',
                'grant_type' => 'client_credentials',
//                'username' => 'tuhuu7165@gmail.com',
//                'password' => '231@231a'
            ],
        ])->getBody()->getContents());
        $this->accessToken = $token->access_token;
    }

    public function getAllFile(){
//        $graph = new Graph();
//        $graph->setAccessToken($this->accessToken);
//
//        $user = $graph->setApiVersion("beta")
//            ->createRequest("GET", "/getFileUpload")
//            ->setReturnType(Model\User::class)
//            ->execute();

        $graph = new Graph();
        $graph->setBaseUrl("https://graph.microsoft.com/")
            ->setApiVersion("v1.0")
            ->setAccessToken($this->accessToken);
//        dd($graph);
        $user = $graph->createRequest("GET","/getFileUpload")
            ->addHeaders(array("Content-Type" => "application/json"))
            ->setReturnType(Model\User::class)
            ->setTimeout("1000")
            ->execute();


        return response()->json($graph);
    }

    public function uploadFile($request){

    }

    public function downloadFile($id){

    }

    public function deleteFile($id){

    }
}
