<?php

namespace Tutorial\Http\Resources;


use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
class LessonCommentResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.

     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

//        return [
//            'data' => $this->collection,
//            'links' => [
//                'self' => 'link-value',
//            ],
//        ];
        return [
            'id' => $this->id,
            'content' => $this->content,
//            'created_by' => $this->created_by,
            'created' => date_format($this->created_at, 'Y-m-d H:i:s'),
            'creator' => 'Fight Light Diamond',
            'upvote_count' => 0,
            'createdByCurrentUser' => $this->created_by,
            'user_has_upvoted' => false
        ];
//        return parent::toArray($request);

    }
}
