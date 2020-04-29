<?php
/**
 * Created by PhpStorm.
 * Date: 8/29/19
 * Time: 5:48 PM
 */

namespace ACL\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ContactResourceCollection extends ResourceCollection
{
    public function toArray($request)
    {
        $currentPage = $this->currentPage();
        $perPage = $this->perPage();

        return [
            'status' => true,
            'total' => $this->total(),
            "last_page" => $this->lastPage(),
            'per_page' => $perPage,
            'current_page' => $currentPage,
            "next_page_url" => $this->nextPageUrl(),
            "prev_page_url" => $this->previousPageUrl(),
            "from" => $perPage * ($currentPage -1) + 1,
            "to" => $perPage  * ($currentPage -1) + $this->count(),

            'data' => $this->collection,
        ];
    }
}
