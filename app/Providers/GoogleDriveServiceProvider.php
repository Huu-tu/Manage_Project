<?php

namespace App\Providers;

use Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use App\Models\User;

class GoogleDriveServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    public function boot()
    {
        \Storage::extend("google", function($app, $config) {
            $client = new \Google_Client;
            $client->setClientId($config['clientId']);
            $client->setClientSecret($config['clientSecret']);
//            $client->setAccessToken($config['accessToken']);
//            $client->refreshToken($config['refreshToken']);
            $client->setDeveloperKey('AIzaSyBcPIIs8yjukTT2o1-hQEfuhKjl3_P97sc');
            $client->setScopes(array(
                'https://www.googleapis.com/auth/drive.file',
//            'https://www.googleapis.com/auth/plus.login',
                'https://www.googleapis.com/auth/userinfo.email',
                'https://www.googleapis.com/auth/drive.metadata',
                'https://www.googleapis.com/auth/drive'
            ));
            $service = new \Google_Service_Drive($client);
            $adapter = new GoogleDriveAdapter($service, $config['folderId']);

            $email = "tuhuu7165@gmail.com";

            $user = User::where('email', '=', "{$email}")->first();

            $client->setAccessToken(json_decode($user->access_token, true));

            if ($client->isAccessTokenExpired()) {

                // SAVE REFRESH TOKEN TO SOME VARIABLE
                $refreshTokenSaved = $client->getRefreshToken();

                // UPDATE ACCESS TOKEN
                $client->fetchAccessTokenWithRefreshToken($refreshTokenSaved);

                // PASS ACCESS TOKEN TO SOME VARIABLE
                $updatedAccessToken = $client->getAccessToken();

                // APPEND REFRESH TOKEN
                $updatedAccessToken['refresh_token'] = $refreshTokenSaved;

                // SET THE NEW ACCES TOKEN
                $client->setAccessToken($updatedAccessToken);

                $user->access_token = $updatedAccessToken;

                $user->save();
                return new Filesystem($adapter);

            }
        });
    }
}
