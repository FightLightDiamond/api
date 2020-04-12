<?php

namespace Tutorial\Models;

use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class LessonResult extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    protected $table = 'lesson_results';
    protected $fillable = ['created_by', 'lesson_id', 'score', 'time', 'replies', 'answers', 'status'];

    protected $hidden = ['answers'];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }
}

