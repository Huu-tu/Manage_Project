<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileCloud extends Model
{
    use HasFactory;

    protected $table = 'fileClouds';
    protected $fillable = [
        'key', 'url','size','type', 'last_sync_at'
    ];
    protected $dates = [
        'last_sync_at',
    ];
}
