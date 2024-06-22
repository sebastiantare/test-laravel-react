<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CalleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'ciudad' => $this->ciudad->nombre,
            'provincia' => $this->ciudad->provincia->nombre,
            'region' => $this->ciudad->provincia->region->nombre,
        ];
    }
}
