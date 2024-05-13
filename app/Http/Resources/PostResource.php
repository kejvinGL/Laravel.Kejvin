<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this->user->id,
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'media' => new MediaResource($this->media),
            'comments_count' => count($this->comments),
        ];

    }
}
