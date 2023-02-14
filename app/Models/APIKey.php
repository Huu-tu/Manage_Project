<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class APIKey extends Model
{
    use HasFactory;

    protected $table = 'apiKeys';
    protected $fillable = [
        'name', 'email','apikey'
    ];
}
