<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VpsServer extends Model
{
    /** @use HasFactory<\Database\Factories\VpsServerFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'username',
        'ip_address',
        'private_key',
        'password',
        'port',
        'domain',
        'status',
    ];

    protected $hidden = [
        'private_key',
        'password',
    ];
}
