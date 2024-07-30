<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExerciseResource extends JsonResource
{
    public static $wrap = false;
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'details' => $this->details,
            'highlights' => $this->highlights,
            'link' => $this->link,
            'results' => ResultResource::collection($this->results),
            'category' => $this->category,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
