<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiKeyAdmin extends Model
{
    use HasFactory;

    protected $table = 'apiKeyAdmins';
    protected $fillable = [
        'name', 'email','apikey'
    ];
}
