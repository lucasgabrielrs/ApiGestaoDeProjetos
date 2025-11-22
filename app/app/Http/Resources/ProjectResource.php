<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'owner_name' => $this->owner_name,
            'created_at' => $this->created_at?->setTimezone('America/Sao_Paulo')->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->setTimezone('America/Sao_Paulo')->format('Y-m-d H:i:s'),
        ];
    }
}
