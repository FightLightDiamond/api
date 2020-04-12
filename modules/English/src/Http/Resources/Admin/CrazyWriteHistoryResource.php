<?php

namespace English\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class CrazyWriteHistoryResource extends JsonResource
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
