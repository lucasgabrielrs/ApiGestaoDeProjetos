<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'due_date' => $this->due_date?->setTimezone('America/Sao_Paulo')->format('Y-m-d'),
            'project_id' => $this->project_id,
            'status' => $this->status,
            'created_at' => $this->created_at?->setTimezone('America/Sao_Paulo')->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->setTimezone('America/Sao_Paulo')->format('Y-m-d H:i:s'),
        ];
    }
}
