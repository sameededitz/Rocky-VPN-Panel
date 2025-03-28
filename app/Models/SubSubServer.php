<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubSubServer extends Model
{
    protected $fillable = ['sub_server_id', 'vps_server_id', 'name'];

    public function subServer()
    {
        return $this->belongsTo(SubServer::class);
    }

    public function vpsServer()
    {
        return $this->belongsTo(VpsServer::class);
    }
}
