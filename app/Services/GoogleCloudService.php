<?php

namespace App\Services;

use App\Interfaces\FileUploadInterface;
use App\Models\FileCloud;
use App\Models\User;

class GoogleCloudService implements FileUploadInterface
{
    public $gClient;

    function __construct(){
        $this->gClient = new \Google_Client();

        $this->gClient->setApplicationName('Web client 2'); // ADD YOUR AUTH2 APPLICATION NAME (WHEN YOUR GENERATE SECRATE KEY)
        $this->gClient->setClientId(env('GOOGLE_DRIVE_CLIENT_ID'));
        $this->gClient->setClientSecret(env('GOOGLE_DRIVE_CLIENT_SECRET'));
        $this->gClient->setRedirectUri(env('http://127.0.0.1:8082/google/login'));
        $this->gClient->setDeveloperKey(env('AIzaSyBcPIIs8yjukTT2o1-hQEfuhKjl3_P97sc'));
//        $this->gClient->setParents();

        $this->gClient->setScopes(array(
            'https://www.googleapis.com/auth/drive.file',
//            'https://www.googleapis.com/auth/plus.login',
            'https://www.googleapis.com/auth/userinfo.email',
            'https://www.googleapis.com/auth/drive.metadata',
            'https://www.googleapis.com/auth/drive',
            'https://www.googleapis.com/auth/drive.readonly'
        ));

        $this->gClient->addScope('email');

        $this->gClient->setAccessType("offline");

        $this->gClient->setApprovalPrompt("force");

    }

    public function getFile($key){
        $result = FileUpload::where('key',$key)->get();
        return response()->json($result);
    }

    public function getAllFile()
    {
        $service = new \Google_Service_Drive($this->gClient);

        $email = "tuhuu7165@gmail.com";

//        $user = User::Find(2);
        $user = User::where('email', '=', "{$email}")->first();

        $this->gClient->setAccessToken(json_decode($user->access_token, true));

        if ($this->gClient->isAccessTokenExpired()) {

            // SAVE REFRESH TOKEN TO SOME VARIABLE
            $refreshTokenSaved = $this->gClient->getRefreshToken();

            // UPDATE ACCESS TOKEN
            $this->gClient->fetchAccessTokenWithRefreshToken($refreshTokenSaved);

            // PASS ACCESS TOKEN TO SOME VARIABLE
            $updatedAccessToken = $this->gClient->getAccessToken();

            // APPEND REFRESH TOKEN
            $updatedAccessToken['refresh_token'] = $refreshTokenSaved;

            // SET THE NEW ACCES TOKEN
            $this->gClient->setAccessToken($updatedAccessToken);

            $user->access_token = $updatedAccessToken;

            $user->save();
        }

        $result = $service->files->get('10qN63wL7NG90n_YpTD_nIRMrygL7Fvka');
        return response()->json($result);
    }

