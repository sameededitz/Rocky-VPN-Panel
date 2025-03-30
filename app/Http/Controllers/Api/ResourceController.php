<?php

namespace App\Http\Controllers\Api;

use App\Models\Plan;
use App\Models\Server;
use App\Models\VpsServer;
use App\Http\Controllers\Controller;
use App\Http\Resources\ServerResource;
use App\Http\Resources\VpsServerResource;

class ResourceController extends Controller
{
    public function servers()
    {
        $servers = Server::with(['subServers.subSubServers'])->get();

        return response()->json([
            'status' => true,
            'servers' => ServerResource::collection($servers),
        ]);
    }

    public function plans()
    {
        $plans = Plan::all();

        return response()->json([
            'status' => true,
            'plans' => $plans,
        ]);
    }

    public function vpsServers()
    {
        $servers = VpsServer::all();

        return response()->json([
            'status' => true,
            'servers' => VpsServerResource::collection($servers),
        ]);
    }
}
