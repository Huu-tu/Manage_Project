<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class GoogleDriveController extends Controller
{
    public $gClient;

    function __construct(){
        $this->gClient = new \Google_Client();

        $this->gClient->setApplicationName('Web client 2'); // ADD YOUR AUTH2 APPLICATION NAME (WHEN YOUR GENERATE SECRATE KEY)
        $this->gClient->setClientId('228114178670-o8hc85va5lsrrkjmihmgpq5bdhc7r05a.apps.googleusercontent.com');
        $this->gClient->setClientSecret('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');
        $this->gClient->setRedirectUri('http://127.0.0.1:8082/google/login');
        $this->gClient->setDeveloperKey('AIzaSyBcPIIs8yjukTT2o1-hQEfuhKjl3_P97sc');
//        $this->gClient->setParents();

        $this->gClient->setScopes(array(
            'https://www.googleapis.com/auth/drive.file',
//            'https://www.googleapis.com/auth/plus.login',
            'https://www.googleapis.com/auth/userinfo.email',
            'https://www.googleapis.com/auth/drive.metadata',
            'https://www.googleapis.com/auth/drive'
        ));

        $this->gClient->addScope('email');

        $this->gClient->setAccessType("offline");

        $this->gClient->setApprovalPrompt("force");

    }

    public function googleLogin(Request $request)  {

        $google_oauthV2 = new \Google_Service_Oauth2($this->gClient);

        if ($request->get('code')){

            $this->gClient->authenticate($request->get('code'));

            $request->session()->put('key', $this->gClient->getAccessToken());
        }

        if ($request->session()->get('key')){

            $this->gClient->setAccessToken($request->session()->get('key'));
        }

        if ($this->gClient->getAccessToken()){
            $google_account_info = $google_oauthV2->userinfo->get();

            $email =  $google_account_info->email;

            $user = User::where('email', '=', "{$email}")->first();

            $user->access_token=json_encode($request->session()->get('key'));

            $user->save();

//            return redirect('/order');
            dd("Thanh cong");
//            return response()->json("{$result}");

        } else{

            // FOR GUEST USER, GET GOOGLE LOGIN URL
            $authUrl = $this->gClient->createAuthUrl();

            return redirect()->to($authUrl);
        }
    }

    public function uploadFile(Request $request)
    {
//        $value = $request->session()->get('key');
//        return response()->json("{$value}");
//        return view('uploadFile.index');
    }

    public function googleDriveFilePpload(Request $request)
    {
        $service = new \Google_Service_Drive($this->gClient);

//        $email = $request->session()->get('key');
        $email = "ngocutcuocdoi89@gmail.com";

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

            return response()->json("{$user}");

//          dd($result);

//            return redirect('/uploadFIle');
        }
    }

    public function getFileUploadToDrive(){
        $result = Storage::disk('google')->exists('');
        return response()->json($result);
    }

        public function fileUploadToDrive(Request $request){
        if ($request->hasFile('file')){
            $file = $request->file;
            $fileName = $file->getClientOriginalName();
            $path = $file->getRealPath();

            $filenamewithextension = $request->file('file')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('file')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            $result = $request->file("file");
//            $result = Storage::disk('google')->put('Webappfix', "sdfdsf");
            return response()->json("{$filenametostore}");
        }else{
            return response()->json("Khong");
        }
    }
}
