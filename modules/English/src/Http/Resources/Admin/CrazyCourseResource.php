<?php

namespace English\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class CrazyCourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'img' => $this->img,
            'small_thumb' => $this->small_thumb,
            'medium_thumb' => $this->medium_thumb,
            'large_thumb' => $this->large_thumb,
        ];
    }
}
