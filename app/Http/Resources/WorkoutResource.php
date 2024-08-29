<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkoutResource extends JsonResource
{
    public static $wrap = false;

    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'content' => $this->content,
            'done_at' => $this->done_at,
            'score' => $this->score,
            'score_type' => $this->score_type,
            'user' => $this->user,
            'id' => $this->id,
            'time' => $this->time,
            'exercises' => $this->exercises,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
