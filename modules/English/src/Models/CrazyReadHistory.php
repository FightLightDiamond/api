<?php

namespace English\Models;


use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CrazyReadHistory extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'crazy_read_histories';
    public $fillable = ['user_id', 'crazy_id', 'score', 'type'];

    public function crazy()
    {
        return $this->belongsTo(Crazy::class, 'crazy_id', 'id');
    }

    public function filterCrazyCourseId($query, $value)
    {
        $crazyIds = Crazy::where('crazy_course_id', $value)->pluck('id');
        return $query->whereIn('crazy_id', $crazyIds);
    }
}

