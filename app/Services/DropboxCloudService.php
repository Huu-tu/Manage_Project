<?php

namespace App\Services;

use App\Interfaces\FileUploadInterface;
use App\Models\FileCloud;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class DropboxCloudService implements FileUploadInterface
{
    public function getFile($key){
//        $result = FileCloud::where('key',$key)->get();
//        return response()->json($result);
//
//        $result = Storage::disk('dropbox')->get($key);
//        return response()->json($result);

//        $url = Storage::disk('dropbox')->url($key);
//        return response()->json($url);

        return response()->make(
            Storage::disk('dropbox')->get("{$key}"),
            200,
            ['Content-Type' => 'application/pdf']
        );
    }

    public function getAllFile()
    {
        $result = Storage::disk('dropbox')->allFiles('');
        return response()->json($result);
    }

    public function uploadFile($request)
    {
        if ($request->hasFile('file')) {
            $filenamewithextension = $request->file('file')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('file')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename . '_' . time() . '.' . $extension;

            $value = $request->file('file');

            $size = $request->file('file')->getSize();

            $type = $request->file('file')->extension();

            $value = $request->file('file');

            $url = "https://api.dropboxapi.com/2/sharing/get_shared_link_metadata/{$filenametostore}";

            FileCloud::create([
                'key' => $filenametostore,
                'url' => $url,
                'size' => $size,
                'type' => $type
            ]);

            $result = Storage::disk('dropbox')->put($filenametostore, $value);

            return response()->json("Success");
        }
    }

    public function downloadFile($id)
    {
        $result = Storage::disk('dropbox')->get($id);
        Storage::put("public/s3/{$id}", "{$result}");
//        dd("Thanh cong");
        return response()->json("Thanh cong");
    }

    public function deleteFile($id)
    {
        Storage::disk('dropbox')->delete($id);
        return response()->json("Success");
    }
}
