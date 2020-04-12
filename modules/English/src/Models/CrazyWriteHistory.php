<?php

namespace English\Models;


use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CrazyWriteHistory extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'crazy_write_histories';
    public $fillable = ['user_id', 'crazy_id', 'score', 'type'];


    public function crazy()
    {
        return $this->belongsTo(Crazy::class, 'crazy_id', 'id');
    }
}

