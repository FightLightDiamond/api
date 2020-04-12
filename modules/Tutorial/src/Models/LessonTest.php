<?php

namespace Tutorial\Models;

use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class LessonTest extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'lesson_tests';
    public $fillable = ['lesson_id', 'question', 'reply1', 'reply2', 'reply3', 'reply4', 'answer',
        'is_active', 'created_by', 'updated_by'];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }

    public $fileUpload = ['image' => 1];
    protected $pathUpload = ['image' => '/images/lesson_tests'];
    protected $thumbImage = [
        'image' => [
            '/thumbs/' => [
                [200, 200], [300, 300], [400, 400]
            ]
        ]
    ];
    protected $checkbox = ['is_active'];
}

