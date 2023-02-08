<?php

return [
    'default' => env('FILESYSTEM_DRIVER', 'local'),
    'cloud' => env('FILESYSTEM_CLOUD', 's3'),
//    'cloud' => 'google',

    'disks' => [
        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],
        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => 'ap-southeast-1',
            'bucket' => env('AWS_BUCKET'),
//            'url' => env('AWS_URL'),
        ],
        'google' => [
            'driver' => 'google',
            'clientId' => env('GOOGLE_DRIVE_CLIENT_ID'),
            'clientSecret' => env('GOOGLE_DRIVE_CLIENT_SECRET'),
            'accessToken'=>env('GOOGLE_DRIVE_ACCESS_TOKEN'),
            'refreshToken' => env('GOOGLE_DRIVE_REFRESH_TOKEN'),
            'folderId' => env('GOOGLE_DRIVE_FOLDER_ID'),
        ],
        'dropbox'=>[
            'driver'=>'dropbox',
            'key'=>env('DROPBOX_TOKEN'),
            'secret'=>env('DROPBOX_SECRET'),
            'authorization_token' => env('DROPBOX_ACCESS_TOKEN'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
