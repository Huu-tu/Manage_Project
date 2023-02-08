<?php

namespace App\Providers;

use App\Interfaces\FileUploadInterface;
use App\Services\DropboxCloudService;
use App\Services\GoogleCloudService;
use App\Services\S3CloudService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;

class FileUploadServiceProvider extends ServiceProvider
{

    public function register()
    {
//        $this->app->singleton(FileUploadInterface::class, function ($app){
//            switch ('s3') {
//                case 's3':
//                    return new S3CloudService;
//                case 'google':
//                    return new GoogleCloudService;
//                case 'dropbox':
//                    return new DropboxCloudService;
//                default:
//                    throw new \RuntimeException("Unknown your option");
//            }
//        });
    }

    public function boot()
    {
        //
    }
}
