<?php

namespace App\Http\Controllers;

use App\Services\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class FileUploadController extends Controller
{
    protected $fileService;

    public function __construct(FileUpload $fileService)
    {
        $this->fileService = $fileService;
    }

    public function getFileUpload(Request $request){
        $option = $request->route('option');
        $key = $request->route('key');
        return $this->fileService->getFileUpload($option,$key);
    }
    public function getAllFileUploadCloud(Request $request){
        $option = $request->route('option');
        return $this->fileService->getAllFileUpload($option);
    }
    public function fileUploadToCloud(Request $request){
        $option = $request->route('option');
        return $this->fileService->fileUploadToCloud($option,$request);
    }
    public function fileDeleteCloud(Request $request){
        $option = $request->route('option');
        $id = $request->route('id');
        return $this->fileService->fileDeleteCloud($option,$id);
   }
    public function fileDownLoadCloud(Request $request){
        $option = $request->route('option');
        $id = $request->route('id');
        return $this->fileService->fileDeleteCloud($option,$id);
    }
}
