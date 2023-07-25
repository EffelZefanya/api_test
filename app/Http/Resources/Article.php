<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Article extends JsonResource
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
            "title" => $this->title,
            "content" => $this->content,
            "image" =>$this->image,
            "user_id" => $this->user_id,
            "category_id" => $this->category_id,
            'created_at' => Carbon::now(),
            "updated_at" =>Carbon::now()
        ];
    }
}
