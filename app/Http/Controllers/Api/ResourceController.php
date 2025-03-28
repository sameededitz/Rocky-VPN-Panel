<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServerResource;
use App\Models\Plan;
use App\Models\Server;

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
}
