<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    protected $except = [
        '/createApiKeyAdmin',
        '/createApiKey',
        'fileDeleteCloud',
        '/fileDeleteCloud/google/555.jpg',
        '/fileDeleteCloud/dropbox/p_1675711048.jpg',
        '/fileDeleteCloud/s3/555_1675735937.jpg',
        '/fileUploadToCloud/google',
        '/fileUploadToCloud/dropbox',
        '/fileUploadToCloud/s3',
        '/fileDeleteCloud/dropbox/deamon_1675534443.jpg',
        '/fileDeleteToS3',
        '/postRegistration',
        '/fileUploadToDrive',
        '/fileUploadToS3',
        '/google/login',
        '/google-drive/file-upload'
    ];
}
