<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResultResource extends JsonResource
{
    public static $wrap = false;

    public function toArray(Request $request): array
    {
        return [
            'reps_type' => $this->reps_type,
            'rehearsals' => explode('#',$this->rehearsals),
            'weights' => explode('#',$this->weights),
            'percentage' => explode('#',$this->percentage),
            'notes' => $this->notes,
            'rounds' => $this->rounds,
            'done_at'  => $this->done_at,
            'meta' => $this->meta,
        ];
    }
}
