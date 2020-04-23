<?php
/**
 * Created by PhpStorm.
 * Date: 8/29/19
 * Time: 5:48 PM
 */

namespace English\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CrazyReadHistoryResourceCollection extends ResourceCollection
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
            "from" => $perPage * ($currentPage - 1) + 1,
            "to" => $perPage * ($currentPage - 1) + $this->count(),

            'data' => $this->changeData(clone $this->collection),
        ];
    }

    public function changeData($collection)
    {
        $data = [];
        foreach ($this->collection as $key => $item) {
            $data[$key] = [
                'id' => $item->id,
                'score' => $item->score / 100,
                'crazy_id' => $item->crazy_id,
                'lesson' =>  $item->crazy->name,
                'course' =>  $item->crazy->crazyCourse->name,
                'created_at' =>  $item->created_at . "",
            ];
        }
        return $data;
    }
}
