<?php

return [
    'default' => env('FILESYSTEM_DRIVER', 'local'),

    'disks' => [
//        'google' => [
//            'driver' => 'google',
//            'clientId' => env('228114178670-o8hc85va5lsrrkjmihmgpq5bdhc7r05a.apps.googleusercontent.com'),
//            'clientSecret' => env('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'),
//            'refreshToken' => env('GOOGLE_DRIVE_REFRESH_TOKEN'),
//            'folderId' => env('1-corZpGGmBfHPS5qY5cH8UB-b0Qi2_fa'),
//        ],
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
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
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
