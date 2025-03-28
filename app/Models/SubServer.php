<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubServer extends Model
{
    protected $fillable = ['server_id', 'name', 'status'];

    public function server()
    {
        return $this->belongsTo(Server::class);
    }

    public function subSubServers()
    {
        return $this->hasMany(SubSubServer::class);
    }

    public function isActive()
    {
        return $this->status === 'active';
    }
}
