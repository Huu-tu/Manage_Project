<?php

namespace App\Adapter;

use App\Interfaces\FileInterface;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DriveAdapter implements FileInterface
{
    public function uploadFile($value)
    {
        return response()->json("Drive");
    }
}

