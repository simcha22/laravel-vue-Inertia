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
            'id' => $this->id,
            'reps_type' => $this->reps_type,
            'level' => $this->level,
            'rehearsals' => explode('#',$this->rehearsals),
            'weights' => explode('#',$this->weights),
            'percentage' => explode('#',$this->percentage),
            'weights_text' => str_replace( '#', 'k, ', $this->weights) .'k',
            'percentage_text' => str_replace( '#', '%, ', $this->percentage) .'%',
            'rehearsals_text' => str_replace( '#', ', ', $this->rehearsals),
            'notes' => $this->notes,
            'rounds' => $this->rounds,
            'done_at'  => $this->done_at,
            'meta' => $this->meta,
        ];
    }
}
