<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomOAuth extends Model
{
    use HasFactory;

    protected $table = 'zoom_o_auth_credentials';

    protected $fillable = [
        'user_id',
        'access_token',
        'refresh_token',
    ];
}
