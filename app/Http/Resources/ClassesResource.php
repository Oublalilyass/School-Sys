<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
   public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            
            // 💡 FIX: Include the sections collection here, using whenLoaded()
            'sections' => SectionResource::collection($this->whenLoaded('sections')),
        ];
    }
}
