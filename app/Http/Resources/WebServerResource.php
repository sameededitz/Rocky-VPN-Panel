<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WebServerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Get the first active sub-server
        $firstSub = $this->subServers->firstWhere('status', 'active');

        return [
            'name' => $this->name,
            'status' => $this->status,
            'type' => $this->type,
            'image_url' => $this->image_url,
            'sub_server' => $firstSub ? [
                'name' => $firstSub->name,
                'status' => $firstSub->status,
            ] : null,
        ];
    }
}
