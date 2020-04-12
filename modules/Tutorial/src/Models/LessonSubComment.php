<?php

namespace Tutorial\Models;

use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class LessonSubComment extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'lesson_sub_comments';
    public $fillable = ['lesson_comment', 'content', 'create_by', 'is_active'];

    public function scopeFilter($query, $input)
    {
        if(isset($input['lesson_comment'])) {
                $query->where('lesson_comment', $input['lesson_comment']); 
                }
if(isset($input['content'])) {
                $query->where('content', $input['content']); 
                }
if(isset($input['create_by'])) {
                $query->where('create_by', $input['create_by']); 
                }
if(isset($input['is_active'])) {
                $query->where('is_active', $input['is_active']); 
                }

        return $query;
    }


    public $fileUpload = ['image' => 1];
    protected $pathUpload = ['image' => '/images/lesson_sub_comments'];
    protected $thumbImage = [
        'image' => [
            '/thumbs/' => [
                [200, 200], [300, 300], [400, 400]
            ]
        ]
    ];
    protected $checkbox = ['is_active'];
}

