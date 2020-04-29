<?php

namespace English\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class CrazyListenHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
