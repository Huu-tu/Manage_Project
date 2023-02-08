<?php

namespace App\Interfaces;

interface FileUploadInterface{

    public function getAllFile();

    public function uploadFile($request);

    public function downloadFile($id);

    public function deleteFile($id);
}
