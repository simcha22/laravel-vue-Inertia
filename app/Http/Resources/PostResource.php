<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public static $wrap = false;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'user_name' => $this->user->name,
            'comments' => CommentResource::collection($this->comments->sortByDesc('created_at')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
