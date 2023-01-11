<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            'https://www.googleapis.com/auth/drive'
        ));

        $this->gClient->addScope('email');

        $this->gClient->setAccessType("online");

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

            //FOR LOGGED IN USER, GET DETAILS FROM GOOGLE USING ACCES
//            $user = User::find(2);
            $user = User::where ('email', '=', "{$email}")->first();


            $user->access_token = json_encode($request->session()->get('key'));

            $user->save();

            dd($user);

//            return redirect('/order');

        } else{

            // FOR GUEST USER, GET GOOGLE LOGIN URL
            $authUrl = $this->gClient->createAuthUrl();

            return redirect()->to($authUrl);
        }
    }

    public function googleDriveFilePpload()
    {
        $service = new \Google_Service_Drive($this->gClient);

        $user = User::find(2);

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

        $fileMetadata = new \Google_Service_Drive_DriveFile(array(
            'name' => "{$user->name}",  // ADD YOUR GOOGLE DRIVE FOLDER NAME
            'mimeType' => 'application/vnd.google-apps.folder',
            'parents' => array('1-corZpGGmBfHPS5qY5cH8UB-b0Qi2_fa') // this is the folder id
        ));

        $folder = $service->files->create($fileMetadata, array('fields' => 'id'));

        printf("Folder ID: %s\n", $folder->id);

        $file = new \Google_Service_Drive_DriveFile(array('name' => 'Henry Calvill in The house of dragon.jpg', 'parents' => array($folder->id)));

        $result = $service->files->create($file, array(

            'data' => file_get_contents(public_path('Henry Calvill in The house of dragon.jpg')), // ADD YOUR FILE PATH WHICH YOU WANT TO UPLOAD ON GOOGLE DRIVE
            'mimeType' => 'application/octet-stream',
            'uploadType' => 'media'
        ));

        // GET URL OF UPLOADED FILE

//        $url = 'https://drive.google.com/open?id=' . $result->id;

        dd($result);
    }
}
