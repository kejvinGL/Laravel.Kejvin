<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'role' => $this->role->name,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'avatar' => new MediaResource($this?->avatar) ?? null,
            'post_count' => count($this->posts),
            'comments_count' => count($this->comments),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