    public function uploadFile($request)
    {
        $service = new \Google_Service_Drive($this->gClient);

//        $email = $request->session()->get('key');
        $email = "tuhuu7165@gmail.com";

//        $user = User::Find(2);
        $user = User::where('email', '=', "{$email}")->first();

        $this->gClient->setAccessToken(json_decode($user->access_token, true));

        if ($request->hasFile('file')) {
            if ($this->gClient->isAccessTokenExpired()) {

                // SAVE REFRESH TOKEN TO SOME VARIABLE
                $refreshTokenSaved = $this->gClient->getRefreshToken();

                // UPDATE ACCESS TOKEN
                $this->gClient->fetchAccessTokenWithRefreshToken($refreshTokenSaved);

                // PASS ACCESS TOKEN TO SOME VARIABLE
                $updatedAccessToken = $this->gClient->getAccessToken();

                // APPEND REFRESH TOKEN
                $updatedAccessToken['refresh_token'] = $refreshTokenSaved;

                // SET THE NEW ACCES TOKEN
                $this->gClient->setAccessToken($updatedAccessToken);

                $user->access_token = $updatedAccessToken;

                $user->save();
            }

            $file = $request->file;
            $fileName = $file->getClientOriginalName();
            $path = $file->getRealPath();

            $fileMetadata = new \Google_Service_Drive_DriveFile(array(
                'name' => "{$user->name}",  // ADD YOUR GOOGLE DRIVE FOLDER NAME
                'mimeType' => 'application/vnd.google-apps.folder',
//                'parents' => array('1-corZpGGmBfHPS5qY5cH8UB-b0Qi2_fa') // this is the folder id
            ));

            $folder = $service->files->create($fileMetadata, array('fields' => 'id'));

            $file = new \Google_Service_Drive_DriveFile(array('name' => "{$fileName}", 'parents' => array($folder->id)));

            $result = $service->files->create($file, array(
                'data' => file_get_contents($path),
                'mimeType' => 'application/octet-stream',
                'uploadType' => 'media'
            ));

            $size = $request->file('file')->getSize();

            $type = $request->file('file')->extension();

            $value = $request->file('file')->getRealPath();

            $url = "https://git-poly-backup.s3.ap-southeast-1.amazonaws.com/{$fileName}";

            FileCloud::create([
                'key' => $fileName,
                'url' => $url,
                'size' => $size,
                'type' => $type
            ]);

            return response()->json("{$user}");

//          dd($result);

//            return redirect('/uploadFIle');
        }
    }

    public function downloadFile($id)
    {
        $service = new \Google_Service_Drive($this->gClient);

        $service2 = new \Google_Service_DriveReadonly();

        $email = "tuhuu7165@gmail.com";

//        $user = User::Find(2);
        $user = User::where('email', '=', "{$email}")->first();

        $this->gClient->setAccessToken(json_decode($user->access_token, true));

        if ($this->gClient->isAccessTokenExpired()) {

            // SAVE REFRESH TOKEN TO SOME VARIABLE
            $refreshTokenSaved = $this->gClient->getRefreshToken();

            // UPDATE ACCESS TOKEN
            $this->gClient->fetchAccessTokenWithRefreshToken($refreshTokenSaved);

            // PASS ACCESS TOKEN TO SOME VARIABLE
            $updatedAccessToken = $this->gClient->getAccessToken();

            // APPEND REFRESH TOKEN
            $updatedAccessToken['refresh_token'] = $refreshTokenSaved;

            // SET THE NEW ACCES TOKEN
            $this->gClient->setAccessToken($updatedAccessToken);

            $user->access_token = $updatedAccessToken;

            $user->save();
        }

        $content = $service->files->export("1-corZpGGmBfHPS5qY5cH8UB-b0Qi2_fa", 'application/pdf', array('alt' => 'media' ));

        $result = $service->files->get('1-corZpGGmBfHPS5qY5cH8UB-b0Qi2_fa',array(
            'alt' => 'media'));

        $sad = response()->download($result,"ád");
        return response()->json("Thanh cONG");
    }

    public function deleteFile($id)
    {
        $service = new \Google_Service_Drive($this->gClient);

        $email = "tuhuu7165@gmail.com";

//        $user = User::Find(2);
        $user = User::where('email', '=', "{$email}")->first();

        $this->gClient->setAccessToken(json_decode($user->access_token, true));

        if ($this->gClient->isAccessTokenExpired()) {

                // SAVE REFRESH TOKEN TO SOME VARIABLE
                $refreshTokenSaved = $this->gClient->getRefreshToken();

                // UPDATE ACCESS TOKEN
                $this->gClient->fetchAccessTokenWithRefreshToken($refreshTokenSaved);

                // PASS ACCESS TOKEN TO SOME VARIABLE
                $updatedAccessToken = $this->gClient->getAccessToken();

                // APPEND REFRESH TOKEN
                $updatedAccessToken['refresh_token'] = $refreshTokenSaved;

                // SET THE NEW ACCES TOKEN
                $this->gClient->setAccessToken($updatedAccessToken);

                $user->access_token = $updatedAccessToken;

                $user->save();
            }

        $service->files->delete("{$id}");
        return response()->json('Thanh cong');
    }
}
