<?php

namespace App\Services;

use App\Interfaces\FileUploadInterface;
use Faker\Core\File;
use Illuminate\Support\Facades\Storage;
use App\Models\FileCloud;

class S3CloudService implements FileUploadInterface{

    public function hasFile($key)
    {
        return Storage::disk('s3')->exists($key);
    }
    
    public function getFile($key){
//        $result = FileCloud::where('key',$key)->get();
//        return response()->json($result);
//        $result = Storage::disk('s3')->url("iphone_1674983458.jpg");
//        return response()->json(json_encode($result));
        return response()->make(
            Storage::disk('s3')->get($key),
            200,
            ['Content-Type' => 'image/png'],
        );
    }

    public function getAllFile(){
        $result = Storage::disk('s3')->allFiles('');
        return response()->json($result);
    }

    public function uploadFile($request)
    {
        if ($request->hasFile('file')) {
//            $file = $request->file;
//            $fileName = $file->getClientOriginalName();
//            $path = $file->getRealPath();

            $filenamewithextension = $request->file('file')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('file')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename . '_' . time() . '.' . $extension;

            $size = $request->file('file')->getSize();

            $type = $request->file('file')->extension();

            $value = $request->file('file')->getRealPath();

            $url = "https://git-poly-backup.s3.ap-southeast-1.amazonaws.com/{$filenametostore}";

            FileCloud::create([
                'key' => $filenametostore,
                'url' => $url,
                'size' => $size,
                'type' => $type
            ]);

            $result = Storage::disk('s3')->put($filenametostore, $value);

            return response()->json("Success");
        }
    }

    public function downloadFile($id)
    {
        $result = Storage::disk('s3')->get($id);
        Storage::put('public/s3/vn_1675002072.jpg', "{$result}");
//        dd("Thanh cong");
        return response()->json("Success");
    }

    public function deleteFile($id)
    {
        Storage::disk('s3')->delete($id);
        return response()->json("Success");
    }
}
