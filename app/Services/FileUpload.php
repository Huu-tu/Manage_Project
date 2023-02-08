<?php

namespace App\Services;

class FileUpload
{
    public function getFileUpload($option,$key){
        if ($option ==='s3'){
            $s3 = new S3CloudService();
            return $s3->getFile($key);
        }elseif ($option =='google'){
            $google = new GoogleCloudService();
            return $google->getFile($key);
        }elseif ($option =='oneDrive'){
            $oneDrive = new OneDriveCloudService();
            return $oneDrive->getAllFile();
        }elseif ($option =='dropbox'){
            $oneDrive = new DropboxCloudService();
            return $oneDrive->getFile($key);
        }else{
            return response()->json("{$option}");
        }
    }

    public function getAllFileUpload($option){
        if ($option ==='s3'){
            $s3 = new S3CloudService();
            return $s3->getAllFile();
        }elseif ($option =='google'){
            $google = new GoogleCloudService();
            return $google->getAllFile();
        }elseif ($option =='oneDrive'){
            $oneDrive = new OneDriveCloudService();
            return $oneDrive->getAllFile();
        }elseif ($option =='dropbox'){
            $oneDrive = new DropboxCloudService();
            return $oneDrive->getAllFile();
        }else{
            return response()->json("{$option}");
        }
    }

    public function fileUploadToCloud($option,$request){
        if ($option =='s3'){
            $s3 = new S3CloudService();
            return $s3->uploadFile($request);
        }elseif($option =='google'){
            $google = new GoogleCloudService();
            return $google->uploadFile($request);
        }elseif ($option =='dropbox'){
            $dropbox = new DropboxCloudService();
            return $dropbox->uploadFile($request);
        }else{
            return response()->json("{$option}");
        }
    }
    public function fileDeleteCloud($option,$id){
        if ($option =='s3'){
            $s3 = new S3CloudService();
            return $s3->deleteFile($id);
        }elseif($option =='google'){
            $google = new GoogleCloudService();
            return $google->deleteFile($id);
        }elseif ($option =='dropbox'){
            $dropbox = new DropboxCloudService();
            return $dropbox->deleteFile($id);
        }else{
            return response()->json("{$option}");
        }
    }

    public function fileDownLoadCloud($option,$id){
        if ($option =='s3'){
            $s3 = new S3CloudService();
            return $s3->downloadFile($id);
//            return $this->s3CloudService->getAllFile();
        }elseif ($option =='google'){
            $google = new GoogleCloudService();
            return $google->downloadFile($id);
        } else{
            return response()->json("{$option}");
        }
    }
}
